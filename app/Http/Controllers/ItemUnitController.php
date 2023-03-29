<?php

namespace App\Http\Controllers;

use App\Models\ItemUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ItemUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = ItemUnit::orderBy('id','desc')->get();
       return view('pages.item-unit.index',compact('units'));
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
            'unit_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = $request->all();
            $data['entered_by']=auth()->id();
            $data['date_entered']=Carbon::now()->format('Y-m-d');
            $status = ItemUnit::create($data);
            if($status){
                return redirect()->back()->with('status','Data Added');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemUnit  $itemUnit
     * @return \Illuminate\Http\Response
     */
    public function show(ItemUnit $itemUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemUnit  $itemUnit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = ItemUnit::find($id);
        return response()->json([
            'status'=>200,
            'unit'=>$unit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemUnit  $itemUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $unit_id = $request->input('unit_id');
        $unit = ItemUnit::find($unit_id);
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $result = $unit->fill($data)->save();
        if($result){
            return redirect()->back()->with('status','Data Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemUnit  $itemUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemUnit $itemUnit)
    {
        //
    }
}
