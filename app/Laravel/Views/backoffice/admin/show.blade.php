@extends('backoffice._layouts.main')

@section('breadcrumbs')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h3>{{ $page_title }}</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.admin.index') }}">Admin</a></li>
                <li class="breadcrumb-item"><a class="text-muted">Admin Details</a></li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        @if(session()->has('notification-msg') AND session()->has('notification-status'))
            <div class="mb-5">
                @include('backoffice._components.notifications')
            </div>
        @endif
        
        <div class="card card-absolute">
            <div class="card-header btn-secondary">
                <h5 class="txt-light">Admin Details</h5>
            </div>
            <div class="card-body">
                <div class="mt-2 d-flex align-items-center">
                    <h3 class="mb-0 me-2 flex-grow-1">
                        <i class="fa-solid fa-user"></i>{{ $record->name }}
                        <div>
                        {{-- <div class="mx-4"> --}}
                            <p class="fw-light">{{ nice_display(/*$record->role*/"admin") }}</p>
                        </div>
                    </h3>

                    <span class="badge bg-{{ status_badge($record->status) }} fs-6">
                        {{ nice_display($record->status) }}
                    </span>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-envelope pe-2"></i>Email</div>
                        <div>{{ $record->email }}</div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-phone pe-2 pe-2"></i>Contact Number</div>
                        <div>{{ $record->contact_number ?? "---" }}</div>
                    </div>
                </div>

                {{-- <div class="row"> --}}
                    {{-- <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-user pe-2"></i>Type</div>
                        <div>{{ nice_display($record->type) }} {{ in_array($record->type, ['admin', 'super_admin']) == "admin" ? "" : "Admin" }}</div>
                    </div> --}}
                    {{-- <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-gear pe-2"></i>Role</div>
                        <div>{{ $record->role }}</div>
                    </div> --}}
                {{-- </div> --}}

                <div class="row">
                    @if(in_array($record->type,['provincial','regional']))
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="mt-4"><i class="fa-solid fa-map-marker pe-2"></i>Region</div>
                            <div>{{ $record->psgc_region_name }}</div>
                        </div>
                        @if($record->type == "provincial")
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="mt-4"><i class="fa-solid fa-map-marker pe-2"></i>Province</div>
                                <div>{{ $record->psgc_prov_name }}</div>
                            </div>
                        @endif
                    @endif
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-calendar pe-2"></i>Date Registered</div>
                        <div>{{ $record->created_at->format('m/d/Y h:i A') }}</div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-history pe-2"></i>Last Login</div>
                        <div>{{ $record->last_login_at ? $record->last_login_at ->format('m/d/Y h:i A') : "---"  }}</div>
                    </div>
                </div>

                <div class="text-end mt-3 d-flex flex-wrap justify-content-end gap-2">
                    {{-- @if($auth->canAny(['backoffice.admin.update_status'],'admin'))
                        <a class="btn btn-{{ $record->status == "inactive" ? "success" : "danger" }} btn-update-status" href="#" data-url="{{route('backoffice.admin.update_status', $record->id)}}">{{ $record->status == "inactive" ? "Activate" : "Deactivate" }}</a>
                    @endif
                    @if($auth->canAny(['backoffice.admin.update_status'],'admin'))
                        <a class="btn btn-secondary btn-reset-admin" href="#" data-url="{{route('backoffice.admin.reset_password', $record->id)}}">Reset Password</a>
                    @endif --}}
                    <a class="btn btn-secondary" href="{{ route('backoffice.admin.index') }}">Back</a>
                </div>             
            </div>
        </div>
    </div>
</div>
@stop

@section('page-scripts')
<script>
    $(".btn-reset-admin").on('click', function(){
        var url = $(this).data('url');

        Swal.fire({
            title: 'Are you sure you want to reset password of this account?',
            icon: 'question',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Yes',
            customClass: {
                cancelButton: 'btn btn-danger',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    $(".btn-update-status").on('click', function(){

        var url = $(this).data('url');
        var status = $(this).data('status');

        Swal.fire({
            title: status === 'active' ? 'Are you sure you want to deactivate this record?' : 'Are you sure you want to activate this record?',
            icon: 'question',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Yes',
            customClass: {
                cancelButton: 'btn btn-danger',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>
@stop