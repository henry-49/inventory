<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // using Eloquent model fetch all supplier
        $supplier = Supplier::all();
        return response()->json($supplier);
        
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
            // name & email should be unique in the suppliers table
            'name'  => 'required|unique:suppliers|max:255',
            'email' => 'required|unique:suppliers',
            'phone'  => 'required|unique:suppliers',
        ]);

        if ($request->photo) {
            // defining position of the image
            $position = strpos($request->photo, ';');
            // taking the  image path before the semikolon starting from 0
            $sub = substr($request->photo, 0, $position);
            // explode the sub by removing slash '/' and take index 1
            $exp =  explode('/', $sub)[1];

            // create unique name for the image
            $name = time() . "." . $exp;
            //  resize image
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path . $name;
            $img->save($image_url);


            
            $supplier = new Supplier();
            $supplier->name    = $request->name;
            $supplier->email   = $request->email;
            $supplier->phone   =  $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname  = $request->shopname;
            $supplier->photo =  $image_url;
            $supplier->save();
        } else {

            $supplier = new Supplier();
            $supplier->name     = $request->name;
            $supplier->email    = $request->email;
            $supplier->phone    =  $request->phone;
            $supplier->address  = $request->address;
            $supplier->shopname  =  $request->shopname;
            $supplier->save();
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
        //shows suppliers data
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        return response()->json($supplier);
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
        //udate supplier
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shopname'] = $request->shopname;
        $image = $request->newphoto;

        // Updating new Image
        if ($image) {
            // defining position of the image
            $position = strpos($image, ';');
            // taking the  image path before the semikolon starting from 0
            $sub = substr($image, 0, $position);
            // explode the sub by removing slash '/' and take index 1
            $exp =  explode('/', $sub)[1];

            // create unique name for the image
            $name = time() . "." . $exp;
            //  resize image
            $img = Image::make($image)->resize(240, 200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path . $name;
            // save newly uploaded image    
            $success = $img->save($image_url);
            if ($success) {
                $data['photo'] = $image_url;
                // select the first data from suppliers table
                $img = DB::table('suppliers')->where('id', $id)->first();
                $image_path = $img->photo;
                // unlink the old image
                $done = unlink($image_path); // delete old image
                $user = DB::table('suppliers')->where('id', $id)->update($data);
            }
        } else {
            // else keep the old Image
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('suppliers')->where('id', $id)->update($data);
        }    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // select the first data from supplier table
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        $photo = $supplier->photo;
        // if the selected supplier field has any photo then unlink it
        if ($photo) {
            unlink($photo); // delete photo
            DB::table('suppliers')->where('id', $id)->delete();
        } else {
            // delete all data
            DB::table('suppliers')->where('id', $id)->delete();
        }
    }
}
