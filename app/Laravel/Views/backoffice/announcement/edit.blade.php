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
        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('backoffice.announcement.index') }}">Announcements</a></li>
                <li class="breadcrumb-item"><a class="text-muted">Edit Announcement</a></li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12 col-md-6">
    @include('backoffice._components.notifications')

    <div class="card height-equal">
        <div class="card-header">
            <h5>Announcement Form</h5>
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
                            <label class="">Title  <b class="text-danger">*</b></label>
                            <div class="">
                                <input type="text" class="form-control" name="title" value="{{ old('title', $record->title) }}" placeholder="e.g. Barangay Feeding Program">
                                
                                @if($errors->first('title'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('title') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="">Content <b class="text-danger">*</b></label>
                            <div class="">
                                <textarea name="content" class="form-control editor">{{ old('content', $record->content) }}</textarea>
                                
                                @if($errors->first('content'))
                                    <div class="text-left mx-3">
                                        <small class="d-block mt-1 text-danger">{{ $errors->first('content') }}</small>
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
                <a class="btn btn-light" href="{{route('backoffice.announcement.index')}}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('page-styles')
<style>
    .ck-editor__editable {
        min-height: 300px;
        max-height: 900px;
        resize: vertical;
        overflow: auto;
    }

    .ck-content ul {
        list-style-type: disc !important;
        padding-left: 20px !important;
    }
    .ck-content ol {
        list-style-type: decimal !important;
        padding-left: 20px !important;
    }
</style>
@stop

@section('page-scripts')
<script src="{{ asset('assets/backoffice/libs/ckeditor5/build/ckeditor.js') }}"></script>
<script type="text/javascript">
$(function(){
    ClassicEditor.create(document.querySelector('.editor'), {
        toolbar: [
            'heading',
            'bold',
            'italic',
            'bulletedList', 
            'numberedList', 
            'outdent', 
            'indent',
        ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },  // Regular paragraph
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },  // Heading 1
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },  // Heading 2
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }   // Heading 3
            ]
        }
    }).catch(error => {
        console.error(error);
    });
});
</script>
@stop