<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = departments::all();
        if ($departments->isEmpty()) {
            $response = [
                'message' => 'no data found',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $departments,
                'message' => 'get data successfly',
                'status' => 200,
            ];
        }
        return response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate(['name' => 'required|string|min:2|max:50']);


        $departments = departments::create([
            'name' => $request->name

        ]);
        $response = [
            'data' => $departments,
            'message' => 'Create department successfully',
            'status' => 201,
        ];
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(departments $departments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(departments $departments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $departments = departments::find($id);

        if ($departments == null) {
            $response = [

                'meesage' => 'not found data!',
                'status' => 201,
            ];
        } else {

            $request->validate(['name' => 'required|string|min:2|max:50']);
            $departments = departments::find($id)->update([
                'name' => $request->name
            ]);


            $response = [
                'data' => $departments,
                'meesage' => 'update data successfuly',
                'status' => 201
            ];
        }
        return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
    {
        $departments = departments::find($id);
        if ($departments == null) {
            $response = [

                'meesage' => 'not found data!',
                'status' => 200,
            ];
        } else {
            $departments->delete();
            $response = [
                'data' => $departments,
                'meesage' => 'delete data successfuly',
                'status' => 200,
            ];
        }


        return response($response, 201);
    }
}
