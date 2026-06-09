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
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.child.index') }}">Children</a></li>
                <li class="breadcrumb-item"><a class="text-muted">Create Child</a></li>
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
            <h5>Child Form</h5>
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
                                <input type="text" class="form-control text-uppercase" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name">
                                
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
                                <input type="text" class="form-control text-capitalize" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name">
                                
                                @if($errors->first('last_name'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('last_name') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3">Birthdate <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control date-input" id="input_birthdate" value="" name="birthdate"  data-date-format="m/d/Y" data-default-date="{{ old('birthdate') }}" placeholder="MM/DD/YYYY">
                                
                                @if($errors->first('birthdate'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('birthdate') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3">Sex <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                {!! html()->select('sex', $sexes, old('sex'))->id('input_sex')->class('form-control') !!}
                            
                                
                                @if($errors->first('sex'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('sex') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="mb-3 row">
                            <label class="col-sm-3">Status <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                {!! html()->select('status', $statuses, old('status'))->id('input_status')->class('form-control') !!}
                            
                                
                                @if($errors->first('status'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('status') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div> --}}

                        <div class="mb-3 row">
                            <label class="col-sm-3">Include Guardian <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input guardian-option" type="radio" name="guardian" id="guardian_no" value="" {{  old('guardian') == '' ? 'checked' : ''  }}>
                                    <label class="form-check-label text-muted" for="guardian_no">
                                        Not yet
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input guardian-option" type="radio" name="guardian" id="guardian_yes" value="create_guardian" {{  old('guardian') == 'create_guardian' ? 'checked' : ''  }}>
                                    <label class="form-check-label text-muted" for="guardian_yes">
                                        Create with Guardian
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input guardian-option" type="radio" name="guardian" id="guardian_exist" value="exist_guardian" {{  old('guardian') == 'exist_guardian' ? 'checked' : ''  }}>
                                    <label class="form-check-label text-muted" for="guardian_exist">
                                        Already Existed
                                    </label>
                                </div>
                                
                                @if($errors->first('status'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('status') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- guardian form --}}
                        <div class="d-none" id="guardian_form">
                            <div class="mb-3">
                                <h5>Guardian Form</h5>
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
                            
                            <div class="mb-3 row">
                                <label class="col-sm-3">First Name  <b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control text-capitalize" name="guardian_first_name" value="{{ old('guardian_first_name') }}" placeholder="Enter Guardian First Name">
                                    
                                    @if($errors->first('guardian_first_name'))
                                        <div class="text-left mx-3">
                                            <small class="d-block mt-1 text-danger">{{ $errors->first('guardian_first_name') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3">Last Name  <b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control text-capitalize" name="guardian_last_name" value="{{ old('guardian_last_name') }}" placeholder="Enter Guardian Last Name">
                                    
                                    @if($errors->first('guardian_last_name'))
                                        <div class="text-left mx-3">
                                            <small class="d-block mt-1 text-danger">{{ $errors->first('guardian_last_name') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3">Contact Number  <b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="input_contact" name="contact_number" value="{{ old('contact_number') }}" placeholder="Enter Contact Number">
                                    
                                    @if($errors->first('contact_number'))
                                        <div class="text-left mx-3">
                                            <small class="d-block mt-1 text-danger">{{ $errors->first('contact_number') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3">Address  <b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="input_address" name="address" placeholder="Enter Address">{{ old('address') }}</textarea>

                                    @if($errors->first('address'))
                                        <div class="text-left mx-3">
                                            <small class="d-block mt-1 text-danger">{{ $errors->first('address') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3">Purok  <b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="input_purok" name="purok" value="{{ old('purok') }}" placeholder="Enter Purok" maxlength="2">
                                    
                                    @if($errors->first('purok'))
                                        <div class="text-left mx-3">
                                            <small class="d-block mt-1 text-danger">{{ $errors->first('purok') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3">Household <br>ID <b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="household_id" value="{{ old('household_id') }}" placeholder="Enter Household ID">
                                    
                                    @if($errors->first('household_id'))
                                        <div class="text-left mx-3">
                                            <small class="d-block mt-1 text-danger">{{ $errors->first('household_id') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{-- guardian search form --}}
                        <div class="d-none" id="guardian_exist_form">
                            <div class="mb-3">
                                <h5>Search Guardian</h5>
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

                            <div class="mb-3 row">
                                <label class="col-sm-3">Guardian Name <b class="text-danger">*</b></label>
                                <div class="col-sm-9">
                                    {{-- <input type="text" class="form-control text-capitalize" name="guardian_exist" id="input_guardiann_exist" value="{{ old('guardian_exist') }}" placeholder="Enter Guardian Name"> --}}
                                    {!! html()->select('guardian_exist', $guardians_exist, old('relationship'))->id('input_guardiann_exist')->class('form-control') !!}
                                    
                                    @if($errors->first('guardian_exist'))
                                        <div class="text-left mx-3">
                                            <small class="d-block mt-1 text-danger">{{ $errors->first('guardian_exist') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="card-footer text-end">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-secondary me-3" id="submit-btn">Submit</button>
                    <a class="btn btn-light" href="{{route('backoffice.child.index')}}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('page-styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('page-scripts')
<script src="{{ asset('assets/js/imask/imask.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

    $(function(){
        $(".date-input").flatpickr({
            dateFormat: "m/d/Y"
        });

        $('#input_guardiann_exist').select2({
            placeholder: "--Select Guardian--",
            allowClear: true,
            width: 'resolve'
        });

        // old guardian
        const oldGuardian = "{{ old('guardian') }}";

        if(oldGuardian === 'create_guardian'){
            $('#guardian_form').removeClass('d-none');
            $('#guardian_exist_form').addClass('d-none');
        }
        else if(oldGuardian === 'exist_guardian'){
            $('#guardian_form').addClass('d-none');
            $('#guardian_exist_form').removeClass('d-none');
        }

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

        $('.guardian-option').on('click', function (){
            const id = $(this).attr('id');
            const guardianForm = $('#guardian_form');
            const guardianExistForm = $('#guardian_exist_form');
            const guardianExistSelect = $('#input_guardiann_exist');

            switch(id){
                case "guardian_yes":
                    guardianForm.removeClass('d-none');
                    guardianExistForm.addClass('d-none')

                    guardianExistSelect.val(null).trigger("change");
                break;
                case "guardian_exist":
                    guardianForm.addClass('d-none');
                    guardianExistForm.removeClass('d-none')

                    guardianExistSelect.val(null).trigger("change");
                break;
                default:
                    guardianForm.addClass('d-none');
                    guardianExistForm.addClass('d-none');

                    guardianExistSelect.val(null).trigger("change");
                break;
            }
        });

        // initialize
        update_mask();
   })

</script>
@stop