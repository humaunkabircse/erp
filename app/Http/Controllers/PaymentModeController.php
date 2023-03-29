<?php

namespace App\Http\Controllers;

use App\Models\PaymentMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PaymentModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentModes = PaymentMode::orderBy('id','desc')->get();
        return view('pages.payment-mode.index',compact('paymentModes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pages.payment-mode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pay_mode'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = PaymentMode::create($data);
        if($status){
            return redirect()->route('payment.mode.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMode  $paymentMode
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMode $paymentMode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMode  $paymentMode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentMode =  PaymentMode::where('id',$id)->first();
      return view('pages.payment-mode.edit',compact('paymentMode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMode  $paymentMode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'pay_mode'=>'required',
            'pay_note'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $paymentMode = PaymentMode::findOrFail($id);
        $status = $paymentMode->fill($data)->save();
        if($status){
            return redirect()->route('payment.mode.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMode  $paymentMode
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMode $paymentMode)
    {
        //
    }
}
