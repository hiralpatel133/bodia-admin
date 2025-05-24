@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Site Settings</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="site_name">Site Name</label>
                                    <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                           id="site_name" name="site_name" 
                                           value="{{ old('site_name', $settings->site_name ?? '') }}">
                                    @error('site_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_logo">Site Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('site_logo') is-invalid @enderror" 
                                                   id="site_logo" name="site_logo">
                                            <label class="custom-file-label" for="site_logo">Choose file</label>
                                        </div>
                                    </div>
                                    @if(isset($settings->site_logo))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $settings->site_logo) }}" 
                                                 alt="Current Logo" class="img-thumbnail" style="max-height: 100px">
                                        </div>
                                    @endif
                                    @error('site_logo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" 
                                           value="{{ old('email', $settings->email ?? '') }}">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" 
                                              rows="3">{{ old('address', $settings->address ?? '') }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_currency">Site Currency</label>
                                    <input type="text" class="form-control @error('site_currency') is-invalid @enderror" 
                                           id="site_currency" name="site_currency" 
                                           value="{{ old('site_currency', $settings->site_currency ?? 'USD') }}">
                                    @error('site_currency')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize custom file input
        bsCustomFileInput.init();
    });
</script>
@endpush
