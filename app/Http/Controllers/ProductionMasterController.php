<?php

namespace App\Http\Controllers;

use App\Models\BomDetails;
use App\Models\BomMaster;
use App\Models\Items;
use App\Models\ProductionMaster;
use App\Models\RmUsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ProductionMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productionMasters = ProductionMaster::orderBy('id','desc')->get();
        return view('pages.production-master.index',compact('productionMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Items::all();
        return view('pages.production-master.create',compact('items'));
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
        $validator = Validator::make($request->all(), [
            'production_date' => 'required'
            
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $productionMaster = new ProductionMaster();
        $productionMaster->batch_number=$request->batch_number;
        $productionMaster->production_date=$request->production_date;
        $productionMaster->item_id=$request->item_id;
        $productionMaster->prod_qty=$request->prod_qty;
        $productionMaster->item_price=$request->item_price;
        $productionMaster->entered_by=auth()->id();
        $productionMaster->date_entered=Carbon::now()->format('Y-m-d');

        DB::transaction(function () use ($productionMaster, $request) { 
            if($productionMaster->save()){
                $count_item = count($request->rm_item_id);
                if($count_item>0){                       
                    for ($i = 0; $i < $count_item; $i++) {
                    $rmused 				=   new RmUsed();
                    $rmused->batch_number   =   $request->batch_number;
                    $rmused->rm_item_id	    =   $request->rm_item_id[$i];
                    $rmused->total_rm_item_qty =   $request->prod_qty*($request->wastage_quantity[$i]+$request->rm_item_qty[$i]);
                    $rmused->total_wastage_qty =   $request->wastage_quantity[$i]*$request->prod_qty;
                    $rmused->rm_item_price  =   $request->rm_item_price[$i];
                    $rmused->save();
                         
                        // $qty = DB::table('items')->where('id', $request->rm_item_id[$i])->first();
                        // $stock_update =  $qty->stock + $request->prod_qty*($request->wastage_quantity[$i]+$request->rm_item_qty[$i]);
                        // DB::table('items')->where('id', $request->rm_item_id[$i])->update([ 
                        //     'stock' => $stock_update
                        // ]);   
                    }   
                }     
                //   $qty = DB::table('items')->where('id', $request->rm_item_id[$i])->first();
                //   $stock_update =  $qty->stock + $request->prod_qty*($request->wastage_quantity[$i]+$request->rm_item_qty[$i]);
                //   DB::table('items')->where('id', $request->rm_item_id[$i])->update([ 
                //       'stock' => $stock_update
                //   ]);
            }
            
        });
        return redirect()->route('production.master.index')->with('success', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductionMaster  $productionMaster
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionMaster $productionMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductionMaster  $productionMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productItem = ProductionMaster::findOrFail($id);
        return view('pages.production-master.edit',compact('productItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductionMaster  $productionMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // dd($request->all());
       $productionMaster = ProductionMaster::find($id);
       if( $productionMaster){
        $productionMaster->batch_number=$request->batch_number;
        $productionMaster->production_date=$request->production_date;
        $productionMaster->item_id=$request->item_id;
        $productionMaster->prod_qty=$request->prod_qty;
        $productionMaster->item_price=$request->item_price;
        $productionMaster->updated_by = auth()->id();
        $productionMaster->date_updated = Carbon::now()->format('Y-m-d');
        $productionMaster->save();
       }
       DB::table('rm_useds')->where('batch_number', '=', $productionMaster->batch_number)->delete();
          
               $count_item = count($request->rm_item_id);
               if($count_item>0){                       
                   for ($i = 0; $i < $count_item; $i++) {
                   $rmused 				=   new RmUsed();
                   $rmused->batch_number   =   $request->batch_number;
                   $rmused->rm_item_id	    =   $request->rm_item_id[$i];
                   $rmused->total_rm_item_qty =   $request->prod_qty*($request->wastage_quantity[$i]+$request->rm_item_qty[$i]);
                   $rmused->total_wastage_qty =   $request->wastage_quantity[$i]*$request->prod_qty;
                   $rmused->rm_item_price  =   $request->rm_item_price[$i];
                   $rmused->save();  
              
                   }   
               }
        
           
    
       return redirect()->route('production.master.index')->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductionMaster  $productionMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionMaster $productionMaster)
    {
        //
    }
    public function rmItemInfo(Request $request){
        // $item_name = Items::where('id',$request->item_id)->first();
        $rm_item_info = BomDetails::where('bom_master_id',$request->item_id)->get();
        $rm_item_name = Items::where('id',$rm_item_info->used_item_id)->first();
        return response()->json([
            'status'=>200,
            'rm_item_info'=>$rm_item_info,
            'rm_item_name'=>$rm_item_name,
        ]);

    }

    public function productSearch(Request $request){
        $validator = Validator::make($request->all(), [
            'item_id'=>'required',
        ],[
          'item_id.required'  =>'Please Select Product'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $getItem = Items::where('id',$request->item_id)->first();
        $bom_master_id = BomMaster::where('prod_item_id',$getItem->id)->first();
        $getItemRm = BomDetails::where('bom_master_id',$bom_master_id->id)->get();
        return view('pages.production-master.create',compact('getItem','getItemRm'));
    }
    public function productItemSearch(){
        $items = Items::where('bom_status',1)->get();
        return view('pages.production-master.productSearch',compact('items'));
    }
}
