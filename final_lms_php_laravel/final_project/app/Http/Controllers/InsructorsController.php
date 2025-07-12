<?php

namespace App\Http\Controllers;

use App\Models\insructors;
use Illuminate\Http\Request;
use App\Models\departments;
use App\Models\User;
use Pest\Support\Str;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class InsructorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insructors = insructors::with("user", 'departments')->get();
        if ($insructors->isEmpty()) {
            $response = [

                'meesage' => 'not found data ',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $insructors,
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
        $departments = departments::all();
        return view('admin.instructors.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string",
            "email" => "required|email|unique:users,email",
            "track" => "required|string",
            "linkedin" => "required|url",
            'departments_id' => 'required'

        ]);

        $password =  Str::random(10);
        $hashPassword = Hash::make($password);
        $user =     User::create([
            'name' => $request->name,
            'email' => $request->email,
            "password" => $hashPassword,
            "type" => "instructors"
        ]);

        $insructors =  insructors::create([
            "track" => $request->track,
            "user_id" => $user->id,
            "linkedin" => $request->linkedin,
            "departments_id" => $request->departments_id,

        ]);

        Mail::to($user->email)->send(new WelcomeMail($user, $password));

        $response = [
            'data' => $insructors,
            'meesage' => 'create data successfuly',
            'status' => 201,
        ];

        return response($response, 201); // Add this line to return the response
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $insructors = insructors::with("user", 'departments')->where("id", $id)->first();
    //     if ($insructors == null) {
    //         $response = [

    //             'meesage' => 'not found data ',
    //             'status' => 200,
    //         ];
    //     } else {
    //         $response = [
    //             'data' =>  $insructors,
    //             'meesage' => 'get data successfuly',
    //             'status' => 200,
    //         ];
    //     }

    //     return  response($response, 200);
    // }
    public function show($id)
{
   $insructors = insructors::with("user", 'departments')->where("id", $id)->first();
        if ($insructors == null) {
            $response = [

                'meesage' => 'not found data ',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $insructors,
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
        $department = departments::all();
        $instructors = insructors::with("user", "departments")->where("id", $id)->first();

        return view('admin.instructors.edit', compact('instructors', 'department'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $instructors = insructors::with("user")->where("id", $id)->first();

 if ($instructors == null) {
            $response = [

                'meesage' => 'not data found',
                'status' => 201,
            ];
        } else {
             $user_id = $instructors->user->id;
        $request->validate([
            'name' => "required|string",
            "email" => "required|email|unique:users,email,$user_id",
            "track" => "required|string",
            "linkedin" => "required|url",
            'department' => 'required'

        ]);

        $instructors->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $instructors->update([
            "track" => $request->track,
            "linkedin" => $request->linkedin,
            "departments_id" => $request->department,
        ]);
 $response = [
                'data' => $instructors,
                'meesage' => 'get data successfuly',
                'status' => 201,
            ];
        }
        return response($response, 201); // Add this line to return the response
    }

    /**
     * Remove the specified resource from storage.
     */



public function destroy($id)
    {
        $insructors = insructors::with("user")->where("id", $id)->first();


        if (!$insructors) {
            return response([
                'message' => 'insructors not found!',
                'status' => 404,
            ]);
        }

        $user = User::find($insructors->user->id);

        $insructors->delete();
        if ($user) {
            $user->delete();
        }

        return response([
            'data' => [
                'insructors' => $insructors,

            ],
            'message' => 'Deleted successfully',
            'status' => 200
        ]);
    }
}


//     public function destroy($id)
//     {

//         $instructors = insructors::with("user")->where("id", $id)->first();
//         $user  = User::where('id', $instructors->user->id);
//         if ($instructors->user->image !== null) {
//             $old_image = $user->image;
//             $old_image_path = public_path('upload/') . $old_image;
//             unlink($old_image_path);
//         }

//         $instructors->delete();
//         $user->delete();
//         return redirect()->route('instructor.index')->with("success", "Delete Successfully");
//     }
// }
