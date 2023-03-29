<?php

namespace App\Http\Controllers;

use App\Models\BankName;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class BankNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankNames = BankName::orderBy('id','desc')->get();
        return view('pages.bank-name.index',compact('bankNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pages.bank-name.create');
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
            'bank_name' => 'required|string',
            'bank_short_name'=>'required|string',
            'status' => 'required'
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = $request->all();
            $data['entered_by']=auth()->id();
            $data['date_entered']=Carbon::now()->format('Y-m-d');
            $status = BankName::create($data);
            if($status){
                return redirect()->route('bank.name.index')->with('status','Created Successfully');
            }else{
                return redirect()->back()->with('error','Something Went Wrong!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankName  $bankName
     * @return \Illuminate\Http\Response
     */
    public function show(BankName $bankName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankName  $bankName
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bankName=BankName::findOrFail($id);
        return view('pages.bank-name.edit',compact('bankName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankName  $bankName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string',
            'bank_short_name'=>'required|string',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $editBank = BankName::find($id);
        $status = $editBank->fill($data)->save();
        if($status){
            return redirect()->route('bank.name.index')->with('status','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankName  $bankName
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankName $bankName)
    {
        //
    }
}
