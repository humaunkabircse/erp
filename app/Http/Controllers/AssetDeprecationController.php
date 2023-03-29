<?php

namespace App\Http\Controllers;

use App\Models\AssetDeprecation;
use Illuminate\Http\Request;
use App\Models\AssetRegister;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AssetDeprecationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetDeprecations = AssetDeprecation::orderBy('id','desc')->get();
        return view('pages.asset-deprecation.index',compact('assetDeprecations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assetRegisterItems = AssetRegister::all();
        return view('pages.asset-deprecation.create',compact('assetRegisterItems'));
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
            'asset_deprecation_date'=>'required',
            'asset_deprecation_value'=>'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = AssetDeprecation::create($data);
        if($status){
            return redirect()->route('asset.deprecation.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetDeprecation  $assetDepreciation
     * @return \Illuminate\Http\Response
     */
    public function show(AssetDeprecation $assetDepreciation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetDeprecation  $assetDepreciation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assetDeprecation = AssetDeprecation::findOrFail($id);
        $info = DB::table('asset_deprecations')
        ->select('asset_name','asset_origin','asset_type_name')
        ->join('asset_registers', 'asset_registers.id', '=', 'asset_deprecations.asset_id')
        ->join('asset_types', 'asset_registers.asset_type', '=', 'asset_types.id')
        ->where('asset_deprecations.id', $assetDeprecation->asset_id)
        ->first();

        return view('pages.asset-deprecation.edit',compact('assetDeprecation','info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetDeprecation  $assetDepreciation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'asset_deprecation_date'=>'required',
            'asset_deprecation_value'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $assetDeprecation = AssetDeprecation::find($id);
        $status = $assetDeprecation->fill($data)->save();
        if($status){
            return redirect()->route('asset.deprecation.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetDeprecation  $assetDepreciation
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetDeprecation $assetDepreciation)
    {
        //
    }
}
