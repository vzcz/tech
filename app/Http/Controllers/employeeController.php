<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class employeeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

    }
    ################## display all employees #################
    public function showEmployee(user $user){
        $this->authorize('read employee');
        $employees = Employee::select("id", "name", "age", "Country")->get();
            return view("employee.display", compact('employees'));

    }
    ############## Return form to add a new employee ###############
    public function addEmployee(User $user){
        $this->authorize('create employee');
        return view("employee.add");
    }

    ############## After click submit ###############
    public function store(employeeRequest $request){
        $this->authorize('create employee');
        Employee::create($request->validated());
        return redirect()->back()->with(["success"=>"Saved successfully"]);

    }
    ##############// Return form for employee update \\###############
    public function edit($id){
        $this->authorize('edit employee');
        Employee::findOrFail($id);
        $employee = Employee::get()->find($id);

        return view("employee.edit", compact('employee'));

    }

    #################//update employee//################### After click submit to update
    public function update(employeeRequest $request){
        $this->authorize('edit employee');
        $employee =  Employee::find($request->id);
        if(!$employee){
            return redirect()->back();
        }

        $employee->update($request->all());

        return redirect()->back()->with(["success"=>"Updated successfully"]);

    }

    ##################//delete employee//##################
    public function delete($id){
        $this->authorize('delete employee');
        $employee = Employee::find($id);

        if(!$employee){
            return redirect()->back()->with("error", 'Employee not exist');
        }
        $employee->where("id", $id)->delete();

        return redirect()->back()->with(["success"=>"Employee deleted successfully"]);


    }
}
