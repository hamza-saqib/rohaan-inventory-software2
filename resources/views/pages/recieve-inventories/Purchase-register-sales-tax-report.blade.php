@extends('layouts.app')

@section('title-meta')
<title>{{ config('app.name') }} | Purchase Register Sale Tax Report</title>

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
            <h2>Purchase Register Sale Tax Report</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Sales Tax</a>
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
                    <form action="{{ route('reports.recieve-inventories.purchaseregister') }}" method="GET">
                        @csrf
                        <div class="col-sm-4">
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
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="reportType">Report type:</label><br>
                                <input type="radio" id="allParties" name="reportType" value="All Parties">
                                <label for="allParties">All Parties</label><br>
                                <input type="radio" id="taxableParties" name="reportType" value="Taxable Parties">
                                <label for="taxableParties">Taxable Parties</label><br>
                                <input type="radio" id="nonTaxableParties" name="reportType" value="Non Taxable Parties">
                                <label for="nonTaxableParties">Non Taxable Parties</label><br>
                                <input type="hidden" id="reportType" value="{{ $reportType }}">

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
                                    <!-- <tr>
                                        <th></th>
                                        <th  style="text-align: center">SUPPLIER NAME / ADDRESS WITH STN</th>
                                        <th  style="text-align: center"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr> -->
                                    <tr>
                                        <th>Invoice Date</th>
                                        <th  style="text-align: center">Supplier Name</th>
                                        <th  style="text-align: center">Supplier Address</th>
                                        <th  style="text-align: center">Sales Tax Number</th>
                                        <th  style="text-align: center">Material Name / Description</th>
                                        <th>Quantity</th>
                                        <th>Unit Rate</th>
                                        <th>Amount Excl. S.Tax</th>
                                        <th>Special Excise Duty</th>
                                        <th>Sales Tax Amount</th>
                                        <th>Amount Including Sales Tax</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                    
                                    <tr class="gradeX" id="row-{{ $record->id_col }}">
                                        
                                        <td>{{ $record->sid }}</td>
                                        <td >{{ $record->name1 }}</td>
                                        <td >{{ $record->address }}</td>
                                        <td >{{ $record->stn }}</td>
                                        <td >{{ $record->product }}</td>
                                        <td>{{ $record->qty }}</td>
                                        <td>{{ $record->rat }}</td>
                                        <td>{{ $record->ved }}</td>
                                        <td>{{ $record->sed }}</td>
                                        <td>{{ $record->st }}</td>
                                        <td>{{ $record->ved + $record->st + $record->sed + $record->fed + $record->od }}</td>
                                        <td>{{ $record->remarks }}</td>
                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>

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
        var code = "{{ $record['ic'] }}";
        var product = "{{ $record['product'] }}";
    </script>
@endif
<script>
    $("#productSelect").select2();
    var date = new Date().toISOString().slice(0, 10);
    var sDate = $('#date_added').val();
    var eDate = $('#date_modified').val();
    var reportType = $('#reportType').val();


    $(document).ready(function() {
    $('.dataTables-example').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {
                extend: 'pdf',
                title: 'CONTINENTAL AIR CONTROL (PVT) LTD.\nPurchase Register '+ reportType +' Of: '  + code + ' ' + product + '\n( From: ' + sDate + ' To: ' + eDate + ' )',
                orientation: 'landscape',
                filename: 'Purchase Register Of: '  + code + ' ' + product + '( From: ' + sDate + ' To: ' + eDate + ' )',
                customize: function(doc) {
                    var colCount = new Array();
                    $('.dataTables-example').find('tbody tr:first-child td').each(function() {
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

@endsection