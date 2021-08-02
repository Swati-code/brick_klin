<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoice;

class invoice_productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $invoice = invoice::select('invoices.id','invoices.invoice_id','invoices.quantity','invoices.total_amount')->get();

         if($invoice) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"  => $invoice
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
        $invoice = new invoice;
        $invoice->invoice_id=$request->i_id;
        $invoice->tax_id=$request->tax_id;
        $invoice->tax_rate=$request->tax_rate;
        $invoice->cgst_amount=$request->cgst;
        $invoice->sgst_amount=$request->sgst;
        $invoice->igst_amount=$request->igst;
        $invoice->quantity=$request->quantity;
        $invoice->price=$request->price;
        $invoice->total_amount=$request->total;
        
        $result = $invoice->save();
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
       return view('sales_invoice_product') ;
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
         $result = invoice::where('id',$request->id)->first();
         
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
         $result =invoice::where('id',$request->id)->update([
            'invoice_id' => $request->edit_i_id,
            'tax_id'     => $request->edit_tax_id,
            'tax_rate'   => $request->edit_tax_rate,
            'cgst_amount'=> $request->edit_cgst,
            'sgst_amount'=> $request->edit_sgst, 
            'igst_amount'=> $request->edit_igst,
            'quantity'   => $request->edit_quantity,
            'price'      => $request->edit_price,
            'total_amount'=> $request->edit_total
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
        $result = invoice::where('id', $request->id)->delete();

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
