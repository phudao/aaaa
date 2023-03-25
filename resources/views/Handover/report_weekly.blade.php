@extends('layouts.master')
@section('content')
<div>&nbsp;</div>
<section class="content">
      <div class="container-fluid">

	  <div class="card">
              <div class="card-header">
                <h3 class="card-title">BÁO CÁO</h3>
              </div>
                
              <!-- /.card-header -->
              <div class="card-body p-1">
<form action="" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" accept-charset="utf-8">
    @csrf
    <div class="col-md-12">
            <div class="form-group"> 
              <label>Tên báo cáo</label>
                <div>
                    <input type="text" id="name" name="name" class="form-control form-control-sm" value="BÁO CÁO TUẦN"/>
                </div>
            </div>
            <div class="form-group"> 
              <label>Ngày bắt đầu:</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="date" id="from" name="from" class="form-control form-control-sm datetimepicker-input" data-target="#reservationdate"/>
                </div>
            </div>
            <div class="form-group">
              <label>Ngày kết thúc:</label>
                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                    <input type="date" id="to" name="to" class="form-control form-control-sm datetimepicker-input" data-target="#reservationdatetime"/>
                </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
</form>
</div></div></div></section>
@section('javascript')
<script>
    function validateForm() {
      var name 	= $('#name').val();
      var from 	= $('#from').val();
	    var to 	    = $('#to').val();
      if (name == "") {
		    return raiseError('name','Tên báo cáo không được để trống');
	    }
      if (from == "" || from == 'dd/mm/yyyy') {
		    return raiseError('from','Ngày bắt đầu không đúng định dạng');
	    }
        if (to == "" || to == 'dd/mm/yyyy') {
		    return raiseError('to','Ngày kết thúc không đúng định dạng');
	    }
        return true;
    }
    function raiseError(element, msg){
	    toastr.error(msg);
		$('#'+element).addClass('is-invalid');
		$('#'+element).focus();
        return false;
	}
</script>
@endsection
@endsection