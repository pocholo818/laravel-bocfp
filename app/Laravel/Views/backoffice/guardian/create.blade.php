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
                <li class="breadcrumb-item"><a class="text-muted">Create Guardian</a></li>
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
            <h5>Guardian Form</h5>
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
                            <label class="col-sm-4">First Name  <b class="text-danger">*</b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control text-capitalize" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name">
                                
                                @if($errors->first('first_name'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('first_name') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4">Last Name  <b class="text-danger">*</b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control text-capitalize" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name">
                                
                                @if($errors->first('last_name'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('last_name') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4">Contact Number  <b class="text-danger">*</b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="input_contact" name="contact_number" value="{{ old('contact_number') }}" placeholder="Enter Contact Number">
                                
                                @if($errors->first('contact_number'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('contact_number') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4">Address  <b class="text-danger">*</b></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="input_address" name="address" placeholder="Enter Address">{{ old('address') }}</textarea>

                                @if($errors->first('address'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('address') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4">Purok  <b class="text-danger">*</b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="input_purok" name="purok" value="{{ old('purok') }}" placeholder="Enter Purok" maxlength="2">
                                
                                @if($errors->first('purok'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('purok') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4">Household ID <b class="text-danger">*</b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="household_id" value="{{ old('household_id') }}" placeholder="Enter Household ID">
                                
                                @if($errors->first('household_id'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('household_id') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4">Status <b class="text-danger">*</b></label>
                            <div class="col-sm-8">
                                {!! html()->select('status', $statuses, old('status'))->id('input_status')->class('form-control') !!}
                            
                                
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
                <div class="col-sm-8 offset-sm-3">
                <button type="submit" class="btn btn-secondary me-3">Submit</button>
                <a class="btn btn-light" href="{{route('backoffice.guardian.index')}}">Cancel</a>
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
        $(".date-input").flatpickr({
            dateFormat: "m/d/Y"
        });

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