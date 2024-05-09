@extends('layouts.app')

@section('title-meta')
<title>{{ config('app.name') }} | Item Ledger Report</title>
<meta name="description" content="this is description">
@endsection

@section('other-css')
<!-- datatable -->
<link href="{{ asset('assets') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection

@section('content')
<div id="page-wrapper" class="gray-bg">

    <div class="row border-bottom">
        @include('partials.header')
    </div>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Item Ledger Report</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Item</a>
                </li>
                <li class="active">
                    <strong>Report</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <form action="{{ route('reports.products.ledger') }}" method="GET">
                        @csrf
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="date_modified">Item</label>
                                <div class="input-group date">
                                    <select data-placeholder="Select Item" class="chosen-select" tabindex="2" id="productSelect" name="product_code" required>
                                        <option selected disabled>Select</option>
                                        @foreach ($products as $product)
                                        @if (old('product_code') == $product->code)
                                        <option selected value="{{ $product->code }}">
                                            {{ $product->code . ' - ' . $product->name1 }}
                                        </option>
                                        @else
                                        <option value="{{ $product->code }}">
                                            {{ $product->code . ' - ' . $product->name1 }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="date_added">Start Date</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="start_date" id="date_added" type="date" class="form-control" value="{{ old('start_date') ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="date_modified">End Date</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="end_date" id="date_modified" type="date" class="form-control" value="{{ old('end_date') ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="amount">_____________</label>
                                <div class="input-group date">
                                    <button class="btn btn-primary" type="submit">Generate</button>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>List of Item.</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-product">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <!-- <th></th> -->
                                        <!-- <th></th> -->
                                        <th colspan="4" style="text-align: center">Recieved</th>
                                        <th colspan="4" style="text-align: center">Issued</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <!-- <th>Code</th>
                                        <th>Description</th> -->
                                        <th>GRN</th>
                                        <th>Qty In</th>
                                        <th>Rate</th>
                                        <th>Amount In</th>
                                        <th>Issue No.</th>
                                        <th>Qty Out</th>
                                        <th>Rate</th>
                                        <th>Amount Out</th>
                                        <th>Balance Qty</th>
                                        <th>Balance Amount</th>
                                        {{-- <th>Amount</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $balanceQty = 0;
                                    $balanceAmount = 0;
                                    @endphp
                                    @foreach ($records as $record)
                                    <tr class="gradeX" id="row-{{ $record['code'] }}">
                                        <td>{{ date('m/d/Y', strtotime($record['date'])) }}</td>
                                        <!-- <td>{{ $record['code'] }}</td>
                                        <td>{{ $record['product'] }}</td> -->
                                        <!-- <td>{{ $record['grn'] ?? '' }}</td>
                                        <td>{{ $record['qtyOut'] ?? '' }}</td>
                                        <td>{{ $record['rateOut'] ?? '' }}</td>
                                        <td>{{ $record['valueOut'] ?? '' }}</td>
                                        <td>{{ $record['code'] ?? '' }}</td>
                                        <td>{{ $record['qtyIn'] ?? '' }}</td>
                                        <td>{{ $record['rateIn'] ?? '' }}</td>
                                        <td>{{ $record['valueIn'] ?? '' }}</td> -->

                                        <td>{{ isset($record['grn']) ? number_format($record['grn'], 2) : '' }}</td>
                                        <td>{{ isset($record['qtyOut']) ? number_format($record['qtyOut'], 2) : '' }}</td>
                                        <td>{{ isset($record['rateOut']) ? number_format($record['rateOut'], 2) : '' }}</td>
                                        <td>{{ isset($record['valueOut']) ? number_format($record['valueOut'], 2) : '' }}</td>
                                        <td>{{ isset($record['code']) ? number_format($record['code'], 2) : '' }}</td>
                                        <td>{{ isset($record['qtyIn']) ? number_format($record['qtyIn'], 2) : '' }}</td>
                                        <td>{{ isset($record['rateIn']) ? number_format($record['rateIn'], 2) : '' }}</td>
                                        <td>{{ isset($record['valueIn']) ? number_format($record['valueIn'], 2) : '' }}</td>

                                        @php
                                        // Check if key exists before accessing its value
                                        $qtyOut = isset($record['qtyOut']) ? $record['qtyOut'] : 0;
                                        $qtyIn = isset($record['qtyIn']) ? $record['qtyIn'] : 0;
                                        $valueOut = isset($record['valueOut']) ? $record['valueOut'] : 0;
                                        $valueIn = isset($record['valueIn']) ? $record['valueIn'] : 0;

                                        $balanceQty -= $qtyIn - $qtyOut;
                                        $balanceAmount -= $valueIn - $valueOut;
                                        @endphp
                                        <td>{{ number_format($balanceQty, 2) }}</td>
                                        <td>{{ number_format($balanceAmount, 2) }}</td>

                                        <!-- <td>{{ $balanceQty }}</td>
                                        <td>{{ $balanceAmount }}</td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <!-- <th></th>
                                        <th></th> -->
                                        <th></th>
                                        <th>{{ $sum['totalQtyOut'] ?? '' }}</th>
                                        <th></th>
                                        <th>{{ $sum['totalValueOut'] ?? '' }}</th>
                                        <th></th>
                                        <th>{{ $sum['totalQtyIn'] ?? '' }}</th>
                                        <th></th>
                                        <th>{{ $sum['totalValueIn'] ?? '' }}</th>
                                        <th>{{ $balanceQty }}</th>
                                        <th>{{ $balanceAmount }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('partials.footer')

</div>
@endsection

@section('custom-script')
<!-- Sweet alert -->
<script src="{{ asset('assets') }}/js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- datatables -->
<script src="{{ asset('assets') }}/js/plugins/dataTables/datatables.min.js"></script>
@if(isset($record) && !is_null($record))
    <script>
        var code = "{{ $record['code'] }}";
        var product = "{{ $record['product'] }}";
    </script>
@endif
<script>
    $("#productSelect").select2();
    var date = new Date().toISOString().slice(0, 10);
    var sDate = $('#date_added').val();
    var eDate = $('#date_modified').val();
    



    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'pdf',
                    // title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\n ' + 'Item Ledger Report of :' + '\n ( ' + sDate + ' to ' + eDate + ' )',
                    title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\n ' + 'Item Ledger Report of: ' + code + ' ' + product  + '( From: ' + sDate + ' To: ' + eDate + ' )',
                    orientation: 'landscape',
                    filename: 'Item Ledger Report of: ' + code + ' ' + product  + '( From: ' + sDate + ' To: ' + eDate + ' )',

                    customize: function(doc) {
                        var colCount = new Array();
                        $('.dataTables-example').find('tbody tr:first-child td').each(
                            function() {
                                if ($(this).attr('colspan')) {
                                    for (var i = 1; i <= $(this).attr('colspan'); $i++) {
                                        colCount.push('*');
                                    }
                                } else {
                                    colCount.push('*');
                                }
                            });
                        doc.content[1].table.widths = colCount;
                    }
                },
                {
                    extend: 'excel',
                    title: 'Item Ledger Report ( ' + date + ' )',
                    filename: 'Item Ledger Report ( ' + date + ' )',
                },
                // {extend: 'excel', title: 'ExampleFile'},
                // {extend: 'pdf', title: 'ExampleFile'},

                // {extend: 'print',
                //  customize: function (win){
                //         $(win.document.body).addClass('white-bg');
                //         $(win.document.body).css('font-size', '10px');

                //         $(win.document.body).find('table')
                //                 .addClass('compact')
                //                 .css('font-size', 'inherit');
                // }
                // }
            ]

        });

    });


    function deleteRecord(id) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            $.ajax({
                method: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                url: "{{ route('products.destroy', '') }}/" + id,
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        swal("Deleted!", "Your record has been deleted.", "success");
                        $("#row-" + id).remove();
                    } else if (response.error) {
                        swal("Error !", response.error, "error");
                    } else {
                        log.
                        swal("Error !", "Not Authorize | Logical Error", "error");
                    }
                },
                error: function(response) {
                    swal("Error!", "Cannot delete !", "error");
                }
            });

        });

    }
</script>

<script>
    var Success = `{{ \Session::has('success') }}`;
    var Error = `{{ \Session::has('error') }}`;

    if (Success) {
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 7000
            };
            toastr.success('Success Message', `{{ \Session::get('success') }}`);
        }, 1300);
    } else if (Error) {
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.error('Failure Message', `{{ \Session::get('error') }}`);
        }, 1300);
    }
</script>
@endsection