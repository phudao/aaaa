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
                      <th class="d-none d-sm-inline-block">Email</th>
                      <th>Active</th>
                      <th class="d-none d-sm-inline-block">Role</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                    <td></td>
                    <td><span class="badge badge-primary">{{ $user->name }}</span></td>
                    <td class="d-none d-sm-inline-block"><span class="badge badge-warning">{{ $user->email }}</span></td>
                    <td>@if($user->active == 1)<span class="badge badge-success">Đã kích hoạt</span> @else <span class="badge badge-dark"> Inactive</span> @endif</span></td>
                    <td class="d-none d-sm-inline-block"><span class="badge badge-info"> </td>
                    <td></td>
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
