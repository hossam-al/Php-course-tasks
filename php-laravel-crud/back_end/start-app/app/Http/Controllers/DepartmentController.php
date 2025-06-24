<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // $department = Department::with('Employee')->paginate(10);

        $department = Department::orderBy('id', 'desc')->paginate(10);

        // return $employees;
        return view('department.index' , compact ('department'));  //compact يعني خد معاك array وانتا رايح صفحة index
    }
    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        //Department
        Department::create([
            'name' => $request->name,
            "description" => $request->description,
        ]);
        return redirect()->route("department.index")->with('success', "create department successfully");
    }

    public function show($id)
    {
        $department = Department::find($id);

        return view('department.show',compact('department'));
    }

    public function edit($id)
    {
        $department = Department::find($id);

        return view('department.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        Department::find($id)->update([
            'name' => $request->name,
            "description" => $request->description

        ]);
        return redirect()->route("department.index")->with('success', "update department successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       Department::destroy($id);
       return redirect()->route("department.index")->with('success', "delete department successfully");

    }
}
