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
                <div class="col-md-3">
                    <label class="form-label">Keyword</label>
                    <input class="form-control" type="text" id="input_keyword" name="keyword" placeholder="e.g. Name" value="{{ $keyword }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    {!! html()->select('status', $statuses, $selected_status)->id('input_status')->class('form-control') !!}
                </div>
                <div class="col-md-3">
                    <label class="form-label">From</label>
                    <input type="text" class="form-control date-input" id="input_start_date" value="{{ $start_date }}" name="start_date" data-date-format="m/d/Y" data-default-date="{{ $start_date }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">To</label>
                    <input type="text" class="form-control date-input" id="input_end_date" value="{{ $end_date }}" name="end_date" 
                        data-date-format="m/d/Y" data-default-date="{{ $end_date }}">
                </div>

                <div class="col-12">
                    <button class="btn btn-secondary" type="submit">Apply Filter</button>
                    <a href="{{ route('backoffice.guardian.index') }}" class="btn btn-light" type="submit">Reset Filter</a>
                </div>
            </form>
            </div>
        </div>
    
    
        <form id="export_form" action="{{-- route('backoffice.guardian.export') --}}" method="POST">
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
                    @if($auth->canAny(['backoffice.guardian.create'],'admin'))
                        <a href="{{ route('backoffice.guardian.create') }}" class="btn btn-secondary" type="submit"><i class="fa-solid fa-plus"></i> Add New Guardian</a>
                    @endif
                    {{-- @if($auth->canAny(['backoffice.guardian.export'],'admin')) --}}
                        {{-- <a type="button" class="btn btn-secondary btn-export" data-label="pdf" data-bs-toggle="modal" data-bs-target="#tooltipmodal">Export to PDF</a>
                        <a type="button" class="btn btn-secondary btn-export" data-label="excel" data-bs-toggle="modal" data-bs-target="#tooltipmodal">Export to Excel</a> --}}
                    {{-- @endif --}}
                </div>
                
                {{-- Mobile view --}}
                <div class="d-md-none">
                    <div class="btn-group" role="group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                        <ul class="dropdown-menu">
                            <li> 
                                @if($auth->canAny(['backoffice.guardian.create'],'admin'))
                                    <a href="{{ route('backoffice.guardian.create') }}" class="dropdown-item active">Add New Child</a>
                                @endif
                                {{-- @if($auth->canAny(['backoffice.guardian.export'],'admin')) --}}
                                    {{-- <a type="button" class="dropdown-item active btn-export" data-label="pdf" data-bs-toggle="modal" data-bs-target="#tooltipmodal">Export to PDF</a>
                                    <a type="button" class="dropdown-item active btn-export" data-label="excel" data-bs-toggle="modal" data-bs-target="#tooltipmodal">Export to Excel</a> --}}
                                {{-- @endif --}}
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        <div>
            <table class="table table-striped table-responsive custom-scrollbar">
                <thead class="tbl-strip-thad-bdr">
                <tr>
                    <th scope="col" width="13%">Name</th>
                    <th scope="col" width="13%">Contact Number</th>
                    <th scope="col" width="10%" class="text-center">Number of Child</th>
                    <th scope="col" width="5%">Status</th>
                    <th scope="col" width="10%">Date Enrolled</th>
                    <th scope="col" width="10%"></th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($records as $index => $record)
                        <tr>
                            <td>
                                <a href="{{ route('backoffice.guardian.show', $record->id )}}">{{ nice_display($record->name) }}</a>
                                <div>
                                    <small class="text-muted">Purok {{ $record->purok }}</small>
                                </div>
                            </td>
                            <td>{{ $record->contact_number }}</td>
                            <td class="text-center">{{ $record->children->count() }}</td>
                            <td>
                                <span class="badge bg-{{status_badge($record->status)}}">{{nice_display($record->status)}}</span>
                            </td>
                            <td>{{ $record->created_at->format('m/d/Y h:i A') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item active" href="{{ route('backoffice.guardian.show', $record->id) }}">View Details</a>
                                        @if($auth->canAny(['backoffice.guardian.edit'],'admin') AND $record->status == "active")
                                            <li><a class="dropdown-item active" href="{{route('backoffice.guardian.edit', $record->id)}}">Edit Details</a></li>
                                        @endif
                                        @if($auth->canAny(['backoffice.guardian.update_status'],'admin'))
                                            <li><a class="dropdown-item active btn-update-status" href="#" data-status="{{ $record->status }}" data-url="{{route('backoffice.guardian.update_status', $record->id)}}">{{ $record->status == "inactive" ? "Activate" : "Deactivate" }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No Record found.</td>
                        </tr>
                    @endforelse
            </tbody>
            </table>
            
            <!-- pagination -->
            @if($records->total() > 0)
                <nav class="m-3">
                    <p>Showing <strong>{{$records->firstItem()}}</strong> to <strong>{{$records->lastItem()}}</strong> of <strong>{{$records->total()}}</strong> entries</p>
                    {!!$records->appends(request()->query())->render()!!}
                </nav>
            @endif
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
        $('#input_status option:first').text('-- All --');
        // $('#input_sex option:first').text('-- All --');
    });

    // $(".btn-export").on('click', function(){
    //     let input_keyword = $('#input_keyword').val();
    //     let input_start_date = $('#input_start_date').val();
    //     let input_end_date = $('#input_end_date').val();
    //     let input_status = $('#input_status').val();
    //     let type = $(this).data('label');
    //     $('#input_file_type').val(type);

    //     Swal.fire({
    //         title: `Are you sure you want to Export this to ${type == "pdf" ? "PDF" : "Excel"}?`,
    //         icon: 'question',
    //         showCancelButton: true,
    //         showLoaderOnConfirm: true,
    //         confirmButtonText: 'Yes',
    //         customClass: {
    //             cancelButton: 'btn btn-danger',
    //         },
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // set the values to the hidden inputs
    //             $('#keyword_data').val(input_keyword);
    //             $('#start_date_data').val(input_start_date);
    //             $('#end_date_data').val(input_end_date);
    //             $('#status_data').val(input_status);
    //             $("#export_form").submit();
    //         }
    //     });
    // });

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
                cancelButton: 'btn btn-light text-dark',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>
@stop