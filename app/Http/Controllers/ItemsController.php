<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $items=Items::orderBy('id','desc')->get();
       return view('pages.items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.items.create');
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
            'item_name'=>'required',
            'item_price'=>'required',
            'cat_id'=>'required',
            'item_unit'=>'required',
            'item_qty'=>'min:1',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = Items::create($data);
        if($status){
            return redirect()->route('items.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editItem = Items::find($id);
        return view('pages.items.edit',compact('editItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'item_name'=>'required',
            'item_price'=>'required',
            'cat_id'=>'required',
            'item_unit'=>'required',
            'item_qty'=>'min:1',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $Item = Items::findOrFail($id);
        $status = $Item->fill($data)->save();
        if($status){
            return redirect()->route('items.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $items)
    {
        //
    }
}
