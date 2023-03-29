<?php

namespace App\Http\Controllers;

use App\Models\AssetRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class AssetRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetRegisters = AssetRegister::orderBy('id','desc')->get();
       return view('pages.asset-register.index',compact('assetRegisters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pages.asset-register.create');
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
            'asset_name' => 'required|string',
            'asset_type'=>'required',
            'asset_price' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');
        $status = AssetRegister::create($data);
        if($status){
            return redirect()->route('asset.register.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetRegister  $assetRegister
     * @return \Illuminate\Http\Response
     */
    public function show(AssetRegister $assetRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetRegister  $assetRegister
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assetRegister=AssetRegister::findOrFail($id);
        return view('pages.asset-register.edit',compact('assetRegister'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetRegister  $assetRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'asset_name' => 'required|string',
            'asset_type'=>'required',
            'asset_price' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $editRegister = AssetRegister::find($id);
        $status = $editRegister->fill($data)->save();
        if($status){
            return redirect()->route('asset.register.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetRegister  $assetRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetRegister $assetRegister)
    {
        //
    }
}
