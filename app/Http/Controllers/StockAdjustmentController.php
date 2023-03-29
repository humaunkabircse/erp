<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\StockAdjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class StockAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockAdjustments = StockAdjustment::orderBy('id','desc')->get();
        return view('pages.stock-adjustment.index',compact('stockAdjustments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Items::all();
        return view('pages.stock-adjustment.create',compact('items'));
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
            'item_id'=>'required',
            'stock_adjustment_date'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = StockAdjustment::create($data);
        if($status){
            return redirect()->route('stock.adjustment.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockAdjustment  $stockAdjustment
     * @return \Illuminate\Http\Response
     */
    public function show(StockAdjustment $stockAdjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockAdjustment  $stockAdjustment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stockAdjustment=StockAdjustment::findOrFail($id);
        $items = Items::all();
        return view('pages.stock-adjustment.edit',compact('stockAdjustment','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockAdjustment  $stockAdjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'item_id'=>'required',
            'stock_adjustment_date'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $stockAdjustment = StockAdjustment::findOrFail($id);
        $status = $stockAdjustment->fill($data)->save();
        if($status){
            return redirect()->route('stock.adjustment.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockAdjustment  $stockAdjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockAdjustment $stockAdjustment)
    {
        //
    }
}
