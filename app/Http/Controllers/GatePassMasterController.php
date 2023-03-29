<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\GatePassDetails;
use App\Models\GatePassMaster;
use App\Models\Items;
use App\Models\Terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GatePassMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gatePassMasters = GatePassMaster::orderBy('id','desc')->get();
        return view('pages.gate-pass.index',compact('gatePassMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $terms = Terms::all();
        $customers = Customer::all();
        $items = Items::all();

        return view('pages.gate-pass.create',compact('terms','customers','items'));
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
            'gp_number' => 'required',
            'gp_date' => 'required',
            'gp_type' => 'required',
            'item_id'=>'required',
            'item_qty'=>'required',
            'item_price'=>'required',
        ]);

        if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $gatePassMaster = new GatePassMaster();
        $gatePassMaster->cus_id=$request->cus_id;
        $gatePassMaster->gp_number=$request->gp_number;
        $gatePassMaster->gp_date=$request->gp_date;
        $gatePassMaster->gp_type=$request->gp_type;
        $gatePassMaster->gp_note=$request->gp_note;
        $gatePassMaster->terms_and_conditions=$request->terms_and_conditions;
        $gatePassMaster->entered_by=auth()->id();
        $gatePassMaster->date_entered=Carbon::now()->format('Y-m-d');

        DB::transaction(function () use ($gatePassMaster, $request) { 
            if($gatePassMaster->save()){
                $count_item = count($request->item_id);
                if($count_item>0){                       
                    for ($i = 0; $i < $count_item; $i++) {
                    $gatePassDetails 				=   new GatePassDetails();
                    $gatePassDetails->gp_id         =   $gatePassMaster->id;
                    $gatePassDetails->item_id	    =   $request->item_id[$i];
                    $gatePassDetails->item_qty      =   $request->item_qty[$i];
                    $gatePassDetails->item_price    =   $request->item_price[$i];
                    $gatePassDetails->save();   
                    }   
                }
            }
            
        });
        return redirect()->route('gate.pass.index')->with('success', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GetPassMaster  $getPassMaster
     * @return \Illuminate\Http\Response
     */
    public function show(GatePassMaster $getPassMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GetPassMaster  $getPassMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $terms = Terms::all();
        $customers = Customer::all();
        $items = Items::all(); 
       $getPassMaster = GatePassMaster::where('id',$id)->first();
       return view('pages.gate-pass.edit',compact('getPassMaster','customers','terms','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GetPassMaster  $getPassMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'item_id'=>'required',
            'item_qty'=>'required',
            'item_price'=>'required',
        ]);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput();
        }
       $gatePassMaster   = GatePassMaster::find($id);
        // if($gatePassMaster){
        //     $gatePassMaster->cus_id=$request->cus_id;
        //     $gatePassMaster->gp_number=$request->gp_number;
        //     $gatePassMaster->gp_date=$request->gp_date;
        //     $gatePassMaster->gp_type=$request->gp_type;
        //     $gatePassMaster->gp_note=$request->gp_note;
        //     $gatePassMaster->terms_and_conditions=$request->terms_and_conditions;
        //     $gatePassMaster->updated_by = auth()->id();
        //     $gatePassMaster->date_updated = Carbon::now()->format('Y-m-d');
        // }
       
        DB::table('gate_pass_details')->where('gp_id', '=', $id)->delete();    

    

                $count_item = count($request->item_id);
                if($count_item>0){                       
                    for ($i = 0; $i < $count_item; $i++) {
                    $gatePassDetails 				=   new GatePassDetails();
                    $gatePassDetails->gp_id         =   $gatePassMaster->id;
                    $gatePassDetails->item_id	    =   $request->item_id[$i];
                    $gatePassDetails->item_qty      =   $request->item_qty[$i];
                    $gatePassDetails->item_price    =   $request->item_price[$i];
                    $gatePassDetails->updated_at		=   Carbon::now()->format('Y-m-d');
                    $gatePassDetails->save();   
                    }   
                }
           
            
      
        return redirect()->route('gate.pass.index')->with('success', 'Created successfully!');
    }
 public function gpInfoUpdate(Request $request){
           $gpMasterinfo= GatePassMaster::find($request->id);
           $gpMasterinfo->cus_id=$request->cus_id;
           $gpMasterinfo->gp_date=$request->gp_date;
           $gpMasterinfo->gp_type=$request->gp_type;
           $gpMasterinfo->gp_note=$request->gp_note;
           $gpMasterinfo->terms_and_conditions=$request->terms_and_conditions;
           $gpMasterinfo->save();
           return response()->json([
               'status'=>true,
               'data'=>$gpMasterinfo
           ]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GetPassMaster  $getPassMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(GatePassMaster $getPassMaster)
    {
        //
    }
}
