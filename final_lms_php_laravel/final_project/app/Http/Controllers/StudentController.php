<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\group;
use App\Models\student;
use App\Mail\WelcomeMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $student = Student::with(['user', 'group.round'])->get();
        if ($student->isEmpty()) {
            $response = [

                'meesage' => 'not found data ',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $student,
                'meesage' => 'get data successfuly',
                'status' => 200,
            ];
        }

        return  response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = group::with('round')->get();
        return  view('admin.student.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string",
            "email" => "required|email|unique:users,email",
            "college" => "required|string",
            "degree" => "required|string",
            'group_id' => 'required'

        ]);

        $password =  Str::random(10);
        $hashPassword = Hash::make($password);
        $user =     User::create([
            'name' => $request->name,
            'email' => $request->email,
            "password" => $hashPassword,
            "type" => "student"
        ]);
        $student = student::create([
            'user_id' => $user->id,
            'college' => $request->college,
            'degree' => $request->degree,
            'group_id' => $request->group_id
        ]);
        Mail::to($user->email)->send(new WelcomeMail($user, $password));

        $response = [
            'data' => $student,
            'meesage' => 'create data successfuly',
            'status' => 201,
        ];

        return response($response, 201); // Add this line to return the response
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = student::with("user", 'group')->where("id", $id)->first();
        if ($student == null) {
            $response = [

                'meesage' => 'not found data ',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $student,
                'meesage' => 'get data successfuly',
                'status' => 200,
            ];
        }

        return  response($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $groups = group::with('round')->get();

        $student = student::with("user", "group")->where("id", $id)->first();
        return view('admin.student.edit', compact('student', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = student::with("user", 'group')->where("id", $id)->first();


        if ($student == null) {
            $response = [

                'meesage' => 'not data found',
                'status' => 201,
            ];
        } else {
            $user_id = $student->user->id;
            $request->validate([
                'name' => "required|string",
                "email" => "required|email|unique:users,email,$user_id",
                "college" => "required|string",
                "degree" => "required|string",
                'group_id' => 'required'

            ]);


            $student->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $student->update([
                'college' => $request->college,
                'degree' => $request->degree,
                'group_id' => $request->group_id
            ]);
            $response = [
                'data' => $student,
                'meesage' => 'get data successfuly',
                'status' => 201,
            ];
        }


        return response($response, 201); // Add this line to return the response
    }


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {

    //     $student = student::with("user")->where("id", $id)->first();
    //     $user  = User::where('id', $student->user->id);
    //     if ($student->user->image !== null) {
    //         $old_image = $user->image;
    //         $old_image_path = public_path('upload/') . $old_image;
    //         unlink($old_image_path);
    //     }

    //     $student->delete();
    //     $user->delete();
    //     return redirect()->route('student.index')->with("success", "Delete Successfully");
    // }
    public function destroy($id)
    {
        $student = Student::with("user")->where("id", $id)->first();

      
        if (!$student) {
            return response([
                'message' => 'Student not found!',
                'status' => 404,
            ]);
        }

        $user = User::find($student->user->id);

        $student->delete();
        if ($user) {
            $user->delete();
        }

        return response([
            'data' => [
                'student' => $student,

            ],
            'message' => 'Deleted successfully',
            'status' => 200
        ]);
    }
}
