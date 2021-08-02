<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bank_detail;
class bankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $bank = bank_detail::select('bank_details.id','bank_details.bank_name','bank_details.ifsc_code','bank_details.micr_code')->get();

        if($bank) {
            return response()->json([
                "message" => "Data Found Successfully",
                "code"    => 200,
                "data"    =>$bank,

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
        $bank = new bank_detail;

        $bank->bank_name =$request->bank_name;
        $bank->account_no= $request->acc_no;
        $bank->ifsc_code = $request->ifsc_code;
        $bank->micr_code = $request->micr_code;

        $result = $bank->save();

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
        return view('bank_details') ; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $result = bank_detail::where('id',$request->id)->first();
         
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
        $result =bank_detail::where('id',$request->id)->update([
            'bank_name'=>$request->edit_name,
            'account_no'=>$request->edit_acc,
            'ifsc_code' =>$request->edit_ifsc,
            'micr_code' =>$request->edit_micr
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
        $result = bank_detail::where('id', $request->id)->delete();

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
