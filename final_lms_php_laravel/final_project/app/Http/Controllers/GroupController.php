<?php

namespace App\Http\Controllers;

use App\Models\group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $group = group::with('instructors','round')->get();
        $group=group::all();
        if ($group->isEmpty()) {
            $response = [
                'message' => 'no data found',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $group,
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
        $request->validate(['name'=>'required|string|min:2|max:50','round_id'=>'required','insructors_id'=>'required']);

        $group = group::create([
            'name' => $request->name,
            'round_id' => $request->round_id,
            'insructors_id' => $request->insructors_id,

        ]);
        $response = [
            'data' => $group,
            'message' => 'Create group successfully',
            'status' => 201,
        ];
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
$group = group::find($id);

        if ($group == null) {
            $response = [

                'meesage' => 'not found data!',
                'status' => 201,
            ];
        } else {

        $request->validate(['name'=>'required|string|min:2|max:50','round_id'=>'required','insructors_id'=>'required']);
            $group = group::find($id)->update([
                'name' => $request->name,
            'round_id' => $request->round_id,
            'insructors_id' => $request->insructors_id,
            ]);


            $response = [
                'data' => $group,
                'meesage' => 'update data successfuly',
                'status' => 201
            ];
        }
        return response($response, 201);    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
 $group = group::find($id);
        if ($group == null) {
            $response = [

                'meesage' => 'not found data!',
                'status' => 200,
            ];
        } else {
            $group->delete();
            $response = [
                'data' => $group,
                'meesage' => 'delete data successfuly',
                'status' => 200,
            ];
        }


        return response($response, 201);    }
}
