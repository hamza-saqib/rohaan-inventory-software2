@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Issue Inventory / Item Monthly Report</title>

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
                <h2>Issue Inventory / Item Monthly Report</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('issue-inventories.index') }}">Issue Location</a>
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
                        <form action="{{ ($report == 'Item') ? route('reports.issue.product') : route('reports.supplier') }}" method="GET">
                            @csrf
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="date_modified">Fiscal Year</label>
                                    <div class="input-group date">
                                        <select class="form-control" name="year" required>
                                            <option selected disabled>Select</option>
                                            @foreach ($years as $year)
                                                @if (old('year') == $year)
                                                    <option selected value="{{ $year }}">{{ $year }}</option>
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
                                    <label class="control-label" for="date_modified">Item</label>
                                    <div class="input-group date">
                                        <select data-placeholder="Select Item" class="chosen-select" tabindex="2" id="productSelect" name="code">
                                            @foreach ($dropDownData as $value)
                                                @if (old('code') == $value->code)
                                                    <option selected value="{{ $value->code }}">{{ $value->code . ' - ' . $value->name1 }}</option>
                                                @else
                                                    <option value="{{ $value->code }}">{{ $value->code . ' - ' . $value->name1 }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4"></div>
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
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</th>
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
                                            <th>Total</th> <!-- New column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $record)
                                            <tr class="gradeX" id="row-{{ $record->code }}">
                                                <td>Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</td>
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
                                                <!-- Calculate total -->
                                                @php
                                                    $total = $record->jul + $record->aug + $record->sep + $record->oct + $record->nov + $record->dec + $record->jan + $record->feb + $record->mar + $record->apr + $record->may + $record->jun;
                                                @endphp
                                                <td>{{ $total }}</td> <!-- Display total -->
                                            </tr>
                                            <tr class="gradeX" id="row-{{ $record->code }}">
                                                <td>Quantity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</td>
                                                <td>{{ $record->code }}</td>
                                                <td>{{ $record->name1 }}</td>
                                                <td>{{ ($record->jul_qty > 0 ) ? round($record->jul_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->aug_qty > 0 ) ? round($record->aug_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->sep_qty > 0 ) ? round($record->sep_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->oct_qty > 0 ) ? round($record->oct_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->nov_qty > 0 ) ? round($record->nov_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->dec_qty > 0 ) ? round($record->dec_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->jan_qty > 0 ) ? round($record->jan_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->feb_qty > 0 ) ? round($record->feb_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->mar_qty > 0 ) ? round($record->mar_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->apr_qty > 0 ) ? round($record->apr_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->may_qty > 0 ) ? round($record->may_qty, 2) : '----  -- --  ----'}}</td>
                                                <td>{{ ($record->jun_qty > 0 ) ? round($record->jun_qty, 2) : '----  -- --  ----'}}</td>
                                                <!-- Calculate total -->
                                                @php
                                                    $total = $record->jul_qty + $record->aug_qty + $record->sep_qty + $record->oct_qty + $record->nov_qty + $record->dec_qty + $record->jan_qty + $record->feb_qty + $record->mar_qty + $record->apr_qty + $record->may_qty + $record->jun_qty;
                                                @endphp
                                                <td>{{ $total }}</td> <!-- Display total -->
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

    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                paging: false,
                searching: false,
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        // title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\n Inventory Issue Monthly Report ({{$year}})',
                        title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\n Inventory Issue  Monthly Report July  ({{$startYear}}) - June({{$endYear}})',
                        filename: 'Monthly Report July  ({{$startYear}}) - June({{$endYear}})',
                    },
                    {
                        extend: 'excel',
                        title: 'Monthly Report ({{$year}})',
                        filename: 'Monthly Report ({{$year}})',
                    }

                ]

            });

        });
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
    <script>
    $(document).ready(function() {
        $('.chosen-select').select2();
    });
</script>

@endsection
