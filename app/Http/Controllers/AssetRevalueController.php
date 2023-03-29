<?php

namespace App\Http\Controllers;

use App\Models\AssetRegister;
use App\Models\AssetRevalue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class AssetRevalueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetRevalues = AssetRevalue::orderBy('id','desc')->get();
        return view('pages.asset-revalue.index',compact('assetRevalues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assetRegisterItems = AssetRegister::where('status','active')->get();
        return view('pages.asset-revalue.create',compact('assetRegisterItems'));
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
            'asset_revalue_date'=>'required',
            'asset_revalue_price'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');
        $status = AssetRevalue::create($data);
        if($status){
            return redirect()->route('asset.revalue.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetRevalue  $assetRevalue
     * @return \Illuminate\Http\Response
     */
    public function show(AssetRevalue $assetRevalue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetRevalue  $assetRevalue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assetRevalue=AssetRevalue::findOrFail($id);
        $info = DB::table('asset_registers')
        ->select('asset_name','asset_origin','asset_type_name')
        ->join('asset_types', 'asset_registers.asset_type', '=', 'asset_types.id')
        ->where('asset_registers.id', $assetRevalue->asset_id)
        ->first();

        return view('pages.asset-revalue.edit',compact('assetRevalue','info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetRevalue  $assetRevalue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'asset_revalue_date'=>'required',
            'asset_revalue_price'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $editRevalue = AssetRevalue::find($id);
        $status = $editRevalue->fill($data)->save();
        if($status){
            return redirect()->route('asset.revalue.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetRevalue  $assetRevalue
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetRevalue $assetRevalue)
    {
        //
    }

    public function info(Request $request){
    $info = DB::table('asset_registers')
        ->select('asset_name','asset_origin','asset_type_name')
        ->join('asset_types', 'asset_registers.asset_type', '=', 'asset_types.id')
        ->where('asset_registers.id', $request->asset_id)
        ->first();
        return response()->json([
            'status'=>200,
            'info' =>$info
        ]);

    }

}
