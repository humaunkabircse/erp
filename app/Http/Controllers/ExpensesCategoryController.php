<?php

namespace App\Http\Controllers;

use App\Models\ExpensesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expensesCategory = ExpensesCategory::orderBy('id','desc')->get();
        return view('pages.expences-category.index',compact('expensesCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.expences-category.create');
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
            'expenses_cat_name'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['entered_by']=auth()->id();
        $data['date_entered']=Carbon::now()->format('Y-m-d');

        $status = ExpensesCategory::create($data);
        if($status){
            return redirect()->route('expenses.category.index')->with('status','Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensesCategory $expensesCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $expencesCategory =  ExpensesCategory::where('id',$id)->first();
      return view('pages.expences-category.edit',compact('expencesCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'expenses_cat_name'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $category = ExpensesCategory::findOrFail($id);
        $status = $category->fill($data)->save();
        if($status){
            return redirect()->route('expenses.category.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensesCategory $expensesCategory)
    {
        //
    }
}
