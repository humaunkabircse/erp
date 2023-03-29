<?php

namespace App\Http\Controllers;

use App\Models\ReceiveType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ReceiveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $receivetypes = ReceiveType::orderBy('id','desc')->get(); 
       return view('pages.receive-type.index',compact('receivetypes'));
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
            'receive_type_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = $request->all();
            $data['entered_by']=auth()->id();
            $data['date_entered']=Carbon::now()->format('Y-m-d');
            $status = ReceiveType::create($data);
            if($status){
                return redirect()->back()->with('status','Data Added');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceiveType  $receiveType
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiveType $receiveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiveType  $receiveType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receiveType = ReceiveType::find($id);
        return response()->json([
            'status'=>200,
            'receiveType'=>$receiveType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReceiveType  $receiveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receive_type_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $receive_type_id = $request->input('receive_type_id');
        $term = ReceiveType::find($receive_type_id);
        $data = $request->all();
        $data['updated_by']=auth()->id();
        $data['date_updated']=Carbon::now()->format('Y-m-d');
        $result = $term->fill($data)->save();
        if($result){
            return redirect()->back()->with('status','Data Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiveType  $receiveType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiveType $receiveType)
    {
        //
    }
}
