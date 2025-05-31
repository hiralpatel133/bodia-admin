@extends('layouts.master')

@section('css')
<style>
    .content-wrapper {
        margin-left: 250px; /* Width of the sidebar */
    }
</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.email-templates.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-2"></i>
                            <strong>Error!</strong> Please check the form below for errors.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('admin.email-templates.update', $emailTemplate->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Template Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $emailTemplate->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Email Subject <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject', $emailTemplate->subject) }}" required>
                                    @error('subject')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Email Body <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote @error('body') is-invalid @enderror" 
                                      id="body" name="body" required>{{ old('body', $emailTemplate->body) }}</textarea>
                            <small class="text-muted">Use the rich text editor to format your email content.</small>
                            @error('body')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusActive" value="1" {{ old('status', $emailTemplate->status) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusActive">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusInactive" value="0" {{ old('status', $emailTemplate->status) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusInactive">Inactive</label>
                            </div>
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="mdi mdi-content-save-outline me-1"></i> Update Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('scripts')
<!-- Summernote initialization -->
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endpush
