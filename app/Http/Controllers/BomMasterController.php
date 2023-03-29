<?php

namespace App\Http\Controllers;

use App\Models\BomDetails;
use App\Models\BomMaster;
use App\Models\Items;
use App\Models\ItemUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BomMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bomMasters = BomMaster::all();
        return view('pages.bom-master.index',compact('bomMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = ItemUnit::all();
        $items = Items::where('bom_status',0)->get();
        return view('pages.bom-master.create',compact('units','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = BomMaster::where('prod_item_id',$request->prod_item_id)->first();


        if($result){
            return redirect()->back()->with('error','This Product BOM Already Exist');
        }
         $bomMaster = new BomMaster();
         $bomMaster->prod_item_id=$request->prod_item_id;
         $bomMaster->entered_by=auth()->id();
         $bomMaster->date_entered=Carbon::now()->format('Y-m-d');

        DB::transaction(function () use ($bomMaster, $request) {
             if($bomMaster->save()){
                 Items::where('id',$request->prod_item_id)->update(['bom_status'=>1]);
                 $count_item = count($request->used_item_id);
                 if($count_item>0){
                     for ($i = 0; $i < $count_item; $i++) {
                     $bomDetails 				=   new BomDetails();
                     $bomDetails->bom_master_id =   $bomMaster->id;
                     $bomDetails->used_item_id	=   $request->used_item_id[$i];
                     $bomDetails->used_item_qty =   $request->used_item_qty[$i];
                     $bomDetails->used_item_unit=   $request->used_item_unit[$i];
                     $bomDetails->wastage_quantity  =$request->wastage_quantity[$i];
                     $bomDetails->save();
                    }
                 }
             }
         });
         return redirect()->route('bom.master.index')->with('success', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BomMaster  $bomMaster
     * @return \Illuminate\Http\Response
     */
    public function show(BomMaster $bomMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BomMaster  $bomMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Items::where('status','active')->get();
       $bomMaster = BomMaster::where('id',$id)->first();
       return view('pages.bom-master.edit',compact('bomMaster','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BomMaster  $bomMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bomMaster   = BomMaster::find($id);
        if($bomMaster){
            $bomMaster->updated_by = auth()->id();
            $bomMaster->date_updated = Carbon::now()->format('Y-m-d');
            $bomMaster->save();
        }
        DB::table('bom_details')->where('bom_master_id', '=', $id)->delete();
                $count_item = count($request->used_item_id);
                if($count_item>0){
                    for ($i = 0; $i < $count_item; $i++) {
                    $bomDetails 				=   new BomDetails();
                    $bomDetails->bom_master_id	=   $id;
                    $bomDetails->used_item_id	=   $request->used_item_id[$i];
                    $bomDetails->used_item_qty  =   $request->used_item_qty[$i];
                    $bomDetails->used_item_unit =   $request->used_item_unit[$i];
                    $bomDetails->wastage_quantity=   $request->wastage_quantity[$i];
                    $bomDetails->updated_at		=   Carbon::now()->format('Y-m-d');
                    $bomDetails->save();
                    }

                }


        return redirect()->route('bom.master.index')->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BomMaster  $bomMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(BomMaster $bomMaster)
    {
        //
    }
    public function itemUnitInfo(Request $request){
        $item_name = Items::where('id',$request->item_id)->first();
        $itemUnitName = ItemUnit::where('id',$item_name->item_unit)->first();
        return response()->json([
            'status'=>200,
            'item_info'=>$item_name,
            'itemUnitName'=>$itemUnitName
        ]);

    }
}
