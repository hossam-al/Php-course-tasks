<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::all();
        if ($products->isEmpty()) {
            $response = [

                'meesage' => 'no found data',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $products,
                'meesage' => 'get data successfuly',
                'status' => 200,
            ];
        }


        return response($response, 200);
    }


    /**


     */
    public function store(Request $request)
    {
        $miga = 2 * 1024;
        $request->validate([
            'titel' => "required|string",
            'description' => "required|min:3|max:100",
            'image' => "required|file|max:$miga",
            'price' => "required|numeric|min:100|max:50000"
        ]);
        if ($request->hasFile('image')) {
            $image_data = $request->file('image');
            $image_name = time() . $image_data->getClientOriginalName();
            $loction = public_path('upload');
            $image_data->move($loction, $image_name);
        } else {
            $image_name = null;
        }
        $product = product::create([
            'titel' => $request->titel,
            'description' => $request->description,
            'image' => $image_name,
            'price' => $request->price
        ]);



        $response = [
            'data' => $product,
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
        $products = product::find($id);
        if ($products == null) {
            $response = [

                'meesage' => 'no found data',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $products,
                'meesage' => 'get data successfuly',
                'status' => 200,
            ];
        }


        return response($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $miga = 2 * 1024;
        $request->validate([
            'titel' => "required|string",
            'description' => "required|min:3|max:100",
            'image' => "required|file|max:$miga",
            'price' => "required|numeric|min:100|max:50000"
        ]);
        if ($request->hasFile('image')) {
            $image_data = $request->file('image');
            $image_name = time() . $image_data->getClientOriginalName();
            $loction = public_path('upload');
            $image_data->move($loction, $image_name);
        } else {
            $image_name = null;
        }
        $product = product::find($id);
        if ($product == null) {
            $response = [

                'meesage' => 'not found data!',
                'status' => 201,
            ];
        } else {
            $products = product::find($id)->update([
                'titel' => $request->titel,
                'description' => $request->description,
                'image' => $image_name,
                'price' => $request->price
            ]);



            $response = [
                'data' => $products,
                'meesage' => 'update data successfuly',
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
        $product = product::find($id);
        if ($product == null) {
            $response = [

                'meesage' => 'not found data!',
                'status' => 200,
            ];
        } else {
            $product->delete();
            $response = [
                'data' => $product,
                'meesage' => 'delete data successfuly',
                'status' => 200,
            ];
        }


        return response($response, 201);
    }
}
