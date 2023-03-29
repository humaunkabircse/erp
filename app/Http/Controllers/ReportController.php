<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(){
        return view('pages.reports.index');
    }
    public function receivedReport(){
        $vendors = Vendor::all();
        return view('pages.reports.received.received-report',compact('vendors'));
    }
    public function receivedSearch(Request $request){
        $vendor_id = $request->vendor_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        if(!empty($vendor_id)){
        $receiveDetails = DB::table('receive_masters')
        ->join('receive_details','receive_masters.id', '=','receive_details.rec_master_id')
        ->join('vendors','receive_masters.vendor_id', '=','vendors.id')
        ->select('receive_details.*','receive_masters.*','vendors.vendor_company')
        ->whereBetween('rec_date',[$start_date,$end_date])
        ->where('receive_masters.vendor_id','=',$request->vendor_id)
        ->orderby('receive_masters.rec_date','ASC')->get();
        return view('pages.reports.received.received-report',compact('receiveDetails','dateRange','vendor_id','start_date','end_date'));
        }else{
            $receiveDetails = DB::table('receive_masters')
            ->join('receive_details','receive_masters.id', '=','receive_details.rec_master_id')
            ->join('vendors','receive_masters.vendor_id', '=','vendors.id')
            ->select('receive_details.*','receive_masters.*','vendors.vendor_company')
            ->whereBetween('rec_date',[$start_date,$end_date])
            ->orderby('receive_masters.rec_date','ASC')->get();
            return view('pages.reports.received.received-report',compact('receiveDetails','dateRange','vendor_id','start_date','end_date'));
        }

    }

    public function receivedPrint(Request $request){
        $vendor_id = $request->vendor_id;
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
if(!empty($vendor_id)){
        $receivePrintDetails = DB::table('receive_masters')
        ->join('receive_details','receive_masters.id', '=','receive_details.rec_master_id')
        ->join('vendors','receive_masters.vendor_id', '=','vendors.id')
        ->select('receive_details.*','receive_masters.*','vendors.vendor_company')
        ->whereBetween('rec_date',[$start_date,$end_date])
        ->where('receive_masters.vendor_id','=',$request->vendor_id)
        ->orderby('receive_masters.rec_date','ASC')->get();
        return view('pages.reports.received.received-print',compact('receivePrintDetails','dateRange'));
        }else{
            $receivePrintDetails = DB::table('receive_masters')
            ->join('receive_details','receive_masters.id', '=','receive_details.rec_master_id')
            ->join('vendors','receive_masters.vendor_id', '=','vendors.id')
            ->select('receive_details.*','receive_masters.*','vendors.vendor_company')
            ->whereBetween('rec_date',[$start_date,$end_date])
            ->orderby('receive_masters.rec_date','ASC')->get();
            return view('pages.reports.received.received-print',compact('receivePrintDetails','dateRange'));
        }
    }
//gatepass report
    public function gatepassReport(){
        $customers = Customer::all();
        return view('pages.reports.gatepass.gatepass-report',compact('customers'));
    }
    public function gatepassSearch(Request $request){
        $customer_id=$request->cus_id;
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $customers = Customer::all();
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $gatepassDetails = DB::table('gate_pass_masters')
        ->join('gate_pass_details','gate_pass_masters.id', '=','gate_pass_details.gp_id')
        ->join('customers','gate_pass_masters.cus_id', '=','customers.id')
        ->select('gate_pass_details.*','gate_pass_masters.*','customers.cus_company')
        ->whereBetween('gp_date',[$start_date,$end_date])
        ->where('gate_pass_masters.cus_id','=',$request->cus_id)->orderby('gate_pass_masters.gp_date','ASC')->get();
        return view('pages.reports.gatepass.gatepass-report',compact('customers','gatepassDetails','dateRange','customer_id','start_date','end_date'));
    }

    public function gatePassPrint(Request $request){
        $customer_id=$request->cus_id;
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $customers = Customer::all();
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $gatepassDetails = DB::table('gate_pass_masters')
        ->join('gate_pass_details','gate_pass_masters.id', '=','gate_pass_details.gp_id')
        ->join('customers','gate_pass_masters.cus_id', '=','customers.id')
        ->select('gate_pass_details.*','gate_pass_masters.*','customers.cus_company')
        ->whereBetween('gp_date',[$start_date,$end_date])
        ->where('gate_pass_masters.cus_id','=',$request->cus_id)->orderby('gate_pass_masters.gp_date','ASC')->get();
        return view('pages.reports.gatepass.gate-pass-print',compact('gatepassDetails','dateRange'));
    }
    //invoice report
    public function challanReport(){
        $customers = Customer::all();
        return view('pages.reports.challan.challan-report',compact('customers'));
    }
    public function challanSearch(Request $request){
        $customers = Customer::all();
        $cus_id= $request->cus_id;
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        if($request->cus_id){
            $challanDetails = DB::table('invoice_masters')
            ->join('invoice_details','invoice_masters.id', '=','invoice_details.invoice_id')
            ->join('customers','invoice_masters.cus_id', '=','customers.id')
            ->select('invoice_masters.*','invoice_details.*','customers.cus_company',DB::raw('SUM(invoice_details.item_total) as challan_total'),DB::raw('SUM(invoice_details.item_qty) as t_item_qty'))
            ->whereBetween('invoice_masters.invoice_date',[$start_date,$end_date])
            ->where('invoice_masters.cus_id','=',$request->cus_id)
            ->groupBy('invoice_details.invoice_id')->get();
            return view('pages.reports.challan.challan-report',compact('customers','challanDetails','dateRange','cus_id','start_date','end_date'));
        }else{
            $challanDetails = DB::table('invoice_masters')
            ->join('invoice_details','invoice_masters.id', '=','invoice_details.invoice_id')
            ->join('customers','invoice_masters.cus_id', '=','customers.id')
            ->select('invoice_masters.*','invoice_details.*','customers.cus_company',DB::raw('SUM(invoice_details.item_total) as challan_total'),DB::raw('SUM(invoice_details.item_qty) as t_item_qty'))
            ->whereBetween('invoice_masters.invoice_date',[$start_date,$end_date])
            ->groupBy('invoice_details.invoice_id')->get();
            return view('pages.reports.challan.challan-report',compact('customers','challanDetails','dateRange','start_date','end_date'));
        }

    }

    public function challanPrint(Request $request){
        $cus_id= $request->cus_id;
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        if($request->cus_id){
            $challanDetails = DB::table('invoice_masters')
            ->join('invoice_details','invoice_masters.id', '=','invoice_details.invoice_id')
            ->join('customers','invoice_masters.cus_id', '=','customers.id')
            ->select('invoice_masters.*','invoice_details.*','customers.cus_company',DB::raw('SUM(invoice_details.item_total) as challan_total'),DB::raw('SUM(invoice_details.item_qty) as t_item_qty'))
            ->whereBetween('invoice_masters.invoice_date',[$start_date,$end_date])
            ->where('invoice_masters.cus_id','=',$request->cus_id)
            ->groupBy('invoice_details.invoice_id')->get();
            return view('pages.reports.challan.challan-print',compact('challanDetails','dateRange'));
        }else{
            $challanDetails = DB::table('invoice_masters')
            ->join('invoice_details','invoice_masters.id', '=','invoice_details.invoice_id')
            ->join('customers','invoice_masters.cus_id', '=','customers.id')
            ->select('invoice_masters.*',
                    'invoice_details.*',
                    'customers.cus_company',
                    DB::raw('SUM(invoice_details.item_total) as challan_total'),
                    DB::raw('SUM(invoice_details.item_qty) as t_item_qty')
                    )
            ->whereBetween('invoice_masters.invoice_date',[$start_date,$end_date])
            ->groupBy('invoice_details.invoice_id')->get();
            return view('pages.reports.challan.challan-print',compact('challanDetails','dateRange'));
        }

    }

    //expensive Report section
    public function expensesReport(){
        // $customers = Customer::all();
        return view('pages.reports.expenses.expenses-report');
    }
    public function expensesSearch(Request $request){
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $expensesDetails = DB::table('expenses')
        ->join('expenses_categories','expenses_categories.id', '=','expenses.expenses_category')
        ->join('customers','expenses.cust_id', '=','customers.id')
        ->select('expenses.*','expenses_categories.expenses_cat_name','customers.cus_company')
        ->whereBetween('expenses_date',[$start_date,$end_date])
        ->orderby('expenses.expenses_date','DESC')->get();
        return view('pages.reports.expenses.expenses-report',compact('expensesDetails','dateRange','start_date','end_date'));
    }

    public function expensesPrint(Request $request){
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $expensesDetails = DB::table('expenses')
        ->join('expenses_categories','expenses_categories.id', '=','expenses.expenses_category')
        ->join('customers','expenses.cust_id', '=','customers.id')
        ->select('expenses.*','expenses_categories.expenses_cat_name','customers.cus_company')
        ->whereBetween('expenses_date',[$start_date,$end_date])
        ->orderby('expenses.expenses_date','DESC')->get();
        return view('pages.reports.expenses.expenses-print',compact('expensesDetails','dateRange','start_date','end_date'));
    }

    //production report section
    public function productionReport(){
        // $customers = Customer::all();
        return view('pages.reports.production.production-report');
    }
    public function productionSearch(Request $request){
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $productionDetails = DB::table('production_masters')
        ->join('items','items.id', '=','production_masters.item_id')
        ->select('production_masters.*','items.item_name')
        ->whereBetween('production_date',[$start_date,$end_date])
        ->orderby('production_masters.production_date','DESC')->get();
        return view('pages.reports.production.production-report',compact('productionDetails','dateRange','start_date','end_date'));
    }

    public function productionPrint(Request $request){
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $dateRange = [
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ];
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $productionDetails = DB::table('production_masters')
        ->join('items','items.id', '=','production_masters.item_id')
        ->select('production_masters.*','items.item_name')
        ->whereBetween('production_date',[$start_date,$end_date])
        ->orderby('production_masters.production_date','DESC')->get();
        return view('pages.reports.production.production-print',compact('productionDetails','dateRange','start_date','end_date'));
    }
//Collection Report
 public function collectionReport(){
    // $customers = Customer::all();
    return view('pages.reports.collection.collection-report');
}
public function collectionSearch(Request $request){
    $start_date=$request->start_date;
    $end_date=$request->end_date;
    $dateRange = [
        'start_date'=>$request->start_date,
        'end_date'=>$request->end_date,
    ];
    $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
    $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
    $collectionDetails = DB::table('payments')
    ->join('customers','customers.id', '=','payments.cus_id')
    ->join('payment_modes','payment_modes.id', '=','payments.pay_mode')
    ->join('bank_names','bank_names.id', '=','payments.bank_name_id')
    ->select('payments.*','customers.cus_company','payment_modes.pay_mode','bank_names.bank_name')
    ->whereBetween('pay_date',[$start_date,$end_date])
    ->orderby('payments.pay_date','DESC')->get();
    return view('pages.reports.collection.collection-report',compact('collectionDetails','dateRange','start_date','end_date'));
}

public function collectionPrint(Request $request){
    $start_date=$request->start_date;
    $end_date=$request->end_date;
    $dateRange = [
        'start_date'=>$request->start_date,
        'end_date'=>$request->end_date,
    ];
    $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
    $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
    $collectionDetails = DB::table('payments')
    ->join('customers','customers.id', '=','payments.cus_id')
    ->join('payment_modes','payment_modes.id', '=','payments.pay_mode')
    ->join('bank_names','bank_names.id', '=','payments.bank_name_id')
    ->select('payments.*','customers.cus_company','payment_modes.pay_mode','bank_names.bank_name')
    ->whereBetween('pay_date',[$start_date,$end_date])
    ->orderby('payments.pay_date','DESC')->get();
    return view('pages.reports.collection.collection-print',compact('collectionDetails','dateRange','start_date','end_date'));
}
//Collection Report


//Stock Reports
public function stockReport(Request $request)
{
    $stockDetails = DB::table('items')
        ->join('receive_details', 'receive_details.item_id', 'items.id')
        ->leftjoin('stock_adjustments', 'stock_adjustments.item_id', 'items.id')
        ->leftjoin('production_masters', 'production_masters.prod_qty', 'items.id')
        ->select('items.*', 'receive_details.*', 'stock_adjustments.stock_adjustment_addition_qty', 'production_masters.prod_qty')
        // ->select(DB::raw('item_qty + IFNULL(stock_adjustment_addition_qty, 0)'))
        // ->select(DB::raw('item_qty + IFNULL(stock_adjustment_addition_qty, 0)'))
        ->get();

    $current_date = Carbon::now();

    // echo "<pre>";
    // print_r($stockDetails);
    // echo "</pre>";

    return view('pages.reports.stock.stock-report',compact('stockDetails', 'current_date'));

}

// Stock Print
    public function stockPrint(Request $request)
    {
        $stockDetails = DB::table('items')
        ->join('receive_details', 'receive_details.item_id', 'items.id')
        ->leftjoin('stock_adjustments', 'stock_adjustments.item_id', 'items.id')
        ->leftjoin('production_masters', 'production_masters.prod_qty', 'items.id')
        ->select('items.*', 'receive_details.*', 'stock_adjustments.stock_adjustment_addition_qty', 'production_masters.prod_qty')
        // ->select(DB::raw('item_qty + IFNULL(stock_adjustment_addition_qty, 0)'))
        // ->select(DB::raw('item_qty + IFNULL(stock_adjustment_addition_qty, 0)'))
        ->get();

        $current_date = Carbon::now();
        return view('pages.reports.stock.stock-print', compact('current_date', 'stockDetails'));
    }


// public function stockReport(){
//     $stockDetails = DB::table('items')
//     ->leftJoin('rm_useds','rm_useds.rm_item_id','=','items.id')
//     ->leftJoin('receive_details','receive_details.item_id','=','items.id')
//     ->leftJoin('gate_pass_details','gate_pass_details.item_id','=','items.id')
//     ->leftJoin('invoice_details','invoice_details.item_id','=','items.id')
//     ->select('items.id','items.item_name',DB::raw('SUM(rm_useds.total_rm_item_qty+receive_details.item_qty-gate_pass_details.item_qty-invoice_details.item_qty) As stock_qty'))
//     ->groupBy('items.id')
//     ->orderby('items.id','ASC')->get();
//     dd($stockDetails);
//     return view('pages.reports.stock.stock-report',compact('stockDetails'));

// }

// public function stockReport1(Request $request){
//     $stockDetails = DB::table('items')
//     ->leftJoin('rm_useds','rm_useds.rm_item_id','=','items.id')
//     ->leftJoin('receive_details','receive_details.item_id','=','items.id')
//     ->leftJoin('invoice_details','invoice_details.item_id','=','items.id')
//     ->leftJoin('gate_pass_details','gate_pass_details.item_id','=','items.id')
//     ->select('items.id','items.item_name','receive_details.item_qty','rm_useds.total_rm_item_qty','invoice_details.item_qty','gate_pass_details.item_qty',DB::raw('SUM(receive_details.item_qty) As r_item_qty'),DB::raw('SUM(rm_useds.total_rm_item_qty) As p_item_qty'),DB::raw('SUM(invoice_details.item_qty) As inv_item_qty'),DB::raw('SUM(gate_pass_details.item_qty) As gp_item_qty'))
//     ->groupBy('receive_details.item_id','invoice_details.item_id','gate_pass_details.item_id','rm_useds.rm_item_id')->orderby('items.id','ASC')->get();
//     dd($stockDetails);
//     return view('pages.reports.stock.stock-report',compact('stockDetails'));
// }

// public function stockPrint(Request $request){
//     $stockDetails = DB::table('items')
//     ->select('items.id','items.item_name','receive_details.item_id','receive_details.item_qty','rm_useds.rm_item_id','rm_useds.total_rm_item_qty','invoice_details.item_id','invoice_details.item_qty','gate_pass_details.item_id','gate_pass_details.item_qty',DB::raw('SUM(receive_details.item_qty) As r_item_qty'),DB::raw('SUM(rm_useds.total_rm_item_qty) As p_item_qty'),DB::raw('SUM(invoice_details.item_qty) As inv_item_qty'),DB::raw('SUM(gate_pass_details.item_qty) As gp_item_qty'))
//     ->leftjoin('rm_useds','rm_useds.rm_item_id','=','items.id')
//     ->leftjoin('receive_details','receive_details.item_id','=','items.id')
//     ->leftjoin('invoice_details','invoice_details.item_id','=','items.id')
//     ->leftjoin('gate_pass_details','gate_pass_details.item_id','=','items.id')

//     ->where('receive_details',">",0)
//     ->orderby('items.id','ASC')
//     ->groupBy(['receive_details.item_id','invoice_details.item_id','gate_pass_details.item_id','rm_useds.rm_item_id'])->get();
//     dd($stockDetails);
//     return view('pages.reports.stock.stock-report',compact('stockDetails'));
// }
//Stock Reports

//Payment Report
public function paymentReport(){
    $vendors = Vendor::all();
    return view('pages.reports.payment.payment-report',compact('vendors'));
}
public function paymentSearch(Request $request){
    $vendors = Vendor::all();
    $vendor_id=$request->vendor_id;
    $start_date=$request->start_date;
    $end_date=$request->end_date;
    $dateRange = [
        'start_date'=>$request->start_date,
        'end_date'=>$request->end_date,
    ];
    $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
    $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
if(empty(!$vendor_id)){
    $paymentDetails = DB::table('vendor_payments')
    ->join('vendors','vendors.id', '=','vendor_payments.vendor_id')
    ->join('payment_modes','payment_modes.id', '=','vendor_payments.pay_mode')
    ->join('bank_names','bank_names.id', '=','vendor_payments.bank_name_id')
    ->select('vendor_payments.*','vendors.vendor_name','payment_modes.pay_mode','bank_names.bank_name')
    ->whereBetween('pay_date',[$start_date,$end_date])
    ->where('vendor_payments.vendor_id','=',$request->vendor_id)
    ->orderby('vendor_payments.pay_date','DESC')->get();
    return view('pages.reports.payment.payment-report',compact('vendors','paymentDetails','dateRange','start_date','end_date','vendor_id'));

}else{
    $paymentDetails = DB::table('vendor_payments')
    ->join('vendors','vendors.id', '=','vendor_payments.vendor_id')
    ->join('payment_modes','payment_modes.id', '=','vendor_payments.pay_mode')
    ->join('bank_names','bank_names.id', '=','vendor_payments.bank_name_id')
    ->select('vendor_payments.*','vendors.vendor_name','payment_modes.pay_mode','bank_names.bank_name')
    ->whereBetween('pay_date',[$start_date,$end_date])
    ->orderby('vendor_payments.pay_date','DESC')->get();
    return view('pages.reports.payment.payment-report',compact('vendors','paymentDetails','dateRange','start_date','end_date','vendor_id'));

}
}

public function paymentPrint(Request $request){
    $vendor_id=$request->vendor_id;
    $start_date=$request->start_date;
    $end_date=$request->end_date;
    $dateRange = [
        'start_date'=>$request->start_date,
        'end_date'=>$request->end_date,
    ];
    $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
    $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
    if(empty(!$vendor_id)){
        $paymentDetails = DB::table('vendor_payments')
        ->join('vendors','vendors.id', '=','vendor_payments.vendor_id')
        ->join('payment_modes','payment_modes.id', '=','vendor_payments.pay_mode')
        ->join('bank_names','bank_names.id', '=','vendor_payments.bank_name_id')
        ->select('vendor_payments.*','vendors.vendor_name','payment_modes.pay_mode','bank_names.bank_name')
        ->whereBetween('pay_date',[$start_date,$end_date])
        ->where('vendor_payments.vendor_id','=',$request->vendor_id)
        ->orderby('vendor_payments.pay_date','DESC')->get();
        return view('pages.reports.payment.payment-print',compact('paymentDetails','dateRange','start_date','end_date','vendor_id'));

    }else{
        $paymentDetails = DB::table('vendor_payments')
        ->join('vendors','vendors.id', '=','vendor_payments.vendor_id')
        ->join('payment_modes','payment_modes.id', '=','vendor_payments.pay_mode')
        ->join('bank_names','bank_names.id', '=','vendor_payments.bank_name_id')
        ->select('vendor_payments.*','vendors.vendor_name','payment_modes.pay_mode','bank_names.bank_name')
        ->whereBetween('pay_date',[$start_date,$end_date])
        ->orderby('vendor_payments.pay_date','DESC')->get();
        return view('pages.reports.payment.payment-print',compact('paymentDetails','dateRange','start_date','end_date','vendor_id'));

    }
}



}
