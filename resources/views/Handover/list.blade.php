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
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th class="d-none d-sm-inline-block">Thứ</th>
                      <th>Ngày</th>
                      <th class="d-none d-sm-inline-block"></th>
                      <th>Kíp trực</th>
                      <th class="d-none d-sm-inline-block"></th>
                      <th class="d-none d-sm-inline-block"></th>
                      <th class="d-none d-sm-inline-block"></th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($logs as $log)
                    <tr>
                    <td class="d-none d-sm-inline-block">@php $day = $Carbon::parse($log->date_working)->format('w'); if($day + 1 == 1){ echo 'CN';} else {echo ($day + 1);} @endphp</td>
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
                    <td><i class="fas fa-print fa-lg" onclick="insss()" style="color:green;cursor: pointer;"></i></td>
                    </tr>
                      @php if(strlen($log->note) > 0) { @endphp
                      <tr class="bg-light">
                        <td colspan="8" style="clear:both;">{{ $log->note }}</td>
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
@endsection
@include('view.print')

@section('javascript')
<script>
  function insss(id){
    var divContents = document.getElementById("form1").innerHTML;
    var a = window.open('', '', 'height=500, width=500');
            a.document.title = '';
            a.document.windowUrl = '';
            a.document.write('<html>');
            a.document.write('<body > ');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
    a.print();
  }
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endsection



