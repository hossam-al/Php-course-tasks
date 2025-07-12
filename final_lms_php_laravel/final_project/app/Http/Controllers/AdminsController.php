<?php

namespace App\Http\Controllers;;

use App\Models\User;
use Pest\Support\Str;
use App\Models\Admin;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with("user")->get();

        if ($admins->isEmpty()) {
            $response = [

                'meesage' => 'not found data ',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $admins,
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

        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => "required|string",
            "email" => "required|email|unique:users,email",
            "position" => "required|string"
        ]);

        $password =  Str::random(10);
        $hashPassword = Hash::make($password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            "password" => $hashPassword,
            "type" => "admin"
        ]);

        $Admin = Admin::create([
            "position" => $request->position,
            "user_id" => $user->id,
        ]);

        // try {
        //     Mail::to($user->email)->send(new WelcomeMail($user, $password));
        // } catch (\Exception $e) {
        //     return redirect(route('admin.index', ['id' => $user->id]))->with("ERORR", "Send Mail Error");
        // }

        // return redirect(route('admin.index', ['id' => $user->id]))->with("success", "Send Mail Successfully");
        $response = [
            'data' =>    $Admin,
            'meesage' => 'create data successfuly',
            'status' => 201,
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $admin = Admin::with("user")->where("id", $id)->first();

        if ($admin  == null) {
            $response = [

                'meesage' => 'not found data ',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' =>  $admin,
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

        $admin = Admin::with("user")->where("id", $id)->first();

        return view('admin.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::with("user")->where("id", $id)->first();
        if ($admin == null) {
            $response = [

                'meesage' => 'not data found',
                'status' => 201,
            ];
        } else {

            $user_id = $admin->user->id;
            $request->validate([
                'name' => "required|string",
                "email" => "required|email|unique:users,email,$user_id",
                "position" => "required|string"
            ]);

            $admin->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $admin->update([
                "position" => $request->position,
            ]);

            $response = [
                'data' =>  $admin,
                'meesage' => 'update data successfuly',
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
    //     $admin = Admin::with("user")->where("id", $id)->first();
    //     $user  = User::where('id', $admin->user->id);
    //     if ($admin->user->image !== null) {
    //         $old_image = $user->image;
    //         $old_image_path = public_path('upload/') . $old_image;
    //         unlink($old_image_path);
    //     }

    //     $admin->delete();
    //     $user->delete();
    //     return redirect()->route('admin.index')->with("success", "Delete Successfully");
    // }

    public function destroy($id)
    {
        $admin = Admin::with("user")->where("id", $id)->first();


        if (!$admin) {
            return response([
                'message' => 'admin not found!',
                'status' => 404,
            ]);
        }

        $user = User::find($admin->user->id);

        $admin->delete();
        if ($user) {
            $user->delete();
        }

        return response([
            'data' => [
                'admin' => $admin,

            ],
            'message' => 'Deleted successfully',
            'status' => 200
        ]);
    }
}
