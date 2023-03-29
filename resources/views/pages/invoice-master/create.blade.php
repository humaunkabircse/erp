@extends('layouts.master')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Invoice Create</h3>
                    <a href="{{ route('invoice.master.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Invoice list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <!-- Textual inputs start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <!-- <h3 class="header-title">Receive Item
                                    <a class="btn btn-success btn-sm float-right" href="{{ route('receive.type.index') }}">
                                        <i class="fa fa-list">Receive List</i></a>
                                </h3> -->
                        @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-12">
                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-12">

                                        <div class="form-group">
                                            <label>Customer</label>
                                            <select class="form-control form-control-sm select2" name="cus_id" id="cus_id" required>
                                                <option selected disabled>Select Customer</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->cus_company }}
                                                </option>
                                                @endforeach
                                                 @if($errors->has('cus_id'))
                                <p class="text-danger">{{ $errors->first('cus_id') }} </p>
                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="form-group">
                                            <label>Invoice No</label>
                                            @php
                                            $invoice_id = \App\Models\InvoiceMaster::latest()->first();
                                            if($invoice_id){
                                            $invoice_number = 'ENV-'.'0'.$invoice_id->id+1;
                                            }else{
                                            $invoice_number = 'ENV-'.'01';
                                            }

                                            @endphp
                                            <input class="form-control form-control-sm small" type="text" name="invoice_number" id="invoice_number" value="{{$invoice_number}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="form-group">
                                            <label>Invoice Date</label>
                                            <input class="form-control form-control-sm datepicker" type="date" name="invoice_date" value="{{date('Y-m-d')}}" id="invoice_date" />
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="form-group">
                                            <label>Invoice Due Date</label>
                                            <input class="form-control form-control-sm datepicker" type="date" name="invoice_due_date" value="{{date('Y-m-d')}}" id="invoice_due_date" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input class="form-control form-control-sm" type="number" name="discount" id="discount">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="form-group">
                                            <label>Adjustment</label>
                                            <input class="form-control form-control-sm" type="number" name="adjustment" id="adjustment">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Terms And Condition</label>
                                            <select class="form-control form-control-sm select2" name="terms_and_conditions" id="terms_and_conditions">
                                                <option selected disabled>Select Item</option>
                                                @foreach ($terms as $term)
                                                <option value="{{ $term->id }}">
                                                    {{ $term->term_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-3 col-md-3 col-12">
                                <div class="form-group">
                                    <label>Client Note</label>
                                    <textarea class="form-control form-control-sm" rows="5" type="text" name="client_note" id="client_note">
                                        </textarea>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Item Name</label>
                                <select class="form-control form-control-sm select2" name="item_id" id="item_id">
                                    <option selected disabled>Select Item</option>
                                    @foreach ($items as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->item_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="item_name" id="item_name" />
                            <div class="form-group col-md-2">
                                <label>Qty</label>
                                <input class="form-control form-control-sm" type="text" name="item_qty" id="item_qty" />
                                @error('item_qty')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label>Item Price</label>
                                <input class="form-control form-control-sm" type="text" name="item_price" id="item_price" />
                            </div>
                            <div class="form-group col-md-2">
                                <label>Item Discount</label>
                                <input class="form-control form-control-sm" type="text" name="item_discount" id="item_discount" />
                            </div>
                            <div class="form-group col-md-2">
                                <label>Total Price</label>
                                <input class="form-control form-control-sm" type="text" name="total_price" id="total_price" />
                            </div>

                            <div class="form-group col-md-1" style="padding-top:28px;">
                                <a class="btn btn-primary btn-sm addeventmore font-italic"><i class="fa fa-plus-circle"></i> Add</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('invoice.master.store') }}" method="POST" id="myForm">
                        @csrf
                        <table class="table-sm table-bordered text-center" width="100%">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Item Qty</th>
                                    <th>Item Price</th>
                                    <th>Item Discount</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="addRow" class="addRow">

                            </tbody>
                        </table>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm" id="storebutton">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Textual inputs end -->
    </div>
</div>
</div>
@endsection
@section('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#vendor_description').summernote({
            height: 100,
        });
    });
</script> -->
<script src="{{ asset('backend/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/handlebars.min.js') }}"></script>
<!--Select2 support-->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>
<!--Select2 cdn support-->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<script type="text/javascript">
    $(".select2").select2();
</script>
<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_item" id="delete_item">
        <input type="hidden" name= "cus_id" value="@{{ cus_id }}">
        <input type="hidden" name= "invoice_number" value="@{{ invoice_number }}">
        <input type="hidden" name= "invoice_date" value="@{{ invoice_date }}">
        <input type="hidden" name= "invoice_due_date" value="@{{ invoice_due_date }}">
        <input type="hidden" name= "discount" value="@{{ discount }}">
        <input type="hidden" name= "adjustment" value="@{{ adjustment }}">
        <input type="hidden" name= "client_note" value="@{{ client_note }}">
        <input type="hidden" name= "terms_and_conditions" value="@{{ terms_and_conditions }}">
        <input type="hidden" name= "item_id[]" value="@{{ item_id }}">
        <td>
            <input type="hidden" name= "item_name[]" class="form-control form-control-sm" value="@{{ item_name }}">
            @{{ item_name }}
        </td>
        <td>
            <input type="hidden" name= "item_qty[]" class="form-control form-control-sm" value="@{{ item_qty }}">
            @{{ item_qty }}
        </td>
        <td>
            <input type="hidden" name= "item_price[]" class="form-control form-control-sm" value="@{{ item_price }}">
            @{{ item_price }}
        </td>
        <td>
            <input type="hidden" name= "item_discount[]" class="form-control form-control-sm" value="@{{ item_discount }}">
            @{{ item_discount }}
        </td>
        <td>
            <input type="hidden" class="form-control form-control-sm" value="">
            @{{ total_price }}
        </td>
        <td><i class="btn btn-danger btn-xs fa fa-window-close removeeventmore"></i></td>
    </tr>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".addeventmore", function() {
            var cus_id = $('#cus_id').val();
            var invoice_number = $('#invoice_number').val();
            var invoice_date = $('#invoice_date').val();
            var invoice_due_date = $('#invoice_due_date').val();
            var discount = $('#discount').val();
            var adjustment = $('#adjustment').val();
            var client_note = $('#client_note').val();
            var terms_and_conditions = $('#terms_and_conditions').val();

            var item_id = $('#item_id').val();
            var item_name = $('#item_name').val();
            var item_qty = $('#item_qty').val();
            var item_price = $('#item_price').val();
            var item_discount = $('#item_discount').val();
            var total_price = $('#total_price').val();

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                cus_id: cus_id,
                invoice_number: invoice_number,
                invoice_date: invoice_date,
                invoice_due_date: invoice_due_date,
                discount: discount,
                adjustment: adjustment,
                client_note: client_note,
                terms_and_conditions: terms_and_conditions,
                item_id: item_id,
                item_name: item_name,
                item_qty: item_qty,
                item_price: item_price,
                item_discount: item_discount,
                total_price: total_price,
            };
            var html = template(data);
            $("#addRow").append(html);
        });
        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest(".delete_item").remove();
        });

    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on("keyup", "#item_qty", function() {
            var item_qty = $(this).val();
            var item_price = $("#item_price").val();
            var item_discount = $("#item_discount").val();
            var total_price = item_qty * item_price - item_discount;
            $("#total_price").val(total_price);
        });
    });
    $(function() {
        $(document).on("keyup", "#item_price", function() {
            var item_price = $(this).val();
            var item_qty = $("#item_qty").val();
            var item_discount = $("#item_discount").val();
            var total_price = item_qty * item_price - item_discount;
            $("#total_price").val(total_price);
        });
    });
    $(function() {
        $(document).on("keyup", "#item_discount", function() {
            var item_discount = $(this).val();
            var item_qty = $("#item_qty").val();
            var item_price = $("#item_price").val();
            var total_price = item_qty * item_price - item_discount;
            $("#total_price").val(total_price);
        });
    });

    $(document).ready(function() {
        $(document).on('change', '#item_id', function() {
            var item_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('item.name.info')}}",
                data: {
                    'item_id': item_id,
                },
                dataType: "json",
                success: function(response) {
                    $('#item_name').val(response.item_info.item_name);
                    $('#item_price').val(response.item_info.item_price);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#myForm').validate({ 
            rules: {
                item_qty: {
                    required: true,
                     minlength: 1
                },
            },
               messages: {
                     item_qty: {
                        required: "Item Quantity is required",
                        minlength: "Item Qty minimum 1"
                    },
            errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

@endsection