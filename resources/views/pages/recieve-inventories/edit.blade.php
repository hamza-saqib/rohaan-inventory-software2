@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Inventory Receipt</title>

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
                <h2>Inventory Receipt Management</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('issue-inventories.index') }}">Inventory</a>
                    </li>
                    <li class="active">
                        <strong>Receipt</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="{{ route('recieve-inventories.index') }}" class="btn btn-primary">Show List</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content ">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" action="{{ route('recieve-inventories.update', $inventory->id_col) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">GRN</label>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control @error('grn') is-invalid @enderror "
                                            name="grn" value="{{ $inventory->gn }}" required>
                                        @error('grn')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-1 control-label">GRN Date</label>

                                    <div class="col-sm-2 @error('grn_date') has-error @enderror">
                                        <input type="date" class="form-control" name="grn_date"
                                            value="{{ date('Y-m-d', strtotime($inventory->gd)) }}" required>
                                        @error('grn_date')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label class="col-sm-1 control-label">Voucher No.</label>

                                    <div class="col-sm-2">
                                        <input type="text"
                                            class="form-control @error('voucher_no') is-invalid @enderror "
                                            name="voucher_no" value="{{ $inventory->vn }}" required>
                                        @error('voucher_no')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-1 control-label">Voucher Date</label>

                                    <div class="col-sm-2 @error('voucher_date') has-error @enderror">
                                        <input type="date" class="form-control" name="voucher_date"
                                            value="{{ date('Y-m-d', strtotime($inventory->vd)) }}" required>
                                        @error('voucher_date')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Suplier</label>

                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <select required data-placeholder="Select Suplier" class="chosen-select"
                                                tabindex="2" id="vendorSelect" name="vendor_code">
                                                <option value="">Select Suplier</option>
                                                @foreach ($vendors as $vendor)
                                                @if ($vendor->code == $inventory->sc)
                                                    <option selected value="{{ $vendor->code }}">
                                                        {{ $vendor->code . ' - ' . $vendor->name1 }}</option>
                                                @else
                                                    <option value="{{ $vendor->code }}">
                                                        {{ $vendor->code . ' - ' . $vendor->name1 }}</option>
                                                @endif
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <label class="col-sm-1 control-label">Suplier Inv. No</label>

                                    <div class="col-sm-2">
                                        <input required type="text" class="form-control has-error" name="vendor_inv"
                                            value="{{ $inventory->sin }}">
                                    </div>
                                    <label class="col-sm-1 control-label">Suplier Inv. Date</label>

                                    <div class="col-sm-2 @error('vendor_inv_date') has-error @enderror">
                                        <input type="date" class="form-control" name="vendor_inv_date"
                                            value="{{ date('Y-m-d', strtotime($inventory->sid)) }}" required>
                                        @error('vendor_inv_date')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>




                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Item</label>

                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <select data-placeholder="Select Item" class="chosen-select" tabindex="2"
                                                id="productSelect" name="product_code">
                                                <option value="">Select Item</option>
                                                @foreach ($products as $product)
                                                    @if ($product->code == $inventory->ic)
                                                        <option selected value="{{ $product->code }}">
                                                            {{ $product->code . ' - ' . $product->name1 }}</option>
                                                    @else
                                                        <option value="{{ $product->code }}">
                                                            {{ $product->code . ' - ' . $product->name1 }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 control-label">Qty</label>

                                    <div class="col-sm-2">
                                        <input id="qty" class="form-control" type="number" name="qty" value="{{$inventory->qty}}">
                                    </div>

                                    <label class="col-sm-1 control-label">L. Rate</label>

                                    <div class="col-sm-2">
                                        <input id="l_rate" class="form-control" type="text" name="l_rate" value="{{$inventory->rat}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Sale Tax</label>

                                    <div class="col-sm-2">
                                        <input id="sale_tax" class="form-control" type="text" name="sale_tax" value="{{$inventory->st}}">
                                    </div>
                                    <label class="col-sm-1 control-label">Excl. Stax</label>

                                    <div class="col-sm-2">
                                        <input id="value_excle_tax" class="form-control" type="text"
                                            name="value_excle_tax" value="{{$inventory->ved}}">
                                    </div>
                                    <label class="col-sm-1 control-label">SED</label>

                                    <div class="col-sm-2">
                                        <input id="sed" class="form-control" type="text" name="sed" value="{{$inventory->sed}}">
                                    </div>
                                    <label class="col-sm-1 control-label">FED</label>

                                    <div class="col-sm-2">
                                        <input id="fed" class="form-control" type="text" name="fed" value="{{$inventory->fed}}">
                                    </div>



                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Other Deduction</label>
                                    <div class="col-sm-2">
                                        <input id="other_deduction" class="form-control" type="text"
                                            name="other_deduction" value="{{$inventory->od}}">
                                    </div>
                                    <label class="col-sm-1 control-label">Net Value</label>
                                    <div class="col-sm-2">
                                        <input id="net_value" class="form-control" type="text" name="net_value" value="{{$inventory->nv}}">
                                    </div>
                                    <label class="col-sm-1 control-label">Remark</label>
                                    <div class="col-sm-2">
                                        <input id="remarks" class="form-control" type="text" name="remarks" value="{{$inventory->remarks}}">
                                    </div>
                                    <label class="col-sm-1 control-label">Type</label>
                                    <div class="col-sm-1">
                                        <input id="ttype" class="form-control" type="text" placeholder="E"
                                            name="ttype" value="{{$inventory->ttype}}">
                                    </div>
                                    {{-- <div class="col-sm-1 " style="text-align: right">
                                        <button onclick="addProduct()" class="btn btn-primary"
                                            type="button">Add</button>
                                    </div> --}}
                                </div>

                                {{-- <div class="ibox-content"> --}}

                                {{-- <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Item Description</th>
                                            <th>Qty</th>
                                            <th>L. Rate</th>
                                            <th>Sale Tax</th>
                                            <th>Value Excel.</th>
                                            <th>SED</th>
                                            <th>FED</th>
                                            <th>Other Deduction</th>
                                            <th>Net Value</th>
                                            <th>Remarks</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                    </tbody>
                                </table> --}}

                                {{-- </div> --}}

                                {{-- <div class="ibox-content">
                                    <h3>Purchase value: <strong id="gPurchaseValue">0</strong></h3>
                                    <h3><strong>Deductions:</strong></h3>
                                    <h3>Sales Tax: <strong id="gSaleTax">0</strong> </h3>
                                    <h3>SED: <strong id="gSED">0</strong> </h3>
                                    <h3>FED: <strong id="gFED">0</strong> </h3>
                                    <h3>Other: <strong id="gOther">0</strong> </h3>
                                    <h3>Total Deduction: <strong id="gTotalDeduction">0</strong> </h3>
                                    <h3>Net Purchase value: <strong id="gNetPurchasevalue">0</strong> </h3>

                                </div> --}}
                                <br>
                                <div class="hr-line-dashed"></div>


                                <button class="btn btn-primary" type="submit" name="button" value="Save">Update
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
        $("#vendorSelect").select2();
        $("#productSelect").select2();
        $(document).ready(function() {
            function calculateValue() {
                // Get values from other input fields
                var qty = $('#qty').val();
                var l_rate = $('#l_rate').val();
                var sale_tax = $('#sale_tax').val();
                var value_excle_tax = $('#value_excle_tax').val();
                var sed = $('#sed').val();
                var fed = $('#fed').val();
                var other_deduction = $('#other_deduction').val();

                // Set value to another input field
                $('#net_value').val((qty * l_rate) + parseFloat(sale_tax) + parseFloat(value_excle_tax) + parseFloat(sed) + parseFloat(fed) + parseFloat(other_deduction));
            }
            $('#qty').on('input', calculateValue);
            $('#l_rate').on('input', calculateValue);
            $('#sale_tax').on('input', calculateValue);
            $('#value_excle_tax').on('input', calculateValue);
            $('#sed').on('input', calculateValue);
            $('#fed').on('input', calculateValue);
            $('#other_deduction').on('input', calculateValue);
        });
    </script>
    <script>
        var products = @json($products);
        var vendors = @json($vendors);
        //console.log(products);
        var counter = 1;
        var gPurchaseValue = 0;
        var gSaleTax = 0;
        var gSED = 0;
        var gFED = 0;
        var gOther = 0;
        var gTotalDeduction = 0;
        var gNetPurchaseValue = 0;

        function addProduct() {
            if ($('#qty').val() && $('#l_rate').val()) {
                var productIndex = $('#productSelect').prop('selectedIndex') - 1;
                var name = $('#productSelect').find(":selected").text();
                var code = $('#productSelect').find(":selected").val();
                var qty = $('#qty').val();
                var l_rate = $('#l_rate').val();
                var sale_tax = $('#sale_tax').val();
                var value_excle_tax = $('#value_excle_tax').val();
                var sed = $('#sed').val();
                var fed = $('#fed').val();
                var net_value = $('#net_value').val();
                var other_deduction = $('#other_deduction').val();
                var remarks = $('#remarks').val();
                var ttype = $('#ttype').val();

                if (productIndex) {
                    $('#productTableBody').append(`<tr id="row-${counter}">
                        <td>${code}</td>
                        <td>${name}</td>
                        <td>${qty}</td>
                        <td>${l_rate}</td>
                        <td>${sale_tax}</td>
                        <td>${value_excle_tax}</td>
                        <td>${sed}</td>
                        <td>${fed}</td>
                        <td>${other_deduction}</td>
                        <td>${net_value}</td>
                        <td>${remarks}</td>
                        <td>${ttype}</td>
                        <td>
                            <a onclick="deleteProduct(${counter})">
                                <small class="label label-danger"><i class="fa"></i>delete</small>
                            </a>
                        </td>

                        <input type="hidden" name="products[code][]" value="${code}">
                        <input type="hidden" name="products['name'][]" value="${name}">
                        <input type="hidden" name="products[qty][]" value="${qty}">
                        <input type="hidden" name="products[l_rate][]" value="${l_rate}">
                        <input type="hidden" name="products[sale_tax][]" value="${sale_tax}">
                        <input type="hidden" name="products[value_excle_tax][]" value="${value_excle_tax}">
                        <input type="hidden" name="products[sed][]" value="${sed}">
                        <input type="hidden" name="products[fed][]" value="${fed}">
                        <input type="hidden" name="products[other_deduction][]" value="${other_deduction}">
                        <input type="hidden" name="products[net_value][]" value="${net_value}">
                        <input type="hidden" name="products[remarks][]" value="${remarks}">
                        <input type="hidden" name="products[ttype][]" value="${ttype}">

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
            gPurchaseValue = 0;
            gSaleTax = 0;
            gSED = 0;
            gFED = 0;
            gOther = 0;
            gTotalDeduction = 0;
            gNetPurchaseValue = 0;

            var products_sale_tax = $("input[name='products[sale_tax][]']")
                .map(function() {
                    return $(this).val();
                }).get();
            var products_sed = $("input[name='products[sed][]']")
                .map(function() {
                    return $(this).val();
                }).get();
            var products_fed = $("input[name='products[fed][]']")
                .map(function() {
                    return $(this).val();
                }).get();
            var products_value_excle_tax = $("input[name='products[value_excle_tax][]']")
                .map(function() {
                    return $(this).val();
                }).get();
            var products_other_deduction = $("input[name='products[other_deduction][]']")
                .map(function() {
                    return $(this).val();
                }).get();

            products_sale_tax.forEach(function myFunction(value, index, arr) {
                gSaleTax = gSaleTax + parseFloat(value);
            })
            products_sed.forEach(function myFunction(value, index, arr) {
                gSED = gSED + parseFloat(value);
            })
            products_fed.forEach(function myFunction(value, index, arr) {
                gFED = gFED + parseFloat(value);
            })
            products_value_excle_tax.forEach(function myFunction(value, index, arr) {
                gPurchaseValue = gPurchaseValue + parseFloat(value);
            })
            products_other_deduction.forEach(function myFunction(value, index, arr) {
                gOther = gOther + parseFloat(value);
            })

            $('#gPurchaseValue').html(gPurchaseValue);
            $('#gSaleTax').html(gSaleTax);
            $('#gSED').html(gSED);
            $('#gFED').html(gFED);
            $('#gOther').html(gOther);
            $('#gTotalDeduction').html(gOther);
            $('#gNetPurchaseValue').html(gPurchaseValue);
        }

        // $('#discount').on('input', function(e) {
        //     discount = $('#discount').val();
        //     calculateTotalAmmount();
        // });


        $('#productSelect').on('change', function(e) {
            // var productSalePrice = products[$(this).val()].sale_price;
            // $('#sale_price').val(productSalePrice);
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
