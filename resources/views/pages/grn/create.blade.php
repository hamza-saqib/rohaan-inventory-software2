@extends('layouts.app')

@section('title-meta')
    <title>{{config('app.name')}} | Location Edit</title>

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
                <h2>GRN Management</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('locations.index') }}">GRN</a>
                    </li>
                    <li class="active">
                        <strong>Create</strong>
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
                            <h5>Fill out this form to create a new GRN.</h5>
                            {{-- <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-class">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div> --}}
                        </div>

                        <div class="ibox-content">
                            <form method="post" class="form-horizontal"
                                action="{{ route('users.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <label class="col-sm-2 control-label @error('fiscal_year') is-invalid @enderror">Fiscal Year</label>

                                    <div class="col-sm-4">
                                        <select class="form-control" name="fiscal_year" required>
                                            <option selected disabled>Select</option>
                                            <option>2011</option>
                                            <option>2012</option>

                                        </select>
                                        @error('fiscal_year')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-sm-2 control-label">GRN Date</label>

                                    <div class="col-sm-4 @error('start_date') has-error @enderror">
                                        <input type="date" class="form-control" name="start_date"
                                            value="{{ old('start_date')?? date('Y-m-d') }}" required>
                                        @error('start_date')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-sm-4 @error('end_date') has-error @enderror">
                                        <input type="date" class="form-control" name="end_date"
                                            value="{{ old('end_date') }}" >
                                        @error('end_date')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

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
                                



                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary disabledbutton" id="submitbtn"
                                            type="submit">Save</button>
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
