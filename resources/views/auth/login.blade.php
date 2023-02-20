@extends('layouts.blank')
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Giao ca</b> CNTT</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc</p>
      
      @if ($message = Session::get('error'))
        <div class="alert alert-danger">
          <ul>
              <li>{{$message}}</li>
          </ul>
        </div>
      @endif
      <!--
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach($error->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
      @endif
      -->

      <form action="/login" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Enter</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="/forgot">Quên mật khẩu</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection