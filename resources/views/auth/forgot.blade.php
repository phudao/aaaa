@extends('layouts.blank')
@section('content')
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Giao ca</b> CNTT</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Nhập email để yêu cầu mật khẩu mới.</p>
      @if ($message = Session::get('error'))
      <div class="alert alert-danger">
        <ul>
            <li>{{$message}}</li>
        </ul>
      </div>
    @elseif ($message = Session::get('success'))
    <div class="alert alert-success">
      <ul>
          <li>{{$message}}</li>
      </ul>
    </div>
    @endif
      <form action="" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Yêu cầu mật khẩu mới</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="/">Đăng nhập</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection