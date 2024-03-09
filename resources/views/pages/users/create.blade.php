@extends('layouts.app')

@section('title-meta')
    <title>{{config('app.name')}} | User Edit</title>

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
                            <h5>Fill out this form to create a new User.</h5>
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
                                    <label class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror "
                                            name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-2 control-label">Profile Image</label>

                                    <div class="col-sm-4">
                                        <input type="file"
                                            class="form-control @error('profile_image') is-invalid @enderror "
                                            name="profile_image">
                                        @error('profile_image')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-4">
                                        <input type="email" class="form-control @error('password') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-2 control-label">Phone</label>

                                    <div class="col-sm-4">
                                        <input type="text" value="{{ old('phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            placeholder="Optional">
                                        @error('phone')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label @error('role') is-invalid @enderror">Role</label>

                                    <div class="col-sm-4">
                                        <select class="form-control" name="role" required>
                                            <option selected disabled>Select</option>
                                            @foreach ($roles as $role)
                                                    @if (old('role') == $role)
                                                    <option selected value="{{ $role }}">{{ $role }}</option>
                                                    @else
                                                    <option value="{{ $role }}">{{ $role }}</option>
                                                    @endif
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label @error('is_active') is-invalid @enderror">Status</label>

                                    <div class="col-sm-4">
                                        <select class="form-control" name="is_active" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0" >Disabled</option>
                                        </select>
                                        @error('is_active')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>

                                    <div class="col-sm-4">
                                        <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                            name="password" id="password" autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Confirm Password</label>

                                    <div class="col-sm-4">
                                        <input type="password"
                                            class="form-control  @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="password">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>

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
