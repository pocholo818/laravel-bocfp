@extends('backoffice._layouts.main')

@section('breadcrumbs')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            {{-- <h3>{{ $page_title }}</h3> --}}
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.announcement.index') }}">Announcements</a></li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12"> 
        @include('backoffice._components.notifications')

        <form>
            <div class="card common-striped">
                <div class="card-header align-items-center d-flex">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="mb-0 flex-grow-1">Announcements</h5>
                        {{-- TBD --}}
                        {{-- <div class="d-none d-md-flex gap-2">
                            <input class="form-control" type="text" id="input_keyword" name="keyword" style="width: 300px;" 
                                placeholder="Search" value="{{ $keyword }}">
                            <button class="btn btn-secondary" type="submit" data-toggle="tooltip" data-bs-placement="top" title="Search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <a href="{{ route('backoffice.announcement.index') }}" class="btn btn-light"  data-toggle="tooltip" data-bs-placement="top" title="Reset"
                                type="submit"><i class="fa-solid fa-arrow-rotate-left"></i>
                            </a>
                        </div> --}}
                    </div>
                    
                    <div class="ms-auto d-md-flex gap-2">
                        <div class="d-md-flex gap-2">
                            @if($auth->canAny(['backoffice.announcement.create'],'admin'))
                                <a href="{{ route('backoffice.announcement.create') }}" class="btn btn-secondary" 
                                        data-toggle="tooltip" data-bs-placement="top" title="Create New Announcement">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            
                {{-- TBD --}}
                <div class="card-body {{--d-md-none--}}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Keyword</label>
                            <input class="form-control" type="text" id="input_keyword" name="keyword" placeholder="Search" value="{{ $keyword }}">
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
                            <a href="{{ route('backoffice.announcement.index') }}" class="btn btn-light" type="submit">Reset Filter</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div>
            @forelse ($records as $record)
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <div class="pull-left">
                            <h5 class="card-title mb-0 flex-grow-1">{{ $record->title }}</h5>
                            <span class="text-muted d-block">{{ $record->created_at->format('l, M d, Y - h:i A') }}</span>
                        </div>
                        
                        <div class="ms-auto">
                            <div class="d-md-flex gap-2">                                
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis"></i></button>
                                    <ul class="dropdown-menu">
                                        <li> 
                                            @if($auth->canAny(['backoffice.announcement.edit'],'admin'))
                                                <a href="{{ route('backoffice.announcement.edit', $record->id) }}" class="dropdown-item active">Edit Post</a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="wrap-text">
                            {!! $record->content !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="card">
                    <div class="card-body">
                        <p class="card-text text-center">No announcements found.</p>
                    </div>
                </div>
            @endforelse
            
            <!-- pagination -->
            @if($records->total() > 0)
                <div class="card">
                    <nav class="m-3 mb-0">
                        <p>Showing <strong>{{$records->firstItem()}}</strong> to <strong>{{$records->lastItem()}}</strong> of <strong>{{$records->total()}}</strong> entries</p>
                        {!!$records->appends(request()->query())->render()!!}
                    </nav>
                </div>
                
            @endif
        </div>
    </div>
</div>
@stop

@section('page-styles')
<style>
    .card-body ul {
        list-style-type: disc !important;
        padding-left: 20px !important;
    }

    .card-body ol {
        list-style-type: decimal !important;
        padding-left: 20px !important;
    }

    .wrap-text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 7;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
        border: none;
        cursor: pointer;
    }

    .dropdown-toggle::after{
        display: none !important;
    }

    .tooltip .tooltip-inner {
        background-color: #5e3f00;
        color: white;
    }
</style>
@stop

@section('page-scripts')
<script>
$(function(){ 
    $('#input_status option:first').text('-- All --');
      $('[data-toggle="tooltip"]').tooltip();

    $(".date-input").flatpickr({
        altInput: true,
        altFormat: "m/d/Y",
        dateFormat: "Y-m-d"
    });
    
    // toggle elipsis
    $('.wrap-text').on('click', function() {
        $(this).toggleClass('wrap-text');
    });
});
</script>
@stop