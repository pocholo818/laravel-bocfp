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
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.guardian.index') }}">Guardian</a></li>
                <li class="breadcrumb-item"><a class="text-muted">Add new child</a></li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-xl-6">
    @include('backoffice._components.notifications')

    <div class="card height-equal">
        <div class="card-header">
            <h5>Add new child Form</h5>
            <p class="f-m-light mt-1">
                Fill up the <b class="text-danger">*</b> required fields before submitting the form.
            </p>
        </div>
        <form method="POST">
            {!! csrf_field() !!}
            <div class="card-body custom-input form theme-form">
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-sm-4">Search Child  <b class="text-danger">*</b></label>
                            <div class="col-sm-8">
                                {!! html()->select('child', [''=>"-- Select child --"]+$children, old('child'))->id('input_child')->class('form-control select2') !!}
                                
                                @if($errors->first('child'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('child') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3">Relationship <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                {!! html()->select('relationship', $relationships, old('relationship'))->id('input_relationship')->class('form-control') !!}
                                
                                @if($errors->first('relationship'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('relationship') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer text-end">
                <div class="col-sm-8 offset-sm-3">
                <button type="submit" class="btn btn-secondary me-3">Submit</button>
                <a class="btn btn-light" href="{{route('backoffice.guardian.index')}}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('page-styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
        line-height: 38px !important;
    }

    .select2-selection__clear {
        position: relative!important;
        margin-bottom: .73rem !important;
    }

    .select2-error{
        margin-top: -1rem !important;
    }

    .select2{
        margin-bottom: -3vh;
    }
</style>
@stop

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

    $(function(){
        $(".date-input").flatpickr({
            dateFormat: "m/d/Y"
        });

        $('.select2').select2({
            placeholder: "-- Select child --",
            allowClear: true,
            width: 'resolve'
        });
   })

</script>
@stop