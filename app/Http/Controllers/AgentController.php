<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::orderBy('id','desc')->get();
        return view('pages.agent.index',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.agent.create');
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
            'agent_fullname' => 'required|string',
            'agent_contact'=>'required',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = $request->all();
            $data['entered_by']=auth()->id();
            $data['date_entered']=Carbon::now()->format('Y-m-d');
            $status = Agent::create($data);
            if($status){
                return redirect()->route('agent.index')->with('status','Created Successfully');
            }else{
                return redirect()->back()->with('error','Something Went Wrong!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent=Agent::findOrFail($id);
        return view('pages.agent.edit',compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'agent_fullname' => 'required|string',
            'agent_contact'=>'required',
        ]);

        if($validator->fails()){
			// return response()->json(['errors'=>$validator->errors()->all()]);
           return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = $request->all();
            $data['entered_by']=auth()->id();
            $data['date_entered']=Carbon::now()->format('Y-m-d');
            $agent=Agent::findOrFail($id);
            $status =$agent->fill($data)->save();
            if($status){
                return redirect()->route('agent.index')->with('status','Updated Successfully');
            }else{
                return redirect()->back()->with('error','Something Went Wrong!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
