@extends('layouts.app')

@section('title-meta')
<title>{{ config('app.name') }} | Inventory Receipt Reports</title>

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
            <h2>Inventory Receipt Reports</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('recieve-inventories.index') }}">Inventory Receipt</a>
                </li>
                <li class="active">
                    <strong>Reports</strong>
                </li>
            </ol>
        </div>
        {{-- <div class="col-sm-8">
                <div class="title-action">
                    <a href="{{ route('recieve-inventories.create') }}" class="btn btn-primary">+ Create New</a>
    </div>
</div> --}}
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <form action="{{ ($report == 'Item') ? route('reports.product') : route('reports.supplier') }}" method="GET">
                    @csrf
                    {{-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="date_added">Start Date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input
                                            name="start_date" id="date_added" type="date" class="form-control"
                                            value="{{ old('start_date') ?? '' }}">
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
    </div> --}}
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label" for="date_modified">Fiscal Year</label>
            <div class="input-group date">
                <select class="form-control" name="year" required>
                    <option selected disabled>Select</option>
                    @foreach ($years as $year)
                    @if (old('year') == $year)
                    <option selected value="{{ $year }}">{{ $year }}
                    </option>
                    @else
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endif
                    @endforeach
                </select>
                @error('year')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label" for="date_modified">{{$report}}</label>
            <div class="input-group date">
                <select data-placeholder="Select {{$report}}" class="chosen-select" tabindex="2" id="productSelect" name="code">
                    <option selected>All</option>
                    @foreach ($dropDownData as $value)
                    @if (old('code') == $value->code)
                    <option selected value="{{ $value->code }}">{{ $value->code . ' - ' . $value->name1 }} </option>
                    @else
                    <option value="{{ $value->code }}">{{ $value->code . ' - ' . $value->name1 }}</option>
                    @endif
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    {{-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="date_modified">Item</label>
                                    <div class="input-group date">
                                        <select class="form-control" name="product_code" >
                                            <option selected disabled>Select</option>
                                            @foreach ($products as $product)
                                                @if (old('product_code') == $product->code)
                                                    <option selected value="{{ $product->code }}">{{ $product->code . ' - ' . $product->name1 }}
    </option>
    @else
    <option value="{{ $product->code }}">{{ $product->code . ' - ' . $product->name1 }}</option>
    @endif
    @endforeach
    </select>
</div>
</div>
</div> --}}
{{-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="date_modified">Supplier</label>
                                    <div class="input-group date">
                                        <select class="form-control" name="vendor_code" >
                                            <option selected disabled>Select</option>
                                            @foreach ($vendors as $vendor)
                                                @if (old('vendor_code') == $vendor->code)
                                                    <option selected value="{{ $vendor->code }}">{{ $vendor->code . ' - '. $vendor->name1 }}
</option>
@else
<option value="{{ $vendor->code }}">{{ $vendor->code . ' - '. $vendor->name1 }}</option>
@endif
@endforeach
</select>
</div>
</div>
</div> --}}
<div class="col-sm-2"></div>
<div class="col-sm-2">
    <div class="form-group">
        <label class="control-label" for="amount">_____________</label>
        <div class="input-group date">
            <button class="btn btn-primary" type="submit">Generate Report</button>
        </div>

    </div>
</div>

</form>
</div>

</div>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>List of {{$report}}.</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
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
                            <th>Code</th>
                            <th>{{$report}} Description</th>
                            <th>July</th>
                            <th>August</th>
                            <th>September</th>
                            <th>October</th>
                            <th>November</th>
                            <th>December</th>
                            <th>January</th>
                            <th>Febraury</th>
                            <th>March</th>
                            <th>April</th>
                            <th>May</th>
                            <th>June</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                        <tr class="gradeX" id="row-{{ $record->code }}">
                            <td>{{ $record->code }}</td>
                            <td>{{ $record->name1 }}</td>
                            <td>{{ ($record->jul > 0 ) ? round($record->jul, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->aug > 0 ) ? round($record->aug, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->sep > 0 ) ? round($record->sep, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->oct > 0 ) ? round($record->oct, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->nov > 0 ) ? round($record->nov, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->dec > 0 ) ? round($record->dec, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->jan > 0 ) ? round($record->jan, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->feb > 0 ) ? round($record->feb, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->mar > 0 ) ? round($record->mar, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->apr > 0 ) ? round($record->apr, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->may > 0 ) ? round($record->may, 2) : '----  -- --  ----'}}</td>
                            <td>{{ ($record->jun > 0 ) ? round($record->jun, 2) : '----  -- --  ----'}}</td>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        {{-- <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>{{$sum['rate']}}</th>
                        <th>{{$sum['sed']}}</th>
                        <th>{{$sum['fed']}}</th>
                        <th>{{$sum['deduction']}}</th>
                        <th>{{$sum['sales_tax']}}</th>
                        <th>{{$sum['net_value']}}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tr> --}}
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
        var product = "{{ $record['name1'] }}";
    </script>
@endif
<script>
    $("#productSelect").select2();
    var date = new Date().toISOString().slice(0, 10);
    var sDate = '{{$startYear}}';
    var eDate = '{{$endYear}}';
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            paging: false,
            searching: false,
            buttons: [{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\n ' + 'Inventory Receipts ' + @json($report) + ' Monthly Report Of: ' + code + ' ' + product + '\n( From July ' + sDate + ' To June ' + eDate + ' )',
                    filename: @json($report) + ' Monthly Report Of: ' + code + ' ' + product + '( From July ' + sDate + ' To June ' + eDate + ' )',

                },
                {
                    extend: 'excel',
                    title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\n ' + 'Inventory Receipts ' + @json($report) + ' Monthly Report Of: ' + code + ' ' + product + '\n( From July ' + sDate + ' To June ' + eDate + ' )',
                    filename: @json($report) + ' Monthly Report Of: ' + code + ' ' + product + '( From July ' + sDate + ' To June ' + eDate + ' )',

                }
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
                url: "{{ route('recieve-inventories.destroy', '') }}/" + id,
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