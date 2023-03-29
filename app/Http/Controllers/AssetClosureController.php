<?php

namespace App\Http\Controllers;

use App\Models\AssetRegister;
use App\Models\AssetClosure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class AssetClosureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetClosures = AssetClosure::orderBy('id','desc')->get();
        return view('pages.asset-closure.index',compact('assetClosures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assetRegisterItems = AssetRegister::all();
        return view('pages.asset-closure.create',compact('assetRegisterItems'));
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
            'asset_closure_date'=>'required',
            'asset_closure_reason'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = AssetClosure::create($data);
        $registerUpdate = AssetRegister::where('id',$request->asset_id)->update([
            'status'=>'inactive'
            ]);
   
        if($status){
            return redirect()->route('asset.closure.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetClosure  $assetClosure
     * @return \Illuminate\Http\Response
     */
    public function show(AssetClosure $assetClosure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetClosure  $assetClosure
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assetClosure = AssetClosure::findOrFail($id);
        $info = DB::table('asset_closures')
        ->select('asset_name','asset_origin','asset_type_name')
        ->join('asset_registers', 'asset_registers.id', '=', 'asset_closures.asset_id')
        ->join('asset_types', 'asset_registers.asset_type', '=', 'asset_types.id')
        ->where('asset_closures.id', $assetClosure->asset_id)
        ->first();

        return view('pages.asset-closure.edit',compact('assetClosure','info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetClosure  $assetClosure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'asset_closure_date'=>'required',
            'asset_closure_reason'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $editClosure = AssetClosure::find($id);
        $status = $editClosure->fill($data)->save();
        if($status){
            return redirect()->route('asset.closure.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetClosure  $assetClosure
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetClosure $assetClosure)
    {
        //
    }
}
