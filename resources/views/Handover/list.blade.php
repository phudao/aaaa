@inject('Carbon', 'Carbon\Carbon')
@extends('layouts.master')


@section('content')
<div>&nbsp;</div>
<section class="content">
      <div class="container-fluid">
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH GIAO CA</h3>
              </div>
                
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="d-none d-sm-inline-block">Thứ</th>
                      <th>Ngày</th>
                      <th class="d-none d-sm-inline-block">Trực khối</th>
                      <th>Kíp trực</th>
                      <th class="d-none d-sm-inline-block">Logger</th>
                      <th class="d-none d-sm-inline-block">Thời gian Tạo</th>
                      <th class="d-none d-sm-inline-block">Thời gian C.Nhật</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($logs as $log)
                    <tr data-widget="expandable-table" aria-expanded="false">
                    <td class="d-none d-sm-inline-block">
                      @php $day = $Carbon::parse($log->date_working)->format('w'); if($day + 1 == 1){ echo 'CN';} else {echo ($day + 1);} @endphp
                      @php if(strlen($log->note) > 0) { echo '<span style="color:red;font-size:18px;font-weight:bold"> *</span>';} @endphp
                    </td>
                    <td>
                    @if ($log->shift == 0) 
                     <a href="/editlog/{{ $log->id }}"  style="cursor: pointer;"><span class="badge badge-light">{{ $log->date_working }}</span></a>
                     @else 
                     <a href="/editlog/{{ $log->id }}"  style="cursor: pointer;"><span class="badge badge-dark">{{ $log->date_working }}</span></a> 
                     @endif</td>
                    <td class="d-none d-sm-inline-block"><span class="badge badge-warning">{{ $log->manager }}</span></td>
                    <td><span class="badge badge-primary">{{ $log->leader }}</span>
                      @foreach(explode(', ', $log->staff_names) as $name)
                        <span class="badge badge-success">{{ $name }}</span>
                      @endforeach
                    </td>
                    
                    <td class="d-none d-sm-inline-block"><span class="badge badge-secondary">{{ $log->user }}</span></td>
                    <td class="d-none d-sm-inline-block">{{ $log->created_at }}</td>
                    <td class="d-none d-sm-inline-block">{{ $log->updated_at }}</td>
                    <td><i class="fas fa-print fa-lg" id="printer" onclick="insss({{ $log->id }})" style="color:green;cursor: pointer;"></i></td>
                    </tr>
                      @php if(strlen($log->note) > 0) { @endphp
                      <tr class="expandable-body">
                        <td colspan="8" style="clear:both;"><p>{{ $log->note }}</p></td>
                      </tr>
                      @php } @endphp
                    @endforeach
                  </tbody>
                </table>
                <table class="table table-stripe">
                <tr><td><div>{!! $logs->links() !!}</div></td></tr>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
</div>
</section>
<div id="printSection" style="display:none;"></div>
@endsection


@section('javascript')
<script>
  function insss(id){
    /*var divContents = document.getElementById("form1").innerHTML;
    var a = window.open('', '', 'height=500, width=500');
            a.document.title = '';
            a.document.windowUrl = '';
            a.document.write('<html>');
            a.document.write('<body > ');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
    a.print();*/  
    $('#printSection').load('/detail/'+id, function(){
      var divContents = document.getElementById("form1").innerHTML;//form1
      var a = window.open('', '', '');
      a.document.title = '';
      a.document.windowUrl = '';
      a.document.write('<html>');
      a.document.write('<body > ');
      a.document.write(divContents);
      a.document.write('</body></html>');
      a.document.close();
      a.print();
    });
  }

$('#printer').on('click', function(){

  })
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(){
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
 
    @if (\Session::has('info'))
      toastr.info("{!! \Session::get('info') !!}");
    @endif
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



