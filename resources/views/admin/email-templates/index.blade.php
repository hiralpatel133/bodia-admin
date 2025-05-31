@extends('layouts.master')

@section('css')
<!-- Bootstrap Toggle -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content py-3">
        <div class="container-fluid px-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ is_array(session('success')) ? session('success')['message'] : session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="page-header mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0 font-weight-bold">Email Templates</h3>
                            <a href="{{ route('admin.email-templates.create') }}" class="btn btn-primary px-4">
                                Add New
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100 data-table" id="email-templates-datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $template)
                                <tr>
                                    <td class="fw-medium">{{ $template->name }}</td>
                                    <td>{{ $template->subject }}</td>
                                    <td>
                                        <input type="checkbox" class="status-toggle" 
                                            data-toggle="toggle" 
                                            data-on="Active" 
                                            data-off="Inactive" 
                                            data-onstyle="success" 
                                            data-offstyle="danger" 
                                            data-size="small"
                                            data-width="80"
                                            data-id="{{ $template->id }}" 
                                            {{ $template->status ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $template->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.email-templates.edit', $template->id) }}" class="btn btn-sm btn-info waves-effect waves-light me-1">
                                            <i class="mdi mdi-square-edit-outline me-1"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger waves-effect waves-light delete-template" 
                                                data-id="{{ $template->id }}">
                                            <i class="mdi mdi-trash-can-outline me-1"></i> Delete
                                        </button>
                                        <form id="delete-form-{{ $template->id }}" 
                                              action="{{ route('admin.email-templates.destroy', $template->id) }}" 
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        // Initialize DataTable
        var table = $('#email-templates-datatable').DataTable({
            responsive: true,
            order: [[3, 'desc']]
        });

        // Initialize toggle switches
        function initializeToggles() {
            $('.status-toggle').each(function() {
                $(this).bootstrapToggle({
                    on: 'Active',
                    off: 'Inactive',
                    onstyle: 'success',
                    offstyle: 'danger',
                    size: 'small',
                    width: 80
                });
            });
        }

        initializeToggles();

        console.log('Setting up delete functionality');
        
        // Delete functionality using event delegation
        $(document).on('click', '.delete-template', function(e) {
            console.log('Delete button clicked - Event target:', e.target);
            console.log('Delete button clicked - Current target:', e.currentTarget);
            e.preventDefault();
            e.stopPropagation();
            
            var button = $(this);
            var id = button.data('id');
            console.log('Delete template ID:', id);
            console.log('Button HTML:', button.prop('outerHTML'));
            console.log('Form HTML:', $('#delete-form-' + id).prop('outerHTML'));
            
            Swal.fire({
                title: 'Delete Template',
                text: "Are you sure you want to delete this template?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false
            }).then((result) => {
                console.log('SweetAlert result:', result);
                if (result.isConfirmed) {
                    console.log('Confirmed delete - Submitting form for ID:', id);
                    var form = $('#delete-form-' + id);
                    console.log('Form found:', form.length > 0);
                    form.submit();
                }
            });
        });

        // Toggle status
        $(document).on('change', '.status-toggle', function() {
            var toggle = $(this);
            var id = toggle.data('id');
            console.log('Toggle clicked for ID:', id);

            $.ajax({
                url: '{{ route("admin.email-templates.toggle-status", "__id__") }}'.replace('__id__', id),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    console.log('Sending toggle request...');
                    toggle.bootstrapToggle('disable');
                },
                success: function(response) {
                    console.log('Toggle response:', response);
                    if (response.success) {
                        toastr.success(response.message, response.title, {
                        closeButton: true,
                        progressBar: true,
                        positionClass: 'toast-top-right'
                    });
                    } else {
                        toggle.bootstrapToggle('toggle');
                        toastr.error(response.message, response.title, {
                        closeButton: true,
                        progressBar: true,
                        positionClass: 'toast-top-right'
                    });
                    }
                },
                error: function(xhr) {
                    console.error('Toggle error:', xhr.responseJSON);
                    toggle.bootstrapToggle('toggle');
                    var message = xhr.responseJSON?.message || 'Failed to update status';
                    toastr.error(message);
                },
                complete: function() {
                    toggle.bootstrapToggle('enable');
                }
            });
        });

        // Re-initialize toggles after DataTable operations
        table.on('draw', function() {
            initializeToggles();
        });

        // Auto-hide alerts
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);
    });
</script>
@endpush
