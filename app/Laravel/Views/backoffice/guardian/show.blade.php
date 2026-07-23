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
                    <img id="guardian_preview" class="img-fluid mx-auto d-block mt-5 guardian-pic" src="{{ asset('placeholder/profile.png') }}" alt="Guardian Photo Preview">
            </div>

            <div class="card-header card-header-custom">
                <h5 class="txt-light">Guardian Details</h5>
            </div>

            <div class="card-body">
                <div class="mt-2 d-flex align-items-center">
                    <h3 class="mb-0 me-2 flex-grow-1">
                        {{ $record->name }}
                    </h3>

                    <span class="badge bg-{{ status_badge($record->status) }} fs-6">
                        {{ nice_display($record->status) }}
                    </span>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-id-card"></i> Household ID</div>
                        <div>{{ $record->household_id ?: "---" }}</div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-phone"></i> Contact Number</div>
                        <div>{{ $record->contact_number ?: "---" }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-map"></i> Address</div>
                        <div>{{ $record->address ?: "---" }}</div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-location-crosshairs"></i> Purok</div>
                        <div>{{ $record->purok ?: "---" }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-children"></i> Total Child</div>
                        <div>{{ $record->children->count() }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="mt-4"><i class="fa-solid fa-calendar"></i> Date Created</div>
                        <div>{{ $record->created_at->format('M. d, Y h:i A') }}</div>
                    </div>
                </div>

                <hr>

                <div class="text-end mt-3 d-flex flex-wrap justify-content-end gap-2">
                    @if($auth->canAny(['backoffice.guardian.update_status'],'admin'))
                        <a class="btn btn-{{ $record->status == "inactive" ? "success" : "danger" }} btn-update-status" href="#" data-url="{{route('backoffice.guardian.update_status', $record->id)}}">{{ $record->status == "inactive" ? "Activate" : "Deactivate" }}</a>
                    @endif
                    <a class="btn btn-secondary" href="{{ route('backoffice.guardian.index') }}">Back</a>
                </div>             
            </div>
        </div>
    </div>

    @if($record->children->count() > 0)
        <div class="col-12 col-md-6">
            <div class="card card-absolute">
                <div class="card-header card-header-custom">
                    <h5 class="txt-light">Children</h5>
                </div>
                <div class="d-flex justify-content-end px-3 pt-2">
                @php 
                    $show_add_supplier = $auth->canAny(["backoffice.guardian.add_child"],'admin');
                @endphp
                @if($show_add_supplier)
                    <a class="btn btn-secondary mb-0" href="{{ route("backoffice.guardian.add_child", $record->id) }}">+</a>
                @endif
            </div>

                <div class="card-body {{ $show_add_supplier ? "table-with-button" : "" }}">
                    <table class="table table-striped table-responsive custom-scrollbar">
                        <thead class="tbl-strip-thad-bdr">
                            <tr>
                                <th scope="col" width="30%">Name</th>
                                <th scope="col" width="10%">Sex</th>
                                <th scope="col" width="30%">Remarks</th>
                                <th scope="col" width="20%">Date Enrolled</th>
                                <th scope="col" width="10%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $guardian = $record->id; @endphp
                            @foreach($record->children as $record)
                                <tr>
                                    <td>
                                        {{ nice_display($record->name) }}
                                        <div>
                                            <small class="text-muted">{{ $record->age }} {{ Str::plural('year', $record->age) }} old</small>
                                        </div>
                                    </td>
                                    <td>{{ display_gender($record->sex) }}</td>
                                    <td>{{ $record->remarks ?: "N/A" }}</td>
                                    <td>{{ $record->created_at->format('m/d/Y H:i A') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item active" target="__blank" href="{{ route('backoffice.child.show', $record->id) }}">View Details</a>
                                                @if($auth->canAny(['backoffice.guardian.remove_child'],'admin'))
                                                    <a class="dropdown-item active btn-remove-child" data-bs-toggle="modal" data-bs-target="#tooltipmodal" href="#"
                                                            data-url="{{ route('backoffice.guardian.remove_child', ['id'=>$guardian,'child_id'=>$record->id]) }}">
                                                        Remove Child
                                                    </a>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
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
    $(".btn-remove-child").on('click', function(){
        var url = $(this).data('url');

        Swal.fire({
            title: 'Are you sure you want to remove child?',
            icon: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>
@stop