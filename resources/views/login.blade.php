@extends('layouts.master')

@section('title', 'Login')

@section('content')

<div class="login-box">
    <div class="login-logo">
      <a href="/">
        <img src="bodia-logo.png" alt="bodia">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
  
        <form action="{{ route('login.submit') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <div class="social-auth-links text-center mb-3">

        </div>
        <!-- /.social-auth-links -->
  
        <p class="mb-1">
        </p>
        <p class="mb-0">
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
@endsection

@section('css')

@endsection

@section('js')
@if(Session::has('alertmsg'))  ,
  <script> toastr.error("{{ Session::get('alertmsg') }}");</script>
@endif 
@endsection
