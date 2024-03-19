@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | User Edit</title>

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
                <h2>User Management</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('users.index') }}">User</a>
                    </li>
                    <li class="active">
                        <strong>Edit</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Show List</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content ">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <div class="ibox-title">
                            <h5>user Users <small>From here you can create your new users.</small></h5>
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
                            <form method="post" class="form-horizontal" action="{{ route('users.update', $user) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">UOM Code</label>

                                    <div class="col-sm-4">
                                        <input type="number" class="form-control @error('code') is-invalid @enderror "
                                            name="code" value="{{ old('code') }}" required>
                                        @error('code')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Factor</label>

                                    <div class="col-sm-4">
                                        <input type="number" class="form-control @error('factor') is-invalid @enderror"
                                            name="factor" value="{{ old('factor') }}" required>
                                        @error('factor')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description</label>

                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            name="description" value="{{ old('description') }}" required>
                                        @error('description')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary disabledbutton" id="submitbtn" type="submit">Update
                                            Unit</button>
                                    </div>
                                </div>
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
