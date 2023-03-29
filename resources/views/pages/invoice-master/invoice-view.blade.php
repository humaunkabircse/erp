@extends('layouts.master')
@section('style')

<style>
    table tr {
        height: 19px !important
    }

    .myTable {
        background: #333;
        padding: 5px 15px;
        border: 1px solid #333;
        border-radius: 10px;
        text-align: center;
        color: #fff;
        margin-left:10px;
    }


table tr{
    line-height: 0.5;  
}

</style>

@endsection
@section('content')
<div class="container">
<div class="row">
    <div class="col-md-10 offset-md-1 col-12">
    <!-- <a href="{{route('invoice.pdf',$invoiceMasterInfo->id)}}" type="button" class="btn btn-outline-warning btn-sm">Export to Pdf</a> -->
    <div class="row">
        <div class="col-md-4 offset-md-8">
        <a href="{{route('invoice.prnpriview',$invoiceMasterInfo->id)}}" class="btn btn-primary btn-sm btnprn">Print invoice</a>
    <a href="{{route('challan.preview',$invoiceMasterInfo->id)}}" class="btn btn-warning btn-sm btnprn">Print challen</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-12">
            <div class="navbar-brand">
                <a href="{{route('home')}}"><img src="{{asset('backend')}}/assets/images/logo.png" alt="" width="120px" height="50px"></a>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <h5 class="text-center">METHAN PLASTIC INDUSTRIES</h5>
            <p class="text-center">Vill: Bevage, Post: Baruipara, Mirpur, Kushtia <br> Email: Mehbuba@methanplastic.com, <br> Web: www.methanplastic.com<br> Cell: +8801955-462558</p>
        </div>
        <div class="col-md-2 col-12">
    
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-12 pb-2">
                    <span class="btn btn-dark btn-block">Invoice</span>
                </div>
        <div class="col-md-12 col-12">
            <table class="table table-bordered text-center">
                <tr>
                    <th>Invoice No</th>
                    <td>{{$invoiceMasterInfo->invoice_number}}</td>
                </tr>
                <tr>
                    <th>Invoice Date</th>
                    <td>{{date('d-m-Y', strtotime($invoiceMasterInfo->invoice_date))}}</td>
                </tr>
                <tr>
                    <th>PWD NO</th>
                    <td></td>
                </tr>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">

            <p>Name/company: {{$customerinfo->cus_company}}</p>


            <p>Address: {{$customerinfo->street}},{{$customerinfo->city}},{{$customerinfo->district}},{{$customerinfo->zip}},{{$customerinfo->country}}</p>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <table class="table table-bordered text-center">
                <tr>
                    <th>SL#</th>
                    <th>Description</th>
                    <th>Quantity(Pcs)</th>
                    <th>Unit Price</th>
                    <th>Total Price(Taka)</th>
                </tr>
                @php
                        $total = 0;
                        @endphp
                @foreach( $invoiceData as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->item_name}}</td>
                    <td>{{$item->item_qty}}</td>
                    <td>{{$item->item_price}}</td>
                    <td class="force">{{$item->item_qty * $item->item_price}}</td>
                   
                </tr>
                @php
                        $total += $item->item_price * $item->item_qty;
                        @endphp
                @endforeach
                <tr>

                    <td colspan="4">Subtotal:</td>
                    <td>{{$total}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 col-12">
           @php
                    function number_to_word( $num = '' )
                    {
                    $num = ( string ) ( ( int ) $num );

                    if( ( int ) ( $num ) && ctype_digit( $num ) )
                    {
                    $words = array( );

                    $num = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

                    $list1 = array('','one','two','three','four','five','six','seven',
                    'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                    'fifteen','sixteen','seventeen','eighteen','nineteen');

                    $list2 = array('','ten','twenty','thirty','forty','fifty','sixty',
                    'seventy','eighty','ninety','hundred');

                    $list3 = array('','thousand','million','billion','trillion',
                    'quadrillion','quintillion','sextillion','septillion',
                    'octillion','nonillion','decillion','undecillion',
                    'duodecillion','tredecillion','quattuordecillion',
                    'quindecillion','sexdecillion','septendecillion',
                    'octodecillion','novemdecillion','vigintillion');

                    $num_length = strlen( $num );
                    $levels = ( int ) ( ( $num_length + 2 ) / 3 );
                    $max_length = $levels * 3;
                    $num = substr( '00'.$num , -$max_length );
                    $num_levels = str_split( $num , 3 );

                    foreach( $num_levels as $num_part )
                    {
                    $levels--;
                    $hundreds = ( int ) ( $num_part / 100 );
                    $hundreds = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                    $tens = ( int ) ( $num_part % 100 );
                    $singles = '';

                    if( $tens < 20 ) { $tens=( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens=( int ) ( $tens / 10 ); $tens=' ' . $list2[$tens] . ' ' ; $singles=( int ) ( $num_part % 10 ); $singles=' ' . $list1[$singles] . ' ' ; } $words[]=$hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas=count( $words ); if( $commas> 1 )
                        {
                        $commas = $commas - 1;
                        }

                        $words = implode( ', ' , $words );

                        $words = trim( str_replace( ' ,' , ',' , ucwords( $words ) ) , ', ' );
                        if( $commas )
                        {
                        $words = str_replace( ',' , ' and' , $words );
                        }

                        return $words;
                        }
                        else if( ! ( ( int ) $num ) )
                        {
                        return 'Zero';
                        }
                        return '';
                        }

                        echo 'In Word (Taka) :'.number_to_word($total);
                        @endphp
        </div>
    </div>
    <div class="row mt-5 pt-3">
        <div class="col-md-3 col-12" style="font-size:12px">
            <p>Received By</p>
        </div>
        <div class="col-md-3 col-12" style="font-size:12px">
        <p>Prepared By</p> 
        </div>
        <div class="col-md-3 col-12" style="font-size:12px">
        <p>Recommended</p>
        </div>
        <div class="col-md-3 col-12" style="font-size:12px">
        <p>Authorised Signature</p>
        </div>
    </div>
    </div>
</div>


    




</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
      jQuery('.btnprn').printPage();
    });
</script>

<script>
    $(function() {
        var a = 0;
        $('.force').each(function() {
            a += parseInt($(this).text());
        });
        $('#total_forces').text(a);
    });
</script>

@endsection