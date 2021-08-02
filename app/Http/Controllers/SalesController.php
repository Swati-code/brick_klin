<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sales;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $sales = sales::select('sales.id','sales.customer_id','sales.invoice_number','sales.total_amount')->get();

         if($sales) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"  => $sales
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
        $sales = new sales;
        $sales->customer_id=$request->c_id;
        $sales->vehicle_no=$request->vehicle_no;
        $sales->invoice_number=$request->invoice;
        $sales->invoice_date=$request->inv_date;
        $sales->amount_before_tax=$request->amtbefore;
        $sales->cgst_amount=$request->cgst;
        $sales->sgst_amount=$request->sgst;
        $sales->igst_amount=$request->igst;
        $sales->amount_after_tax=$request->amtafter;
        $sales->cgcr=$request->cgcr;
        $sales->freight=$request->freight;
        $sales->labour_tax=$request->labour;
        $sales->total_amount=$request->total;
        
        $result = $sales->save();
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
        return view('sales_invoice');
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
         $result = Sales::where('id',$request->id)->first();
         
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
        $result =sales::where('id',$request->id)->update([
            'customer_id'       => $request->edit_c_id,
            'vehicle_no'        => $request->edit_vehicle_no,
            'invoice_number'    => $request->edit_invoice,
            'invoice_date'      => $request->edit_inv_date,
            'amount_before_tax' => $request->edit_amtbefore, 
            'amount_after_tax'  => $request->edit_amtafter,
            'cgcr'              => $request->edit_cgcr,
            'freight'           => $request->edit_freight,
            'labour_tax'        => $request->edit_labour,
            'total_amount'      => $request->edit_total
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
         $result = sales::where('id', $request->id)->delete();

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
