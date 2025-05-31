@extends('layouts.master')

@section('css')
<!-- Bootstrap Toggle -->
<!-- We don't need this since it's already in master layout -->
<!-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet"> -->
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content py-3">
        <div class="container-fluid px-3">
            @csrf
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
                            <h3 class="mb-0 font-weight-bold">Users</h3>
                            <div>
                                <div class="btn-group me-2">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Export
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.users.export', 'csv') }}">CSV</a>
                                        <a class="dropdown-item" href="{{ route('admin.users.export', 'xlsx') }}">Excel</a>
                                        <a class="dropdown-item" href="{{ route('admin.users.export', 'pdf') }}">PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100 data-table" id="users-datatable">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>COD Block</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="fw-medium">{{ $user->full_name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <input type="checkbox" class="status-toggle" 
                                            data-toggle="toggle" 
                                            data-on="Active" 
                                            data-off="Inactive" 
                                            data-onstyle="success" 
                                            data-offstyle="danger" 
                                            data-size="small"
                                            data-width="80"
                                            data-id="{{ $user->id }}" 
                                            {{ $user->status == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="cod-block-toggle" 
                                            data-toggle="toggle" 
                                            data-on="Yes" 
                                            data-off="No" 
                                            data-onstyle="danger" 
                                            data-offstyle="success" 
                                            data-size="small"
                                            data-width="80"
                                            data-id="{{ $user->id }}" 
                                            {{ $user->cod_block == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light me-1 view-user"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->full_name }}"
                                                data-phone="{{ $user->phone }}"
                                                data-email="{{ $user->email }}">
                                            <i class="mdi mdi-eye me-1"></i> View
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger waves-effect waves-light delete-user" 
                                                data-id="{{ $user->id }}">
                                            <i class="mdi mdi-trash-can-outline me-1"></i> Delete
                                        </button>
                                        <form id="delete-form-{{ $user->id }}" 
                                              action="{{ route('admin.users.destroy', $user->id) }}" 
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
    </section>
</div>

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">View User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="font-weight-bold">User Name:</label>
                        <p id="viewUserName" class="mb-0"></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="font-weight-bold">Mobile Number:</label>
                        <p id="viewUserPhone" class="mb-0"></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="font-weight-bold">Email:</label>
                        <p id="viewUserEmail" class="mb-0"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Set up CSRF token for all AJAX requests
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Initialize DataTable
        var table = $('#users-datatable').DataTable({
            responsive: true,
            order: [[5, 'desc']]
        });

        // Initialize toggle switches
        function initializeToggles() {
            $('.status-toggle, .cod-block-toggle').each(function() {
                if (!$(this).data('bs.toggle')) {
                    $(this).bootstrapToggle({
                        on: $(this).data('on'),
                        off: $(this).data('off'),
                        onstyle: $(this).data('onstyle'),
                        offstyle: $(this).data('offstyle'),
                        size: $(this).data('size'),
                        width: $(this).data('width')
                    });
                }
            });
        }

        initializeToggles();

        // Delete functionality
        $(document).on('click', '.delete-user', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var button = $(this);
            var id = button.data('id');
            
            Swal.fire({
                title: 'Delete User',
                text: "Are you sure you want to delete this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                }
            });
        });

        // Toggle status
        $(document).on('change', '.status-toggle', function() {
            var toggle = $(this);
            var id = toggle.data('id');
            var currentState = toggle.is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route("admin.users.toggle-status", "__id__") }}'.replace('__id__', id),
                type: 'POST',
                data: { 
                    status: currentState,
                    _token: csrfToken
                },
                beforeSend: function() {
                    toggle.bootstrapToggle('disable');
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toggle.bootstrapToggle('toggle');
                        toastr.error(response.message || 'Failed to update status');
                    }
                },
                error: function(xhr) {
                    toggle.bootstrapToggle('toggle');
                    toastr.error('Failed to update status. Please try again.');
                },
                complete: function() {
                    toggle.bootstrapToggle('enable');
                }
            });
        });

        // Toggle COD Block
        $(document).on('change', '.cod-block-toggle', function() {
            var toggle = $(this);
            var id = toggle.data('id');
            var currentState = toggle.is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route("admin.users.toggle-cod-block", "__id__") }}'.replace('__id__', id),
                type: 'POST',
                data: { 
                    cod_block: currentState,
                    _token: csrfToken
                },
                beforeSend: function() {
                    toggle.bootstrapToggle('disable');
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toggle.bootstrapToggle('toggle');
                        toastr.error(response.message || 'Failed to update COD block status');
                    }
                },
                error: function(xhr) {
                    toggle.bootstrapToggle('toggle');
                    toastr.error('Failed to update COD block status. Please try again.');
                },
                complete: function() {
                    toggle.bootstrapToggle('enable');
                }
            });
        });

        // View User Modal
        $(document).on('click', '.view-user', function() {
            var button = $(this);
            var modal = $('#viewUserModal');
            
            // Set modal content
            modal.find('#viewUserName').text(button.data('name'));
            modal.find('#viewUserPhone').text(button.data('phone'));
            modal.find('#viewUserEmail').text(button.data('email'));
            
            // Show modal
            modal.modal('show');
        });

        // Handle modal close
        $('#viewUserModal').on('hidden.bs.modal', function () {
            $(this).find('#viewUserName, #viewUserPhone, #viewUserEmail').text('');
        });

        // Re-initialize toggles after DataTable operations
        table.on('draw', function() {
            initializeToggles();
        });
    });
</script>
@endpush
