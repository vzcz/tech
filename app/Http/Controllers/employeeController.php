<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeRequest;
use App\Models\Employee;
use App\Models\File;
use App\Models\User;
use App\Traits\employeeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class employeeController extends Controller
{
    use employeeTrait;

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
    ##################//Display employee files//##################
    public function files($id){
        $this->authorize('edit employee');

        $employees = Employee::with('File')->find($id);
        if(!$employees)
            return view('employee.files');

            return view('employee.files', compact('employees'));

    }
    ##################//Add employee files//##################
    public function storeFile(Request $request){
        $this->authorize('create employee');

        $validator = Validator::make($request->all(), [
            'file' => ['required','mimes:pdf,docx,png, document, jpeg, jpg, gif','max:2048']
            // file validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {

            // validation failed redirect back to form
            return redirect()->back()->with(["error"=>"You can only upload following files: pdf, docx, jpg, jpeg, png, gif"]);

        }
        else
        {
            $file_full_path = $this -> saveFile($request -> file, 'files/employee/' );
            File::create([
                "name"=>$file_full_path,
                "extension"=>$request->file->getClientOriginalExtension(),
                "employee_id"=>$request->id,
            ]);
            return redirect()->back()->with(["success"=>"Uploaded file successfully"]);

        }



    }

}
