@extends('backoffice._layouts.main')

@section('breadcrumbs')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ $page_title }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.admin.index') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a class="text-muted">Change Password</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-5">
        @include('backoffice._components.notifications')
        <form class="form theme-form" method="POST">
            {!! csrf_field() !!}
            <div class="card user-bio"> 
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="ttl-info align-items-center d-flex">
                                <h4 class="flex-grow-1">Change Password</h4>
                            </div>
                            <hr>
                        </div>
                
                        <div>
                            <p class="text-muted mb-2">Fill up the required fields before submitting the form</p>
                            <p class="text-danger mb-4 lh-sm">Note: Password must be atleast 8 characters long, should contain atleast 1 uppercase, 1 lowercase, 1 numeric and 1 special character.</p>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">New Password</label>
                            <input class="form-control" type="password" name="password" value="" placeholder="*********">
                            @if($errors->first('password'))
                                <div class="text-left mb-3 mx-3">
                                    <small class="d-block mt-1 text-danger">{{ $errors->first('password') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" value="" placeholder="*********">
                            @if($errors->first('password_confirmation'))
                                <div class="text-left mb-3 mx-3">
                                    <small class="d-block mt-1 text-danger">{{ $errors->first('password_confirmation') }}</small>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-secondary">Change Password</button>
                                <a class="btn btn-primary" href="{{route('backoffice.admin.index')}}">Back</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@stop