<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tax;

class taxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $tax = tax::select('taxes.id','taxes.name')->get();

         if($tax) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"  => $tax
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
         $tax = new tax;
        $tax->name = $request->name;
        $tax->cgst_name = $request->cgst_name;
        $tax->sgst_name = $request->sgst_name;
        $tax->igst_name = $request->igst_name;
        $tax->cgst_amount= $request->cgst_amt;
        $tax->sgst_amount= $request->sgst_amt;
        $tax->igst_amount= $request->igst_amt;
        $result= $tax->save();

         if($result) {
            return response()->json([
                'message' => "Data Inserted Successfully",
                "code"    => 200,
                
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
           
        return view('tax');
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
        $result = tax::where('id',$request->id)->first();
         
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
         $result =tax::where('id',$request->id)->update([
            'name'=>$request->edit_name,
            'cgst_name'=>$request->edit_cgst,
            'sgst_name'=>$request->edit_sgst,
            'igst_name'=>$request->edit_igst,
            'cgst_amount'=>$request->edit_camount,
            'sgst_amount'=>$request->edit_samount,
            'igst_amount'=>$request->edit_iamount

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
         $result = tax::where('id', $request->id)->delete();

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
