<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // using Eloquent model fetch all employee
        $employee = Employee::all();
        return response()->json($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // validate data
        $validateData = $request->validate([
             // name & email should be unique in the employee table
            'name'  => 'required|unique:employees|max:255',
            'email' => 'required|unique:employees',
            'phone'  => 'required|unique:employees',
        ]);

       if($request->photo){
            // defining position of the image
             $position = strpos($request->photo, ';');
            // taking the  image path before the semikolon starting from 0
            $sub = substr($request->photo, 0, $position);
             // explode the sub by removing slash '/' and take index 1
            $exp =  explode('/', $sub)[1];

             // create unique name for the image
             $name = time().".".$exp;
            //  resize image
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);


            $employee = new Employee();
            $employee->name    = $request->name;
            $employee->email   = $request->email;
            $employee->phone   =  $request->phone;
            $employee->salary  = $request->salary;
            $employee->address = $request->address;
            $employee->nid     =    $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->photo =  $image_url;
            $employee->save();

       }else{

            $employee = new Employee();
            $employee->name     = $request->name;
            $employee->email    = $request->email;
            $employee->phone    =  $request->phone;
            $employee->salary   = $request->salary;
            $employee->address  = $request->address;
            $employee->nid      =    $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->save();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      $employee = DB::table('employees')->where('id',$id)->first();
       return response()->json($employee);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
