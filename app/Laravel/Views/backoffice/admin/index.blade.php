@extends('backoffice._layouts.main')

@section('breadcrumbs')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h3>{{ $page_title }}</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted" href="{{-- route('backoffice.index') --}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted" href="{{-- route('backoffice.admin.index') --}}">Administrator</a></li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        @include('backoffice._components.notifications')

        <div class="card">
            <div class="card-header">
            <h5>Advance Filter</h5>
            </div>
            <div class="card-body">
            <form class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Keyword</label>
                    <input class="form-control" type="text" id="input_keyword" name="keyword" placeholder="e.g. Name, Email" value="{{ $keyword }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Role</label>
                    {!! html()->select('role', $roles)->id('input_role')->class('form-control') !!}
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    {!! html()->select('status', $statuses)->id('input_status')->class('form-control') !!}
                </div>
                <div class="col-md-2">
                    <label class="form-label">From</label>
                    <input type="text" class="form-control date-input" id="input_start_date" value="{{ now()->subMonths(1)->format('m/d/y') }}" name="start_date" data-date-format="m/d/Y" data-default-date="{{ now()->subMonths(1)->format('m/d/y') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">To</label>
                    <input type="text" class="form-control date-input" id="input_end_date" value="{{ now()->format('m/d/y') }}" name="end_date" 
                        data-date-format="m/d/Y" data-default-date="{{ now()->format('m/d/y') }}">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Apply Filter</button>
                    <a href="{{ route('backoffice.admin.index') }}" class="btn btn-light" type="submit">Reset Filter</a>
                </div>
            </form>
            </div>
        </div>
    
    
        <form id="export_form" action="{{-- route('backoffice.admin.export') --}}" method="POST">
            {!! csrf_field() !!}

            {{-- modal inputs --}}
            <input type="hidden" name="keyword" id="keyword_data">
            <input type="hidden" name="start_date" id="start_date_data">
            <input type="hidden" name="end_date" id="end_date_data">
            <input type="hidden" name="status" id="status_data">
            <input type="hidden" name="file_type" id="input_file_type">
        </form>
    </div>
</div>

<div class="col-sm-12"> 
    <div class="card common-striped">
        <div class="card-header align-items-center d-flex">
            <h5 class="mb-0 flex-grow-1">Record</h5>
            <div class="form-check form-switch form-switch-right form-switch-md">
                
                {{-- Desktop view --}}
                <div class="d-none d-md-flex gap-2">
                    {{-- @if($auth->canAny(['backoffice.admin.create'],'admin')) --}}
                        <a href="{{-- route('backoffice.admin.create') --}}" class="btn btn-primary" type="submit">Add User</a>
                    {{-- @endif --}}
                    {{-- @if($auth->canAny(['backoffice.admin.export'],'admin')) --}}
                        <a type="button" class="btn btn-primary btn-export" data-label="pdf" data-bs-toggle="modal" data-bs-target="#tooltipmodal">Export to PDF</a>
                        <a type="button" class="btn btn-secondary btn-export" data-label="excel" data-bs-toggle="modal" data-bs-target="#tooltipmodal">Export to Excel</a>
                    {{-- @endif --}}
                </div>
                
                {{-- Mobile view --}}
                <div class="d-md-none">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                        <ul class="dropdown-menu">
                            <li> 
                                {{-- @if($auth->canAny(['backoffice.admin.create'],'admin')) --}}
                                    <a href="{{-- route('backoffice.admin.create') --}}" class="dropdown-item active">Add User</a>
                                {{-- @endif --}}
                                {{-- @if($auth->canAny(['backoffice.admin.export'],'admin')) --}}
                                    <a type="button" class="dropdown-item active btn-export" data-label="pdf" data-bs-toggle="modal" data-bs-target="#tooltipmodal">Export to PDF</a>
                                    <a type="button" class="dropdown-item active btn-export" data-label="excel" data-bs-toggle="modal" data-bs-target="#tooltipmodal">Export to Excel</a>
                                {{-- @endif --}}
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="table-responsive custom-scrollbar">
        <table class="table table-striped">
            <thead class="tbl-strip-thad-bdr">
            <tr>
                <th scope="col" width="15%">Name</th>
                <th scope="col" width="15%">Email</th>
                <th scope="col" width="10%">Role</th>
                <th scope="col" width="5%">Status</th>
                <th scope="col" width="10%">Last Login</th>
                <th scope="col" width="10%">Date Registered</th>
                <th scope="col" width="10%"></th>
            </tr>
            </thead>
            <tbody>
                {{-- @forelse ($records as $index => $record)
                    <tr>
                        <td><a href="{{route('backoffice.admin.show', $record->id)}}" class="text-decoration-underline">{{ nice_display($record->name) }}</a></td>
                        <td class="text-lowercase">{{ $record->email }}</td>
                        <td>{{ nice_display($record->type) }}</td>
                        <td>
                            <span class="badge bg-{{status_badge($record->status)}}">{{nice_display($record->status)}}</span>
                        </td>
                        <td>{{ $record->last_login_at ? $record->last_login_at ->format('m/d/Y h:i A') : "---" }}</td>
                        <td>{{ $record->created_at->format('m/d/Y h:i A') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item active" href="{{ route('backoffice.admin.show', $record->id) }}">View Details</a>
                                    @if($auth->canAny(['backoffice.admin.reset_password'],'admin') AND $record->status == "active")
                                        <li><a class="dropdown-item active" href="{{route('backoffice.admin.edit', $record->id)}}">Edit Details</a></li>
                                        <li><a class="dropdown-item active btn-reset-admin" href="#" data-url="{{route('backoffice.admin.reset_password', $record->id)}}">Reset Password</a></li>
                                    @endif
                                    @if($auth->canAny(['backoffice.admin.update_status'],'admin'))
                                        <li><a class="dropdown-item active btn-update-status" href="#" data-status="{{ $record->status }}" data-url="{{route('backoffice.admin.update_status', $record->id)}}">{{ $record->status == "inactive" ? "Activate" : "Deactivate" }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Record found.</td>
                    </tr>
                @endforelse --}}

                <tr>
                    <td colspan="7" class="text-center">No Record found.</td>
                </tr>
        </tbody>
        </table>
        
        <!-- pagination -->
        {{-- @if($records->total() > 0)
            <nav class="m-3">
                <p>Showing <strong>{{$records->firstItem()}}</strong> to <strong>{{$records->lastItem()}}</strong> of <strong>{{$records->total()}}</strong> entries</p>
                {!!$records->appends(request()->query())->render()!!}
            </nav>
        @endif --}}
        </div>
    </div>
</div>
@stop


@section('page-scripts')
<script>
    $(".date-input").flatpickr({
        dateFormat: "m/d/Y"
    });
    
    $(function(){ 
        $('#input_status option:first').text('-- All Status --');
    });

    $(function(){ 
        $('#input_role option:first').text('-- All Role --');
    });

    $(".btn-export").on('click', function(){
        let input_keyword = $('#input_keyword').val();
        let input_start_date = $('#input_start_date').val();
        let input_end_date = $('#input_end_date').val();
        let input_status = $('#input_status').val();
        let type = $(this).data('label');
        $('#input_file_type').val(type);

        Swal.fire({
            title: `Are you sure you want to Export this to ${type == "pdf" ? "PDF" : "Excel"}?`,
            icon: 'question',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Yes',
            customClass: {
                cancelButton: 'btn btn-danger',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                // set the values to the hidden inputs
                $('#keyword_data').val(input_keyword);
                $('#start_date_data').val(input_start_date);
                $('#end_date_data').val(input_end_date);
                $('#status_data').val(input_status);
                $("#export_form").submit();
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
</script>
@stop