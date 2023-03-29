<?php

namespace App\Http\Controllers;

use App\Models\CollectionAdjustment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class CollectionAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectionAdjustments = CollectionAdjustment::orderBy('id','desc')->get();
        return view('pages.collection-adjustment.index',compact('collectionAdjustments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('pages.collection-adjustment.create',compact('customers'));
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
            'collection_adjustment_date'=>'required',
            'collection_adjustment_amount'=>'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = CollectionAdjustment::create($data);
        if($status){
            return redirect()->route('collection.adjustment.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CollectionAdjustment  $collectionAdjustment
     * @return \Illuminate\Http\Response
     */
    public function show(CollectionAdjustment $collectionAdjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CollectionAdjustment  $collectionAdjustment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collectionAdjustment=CollectionAdjustment::findOrFail($id);
        $customers = Customer::all();
        return view('pages.collection-adjustment.edit',compact('collectionAdjustment','customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CollectionAdjustment  $collectionAdjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cus_id'=>'required',
            'collection_adjustment_date'=>'required',
            'collection_adjustment_amount'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $collectionAdjustment = CollectionAdjustment::findOrFail($id);
        $status = $collectionAdjustment->fill($data)->save();
        if($status){
            return redirect()->route('collection.adjustment.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CollectionAdjustment  $collectionAdjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectionAdjustment $collectionAdjustment)
    {
        //
    }
}
