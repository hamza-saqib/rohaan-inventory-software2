@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Inventory Receipt List</title>

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
                        <a href="#">{{$report}}</a>
                    </li>
                    <li class="active">
                        <strong>List</strong>
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
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input
                                            name="end_date" id="date_modified" type="date" class="form-control"
                                            value="{{ old('end_date') ?? '' }}">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="date_modified">{{$report}}</label>
                                    <div class="input-group date">
                                        <select class="form-control" name="code" >
                                            <option selected >All</option>
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
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $record)
                                            <tr class="gradeX" id="row-{{ $record->code }}">
                                                <td>{{ $record->code }}</td>
                                                <td>{{ $record->name1 }}</td>
                                                <td>{{ ($record->jul > 0 ) ? $record->jul : ''}}</td>
                                                <td>{{ ($record->aug > 0 ) ? $record->aug : ''}}</td>
                                                <td>{{ ($record->sep > 0 ) ? $record->sep : ''}}</td>
                                                <td>{{ ($record->oct > 0 ) ? $record->oct : ''}}</td>
                                                <td>{{ ($record->nov > 0 ) ? $record->nov : ''}}</td>
                                                <td>{{ ($record->dec > 0 ) ? $record->dec : ''}}</td>
                                                <td>{{ ($record->jan > 0 ) ? $record->jan : ''}}</td>
                                                <td>{{ ($record->feb > 0 ) ? $record->feb : ''}}</td>
                                                <td>{{ ($record->mar > 0 ) ? $record->mar : ''}}</td>
                                                <td>{{ ($record->apr > 0 ) ? $record->apr : ''}}</td>
                                                <td>{{ ($record->may > 0 ) ? $record->may : ''}}</td>
                                                <td>{{ ($record->jun > 0 ) ? $record->jun : ''}}</td>
                                                
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

    <script>
        var date = new Date().toISOString().slice(0,10);
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                paging: false,
                searching: false,
                buttons: [
                    {
                        extend: 'pdf',
                        title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\n ' + @json($report) + ' Monthly Report ( ' + date + ' )' ,
                        orientation: 'landscape',
                        filename: @json($report) + ' Monthly Report ( ' + date + ' )',
                    },
                    {
                        extend: 'excel',
                        title: @json($report) + ' Monthly Report ( ' + date + ' )',
                        filename: @json($report) + ' Monthly Report ( ' + date + ' )',
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
