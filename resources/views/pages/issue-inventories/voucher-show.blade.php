@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Issue Voucher Show</title>

    <meta name="description" content="this is description">
@endsection

@section('other-css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
@endsection

@section('content')
    <div id="page-wrapper" class="gray-bg">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2>Inventory Issue Management</h2>
                <ol class="breadcrumb">

                    <li>
                        <a>Inventory</a>
                    </li>
                    <li class="active">
                        <strong>Issue Voucher</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    {{-- <a href="#" class="btn btn-white"><i class="fa fa-pencil"></i> Edit </a> --}}
                    <button onclick="pdf()" class="btn btn-primary">Download Pdf</button>

                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="ibox-content p-xl" id="myBillingArea" style="border: none">

                            <div class="col-sm-12 text-center">
                                <h2><strong>CONTINENTAL AIR CONTROL (PVT) LTD.</strong></h2>
                                <h2> <strong>Issue Voucher</strong> </h2>

                            </div>
                            <div class="row">


                                <div class="col-sm-6 text-left">
                                    <h4><strong>Issue No:</strong> {{ $issueNo }}</h4>

                                </div>
                                <div class="col-sm-6 text-right">
                                    <h4> <strong>Issue Date:</strong> {{ date('d/m/Y', strtotime($date)) }}
                                    </h4>

                                </div>
                            </div>
                            <br>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Item Description</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>{{ $inventory->ic }}</td>
                                                <td>
                                                    <strong>{{ $inventory->product }}</strong>
                                                </td>

                                                <td>{{ intval($inventory->Qty) }}</td>
                                                <td>{{ $inventory->Irate }}</td>
                                                <td>{{ $inventory->Qty * $inventory->Irate }}</td>
                                            </tr>
                                        @endforeach



                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>{{$qty}}</th>
                                            <th></th>
                                            <th>{{$totalValue}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">

                                    <h4>Prepared By : ______________________</h4>
                                </div>
                                <div class="col-sm-6 text-right">

                                    <h4>Approved By : ______________________</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        window.jsPDF = window.jspdf.jsPDF;
        var docPDF = new jsPDF("p", "mm", "a4");

        function pdf() {
            var elementHTML = document.querySelector("#myBillingArea");
            docPDF.html(elementHTML, {
                callback: function(docPDF) {
                    docPDF.save('voucher-issue-no-' + @json($issueNo)+ '.pdf');
                },
                x: 1,
                y: 1,
                width: 205,
                height: docPDF.internal.pageSize.getHeight(),
                windowWidth: 650
            });
        }
        $(document).ready(function() {


            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
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
@endsection
