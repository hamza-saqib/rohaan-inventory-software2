@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Inventory Issue List</title>

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
                <h2>Inventory Issue Management</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('issue-inventories.index') }}">Issue Inventory</a>
                    </li>
                    <li class="active">
                        <strong>List</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="{{ route('issue-inventories.create') }}" class="btn btn-primary">+ Create New</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="ibox-content m-b-sm border-bottom">
                    <div class="row">
                        <form action="{{ route('issue-inventories.index') }}" method="GET">
                            @csrf
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="saerch_keyword">Search</label>
                                    <input
                                        name="saerch_keyword" id="saerch_keyword" type="text" class="form-control"
                                        value="{{ old('saerch_keyword') ?? '' }}">

                                </div>
                            </div>
                            <div class="col-sm-3">
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
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="date_modified">Item</label>
                                    <div class="input-group date">
                                        <select data-placeholder="Select Item" class="chosen-select" tabindex="2"
                                        id="productSelect" name="product_code" >
                                            <option selected >All</option>
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
                            </div>

                            <div class="col-sm-1">
                                <div class="form-group">
                                    <!-- <label class="control-label" for="amount">_____________</label> -->
                                    <div class="input-group date">
                                        <button class="btn btn-primary" type="submit" value="search" name="button">Search</button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <!-- <label class="control-label" for="amount">_____________</label> -->
                                    <div class="input-group date">
                                        <button class="btn btn-warning" type="submit" name='button' value="export">Export</button>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>List of Inventory Issue.</h5>
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
                                            <th>Issue No.</th>
                                            <th>Issue Date</th>
                                            <th>Location</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventories as $inventory)
                                            <tr class="gradeX" id="row-{{ $inventory->id_col }}">
                                                <td>{{ $inventory->isno }}</td>
                                                <td>{{ date('d/m/Y', strtotime($inventory->isdt)) }}</td>
                                                <td>{{ $inventory->dpt }}</td>
                                                <td>{{ $inventory->product }}</td>
                                                <td>{{ $inventory->Qty }}</td>
                                                <td>{{ $inventory->Irate }}</td>
                                                <td>{{ $inventory->remarks }}</td>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">

                                                        <a href="{{ route('issue-inventories.edit', $inventory->id_col) }}"
                                                            class="btn-white btn btn-xs">Edit</a>
                                                        <a href="{{ route('issue-inventories.voucher', $inventory->isno) }}"
                                                            class="btn-white btn btn-xs">Voucher</a>
                                                        <button onclick="deleteRecord({{ $inventory->id_col }})"
                                                            class="btn-white btn btn-xs">Delete</button>
                                                    </div>
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
                                            <th>{{$sum['totalValue']}}</th>
                                            <th></th>
                                        </tr> --}}
                                    </tfoot>
                                </table>
                                <!-- {{ $inventories->links('vendor.pagination.bootstrap-5') }} -->
                                {{ $inventories->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
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
        $("#vendorSelect").select2();
        $("#productSelect").select2();
        // $(document).ready(function() {
        //     $('.dataTables-example').DataTable({
        //         dom: '<"html5buttons"B>lTfgitp',
        //         buttons: [
        //             // {extend: 'copy'},
        //             // {extend: 'csv'},
        //             // {extend: 'excel', title: 'ExampleFile'},
        //             // {extend: 'pdf', title: 'ExampleFile'},

        //             // {extend: 'print',
        //             //  customize: function (win){
        //             //         $(win.document.body).addClass('white-bg');
        //             //         $(win.document.body).css('font-size', '10px');

        //             //         $(win.document.body).find('table')
        //             //                 .addClass('compact')
        //             //                 .css('font-size', 'inherit');
        //             // }
        //             // }
        //         ],
        //         processing: true,
        //         serverSide: true,
        //         ajax: "{{ route('recieve-inventories.index') }}",
        //         columns: [{
        //                 data: 'sc',
        //                 name: 'id'
        //             },
        //             {
        //                 data: 'ic',
        //                 name: 'name'
        //             },
        //             {
        //                 data: 'rat',
        //                 name: 'email'
        //             },
        //             {
        //                 data: 'rat',
        //                 name: 'email'
        //             },
        //         ]

        //     });

        // });

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
                    url: "{{ route('issue-inventories.destroy', '') }}/" + id,
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
