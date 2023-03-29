<?php

namespace App\Http\Controllers;

use App\Models\Terms;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $terms = Terms::orderBy('id','desc')->get();
       return view('pages.term.index',compact('terms'));
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
            'term_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = $request->all();
            $data['entered_by']=auth()->id();
            $data['date_entered']=Carbon::now()->format('Y-m-d');
            $status = Terms::create($data);
            if($status){
                return redirect()->back()->with('status','Data Added');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function show(Terms $terms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $term = Terms::find($id);
        return response()->json([
            'status'=>200,
            'term'=>$term
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'term_name' => 'required|string',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $term_id = $request->input('term_id');
        $term = Terms::find($term_id);
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
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $term_id = $request->input('delete_term_id');
        $terms = Terms::find($term_id);
        $status = $terms->delete();
        if($status){
            return redirect()->back()->with('status','Data Deleted');
        }
    }
}
