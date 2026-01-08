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
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.child.index') }}">Admin</a></li>
                <li class="breadcrumb-item"><a class="text-muted">Edit Details</a></li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-xl-5">
    @include('backoffice._components.notifications')

    <div class="card height-equal">
        <div class="card-header">
            <h5>Admin Form</h5>
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
                            <label class="col-sm-3">First Name  <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-capitalize" name="first_name" value="{{ old('first_name', $record->first_name) }}" placeholder="Enter First Name">
                                
                                @if($errors->first('first_name'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('first_name') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3">Last Name  <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-capitalize" name="last_name" value="{{ old('last_name', $record->last_name) }}" placeholder="Enter Last Name">
                                
                                @if($errors->first('last_name'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('last_name') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3">Sex <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                {!! html()->select('sex', $sexes, old('sex', $record->sex))->id('input_sex')->class('form-control') !!}
                            
                                
                                @if($errors->first('sex'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('sex') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3">Status <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                {!! html()->select('status', $statuses, old('status', $record->status))->id('input_status')->class('form-control') !!}
                            
                                
                                @if($errors->first('status'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('status') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer text-end">
                <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-secondary me-3">Submit</button>
                <a class="btn btn-light" href="{{ route('backoffice.child.index') }}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('page-scripts')
<script src="{{ asset('assets/js/imask/imask.min.js') }}"></script>
<script type="text/javascript">

    $(function(){
        // contact number
        let input = document.getElementById('input_contact');
        let input_value = "{{ old('contact_number') }}";
        let mask;

        function update_mask(){
            if (mask) mask.destroy(); // destroy mask

            mask = IMask(input, {
                mask: '+630000000000',
            });
            $("#input_contact").attr("placeholder", "+63XXXXXXXXXX");

            if (input_value) {
                mask.value = input_value;
            }
        }

        // initialize
        update_mask();
   })

</script>
@stop