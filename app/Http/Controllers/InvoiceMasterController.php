<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InvoiceDetails;
use App\Models\InvoiceMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Items;
use App\Models\Terms;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoiceMasters = InvoiceMaster::orderBy('id','desc')->get();
        return view('pages.invoice-master.index',compact('invoiceMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $terms = Terms::all();
        $customers = Customer::all();
        $items = Items::where('status','active')->get();
        return view('pages.invoice-master.create',compact('terms','customers','items'));

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
            'cus_id'=> 'required',
            'invoice_date' => 'required',
            'item_id.*'=>'required',
            'invoice_item_qty.*'=>'required|min:1',
            'item_price.*'=>'required',
        ]);

        if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $invoiceMaster = new InvoiceMaster();
        $invoiceMaster->cus_id=$request->cus_id;
        $invoiceMaster->invoice_number=$request->invoice_number;
        $invoiceMaster->invoice_date=$request->invoice_date;
        $invoiceMaster->invoice_due_date=$request->invoice_due_date;
        $invoiceMaster->discount=$request->discount;
        $invoiceMaster->adjustment=$request->adjustment;
        $invoiceMaster->client_note=$request->client_note;
        $invoiceMaster->terms_and_conditions=$request->terms_and_conditions;
        $invoiceMaster->entered_by=auth()->id();
        $invoiceMaster->date_entered=Carbon::now()->format('Y-m-d');

        DB::transaction(function () use ($invoiceMaster, $request) {
            if($invoiceMaster->save()){
                $count_item = count($request->item_id);
                if($count_item>0){
                    for ($i = 0; $i < $count_item; $i++) {
                    $invoiceDetails 				=   new InvoiceDetails();
                    $invoiceDetails->invoice_id     =   $invoiceMaster->id;
                    $invoiceDetails->item_id	    =   $request->item_id[$i];
                    $invoiceDetails->invoice_item_qty       =   $request->invoice_item_qty[$i];
                    $invoiceDetails->item_price     =   $request->item_price[$i];
                    $invoiceDetails->item_discount  =   $request->item_discount[$i];
                    $invoiceDetails->item_total     =   $request->invoice_item_qty[$i]*$request->item_price[$i]-$request->item_discount[$i];
                    $invoiceDetails->created_at		=   date('Y-m-d', strtotime($request->invoice_date));
                    $invoiceDetails->save();
                    }
                }
            }

        });
        return redirect()->route('invoice.master.index')->with('success', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceMaster  $invoiceMaster
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoiceData = DB::table('invoice_masters')
                        ->join('invoice_details','invoice_masters.id', '=','invoice_details.invoice_id')
                        ->join('items','invoice_details.item_id', '=','items.id')
                        ->select('invoice_masters.*','invoice_details.invoice_item_qty','invoice_details.item_price','invoice_details.item_discount','items.item_name')
                        ->where('invoice_masters.id', $id)
                        ->get();
                        // dd( $invoiceData);
        $customerinfo = DB::table('invoice_masters')
                        ->join('customers','invoice_masters.cus_id','=','customers.id')
                        ->select('invoice_masters.*','customers.*')
                        ->where('invoice_masters.id', $id)
                        ->first();
        $invoiceMasterInfo = DB::table('invoice_masters')->where('id',$id)->first();
       return view('pages.invoice-master.invoice-view',compact('invoiceData','customerinfo','invoiceMasterInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceMaster  $invoiceMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $terms = Terms::all();
        $customers = Customer::all();
        $items = Items::all();
       $invoiceMaster = InvoiceMaster::where('id',$id)->first();
       return view('pages.invoice-master.edit',compact('invoiceMaster','customers','terms','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceMaster  $invoiceMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $invoiceMaster   = InvoiceMaster::find($id);

        DB::table('invoice_details')->where('invoice_id', '=', $id)->delete();
                $count_item = count($request->item_id);
                if($count_item>0){
                    for ($i = 0; $i < $count_item; $i++) {
                    $invoiceDetails 				=   new InvoiceDetails();
                    $invoiceDetails->invoice_id     =   $invoiceMaster->id;
                    $invoiceDetails->item_id	    =   $request->item_id[$i];
                    $invoiceDetails->invoice_item_qty       =   $request->invoice_item_qty[$i];
                    $invoiceDetails->item_discount  =   $request->item_discount[$i];
                    $invoiceDetails->item_price     =   $request->item_price[$i];
                    $invoiceDetails->item_total     =   $request->invoice_item_qty[$i]*$request->item_price[$i]-$request->item_discount[$i];
                    $invoiceDetails->updated_at		=   Carbon::now()->format('Y-m-d');
                    $invoiceDetails->save();
                    }
                }

        return redirect()->route('invoice.master.index')->with('success', 'Updated successfully!');
    }
        public function invoiceInfoUpdate(Request $request){
           $invoiceMasterinfo= InvoiceMaster::find($request->id);
           $invoiceMasterinfo->cus_id=$request->cus_id;
           $invoiceMasterinfo->invoice_date=$request->invoice_date;
           $invoiceMasterinfo->invoice_due_date=$request->invoice_due_date;
           $invoiceMasterinfo->discount=$request->discount;
           $invoiceMasterinfo->adjustment=$request->adjustment;
           $invoiceMasterinfo->client_note=$request->client_note;
           $invoiceMasterinfo->terms_and_conditions=$request->terms_and_conditions;
           $invoiceMasterinfo->save();
           return response()->json([
               'status'=>true,
               'data'=>$invoiceMasterinfo
           ]);
    }

     public function invoicePrint($id)
    {
        $invoiceData = DB::table('invoice_masters')
                        ->join('invoice_details','invoice_masters.id', '=','invoice_details.invoice_id')
                        ->join('items','invoice_details.item_id', '=','items.id')
                        ->select('invoice_masters.*','invoice_details.invoice_item_qty','invoice_details.item_price','invoice_details.item_discount','items.item_name')
                        ->where('invoice_masters.id', $id)
                        ->get();
                        // dd( $invoiceData);
        $customerinfo = DB::table('invoice_masters')
                        ->join('customers','invoice_masters.cus_id','=','customers.id')
                        ->select('invoice_masters.*','customers.*')
                        ->where('invoice_masters.id', $id)
                        ->first();
        $invoiceMasterInfo = DB::table('invoice_masters')->where('id',$id)->first();
       return view('pages.invoice-master.printInvoice',compact('invoiceData','customerinfo','invoiceMasterInfo'));
    }
//challan print preview
    public function challanPrint($id)
    {
        $invoiceData = DB::table('invoice_masters')
                        ->join('invoice_details','invoice_masters.id', '=','invoice_details.invoice_id')
                        ->join('items','invoice_details.item_id', '=','items.id')
                        ->select('invoice_masters.*','invoice_details.invoice_item_qty','invoice_details.item_price','invoice_details.item_discount','items.item_name')
                        ->where('invoice_masters.id', $id)
                        ->get();
                        // dd( $invoiceData);
        $customerinfo = DB::table('invoice_masters')
                        ->join('customers','invoice_masters.cus_id','=','customers.id')
                        ->select('invoice_masters.*','customers.*')
                        ->where('invoice_masters.id', $id)
                        ->first();
        $invoiceMasterInfo = DB::table('invoice_masters')->where('id',$id)->first();
       return view('pages.invoice-master.challan-print-preview',compact('invoiceData','customerinfo','invoiceMasterInfo'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceMaster  $invoiceMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceMaster $invoiceMaster)
    {
        //
    }
    public function invoicePdf($id){
        $data['invoiceData'] = DB::table('invoice_masters')
        ->join('invoice_details','invoice_masters.id', '=','invoice_details.invoice_id')
        ->join('items','invoice_details.item_id', '=','items.id')
        ->select('invoice_masters.*','invoice_details.invoice_item_qty','invoice_details.item_price','invoice_details.item_discount','items.item_name')
        ->where('invoice_masters.id', $id)
        ->get();
        // dd( $invoiceData);
        $data['customerinfo'] = DB::table('invoice_masters')
        ->join('customers','invoice_masters.cus_id','=','customers.id')
        ->select('invoice_masters.*','customers.*')
        ->where('invoice_masters.id', $id)
        ->first();
        $data['invoiceMasterInfo'] = DB::table('invoice_masters')->where('id',$id)->first();
        $pdf = PDF::loadView('pages.invoice-master.pdf', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('invoice.pdf');
        // return $pdf->download('invoice.pdf');

    }
}
