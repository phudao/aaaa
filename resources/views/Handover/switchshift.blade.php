@extends('layouts.master')


@section('content')
<div>&nbsp;</div>
<section class="content">
      <div class="container-fluid">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">ĐỔI CA</h3>
              </div>
            <!-- /.card-header -->
            <div class="card-body p-0">


<div class="row">
    <!-- left column -->
    <div class="col-md-4">
      <!-- general form elements -->

        <!-- /.card-header -->
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Người đổi ca</label>
              <select class="form-control">
                <option>-Chọn người đổi ca-</option>
                <option></option>
                <option></option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Ngày trực thay</label>
              <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Người trực thay</label>
              <select class="form-control">
                <option>-Chọn người trực thay-</option>
                <option></option>
                <option></option>
              </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Ngày trực trả</label>
                <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group"><button type="submit" class="btn btn-primary">Lưu & In</button></div>   
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