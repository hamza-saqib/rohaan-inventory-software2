@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Inventory Issue</title>

    <meta name="description" content="this is description">
@endsection

@section('other-css')
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
                        <a href="{{ route('issue-inventories.index') }}">Inventory</a>
                    </li>
                    <li class="active">
                        <strong>Issue</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="{{ route('issue-inventories.index') }}" class="btn btn-primary">Show List</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content ">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" action="{{ route('issue-inventories.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Issue No.</label>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control @error('issue_no') is-invalid @enderror "
                                            name="issue_no" value="{{ old('issue_no') ?? $currentCode }}" required>
                                        @error('issue_no')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-1 control-label">Issue Date</label>

                                    <div class="col-sm-2 @error('issue_date') has-error @enderror">
                                        <input type="date" class="form-control" name="issue_date"
                                            value="{{ old('issue_date') ?? date('Y-m-d') }}" required>
                                        @error('issue_date')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Item</label>

                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <select data-placeholder="Select Item" class="chosen-select" tabindex="2"
                                                id="productSelect" name="product_code">
                                                <option value="">Select Item</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->code }}">
                                                        {{ $product->code . ' - ' . $product->name1 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 control-label">Onhand</label>

                                    <div class="col-sm-2">
                                        <input id="onhand" class="form-control" type="text" name="onhand">
                                    </div>
                                    {{-- <label class="col-sm-1 control-label">Value</label>

                                    <div class="col-sm-2">
                                        <input id="value" class="form-control" type="number" name="value">
                                    </div> --}}


                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Qty</label>

                                    <div class="col-sm-2">
                                        <input id="qty" class="form-control" type="number" name="qty">
                                    </div>
                                    <label class="col-sm-1 control-label">Wgt Avg. Rate</label>

                                    <div class="col-sm-2">
                                        <input id="wgt_avg_rate" class="form-control" type="text" name="wgt_avg_rate">
                                    </div>

                                    <label class="col-sm-1 control-label">Value</label>

                                    <div class="col-sm-2">
                                        <input id="wgt_value" class="form-control" type="text" name="wgt_value">
                                    </div>
                                    <label class="col-sm-1 control-label">Remarks</label>
                                    <div class="col-sm-2">
                                        <input id="remarks" class="form-control" type="text" name="remarks">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Location</label>

                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <select data-placeholder="Select Location" class="chosen-select" tabindex="2"
                                                id="locationSelect" name="location_code">
                                                <option value="">Select Location</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->code1 }}">
                                                        {{ $location->code1 . ' - ' . $location->name1 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 " style="text-align: right">
                                        <button onclick="addProduct()" class="btn btn-primary" type="button">Add</button>
                                    </div>
                                </div>

                                {{-- <div class="ibox-content"> --}}

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Issue Value</th>
                                            <th>Issue Location</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                    </tbody>
                                </table>


                                <div class="ibox-content">
                                    <h3>Total value: <strong id="gTotalValue">0</strong></h3>

                                </div>
                                <br>
                                <div class="hr-line-dashed"></div>


                                <button class="btn btn-primary" type="submit" name="button" value="Save">Issue
                                    Inventory</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        @include('partials.footer')

    </div>
@endsection


@section('custom-script')
    <script>
        $("#locationSelect").select2();
        $("#productSelect").select2();

        $(document).ready(function() {
            var products = @json($products);
            function calculateValue() {
                // Get values from other input fields
                var value1 = $('#qty').val();
                var value2 = $('#wgt_avg_rate').val();

                // Set value to another input field
                $('#wgt_value').val(value1 * value2);
            }
            $('#qty').on('input', calculateValue);
            $('#wgt_avg_rate').on('input', calculateValue);

            $('#productSelect').on('change', function(e) {
                var product = products[$(this).prop('selectedIndex')];
                $('#onhand').val(parseFloat(product.qtyIn) - parseFloat(product.qtyOut));
            });
        });
    </script>
    <script>
        var products = @json($products);
        var vendors = @json($locations);
        //console.log(products);
        var counter = 1;
        var gTotalValue = 0;

        function addProduct() {
            if ($('#qty').val() && $('#wgt_avg_rate').val()) {
                var productIndex = $('#productSelect').prop('selectedIndex') - 1;
                var name = $('#productSelect').find(":selected").text();
                var code = $('#productSelect').find(":selected").val();
                var locationCode = $('#locationSelect').find(":selected").val();
                var locationName = $('#locationSelect').find(":selected").text();
                var qty = $('#qty').val();
                var wgt_avg_rate = $('#wgt_avg_rate').val();
                var issue_value = $('#wgt_value').val();
                var remarks = $('#remarks').val();

                if (productIndex) {
                    $('#productTableBody').append(`<tr id="row-${counter}">
                        <td>${code}</td>
                        <td>${name}</td>
                        <td>${qty}</td>
                        <td>${wgt_avg_rate}</td>
                        <td>${wgt_avg_rate * qty}</td>
                        <td>${locationName}</td>
                        <td>${remarks}</td>
                        <td>
                            <a onclick="deleteProduct(${counter})">
                                <small class="label label-danger"><i class="fa"></i>delete</small>
                            </a>
                        </td>

                        <input type="hidden" name="products[code][]" value="${code}">
                        <input type="hidden" name="products[qty][]" value="${qty}">
                        <input type="hidden" name="products[wgt_avg_rate][]" value="${wgt_avg_rate}">
                        <input type="hidden" name="products[issue_value][]" value="${wgt_avg_rate * qty}">
                        <input type="hidden" name="products[locationCode][]" value="${locationCode}">
                        <input type="hidden" name="products[remarks][]" value="${remarks}">
                        <input type="hidden" name="products[location][]" value="${locationName}">

                    </tr>`);
                    counter++;

                }
                calculateTotalAmmount();
            }

        }

        function deleteProduct(rowId) {
            $("#row-" + rowId).remove();
            calculateTotalAmmount();
        }

        function calculateTotalAmmount() {
            gTotalValue = 0;

            var wgt_avg_rateArr = $("input[name='products[wgt_avg_rate][]']")
                .map(function() {
                    return $(this).val();
                }).get();

            var qtyArr = $("input[name='products[qty][]']")
                .map(function() {
                    return $(this).val();
                }).get();

            wgt_avg_rateArr.forEach(function myFunction(value, index, arr) {
                console.log('wgt_avg_rateArr', value);
                gTotalValue = gTotalValue + (parseFloat(value) * qtyArr[index]);
            })

            $('#gTotalValue').html(gTotalValue);
        }

        // $('#discount').on('input', function(e) {
        //     discount = $('#discount').val();
        //     calculateTotalAmmount();
        // });


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
