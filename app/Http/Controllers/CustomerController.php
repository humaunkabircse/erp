<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('id','desc')->get();
       return view('pages.customer.index',compact('customers'));
    }

    // public function customerStatus(Request $request){
    //     if($request->mode == 'true'){
    //         DB::table('customers')->where('id',$request->id)->update(['status'=>'active']);
    //     }else{
    //         DB::table('customers')->where('id',$request->id)->update(['status'=>'inactive']);
    //     }

    //     return response()->json([
    //         'msg'=>'Status Successfully Updated',
    //         'status'=>true
    //     ]);
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.customer.create');
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
            'name' => 'required|string',
            'contact_number' => 'required|string',
            'country' => 'required|string',
            'district' => 'required|string',
            'zip' => 'required',
            'street' => 'required',
            'city' => 'required',
            'billing_country' => 'required|string',
            'billing_district' => 'required|string',
            'billing_zip' => 'required',
            'billing_street' => 'required',
            'billing_city' => 'required',
            'shipping_country' => 'required|string',
            'shipping_district' => 'required|string',
            'shipping_zip' => 'required',
            'shipping_street' => 'required',
            'shipping_city' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $status = Customer::create($data);
        if($status){
            return redirect()->route('customer.index')->with('status','Customer Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('pages.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'contact_number' => 'required|string',
            'country' => 'required|string',
            'district' => 'required|string',
            'zip' => 'required',
            'street' => 'required',
            'city' => 'required',
            'billing_country' => 'required|string',
            'billing_district' => 'required|string',
            'billing_zip' => 'required',
            'billing_street' => 'required',
            'billing_city' => 'required',
            'shipping_country' => 'required|string',
            'shipping_district' => 'required|string',
            'shipping_zip' => 'required',
            'shipping_street' => 'required',
            'shipping_city' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $customer = Customer::where('id',$id)->first();
        $status = $customer->fill($data)->save();
        if($status){
            return redirect()->route('customer.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
