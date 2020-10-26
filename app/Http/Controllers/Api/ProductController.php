<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // using Eloquent model fetch all product
        $product = DB::table('products')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('suppliers', 'products.supplier_id', 'suppliers.id')
                    ->select('categories.category_name', 'suppliers.name', 'products.*')
                    ->orderBy('products.id', 'DESC')
                    ->get();
                    return response()->json($product);
        
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
            // product_name & product_code should be unique in the products table
            'product_name'  => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id'  => 'required',
            'supplier_id'  => 'required',
            'buying_price'  => 'required',
            'selling_price'  => 'required',
            'buying_date'  => 'required',
            'product_quantity'  => 'required',
        ]);


        if ($request->image) {
            // defining position of the image
            $position = strpos($request->image, ';');
            // taking the  image path before the semikolon starting from 0
            $sub = substr($request->image, 0, $position);
            // explode the sub by removing slash '/' and take index 1
            $exp =  explode('/', $sub)[1];

            // create unique name for the image
            $name = time() . "." . $exp;
            //  resize image
            $img = Image::make($request->image)->resize(240, 200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path . $name;
            $img->save($image_url);


            $product = new Product();
            $product->category_id   =  $request->category_id;
            $product->product_name  = $request->product_name;
            $product->product_code  = $request->product_code;
            $product->root   = $request->root;    // stock
            $product->buying_price = $request->buying_price;
            $product->selling_price =  $request->selling_price;
            $product->supplier_id  = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->image =  $image_url;
            $product->save();
        } else {

            $product = new Product();
            $product->category_id   =  $request->category_id;
            $product->product_name    = $request->product_name;
            $product->product_code   = $request->product_code;
            $product->root   = $request->root; 
            $product->buying_price = $request->buying_price;
            $product->selling_price   =  $request->selling_price;
            $product->supplier_id  = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;;
            $product->save();
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
