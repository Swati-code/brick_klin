<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer = Customer::select('customers.id','customers.name','customers.address','customers.vehicle_no')->get();

         if($customer) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"  => $customer
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
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->email= $request->email;
        $customer->gst_no = $request->gst_no;
        $customer->state= $request->state;
        $customer->state_code = $request->state_code;
        $customer->vehicle_no= $request->vehicle_no;

        $result = $customer->save();

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
        return view('customer_details');
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
        $result = Customer::where('id',$request->id)->first();
         
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
        $result =Customer::where('id',$request->id)->update([
            'name'=>$request->edit_name,
            'address'=>$request->edit_address,
            'email' =>$request->edit_email,
            'gst_no'   =>$request->edit_gstno,
            'state'   =>$request->edit_state, 
            'state_code'=>$request->edit_statecode,
            'vehicle_no'=>$request->edit_vehicle_no,
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
        $result = Customer::where('id', $request->id)->delete();

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
