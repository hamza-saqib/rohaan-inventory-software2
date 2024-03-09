@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Item Edit</title>

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
                <h2>Item Management</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('products.index') }}">Item</a>
                    </li>
                    <li class="active">
                        <strong>Edit</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Show List</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content ">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <div class="ibox-title">
                            <h5><small>From here you can edit your Item.</small></h5>
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
                            <form method="post" class="form-horizontal" action="{{ route('products.update', $product) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Code</label>

                                    <div class="col-sm-4">
                                        <input type="number" class="form-control @error('code') is-invalid @enderror "
                                            name="code" value="{{ $product->code }}" required>
                                        @error('code')
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
                                            class="form-control @error('description') is-invalid @enderror "
                                            name="description" value="{{ $product->name1 }}" required>
                                        @error('description')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 control-label @error('uom') is-invalid @enderror">UOM</label>

                                    <div class="col-sm-4">
                                        <select class="form-control" name="uom" required>
                                            <option selected disabled>Select</option>
                                            @foreach ($units as $unit)
                                                @if ($product->uom == $unit->code)
                                                    <option selected value="{{ $unit->code }}">{{ $unit->descrip }}
                                                    </option>
                                                @else
                                                    <option value="{{ $unit->code }}">{{ $unit->descrip }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('uom')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label
                                        class="col-sm-2 control-label @error('category') is-invalid @enderror">Category</label>

                                    <div class="col-sm-4">
                                        <select class="form-control" name="category" required>
                                            <option selected disabled>Select</option>
                                            @foreach ($categories as $category)
                                                @if ($product->catcode == $category->code)
                                                    <option selected value="{{ $category->code }}">{{ $category->name1 }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->code }}">{{ $category->name1 }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Misc. Code</label>

                                    <div class="col-sm-4">
                                        <input type="number" class="form-control @error('misc_code') is-invalid @enderror"
                                            name="misc_code" value="{{ $product->misc_code }}" required>
                                        @error('misc_code')
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
                                            class="form-control @error('adress') is-invalid @enderror">{{ $product->remarks }}</textarea>

                                        @error('remarks')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">History Qty</label>

                                    <div class="col-sm-4">
                                        <input type="number"
                                            class="form-control @error('history_qty') is-invalid @enderror"
                                            name="history_qty" value="{{ old('history_qty') }}">
                                        @error('history_qty')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-2 control-label">History Value</label>

                                    <div class="col-sm-4">
                                        <input type="number"
                                            class="form-control @error('history_value') is-invalid @enderror"
                                            name="history_value" value="{{ old('history_value') }}">
                                        @error('history_value')
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
