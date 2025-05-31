  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Bodia')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Toastr style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Bootstrap Toggle -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    
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
    /* Toggle button styling */
    .toggle.btn {
        min-width: 80px;
    }
    </style>

    @yield('css')
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div>
  
      @include('layouts.header') <!-- Header Section -->

      @include('layouts.sidebar')

      @yield('content') <!-- Main Content -->

      @include('layouts.footer')

    </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables & Plugins -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Bootstrap Toggle -->
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };
  </script>

  @yield('js')
  @stack('scripts')
  </body>
  </html>
