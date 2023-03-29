<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\ReceiveMaster;
use App\Models\ReceiveDetails;
use App\Models\ReceiveType;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ReceiveMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receiveMasters = ReceiveMaster::orderBy('id','desc')->get();
        return view('pages.receive-master.index',compact('receiveMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $receiveTypes=ReceiveType::all();
        $vendors = Vendor::all();
        $items = Items::all();
        return view('pages.receive-master.create',compact('receiveTypes','vendors','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $receiveMaster = new ReceiveMaster();
        $receiveMaster->rec_type_id=$request->rec_type_id;
        $receiveMaster->vendor_id=$request->vendor_id;
        $receiveMaster->rec_invoice_number=$request->rec_invoice_number;
        $receiveMaster->rec_date=$request->rec_date;
        $receiveMaster->rec_by=$request->rec_by;
        $receiveMaster->discount=$request->discount;
        $receiveMaster->adjustment_qty=$request->adjustment_qty;
        $receiveMaster->rec_note=$request->rec_note;
        $receiveMaster->entered_by=auth()->id();
        $receiveMaster->date_entered=Carbon::now()->format('Y-m-d');

        DB::transaction(function () use ($receiveMaster, $request) {
            if($receiveMaster->save()){
                $count_item = count($request->item_id);
                if($count_item>0){                       
                    for ($i = 0; $i < $count_item; $i++) {
                    $receiveDetails 				=   new ReceiveDetails();
                    $receiveDetails->rec_master_id  =   $receiveMaster->id;
                    $receiveDetails->item_id	    =   $request->item_id[$i];
                    $receiveDetails->item_qty       =   $request->item_qty[$i];
                    $receiveDetails->item_price     =   $request->item_price[$i];
                    $receiveDetails->created_at		=   date('Y-m-d', strtotime($request->rec_date));
                    $receiveDetails->save();   
                    }
    
                }
            }
            
        });
        return redirect()->route('receive.master.index')->with('success', 'Created successfully!');

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceiveMaster  $receiveMaster
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiveMaster $receiveMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiveMaster  $receiveMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $receiveTypes=ReceiveType::all();
        $vendors = Vendor::all();
        $items = Items::all();  
       $receiveMaster = ReceiveMaster::where('id',$id)->first();
       return view('pages.receive-master.edit',compact('receiveMaster','receiveTypes','vendors','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReceiveMaster  $receiveMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {    
        $receiveMaster   = ReceiveMaster::find($id);
        DB::table('receive_details')->where('rec_master_id', '=', $id)->delete();               
                $count_item = count($request->item_id);
                if($count_item>0){                       
                    for ($i = 0; $i < $count_item; $i++) {
                    $receiveDetails 				=   new ReceiveDetails();
                    $receiveDetails->rec_master_id  =   $receiveMaster->id;
                    $receiveDetails->item_id	    =   $request->item_id[$i];
                    $receiveDetails->item_qty       =   $request->item_qty[$i];
                    $receiveDetails->item_price     =   $request->item_price[$i];
                    $receiveDetails->created_at		=   date('Y-m-d', strtotime($request->rec_date));
                    $receiveDetails->save();   
                    }
    
                }
    

        return redirect()->route('receive.master.index')->with('success', 'Updated successfully!');

    }

    public function receiveInfoUpdate(Request $request){
        $receiveMasterinfo   = ReceiveMaster::where('id',$request->id)->first();
        // dd($receiveMasterinfo);
        $receiveMasterinfo->rec_type_id = $request->rec_type_id;
        $receiveMasterinfo->vendor_id = $request->vendor_id;
        $receiveMasterinfo->rec_invoice_number = $request->rec_invoice_number;
        $receiveMasterinfo->rec_date = $request->rec_date;
        $receiveMasterinfo->rec_by = $request->rec_by;
        $receiveMasterinfo->discount = $request->discount;
        $receiveMasterinfo->adjustment_qty = $request->adjustment_qty;
        $receiveMasterinfo->rec_note = $request->rec_note;
        $receiveMasterinfo->updated_by = auth()->id();
        $receiveMasterinfo->date_updated = Carbon::now()->format('Y-m-d');
        $receiveMasterinfo->save();
        return response()->json([
            'status'=>true,
            'data'=>$receiveMasterinfo
        ]);

 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiveMaster  $receiveMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
    public function itemInfo(Request $request){
        $item_name = Items::where('id',$request->item_id)->first();
        return response()->json([
            'status'=>200,
            'item_info'=>$item_name
        ]);

    }
}
