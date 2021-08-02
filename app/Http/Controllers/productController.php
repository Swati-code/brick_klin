<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;
class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prod = Product::select('products.id','products.name','cat.category_name','products.description')->join('categories as cat','cat.id','=','products.category')->get();

        if($prod) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"  => $prod
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }

    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $prod = new Product;
        $prod->name = $request->name;
        $prod->product_code = $request->code;
        $prod->category = $request->category;
        $prod->tax_id = $request->tax;
        $prod->hsn_id = $request->hsn;
        $prod->price  = $request->price;
        $prod->description = $request->description;
        

        $result = $prod->save();
        if($result) {
            return response()->json([
                'message' => "Data Inserted Successfully",
                "code"    => 200
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
         $cat = category::select('categories.id','categories.category_name')->get();
          return view('products',['cat'=>$cat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $result = Product::where('id',$request->id)->first();
         
        if($result) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"    =>$result  
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    
        
    //
        $result = Product::where('id',$request->id)->update([
            'name'        => $request->edit_name,
            'product_code'=>$request->edit_code,
            'tax_id'      =>$request->edit_tax,
            'hsn_id'      =>$request->edit_hsn,
            'price'       =>$request->edit_price,
            'description' =>$request->edit_description
            ]);

        if($result){
            return response()->json([
                'message' => "Data Updated Successfully",
                'code' => 200,
            ]);

        }else{
            return response()->json([
                'message' => "Internal Server Error",
                'code'=>500
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
         $result = Product::where('id', $request->id)->delete();

        if($result) {
            return response()->json([
                'message' => "Data Deleted Successfully!",
                "code"    => 200,
            ]);
        } else{
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
}
