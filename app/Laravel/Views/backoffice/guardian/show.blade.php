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
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.guardian.index') }}">Guardians</a></li>
                <li class="breadcrumb-item"><a class="text-muted">Guardian Details</a></li>
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
            <div class="row">
                {{-- <a href="{{ asset('placeholder/profile.png') }}}"> --}}
                    <img id="guardian_preview" class="img-fluid mx-auto d-block mt-5 guardian-pic" src="{{ asset('placeholder/profile.png') }}" alt="Guardian Photo Preview">
                {{-- </a> --}}
            </div>

            <div class="card-header btn-secondary">
                <h5 class="txt-light">Guardian Details</h5>
            </div>

            <div class="card-body">
                <div class="mt-2 d-flex align-items-center">
                    <h3 class="mb-0 me-2 flex-grow-1">
                        <i class="fa-solid fa-user-group"></i>{{ $record->name }}
                        {{-- <div>
                            <p class="fw-light">{{ nice_display($record->role) }}</p>
                        </div> --}}
                    </h3>

                    <span class="badge bg-{{ status_badge($record->status) }} fs-6">
                        {{ nice_display($record->status) }}
                    </span>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-id-card"></i>Household ID</div>
                        <div>{{ $record->household_id ?: "---" }}</div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-phone"></i>Contact Number</div>
                        <div>{{ $record->contact_number ?: "---" }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-map"></i>Address</div>
                        <div>{{ $record->address ?: "---" }}</div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-location-crosshairs"></i>Purok</div>
                        <div>{{ $record->purok ?: "---" }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-children"></i>Total Child</div>
                        <div>{{ $record->child_count }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-calendar pe-2"></i>Date Enrolled</div>
                        <div>{{ $record->created_at->format('m/d/Y h:i A') }}</div>
                    </div>
                </div>

                <div class="text-end mt-3 d-flex flex-wrap justify-content-end gap-2">
                    @if($auth->canAny(['backoffice.guardian.update_status'],'admin'))
                        <a class="btn btn-{{ $record->status == "inactive" ? "success" : "danger" }} btn-update-status" href="#" data-url="{{route('backoffice.guardian.update_status', $record->id)}}">{{ $record->status == "inactive" ? "Activate" : "Deactivate" }}</a>
                    @endif
                    <a class="btn btn-secondary" href="{{ route('backoffice.guardian.index') }}">Back</a>
                </div>             
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<style>
    .guardian-pic {
        width: 50%;
    }
</style>
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