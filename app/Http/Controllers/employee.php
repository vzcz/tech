<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeRequest;
use App\Models\User;
use Illuminate\Http\Request;

class employee extends Controller
{
    public function showEmployee(){
        $employees = \App\Models\Employee::select("id", "name", "age", "Country")->get();
        return view("employee.display", compact('employees'));
    }
    public function addEmployee(){
            return view("employee.add");
    }
    public function store(employeeRequest $request){
        \App\Models\Employee::create([
           'name'=>$request->name,
           'age'=>$request->age,
           'country'=>$request->country
        ]);
        return redirect()->back()->with(["success"=>"Saved successfully"]);

    }
//    public function edit($id){
//
////        $employee = employee::find($id)->get();
//        return "dd";
//
//    }
}
