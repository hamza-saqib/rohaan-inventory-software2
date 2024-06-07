@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Item List</title>
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
                <h2>Item Management</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">Item</a>
                    </li>
                    <li class="active">
                        <strong>List</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Create New</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
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
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>UOM</th>
                                            <th>Category</th>
                                            <th>Misc. Code</th>
                                            <!-- <th>Fax No.</th> -->
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr class="gradeX" id="row-{{ $product->code }}">
                                                <td>{{ $product->code }}</td>
                                                <td>{{ $product->name1 }}</td>
                                                <td>{{ $product->uom }}</td>
                                                <td>{{ $product->category->name1 }}</td>
                                                <td>{{ $product->misc_code }}</td>
                                                <!-- <td>{{ $product->tax_rate }}</td> -->
                                                <td>{{ $product->remarks }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('products.edit', $product->code) }}"
                                                            class="btn-white btn btn-xs">Edit</a>
                                                        <button onclick="deleteRecord({{ $product->code }})"
                                                            class="btn-white btn btn-xs">Delete</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>UOM</th>
                                            <th>Category</th>
                                            <th>Misc. Code</th>
                                            <!-- <th>Fax No.</th> -->
                                            <th>Remarks</th>
                                            <th>Action</th>
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
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {
                        extend: 'excel',
                        title: 'Products Data',
                        filename: 'Products Data',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
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
