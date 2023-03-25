
@extends('layouts.master')


@section('content')
<div>&nbsp;</div>
<section class="content">
      <div class="container-fluid">

	  <div class="card">
              <div class="card-header">
                <h3 class="card-title">THAY ĐỔI MẬT KHẨU</h3>
              </div>
                
              <!-- /.card-header -->
              <div class="card-body p-1">

			<div id="giaoca" class="row">
				<!-- <div class="col-2 col-s-2"></div> -->
			  	<div class="col-12 col-s-12 gc">
<form action="" method="post">
  @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu cũ</label>
        <input type="password" class="form-control form-control-sm" id="current_password" name="current_password">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu mới(tối thiểu 6 kí tự)</label>
        <input type="password" class="form-control form-control-sm" id="new_password" name="new_password">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Xác nhận mật khẩu mới</label>
        <input type="password" class="form-control form-control-sm" id="new_confirm_password" name="new_confirm_password">
      </div>
      <button type="submit" class="btn btn-sm btn-primary">Submit</button>
    </div>
    <!-- /.card-body -->
  </form>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection

@section('javascript')
<script>
  $(document).ready(function(){
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
 
    
    @if (\Session::has('error'))
      toastr.error("{!! \Session::get('error') !!}");
    @endif
    @if (\Session::has('success'))
      toastr.success("{!! \Session::get('success') !!}");
    @endif
    @if ($errors->any())
     @foreach ($errors->all() as $error)
      toastr.error("{{$error}}")
      @break
     @endforeach
 @endif
});
  
</script>
@endsection