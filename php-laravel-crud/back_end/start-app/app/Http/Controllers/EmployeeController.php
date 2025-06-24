<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {

        $employees = Employee::with('department')->orderBy('id', 'desc')->paginate(10);

        // return $employees;
        return view('employees.index', compact('employees'));  //compact يعني خد معاك array وانتا رايح صفحة index
    }


    public function create()
    {
        $deparments = Department::all();
        return view('employees.create', compact('deparments'));
    }

    public function store(Request $request)

    {

        if ($request->hasFile("image")){
            $miga = 2 * 1024;

            $request->validate([
                'name' => "required|min:3|max:50|string|unique:employees,name",
                "salary" => "required|numeric",
                'image' => "required|file|max:$miga|mimes:png,jpg,jepg",
                'department_id' => "required|exists:departments,id",
            ]);
            $image_data = $request->file("image");

            $image_name = time() . $image_data->getClientOriginalName();
            $location = public_path('upload');
            $image_data->move($location, $image_name);

        }else{
            $image_name=null;
        }

        Employee::create([
            'name' => $request->name,
            "salary" => $request->salary,
            "image" => $image_name,
            "department_id" => $request->department_id

        ]);
        return redirect()->route("employee.index")->with('success', "create employee successfully");
    }

    public function show($id)
    {
        $employee=Employee::with("department")-> where('id','=',$id)->first();

        return view('employees.show', compact('employee'));
    }

public function edit($id)
{
    $employee = Employee::find($id);
    $deparments = Department::all();
    return view('employees.edit', compact('deparments','employee'));
}

    public function update(Request $request,$id)
    {

        if ($request->hasFile("image")){
            $miga = 2 * 1024;

            $request->validate([
                'name' => "required|min:3|max:50|string|unique:employees,name,$id",
                "salary" => "required|numeric",
                'image' => "required|file|max:$miga|mimes:png,jpg,jepg",
                'department_id' => "required|exists:departments,id",
            ]);
            $image_data = $request->file("image");

            $image_name = time() . $image_data->getClientOriginalName();
            $location = public_path('upload');
            $image_data->move($location, $image_name);

        }else{
            $image_name=null;
        }


        Employee::find($id)->update([
            'name' => $request->name,
            "salary" => $request->salary,
            "image" => $image_name,
            "department_id" => $request->department_id

        ]);
        return redirect()->route("employee.index")->with('success', "update employee successfully");

    }


    public function destroy($id)
    {
     Employee::destroy($id);
     return redirect()->route("employee.index")->with('success', "delete employee successfully");
    }
}
