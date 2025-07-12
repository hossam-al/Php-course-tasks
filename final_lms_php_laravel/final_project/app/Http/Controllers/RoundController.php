<?php

namespace App\Http\Controllers;

use App\Models\round;
use Illuminate\Http\Request;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $round = round::all();
        if ($round->isEmpty()) {
            $response = [

                'meesage' => 'no found data',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $round,
                'meesage' => 'get data successfuly',
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
  $request->validate(['name']);

        $round = round::create([
            'titel' => $request->titel,
            'description'=>$request->description

        ]);
        $response = [
            'data' => $round,
            'message' => 'Create round successfully',
            'status' => 201,
        ];
        return response($response, 201);
      }

    /**
     * Display the specified resource.
     */
    public function show(round $round)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(round $round)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
           $round = round::find($id);

        if ($round == null) {
            $response = [

                'meesage' => 'not found data!',
                'status' => 201,
            ];
        } else {

            $request->validate(['titel' => 'required|string|min:2|max:50','description'=>'required|string|min:5|max:100']);
            $round = round::find($id)->update([
                'titel' => $request->titel,
                'description'=>$request->description
            ]);


            $response = [
                'data' => $round,
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
       $round = round::find($id);
        if ($round == null) {
            $response = [

                'meesage' => 'not found data!',
                'status' => 200,
            ];
        } else {
            $round->delete();
            $response = [
                'data' => $round,
                'meesage' => 'delete data successfuly',
                'status' => 200,
            ];
        }


        return response($response, 201);
    }
}
