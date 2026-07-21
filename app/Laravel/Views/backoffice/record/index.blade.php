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
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.child.show', $child->id) }}">{{ nice_display($child->name) }}</a></li>
                <li class="breadcrumb-item"><a class="text-muted">Record</a></li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        @include('backoffice._components.notifications')

        <div class="row g-2 justify-content-md-start justify-content-center visual-button visual-button1 mb-3">
            <div class="col-12 col-md-auto">
                <a href="{{ route('backoffice.child.show', $child->id) }}">
                    <button class="btn btn-outline-secondary btn-lg">
                    <i data-feather="arrow-left-circle"></i>
                    <span>Go back</span></button>
                </a>
            </div>
        </div>
        
        {{-- <div class="card">
            <div class="card-header">
            <h5>Advance Filter</h5>
            </div>
            <div class="card-body">
            <form class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">From</label>
                    <input type="text" class="form-control date-input" id="input_start_date" value="{{ $start_date }}" name="start_date" data-date-format="m/d/Y" data-default-date="{{ $start_date }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">To</label>
                    <input type="text" class="form-control date-input" id="input_end_date" value="{{ $end_date }}" name="end_date" 
                        data-date-format="m/d/Y" data-default-date="{{ $end_date }}">
                </div>

                <div class="col-12">
                    <button class="btn btn-secondary" type="submit">Apply Filter</button>
                    <a href="{{ route('backoffice.record.index') }}" class="btn btn-light" type="submit">Reset Filter</a>
                </div>
            </form>
            </div>
        </div> --}}
    </div>
</div>

<div class="col-sm-12"> 
    <div class="card common-striped">
        <div class="card-header align-items-center d-flex">
            <h5 class="mb-0 flex-grow-1">{{ nice_display($child->name) }}</h5>
            <div class="form-check form-switch form-switch-right form-switch-md">
                
                {{-- Desktop view --}}
                <div class="d-none d-md-flex gap-2">
                    @if($auth->canAny(['backoffice.record.create'],'admin'))
                        <a href="{{ route('backoffice.record.create', $child->id) }}" class="btn btn-secondary" type="submit"><i class="fa-solid fa-plus"></i> Add New Record</a>
                    @endif
                </div>
                
                {{-- Mobile view --}}
                <div class="d-md-none">
                    <div class="btn-group" role="group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                        <ul class="dropdown-menu">
                            <li> 
                                @if($auth->canAny(['backoffice.record.create'],'admin'))
                                    <a href="{{ route('backoffice.record.create') }}" class="dropdown-item active">Add New Child</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        <div>
            @forelse ($records as $index => $record)
                <div class="card">
                    <div class="card-body lh-lg">
                        <h5 class="card-title">{{ $record->created_at->format('M. d, Y H:i A') }}</h5>
                        <p class="card-text">Height: {{ round($record->height, 0) }} cm</p>
                        <p class="card-text">Weight: {{ round($record->weight, 0) }} kg</p>
                        <p class="card-text">BMI: {{ round($record->bmi, 2) }}</p>
                        <p class="card-text">Remarks: {{ $record->remarks }}</p>
                        <p class="card-text">Recorded By: {{ nice_display($record?->recorder->name) }}</p>
                        <a class="btn btn-warning" href="{{ route('backoffice.record.edit', ['child_id'=>$child->id,'id'=>$record->id]) }}">Edit</a>
                    </div>
                </div>
            @empty
                <tr>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">No Record found.</h5>
                        </div>
                    </div>
                </tr>
            @endforelse
            {{-- <table class="table table-striped table-responsive custom-scrollbar">
                <thead class="tbl-strip-thad-bdr">
                    <tr>
                        <th scope="col" width="13%">Remarks</th>
                        <th scope="col" width="10%">Height</th>
                        <th scope="col" width="5%">Weight</th>
                        <th scope="col" width="13%">BMI</th>
                        <th scope="col" width="10%">Date Enrolled</th>
                        <th scope="col" width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $index => $record)
                        <tr>
                            <td>{{ $record->remarks }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No Record found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table> --}}
            
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
</script>
@stop