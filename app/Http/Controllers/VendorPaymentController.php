<?php

namespace App\Http\Controllers;

use App\Models\VendorPayment;
use Illuminate\Http\Request;
use App\Models\BankName;
use App\Models\PaymentMode;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class VendorPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendorPayments = VendorPayment::orderBy('id','desc')->get();
        return view('pages.vendor-payment.index',compact('vendorPayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::all();
        $paymentMode = PaymentMode::where('status','active')->get();
        $bankName = BankName::all();
        return view('pages.vendor-payment.create',compact('vendors','paymentMode','bankName'));
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
            'vendor_id'=>'required',
            'pay_mode'=>'required',
            'pay_date'=>'required',
            'pay_amount'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = VendorPayment::create($data);
        if($status){
            return redirect()->route('vendor.payment.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function show(VendorPayment $vendorPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendors = Vendor::all();
        $paymentMode = PaymentMode::where('status','active')->get();
        $bankName = BankName::all();
        $vendorPayment =  VendorPayment::where('id',$id)->first();
      return view('pages.vendor-payment.edit',compact('vendorPayment','vendors','paymentMode','bankName'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id'=>'required',
            'pay_mode'=>'required',
            'pay_date'=>'required',
            'pay_amount'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $vendorPayment = VendorPayment::findOrFail($id);
        $status = $vendorPayment->fill($data)->save();
        if($status){
            return redirect()->route('vendor.payment.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorPayment $vendorPayment)
    {
        //
    }
}
