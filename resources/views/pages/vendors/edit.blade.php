@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Suplier Edit</title>

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
                <h2>Supliers Management</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('vendors.index') }}">Suplier</a>
                    </li>
                    <li class="active">
                        <strong>Edit</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="{{ route('vendors.index') }}" class="btn btn-primary">Show List</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content ">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <div class="ibox-title">
                            <h5><small>From here you can edit suplier.</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-vendor">
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
                            <form method="post" class="form-horizontal" action="{{ route('vendors.update', $vendor) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Code</label>

                                    <div class="col-sm-4">
                                        <input type="number" class="form-control @error('code') is-invalid @enderror "
                                            name="code" value="{{ $vendor->code }}" required>
                                        @error('code')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror "
                                            name="name" value="{{ $vendor->name1 }}" required>
                                        @error('name')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Address</label>

                                    <div class="col-sm-10">
                                        <textarea name="address" id="" cols="4" rows="3"
                                            class="form-control @error('adress') is-invalid @enderror">{{ $vendor->address }}</textarea>

                                        @error('address')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Phone 1</label>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('phone1') is-invalid @enderror"
                                            name="phone1" value="{{ $vendor->phone1 }}" required>
                                        @error('phone1')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Phone 2</label>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('phone2') is-invalid @enderror"
                                            name="phone2" value="{{ $vendor->phone2 }}" required>
                                        @error('phone2')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fax No.</label>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('fax_no') is-invalid @enderror"
                                            name="fax_no" value="{{ $vendor->faxno }}" required>
                                        @error('fax_no')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">NTN</label>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('ntn') is-invalid @enderror"
                                            name="ntn" value="{{ $vendor->ntn }}" required>
                                        @error('ntn')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">STN</label>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('stn') is-invalid @enderror"
                                            name="stn" value="{{ $vendor->stn }}" required>
                                        @error('stn')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Remarks</label>

                                    <div class="col-sm-10">
                                        <textarea name="remarks" id="" cols="4" rows="3"
                                            class="form-control @error('adress') is-invalid @enderror">{{ $vendor->remarks }}</textarea>

                                        @error('remarks')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary disabledbutton" id="submitbtn"
                                            type="submit">Update Unit</button>
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
