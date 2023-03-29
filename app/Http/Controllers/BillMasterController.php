<?php

namespace App\Http\Controllers;

use App\Models\BillDetails;
use App\Models\BillMaster;
use App\Models\InvoiceMaster;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class BillMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billMasters = BillMaster::orderBy('id','desc')->get();
        return view('pages.bill-master.index',compact('billMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = InvoiceMaster::all();
        $items = Items::where('status','active')->get();
        return view('pages.bill-master.create',compact('invoices','items'));
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
            'bill_date' => 'required',
            'invoice_id' => 'required',
            'item_id'=>'required',
            'item_qty'=>'required',
            'item_price'=>'required',
        ]);

        if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $billMaster = new BillMaster();
        $billMaster->bill_number=$request->bill_number;
        $billMaster->bill_date=$request->bill_date;
        $billMaster->invoice_id=$request->invoice_id;
        $billMaster->bill_note=$request->bill_note;
        $billMaster->entered_by=auth()->id();
        $billMaster->date_entered=Carbon::now()->format('Y-m-d');

        DB::transaction(function () use ($billMaster, $request) { 
            if($billMaster->save()){
                $count_item = count($request->item_id);
                if($count_item>0){                       
                    for ($i = 0; $i < $count_item; $i++) {
                    $billDetails 				=   new BillDetails();
                    $billDetails->bill_id       =   $billMaster->id;
                    $billDetails->invoice_id    =   $request->invoice_id;
                    $billDetails->item_id	    =   $request->item_id[$i];
                    $billDetails->item_qty      =   $request->item_qty[$i];
                    $billDetails->item_price    =   $request->item_price[$i];
                    $billDetails->discount      =   $request->discount[$i];
                    $billDetails->created_at	=   date('Y-m-d', strtotime($request->bill_date));
                    $billDetails->save();   
                    }   
                }
            }
            
        });
        return redirect()->route('bill.master.index')->with('success', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillMaster  $billMaster
     * @return \Illuminate\Http\Response
     */
    public function show(BillMaster $billMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillMaster  $billMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Items::where('status','active')->get(); 
       $billMaster = BillMaster::where('id',$id)->first();
       $invoices = InvoiceMaster::all();
       return view('pages.bill-master.edit',compact('billMaster','items','invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillMaster  $billMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $billMaster   = BillMaster::find($id);
        if($billMaster){
            $billMaster->bill_number = $request->bill_number;
            $billMaster->bill_date = $request->bill_date;
            $billMaster->invoice_id = $request->invoice_id;
            $billMaster->bill_note = $request->bill_note;
            $billMaster->updated_by = auth()->id();
            $billMaster->date_updated = Carbon::now()->format('Y-m-d');
            $billMaster->save();
        }
        DB::table('bill_details')->where('bill_id', '=', $id)->delete();               
                $count_item = count($request->item_id);
                if($count_item>0){                       
                    for ($i = 0; $i < $count_item; $i++) {
                    $billDetails 				=   new BillDetails();
                    $billDetails->bill_id	    =   $id;
                    $billDetails->invoice_id	=  $request->invoice_id;
                    $billDetails->item_id	    =   $request->item_id[$i];
                    $billDetails->item_qty      =   $request->item_qty[$i];
                    $billDetails->discount      =   $request->discount[$i];
                    $billDetails->item_price    =   $request->item_price[$i];
                    $billDetails->updated_at    =   Carbon::now()->format('Y-m-d');
                    $billDetails->save();   
                    }
    
                }
    

        return redirect()->route('bill.master.index')->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillMaster  $billMaster
     * @return \Illuminate\Http\Response
     */
    public function billPreview($id){
        $id = $id;
        $customerinfo = DB::table('bill_masters')
                         ->join('invoice_masters','bill_masters.invoice_id','=','invoice_masters.id')
                        ->join('customers','invoice_masters.cus_id','=','customers.id')
                        ->select('customers.*')
                        ->where('bill_masters.id', $id)
                        ->first();
        $invoice = DB::table('bill_masters')
                        ->join('invoice_masters','bill_masters.invoice_id','=','invoice_masters.id')
                        ->select('invoice_masters.*')
                        ->where('bill_masters.id', $id)
                        ->first();
        $billMasterInfo = DB::table('bill_masters')->where('id',$id)->first();

        $billDetails = DB::table('bill_masters')
                        ->join('bill_details','bill_masters.id', '=', 'bill_details.bill_id')
                        ->join('items','items.id', '=', 'bill_details.item_id')
                        ->where('bill_masters.id',$id)
                        ->select('bill_masters.*','bill_details.*','items.item_name')->get();
        return view('pages.bill-master.bill-preview',compact('billDetails','customerinfo','billMasterInfo','invoice','id'));
    }
    public function billPrint($id){
        $customerinfo = DB::table('bill_masters')
                        ->join('invoice_masters','bill_masters.invoice_id','=','invoice_masters.id')
                        ->join('customers','invoice_masters.cus_id','=','customers.id')
                        ->select('customers.*')
                        ->where('bill_masters.id', $id)
                        ->first();
        $invoice = DB::table('bill_masters')
                        ->join('invoice_masters','bill_masters.invoice_id','=','invoice_masters.id')
                        ->select('invoice_masters.*')
                        ->where('bill_masters.id', $id)
                        ->first();
        $billMasterInfo = DB::table('bill_masters')->where('id',$id)->first();

        $billDetails = DB::table('bill_masters')
                        ->join('bill_details','bill_masters.id', '=', 'bill_details.bill_id')
                        ->join('items','items.id', '=', 'bill_details.item_id')
                        ->where('bill_masters.id',$id)
                        ->select('bill_masters.*','bill_details.*','items.item_name')->get();
                     
        return view('pages.bill-master.bill-print',compact('billDetails','customerinfo','billMasterInfo','invoice'));
    }


    public function destroy(BillMaster $billMaster)
    {
        //
    }
}
