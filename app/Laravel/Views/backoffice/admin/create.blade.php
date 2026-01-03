@extends('backoffice._layouts.main')

@section('breadcrumbs')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ $page_title }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.admin.index') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a class="text-muted">Create Admin</a></li>
                    </ol>
                </div>
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
                            <label class="col-sm-3">Name  <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-capitalize" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                
                                @if($errors->first('name'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('name') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3">Email <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control digits text-lowercase" name="email" value="{{ old('email') }}" placeholder="e.g. juan@gmail.com">
                                
                                @if($errors->first('email'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('email') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3">Contact Number <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control digits" name="contact_number" value="{{ old('contact_number') }}" id="input_contact" placeholder="09123456789">
                            
                                @if($errors->first('contact_number'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('contact_number') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="mb-3 row">
                            <label class="col-sm-3">Type <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                {!! html()->select('type', $types, old('type'))->id('input_type')->class('form-control') !!}

                                @if($errors->first('type'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('type') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div> --}}

                        <div class="mb-3 row">
                            <label class="col-sm-3">Role <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
                                {!! html()->select('role', $roles, old('role'))->id('input_role')->class('form-control') !!}

                                @if($errors->first('role'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('role') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3">Status <b class="text-danger">*</b></label>
                            <div class="col-sm-9">
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
                <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-secondary me-3">Submit</button>
                <a class="btn btn-light" href="{{route('backoffice.admin.index')}}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('page-scripts')
<script src="{{ asset('assets/js/imask/imask.min.js') }}"></script>
<script type="text/javascript">

    $('.text-capitalize').on('input', function() {
        let value = $(this).val().toLowerCase();
        let title_case = value.replace(/\b\w/g, function(letter) {
            return letter.toUpperCase();
        });
        $(this).val(title_case);
    });

    $('.text-capitalize').on('input', function() {
        let value = $(this).val().replace(/[^A-Za-z\s.'-]/g, '');
        value = value.replace(/\s{2,}/g, ' ');

        $(this).val(value);
    });

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