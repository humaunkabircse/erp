<?php

namespace App\Http\Controllers;

use App\Models\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AssetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetTypes = AssetType::orderBy('id','desc')->get();
        return view('pages.asset-type.index',compact('assetTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'asset_type_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = $request->all();
            $data['entered_by']=auth()->id();
            $data['date_entered']=Carbon::now()->format('Y-m-d');
            $status = AssetType::create($data);
            if($status){
                return redirect()->route('asset.type.index')->with('status','Data Added');
            }else{
                return redirect()->back()->with('error','Something Went Wrong!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetType  $assetType
     * @return \Illuminate\Http\Response
     */
    public function show(AssetType $assetType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetType  $assetType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $assetType = AssetType::where('id',$request->asset_type_id)->first();
        return response()->json([
            'status'=>200,
            'assetType'=>$assetType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetType  $assetType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'asset_type_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $asset_type_id = $request->input('asset_type_id');
        $assetType = AssetType::find($asset_type_id);
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $result = $assetType->fill($data)->save();
        if($result){
            return redirect()->route('asset.type.index')->with('status','Data Added');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetType  $assetType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetType $assetType)
    {
        //
    }
}
