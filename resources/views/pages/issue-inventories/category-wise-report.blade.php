@extends('layouts.app')

@section('title-meta')
<title>{{ config('app.name') }} | Issue Inventory / Category Wise Report</title>

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
            <h2>Issue Inventory / Category Wise Report</h2>
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
                    <form action="{{ route('reports.issue-inventories.category') }}" method="GET">
                        @csrf
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="date_modified">Item Category</label>
                                <div class="input-group date">
                                    <select data-placeholder="Select Category" class="chosen-select" tabindex="2" id="productSelect" name="category_code" required>
                                        <option selected disabled>Select</option>
                                        @foreach ($categories as $category)
                                        @if (old('category_code') == $category->code)
                                        <option selected value="{{ $category->code }}">
                                            {{ $category->code . ' - ' . $category->name1 }}
                                        </option>
                                        @else
                                        <option value="{{ $category->code }}">
                                            {{ $category->code . ' - ' . $category->name1 }}
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
                                        <th>Item Name</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                    <tr class="gradeX" id="row-{{ $record->id_col }}">
                                        <td>{{ $record->product }}</td>
                                        <td>{{ number_format($record->Irate * $record->Qty, 2) }}</td>
                                        <td>{{ $record->Irate }}</td>
                                        <td>{{ $record->Irate * $record->Qty }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total:</th>
                                        <th></th>
                                        <th></th>
                                        <th id="totalValue">{{ number_format($totalValue, 2) }}</th>
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

<script>
    $("#productSelect").select2();
    var date = new Date().toISOString().slice(0, 10);
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'pdf',
                    title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\n ' + 'Category Wise Issue Report ( ' +
                        date + ' )',
                    // orientation: 'landscape',
                    filename: 'Category Wise Issue Report ( ' + date + ' )',
                    customize: function(doc) {
                        var colCount = new Array();
                        $('.dataTables-example').find('tbody tr:first-child td').each(
                            function() {
                                if ($(this).attr('colspan')) {
                                    for (var i = 1; i <= $(this).attr('colspan'); i++) {
                                        colCount.push('*');
                                    }
                                } else {
                                    colCount.push('*');
                                }
                            });
                        doc.content[1].table.widths = colCount;

                        // Add total value row at the end of the table in PDF
                        var totalRow = ['Total:', '', '', $('#totalValue').text()];
                        doc.content[1].table.body.push(totalRow);
                    }
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

    <
    script >
        $(document).ready(function() {
            // Calculate and display total value
            calculateTotalValue();
        });

    function calculateTotalValue() {
        var total = 0;
        $('.dataTables-example tbody tr').each(function() {
            var value = parseFloat($(this).find('td:eq(3)').text());
            total += value;
        });
        $('#totalValue').text(total.toFixed(2));
    }
</script>

</script>
@endsection
