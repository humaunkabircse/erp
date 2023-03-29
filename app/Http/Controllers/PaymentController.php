<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\BankName;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('id','desc')->get();
        return view('pages.payment.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $paymentMode = PaymentMode::where('status','active')->get();
        $bankName = BankName::all();
        $agents = Agent::all();
        return view('pages.payment.create',compact('customers','paymentMode','bankName','agents'));
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
            'cus_id'=>'required',
            'pay_mode'=>'required',
            'pay_date'=>'required',
            'pay_receive_by'=>'required',
            'pay_amount'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = Payment::create($data);
        if($status){
            return redirect()->route('payment.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::all();
        $paymentMode = PaymentMode::where('status','active')->get();
        $bankName = BankName::all();
        $agents = Agent::all();
        $payment =  Payment::where('id',$id)->first();
      return view('pages.payment.edit',compact('payment','customers','paymentMode','bankName','agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'cus_id'=>'required',
            'pay_mode'=>'required',
            'cheque_no'=>'required',
            'cheque_date'=>'required',
            'bank_name_id'=>'required',
            'pay_date'=>'required',
            'pay_receive_by'=>'required',
            'pay_amount'=>'required',
            'pay_note'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $payment = Payment::findOrFail($id);
        $status = $payment->fill($data)->save();
        if($status){
            return redirect()->route('payment.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
