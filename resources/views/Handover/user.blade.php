@extends('layouts.master')


@section('content')
<div>&nbsp;</div>
<section class="content">
      <div class="container-fluid">
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH NGƯỜI DÙNG</h3>
              </div>
                
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Tên người dùng</th>
                      <th>Email</th>
                      <th>Vị Trí</th>
                      <th>Role</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                    <td></td>
                    <td><span class="badge badge-secondary badge-success">{{ $user->name }}</span></td>
                    <td><span class="badge badge-warning">{{ $user->email }}</span></td>
                    <td><span class="badge badge-danger"> </span></td>
                    <td><span class="badge badge-info"> </td>
                    <td width="10%"><button type="button" class="btn btn-sm btn-block btn-primary">Change Pass</button>
                    <td width="5%"><button type="button" class="btn btn-sm btn-block btn-primary">Sửa</button>
                    </tr>
                    @endforeach
                    <tr><td colspan="8"><div>{!! $users->links() !!}</div></td></tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>


</div>
</section>
@stop
