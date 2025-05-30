@extends('layouts.master')

@section('css')
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
    .content-wrapper {
        margin-left: 250px; /* Width of the sidebar */
    }
    .dataTables_wrapper {
        position: relative;
        z-index: 0;
    }
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        z-index: 0;
        position: relative;
    }
    .dtr-details {
        z-index: 0;
        position: relative;
    }
    .card {
        position: relative;
        z-index: 0;
        margin-bottom: 1rem;
    }
    .main-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 250px;
        z-index: 1040;
    }
    /* Custom Toggle Switch Styling */
    .form-switch .form-check-input {
        width: 3em !important;
        height: 1.5em !important;
        margin-left: -0.5em;
        background-color: #dc3545;
        border-color: #dc3545;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
        cursor: pointer;
    }
    .form-switch .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }
    .form-switch .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="page-title mb-0">
                    <i class="mdi mdi-email-outline me-1"></i> Email Templates
                </h4>
                <div>
                    <a href="{{ route('admin.email-templates.create') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-plus-circle me-1"></i> Add New Template
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
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
                                            data-id="{{ $template->id }}" 
                                            {{ $template->status ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $template->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.email-templates.edit', $template->id) }}" class="btn btn-sm btn-info waves-effect waves-light me-1" title="Edit">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger waves-effect waves-light delete-template" 
                                                data-id="{{ $template->id }}" title="Delete">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
                                        <form id="delete-form-{{ $template->id }}" 
                                              action="{{ route('admin.email-templates.destroy', $template->id) }}" 
                                              method="POST" class="d-none">
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
<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Bootstrap Toggle -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#email-templates-datatable').DataTable({
            responsive: true,
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });

        $('.status-toggle').bootstrapToggle();

        $('.status-toggle').on('change', function() {
            const toggle = $(this);
            const id = toggle.data('id');
            const isChecked = toggle.prop('checked');

            $.ajax({
                url: `/email-templates/${id}/toggle-status`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        
                        Swal.fire({
                            title: 'Success!',
                            text: 'Status updated successfully',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function() {
                    toggle.bootstrapToggle('toggle');
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update status',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        });

        // Delete template
        $('.delete-template').click(function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                }
            });
        });

        // Auto-hide alerts
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    });
</script>
@endpush
