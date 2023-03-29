<?php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemGroups = ItemGroup::orderBy('id','desc')->get();
        return view('pages.item-group.index',compact('itemGroups'));
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
            'item_group_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = $request->all();
            $data['entered_by']=auth()->id();
            $data['date_entered']=Carbon::now()->format('Y-m-d');
            $status = ItemGroup::create($data);
            if($status){
                return redirect()->back()->with('status','Data Added');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemGroup  $itemGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ItemGroup $itemGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemGroup  $itemGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemGroup = ItemGroup::find($id);
        return response()->json([
            'status'=>200,
            'itemGroup'=>$itemGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemGroup  $itemGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_group_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }

        $item_group_id = $request->input('item_group_id');
        $itemGroup = ItemGroup::find($item_group_id);
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $result = $itemGroup->fill($data)->save();
        if($result){
            return redirect()->back()->with('status','Data Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemGroup  $itemGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemGroup $itemGroup)
    {
        //
    }
}
