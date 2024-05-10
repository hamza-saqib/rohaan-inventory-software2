@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Item with Negative Qty List</title>
    <meta name="description" content="this is description">
@endsection

@section('other-css')
    <!-- Include necessary CSS -->
    <link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('partials.header')
        </div>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>Item with Negative Qty</h2>
                <ol class="breadcrumb">
                    <li><a href="#">Item</a></li>
                    <li class="active"><strong>List</strong></li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>List of Items</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <!-- Other tools -->
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Item Description</th>
                                            <!-- <th>Qty Recieved</th>
                                            <th>Qty Issued</th> -->
                                            <th>Balance Qty</th>
                                            <!-- <th>Amount In</th>
                                            <th>Amount Out</th> -->
                                            <th>Balance Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr class="gradeX" id="row-{{ $product->code }}">
                                                <td>{{ $product->code }}</td>
                                                <td>{{ $product->name1 }}</td>
                                                <!-- <td>{{ $product->qtyIn }}</td>
                                                <td>{{ $product->qtyOut }}</td> -->
                                                <td style="color: red">{{ -($product->qtyOut - $product->qtyIn) }}</td>
                                                <!-- <td>{{$product->totIn }}</td>
                                                <td>{{ $product->totOut }}</td> -->
                                                <td>{{ ($product->totIn - $product->totOut) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
    <!-- Include necessary JavaScript -->
    <script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        var date = new Date().toISOString().slice(0, 10);
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                    extend: 'pdf',
                    title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\nItem With Negative Qty Report (' + date + ')',
                    filename: 'Item With Negative Qty Report (' + date + ')',
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
                    }
                },
                {
                    extend: 'excel',
                    title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\nItem With Negative Qty Report (' + date + ')',
                    filename: 'Item With Negative Qty Report (' + date + ')',
                }
            ]
            });
        });

        function deleteRecord(id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
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
                            swal("Error !", "Not Authorized | Logical Error", "error");
                        }
                    },
                    error: function(response) {
                        swal("Error!", "Cannot delete!", "error");
                    }
                });
            });
        }

        // Display toastr messages
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
