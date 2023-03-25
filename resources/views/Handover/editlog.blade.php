
@extends('layouts.master')


@section('content')
<div>&nbsp;</div>
<section class="content">
      <div class="container-fluid">
		@if (count($diffs) > 0)
			<div class="card">
			<div class="card-header">
			  <h3 class="card-title">LỊCH SỬ THAY ĐỔI</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body table-responsive p-0">
			  <table class="table table-hover text-nowrap">
				<thead>
				  <tr>
					<th>Thời gian</th>
					<th>Người Dùng</th>
					<th>Nội dung thay đổi</th>
				  </tr>
				</thead>
				<tbody>
				@foreach($diffs as $diff)					
				  <tr>
					<td>{{$diff['updated_at'] }}</td>
					<td><span class="tag tag-success">{{ $diff['username']}}</span></td>
					<td>{{ $diff['diff']}}</td>
				  </tr>
				@endforeach
				</tbody>
			  </table>
			</div>
			<!-- /.card-body -->
		  	</div>
		  @endif
	  <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="color: #dc3545;">{{ $title }}</h3>
              </div>
                
              <!-- /.card-header -->
              <div class="card-body p-1">

			<div id="giaoca" class="row">
				<!-- <div class="col-2 col-s-2"></div> -->
			  	<div class="col-12 col-s-12 gc">
					<form class="" action="/edit" method="post" id="logForm" onsubmit="return validateForm()">
                        @csrf
						<div class="row justify-content-start">
						  	<div class="col-12 col-sm-2">
							  <div class="form-group">
								<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Ngày trực: </p>
								<input class="form-control form-control-sm select-default" disabled value="{{ $log->date_working }}" type="date" name="data[date_working]" id="ngaytruc">
							</div>
							</div>
							<div class="col1 col-sm-1">
								<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Ca trực: </p>
								<input type="radio" name="data[shift]" disabled value="0" @if($log->shift == 0) checked @endif>Ngày&nbsp;&nbsp; 
								<input type="radio" name="data[shift]" disabled value="1" @if($log->shift == 1) checked @endif>Đêm
								</p>
							</div>
							
						    
							<div class="col-12 col-sm-2">
							
								<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Trực trung tâm:</p>
								<select class="form-control select-default form-control-sm" id="manager" class="operator" name="data[manager_id]">
									<option value="-1">---Trực Trung Tâm---</option>
									@foreach ($managers as $manager)
										@if($manager->id == $log->manager_id)
											<option value="{{ $manager->id }}" selected>{{ $manager->name }}</option>
										@else
											<option value="{{ $manager->id }}">{{ $manager->name }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-2">
								<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Kíp trưởng: </p>
								<select class="form-control select-default form-control-sm" id="leader" class="operator" name="data[leader_id]">
									<option value="-1">---Chọn Kíp trưởng---</option>
									@foreach ($leaders as $leader)
										@if($leader->id == $log->leader_id)
											<option value="{{ $leader->id }}" selected>{{ $leader->name }}</option>
										@else
											<option value="{{ $leader->id }}">{{ $leader->name }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-5">
								<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Kíp viên: </p>
								<select class="form-control select2bs4 select-default form-control-sm" id="staffs" multiple="multiple" name="data[staff_names][]">
								@foreach ($staffs as $staff)									 
									@php
									
									$arrIds = explode(',', $log->staff_ids); 

									@endphp
									@if(in_array($staff->id, $arrIds))
										<option  value="{{ $staff->id }}:{{ $staff->name }}" selected="selected">{{ $staff->name }}</option>
									@else
										<option value="{{ $staff->id }}:{{ $staff->name }}">{{ $staff->name }}</option>
									@endif
								@endforeach
								</select>
							</div>
						
						</div>
						
						<h4 style="color:#000; margin-top:0px"><hr>A. Hệ thống ATM<hr></h4>
						<div class="row">
							<div class="col-12 col-sm-2">
				  			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Thiết bị trên ACC h/đ tốt không?</p>
							  <select class="form-control select-color form-control-sm" id="acc_devices" name="data[acc_devices]">
								@foreach ($bools as $bool)
									@if($log->acc_devices == $bool->key)
										<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}" selected>{{ $bool->title }}</option>
									@else
										<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}">{{ $bool->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">CWP TEST on ACC: </p>
						  		<select class="form-control select-color form-control-sm" id="acc_cwps_test" name="data[acc_cwps_test]">
									@foreach ($onoffs as $onoff)
									@if($log->acc_cwps_test == $onoff->key)
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}" selected>{{ $onoff->title }}</option>
									@else
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}">{{ $onoff->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
						</div>
						<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">1. RFE 1/2 ( màu sắc trên CMS)</p>
						<div class="row">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[rf12_mst]">
							    <option value="1" @if($log->rf12_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->rf12_mst == 2) selected @endif>2</option>
							</select>
							</div>
						
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">NB: </p>
						  		<select class="form-control select-color form-control-sm" id="nb" name="data[nb]">
								@foreach ($colors as $color)
									@if($log->nb == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">CM: </p>
						  		<select class="form-control select-color form-control-sm" id="cm" name="data[cm]">
								@foreach ($colors as $color)
									@if($log->cm == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">ST: </p>
						  		<select class="form-control select-color form-control-sm" id="st" name="data[st]">
								@foreach ($colors as $color)
									@if($log->st == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
					    </div>
					    
				  			<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">2. RFE 3/4 ( màu sắc trên CMS)</></p>
							  <div class="row justify-content-start select-2">
							  <div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[rf34_mst]">
							    <option value="3" @if($log->rf34_mst == 3) selected @endif>3</option>
							    <option value="4" @if($log->rf34_mst == 4) selected @endif>4</option>
							</select>
								</div>
						
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">VI: </p>
						  		<select class="form-control select-color form-control-sm" id="vi" name="data[vi]">
								  @foreach ($colors as $color)
								  	@if($log->vi == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">TN: </p>
						  		<select class="form-control select-color form-control-sm" id="tn" name="data[tn]">
								  @foreach ($colors as $color)
								  	@if($log->tn == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">VC: </p>
						  		<select class="form-control select-color form-control-sm" id="vc" name="data[vc]">
								  @foreach ($colors as $color)
								  	@if($log->vc == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">BH: </p>
						  		<select class="form-control select-color form-control-sm" id="bh" name="data[bh]">
								  @foreach ($colors as $color)
								  	@if($log->bh == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">BI: </p>
						  		<select class="form-control select-color form-control-sm" id="bi" name="data[bi]">
								  @foreach ($colors as $color)
								  	@if($log->bi == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">BN: </p>
						  		<select class="form-control select-color form-control-sm" id="bn" name="data[bn]">
								  @foreach ($colors as $color)
								  	@if($log->bn == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
					    </div>
					    
						<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">3. RFE 5/6 ( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							  <div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[rf56_mst]">
							  	<option value="5" @if($log->rf56_mst == 5) selected @endif>5</option>
							    <option value="6" @if($log->rf56_mst == 6) selected @endif>6</option>
							</select>
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">NT: </p>
						  		<select class="form-control select-color form-control-sm" id="nt" name="data[nt]">
								@foreach ($colors as $color)
									@if($log->nt == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">NH: </p>
						  		<select class="form-control select-color form-control-sm" id="nh" name="data[nh]">
								@foreach ($colors as $color)
									@if($log->nh == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">BS: </p>
						  		<select class="form-control select-color form-control-sm" id="bs" name="data[bs]">
								@foreach ($colors as $color)
									@if($log->bs == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">BO: </p>
						  		<select class="form-control select-color form-control-sm" id="bo" name="data[bo]">
								@foreach ($colors as $color)
									@if($log->bo == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">BT: </p>
						  		<select class="form-control select-color form-control-sm" id="bt" name="data[bt]">
								@foreach ($colors as $color)
								@if($log->bt == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">BR: </p>
						  		<select class="form-control select-color form-control-sm" id="br" name="data[br]">
								@foreach ($colors as $color)
									@if($log->br == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
					    </div>
					    
						<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">4. RFE 7/8 ( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[rf78_mst]">
							  	<option value="7" @if($log->rf78_mst == 7) selected @endif>7</option>
							    <option value="8" @if($log->rf78_mst == 8) selected @endif>8</option>
							</select>
						
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">BV: </p>
						  		<select class="form-control select-color form-control-sm" id="bv" name="data[bv]">
								@foreach ($colors as $color)
								  	@if($log->bv == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">RG: </p>
						  		<select class="form-control select-color form-control-sm" id="rg" name="data[rg]">
								  @foreach ($colors as $color)
								  @if($log->rg == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
						</div>
						
						<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">5. MSF ( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[ms_mst]">
							    <option value="1" @if($log->ms_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->ms_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MSF: </p>
						  		<select class="form-control select-color form-control-sm" id="msf" name="data[msf]">
								  @foreach ($colors as $color)
								  @if($log->msf == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
						</div>
						
						<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">6. SafeNet - MONA( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[sf_mst]">
							    <option value="1" @if($log->sf_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->sf_mst == 2) selected @endif>2</option>
							</select>
						
								</div >
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">STCA: </p>
						  		<select class="form-control select-color form-control-sm" id="stca" name="data[stca]">
								  @foreach ($colors as $color)
								  @if($log->stca == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MSAW: </p>
						  		<select class="form-control select-color form-control-sm" id="msaw" name="data[msaw]">
								  @foreach ($colors as $color)
								  @if($log->msaw == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">DAIW: </p>
						  		<select class="form-control select-color form-control-sm" id="daiw" name="data[daiw]">
								  @foreach ($colors as $color)
								  @if($log->daiw == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
						</div>
						
						<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">7. RPB ( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
						<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[rp_mst]">
							    <option value="1" @if($log->rp_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->rp_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">REC,BCK: </p>
						  		<select class="form-control select-color form-control-sm" id="rpb" name="data[rec_bck]">
								@foreach ($colors as $color)
								@if($log->rec_bck == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div><div class="col-12  col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Backuped USB </p>
						  		<select class="form-control select-color form-control-sm" id="bck-usb" name="data[backed_up]">
								@foreach ($dones as $done)
								@if($log->backed_up == $done->key)
										<option style="color:{{ $done->color }}" value="{{ $done->key }}" color="{{ $done->color }}" selected>{{ $done->title }}</option>
									@else
										<option style="color:{{ $done->color }}" value="{{ $done->key }}" color="{{ $done->color }}">{{ $done->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							
					    	<div class="col-12 col-sm-2">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">HD1 from: </p>
						  		<input class="form-control select-color form-control-sm" type="datetime-local" id="hd1-from" value="{{ $log->hd1_from }}" name="data[hd1_from]" step="1">
							</div>
							<div class="col-12 col-sm-2">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">HD1 to</p>
						  		<input class="form-control select-color form-control-sm" type="datetime-local" id="hd1-to" value="{{ $log->hd1_to }}" name="data[hd1_to]" step="1">
							</div>
							<div class="col-12 col-sm-2">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">HD2 from: </p>
						  		<input class="form-control select-color form-control-sm" type="datetime-local" id="hd2-from" value="{{ $log->hd2_from }}" name="data[hd2_from]" step="1">
								  </div>
							<div class="col-12 col-sm-2">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">HD2 to </p>
						  		<input class="form-control select-color form-control-sm" type="datetime-local" id="hd2-to" value="{{ $log->hd2_to }}" name="data[hd2_to]" step="1">
							</div>
							
						</div>
						<div class="row justify-content-start">
						<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">8. GTW MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[gw_mst]">
							    <option value="1" @if($log->gw_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->gw_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">GDO, GRC: </p>
						  		<select class="form-control select-color form-control-sm" id="gtw" name="data[gdo_grc]">
								  @foreach ($colors as $color)
								  @if($log->gdo_grc == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							</div>
						<div class="row justify-content-start">
						<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">9. FDP MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[fp_mst]">
							    <option value="1" @if($log->fp_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->fp_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">AFS: </p>
						  		<select class="form-control select-color form-control-sm" id="gtw" name="data[afs]">
								@foreach ($colors as $color)
									@if($log->afs == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>

						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">10. DBH MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[db_mst]">
							    <option value="1" @if($log->db_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->db_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">DBH: </p>
						  		<select class="form-control select-color form-control-sm" id="dbh" name="data[dbh]">
								  @foreach ($colors as $color)
								  @if($log->dbh == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>

							<div class="col-12 col-sm-1">
								<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">11. MNA MST:</p>
								<select class="form-control select-color form-control-sm" id="mst" name="data[mn_mst]">
								  <option value="1" @if($log->mn_mst == 1) selected @endif>1</option>
								  <option value="2" @if($log->mn_mst == 2) selected @endif>2</option>
							  </select>
							  </div>
  
								<div class="col-12 col-sm-1">
									<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MONA: </p>
									<select class="form-control select-color form-control-sm" id="mn" name="data[mona]">
									@foreach ($colors as $color)
									@if($log->mona == $color->key)
										  <option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									  @else
										  <option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									  @endif
								  @endforeach
								  </select>
							  </div>

						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">12. MTCD MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[mt_mst]">
							    <option value="1" @if($log->mt_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->mt_mst == 2) selected @endif>2</option>
							</select>
							</div>

						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">MTCD: </p>
						  		<select class="form-control select-color form-control-sm" id="mt" name="data[mtcd]">
								@foreach ($colors as $color)
								@if($log->mtcd == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>

						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">13. IDS MST:</p>
				  			<select class="form-control select-color form-control-sm" id="mst" name="data[id_mst]">
							    <option value="1" @if($log->id_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->id_mst == 2) selected @endif>2</option>
							</select>
							</div >	
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Nhận điện?: </p>
						  		<select class="form-control select-color form-control-sm" id="ids" name="data[id_data_received]">
								@foreach ($bools as $bool)
									@if($log->id_data_received == $bool->key)
										<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}" selected>{{ $bool->title }}</option>
									@else
										<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}">{{ $bool->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							</div>
						<div class="row justify-content-start">
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">14.D36-ADMAN?</p>
						  		<select class="form-control select-color form-control-sm" id="adman1" name="data[adman_client]">
								  @foreach ($bools as $bool)
								  @if($log->adman_client == $bool->key)
										<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}" selected>{{ $bool->title }}</option>
									@else
										<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}">{{ $bool->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Input vàng ?: </p>
						  		<select class="form-control select-color form-control-sm" id="adman2" name="data[fpl_track_met]">
								@foreach ($admans as $adman)
								@if($log->fpl_track_met == $adman->key)
										<option style="color:{{ $adman->color }}" value="{{ $adman->key }}" color="{{ $adman->color }}" selected>{{ $adman->title }}</option>
									@else
										<option style="color:{{ $adman->color }}" value="{{ $adman->key }}" color="{{ $adman->color }}">{{ $adman->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
						</div>
						</div></div>
						<p style="margin-top: 0px; margin-bottom: 0px; font-weight:bold" class="col-form-label-sm">15. Shared device. </p>	
						<div class="row justify-content-start">

						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">DBH:</p>
						  		<select class="form-control select-color form-control-sm" id="sharedbh" name="data[shd_dbh]">
								@foreach ($colors as $color)
								@if($log->shd_dbh == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">RPB:</p>
						  		<select class="form-control select-color form-control-sm" id="sharerpb" name="data[shd_rpb]">
								  @foreach ($colors as $color)
								  @if($log->shd_rpb == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">IDS:</p>
						  		<select class="form-control select-color form-control-sm" id="shareids" name="data[shd_ids]">
								  @foreach ($colors as $color)
								  @if($log->shd_ids == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>		
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">16. DEC:</p>
						  		<select class="form-control select-color form-control-sm" id="dec" name="data[dec]">
								  @foreach ($colors as $color)
								  @if($log->dec == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">17.Clocks đ.bộ?</p>
						  		<select class="form-control select-color form-control-sm" id="clockwall" name="data[clocks]">
								  @foreach ($bools as $bool)
								  @if($log->clocks == $bool->key)
										<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}" selected>{{ $bool->title }}</option>
									@else
										<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}">{{ $bool->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">18. DAS-Web</p>
						  		<select class="form-control select-color form-control-sm" id="webserver" name="data[das_webserver]">
								@foreach ($onoffs as $onoff)
								@if($log->das_webserver == $onoff->key)
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}" selected>{{ $onoff->title }}</option>
									@else
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}">{{ $onoff->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Oracle DAS:</p>
						  		<select class="form-control select-color form-control-sm" id="oracledas" name="data[das_oracledb]">
								@foreach ($onoffs as $onoff)
								@if($log->das_oracledb == $onoff->key)
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}" selected>{{ $onoff->title }}</option>
									@else
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}">{{ $onoff->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
</div>
							
						<div id="lab" >
							<h4 style="color:#000; margin-top:0px"><hr>B. Hệ thống thiết bị phòng LAB<hr></h4>
							<div class="row justify-content-start">	
								<div class="col-12 col-sm-6">
									<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Thiết bị tại tủ server: </p>
									<textarea class="form-control" name="data[lab_servers]" type="text" class="form-control" id="thietbi1">{{$log->lab_servers}}</textarea>
								</div><div class="col-12 col-sm-6">
									<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Thiết bị tại vị trí giảng viên/học viên: </p>
									<textarea class="form-control" name="data[lab_cpws]" type="text" class="form-control" id="thietbi2">{{$log->lab_cpws}}</textarea>
								</div>		
							</div>							
						</div>
						
						<div id="ricochet">
							<h4 style="color:#000; margin-top:0px"><hr>C. Hệ thống Ricochet<hr></h4>
							<div class="row justify-content-start">
								
					                <div class="col-12 col-sm-2 ricochet1">
					                    <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Server A: </p>
					                    <select class="form-control select-color form-control-sm" id="recochetA_services" name="data[recochetA_services]">
										@foreach ($runstops as $runstop)
										@if($log->recochetA_services == $runstop->key)
											<option style="color:{{ $runstop->color }}" value="{{ $runstop->key }}" color="{{ $runstop->color }}" selected>{{ $runstop->title }}</option>
										@else
											<option style="color:{{ $runstop->color }}" value="{{ $runstop->key }}" color="{{ $runstop->color }}">{{ $runstop->title }}</option>
										@endif
										@endforeach
					                  </select>               
					                </div>
									
					                <div class="col-12 col-sm-2 ricochet1">
									<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">(GB)</p>
					                  <input class="form-control select-color form-control-sm" id="recochetA_hd_free" min="0" step="0.1" value="{{ $log->recochetA_hd_free }}" type="number" value name="data[recochetA_hd_free]" placeholder="Dung lượng free ổ cứng">
					                  
					                </div>
					                <div class="col-12 col-sm-2 ricochet1">
					                    <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Server B: </p>
					                    <select class="form-control select-color form-control-sm" id="recochetB_services" name="data[recochetB_services]">
										@foreach ($runstops as $runstop)
										@if($log->recochetB_services == $runstop->key)
											<option style="color:{{ $runstop->color }}" value="{{ $runstop->key }}" color="{{ $runstop->color }}" selected>{{ $runstop->title }}</option>
										@else
											<option style="color:{{ $runstop->color }}" value="{{ $runstop->key }}" color="{{ $runstop->color }}">{{ $runstop->title }}</option>
										@endif
										@endforeach
					                  </select>               
					                </div>
									
					                <div class="col-12 col-sm-2 ricochet1">
									<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">(GB)</p>
					                  <input class="form-control select-color form-control-sm" id="recochetB_hd_free" min="0" step="0.1" type="number" value="{{ $log->recochetB_hd_free }}" name="data[recochetB_hd_free]" placeholder="Dung lượng free ổ cứng">
								</div>
					          
							</div>
						</div>

						<div id="friday" style="display:none">
							<h4 style="color:#000; margin-top:0px"><hr>Công việc ca ngày thứ 6 hàng tuần<hr></h4>
							<div class="row justify-content-start">
								<div class="col-12 col-sm-4">
					                <div class="form-check">
					                  <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm"><input type="checkbox" @if ($log->offices_cleanup == 'on') checked @endif id="offices_cleanup" name="data[offices_cleanup]"> Vệ sinh ACC, phòng trực, phòng T&E, Sim 3D</p>
					                  <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm"><input type="checkbox" @if ($log->cabinet_cleanup == 'on') checked @endif id="cabinet_cleanup" name="data[cabinet_cleanup]"> Vệ sinh công nghiệp bên ngoài các khe thiết bị, tủ rack</p>
					                  <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm"><input type="checkbox" @if ($log->magneticdisc_cleanup == 'on') checked @endif id="magneticdisc_cleanup" name="data[magneticdisc_cleanup]"> Lau đầu từ</p>
					                  <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm"><input type="checkbox" @if ($log->backedup_dat == 'on') checked @endif id="backedup_dat" name="data[backedup_dat]"> Backup băng DAT nếu có HD đầy mà chưa backup</p>
					                  <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm"><input type="checkbox" @if ($log->corefiles_cleanup == 'on') checked @endif id="corefiles_cleanup" name="data[corefiles_cleanup]"> Kiểm tra và xóa bớt core file trên các máy chủ, các CWP</p>
					                  <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm"><input type="checkbox" @if ($log->plbvoice_working == 'on') checked @endif id="plbvoice_working" name="data[plbvoice_working]"> Kiểm tra PLB+voice có hoạt động không</p>
					                  <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm"><input type="checkbox" @if ($log->usb_rpb_cleanup == 'on') checked @endif id="usb_rpb_cleanup" name="data[usb_rpb_cleanup]"> Xóa bớt dữ liệu trong USB cắm ngoài của RPB nếu quá 85%</p>
					                  <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Thay đổi trong file cấu hình: <input class="form-control select-color form-control-sm" value="{{$log->compare_config_files}}" type="text" id="compare_config_files" name="data[compare_config_files]" placeholder=""></p>		
					                </div>
					            </div>
					        </div>
						</div>
						
						<div id="thursday" style="display:none">
							<h4 style="color:#000; margin-top:0px"><hr>Công việc ca đêm thứ 3 hàng tuần<hr></h4>
							<div class="row justify-content-start">
								<div class="col-12 col-sm-1">
							  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Cluster DBH:</p>
							  		<select class="form-control select-color form-control-sm" id="dbh_cluster_offline" name="data[dbh_cluster_offline]">
									  @foreach ($onoffs as $onoff)
									  @if($log->dbh_cluster_offline == $onoff->key)
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}" selected>{{ $onoff->title }}</option>
									@else
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}">{{ $onoff->title }}</option>
									@endif
									@endforeach
									</select>
								</div>
								<div class="col-12 col-sm-1">
							  		<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Kiểm tra HN3:</p>
							  		<select class="form-control select-color form-control-sm" id="hn3" name="data[hn3]">
									  @foreach ($goods as $good)
									  @if($log->hn3 == $good->key)
										<option style="color:{{ $good->color }}" value="{{ $good->key }}" color="{{ $good->color }}" selected>{{ $good->title }}</option>
									@else
										<option style="color:{{ $good->color }}" value="{{ $good->key }}" color="{{ $good->color }}">{{ $good->title }}</option>
									@endif
									@endforeach
									</select>
								</div>
							</div>
						</div>

						<div id="onest" style="display:none">
							<h4 style="color:#000; margin-top:0px"><hr>Công việc ca ngày 01 đầu tháng<hr></h4>
							<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Dùng SAM kiểm tra các đường radar:</p>
							<div class="row justify-content-start">
							
									<div class="col-12 col-sm-2">
										<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Radar NB (% lỗi đường kém nhất): <input class="form-control select-color form-control-sm" type="number" min="0" max="100" step="0.00001" value="{{$log->nb_error}}" id="nb_error" name="data[nb_error]" placeholder="0"></p>
								</div><div class="col-12 col-sm-2">
					                <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Radar RG (% lỗi đường kém nhất): <input class="form-control select-color form-control-sm" type="number" min="0" max="100" step="0.00001" value="{{$log->rg_error}}" id="rg_error" name="data[rg_error]" placeholder="0"></p>
									</div>
					                <div class="col-12 col-sm-2">
					                	<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Radar ST(% lỗi đường kém nhất): <input class="form-control select-color form-control-sm" type="number" min="0" max="100" step="0.00001" value="{{$log->st_error}}" id="st_error" name="data[st_error]" placeholder="0"></p>
										</div><div class="col-12 col-sm-2">
					                <p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Radar VI (% lỗi đường kém nhất): <input class="form-control select-color form-control-sm" type="number" min="0" max="100" step="0.00001" value="{{$log->vi_error}}" id="vi_error" name="data[vi_error]" placeholder="0"></p>
					                </div>
					        </div>
					    </div>
 
				    	<div id=ghichu >
				    		<div class="row justify-content-start">
					    		<div class="col-12 col-sm-12">
					    			<p style="margin-top: 0px; margin-bottom: 0px;" class="col-form-label-sm">Ghi chú ca làm việc: </p>
						    		<textarea class="form-control" name="data[note]" type="text" id="ghichu">{{$log->note}}</textarea>
					    		</div>
					    	</div>				    	
				    	</div>
				    	
				    	<div id=save>
							<div class="row justify-content-start">
					    		
							@if(in_array(Auth::id(), $auth_ids))								
								<div class="col-4 col-sm-1"><BR/>
				    			<input class="form-control btn btn-sm btn-primary" type="submit" value="Save" id="input-submit" alt="Save">
								</div><div class="col-4 col-sm-1"><BR/>
								<input class="form-control btn btn-sm btn-primary" type="reset" value="Reset"></div> 
								<input type="hidden" name="data[id]" value="{{ $log->id }}">
								<div class="col-4 col-sm-1"><BR/>
									<button class="form-control btn btn-sm btn-primary" onclick="history.back()">Quay lại</button></div>
							@else
								<div class="col-6 col-sm-1"><BR/>
								<button class="form-control btn btn-sm btn-primary" onclick="history.back()">Quay lại</button>
								</div>
							@endif
								
				    		</div></div>
				    	</div>
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
 $(function () {
    $('#staffs').select2();
	$(".select2-selection--multiple").find("ul").css( "border", "2px solid #007bff" );

	
	var shift 	= getShift();
	var d 		= getDate();
	var day 	= getDay();
	
	changeElements(shift, d, day);

	$('input[name="data[date_working]"]').change(function() {
		var d 		= getDate();
		var day 	= getDay();
		var shift 	= getShift();
		changeElements(shift, d, day);
	});

	$('input[type=radio][name="data[shift]"]').change(function() {
		var d 		= getDate();
		var day 	= getDay();
		var shift 	= getShift();
    	changeElements(shift, d, day);
    });
	
	@if(!in_array(Auth::id(), $auth_ids))
	$('input, select, textarea').each(
		function(index){  
			var input = $(this);
			input.attr('disabled', 'disabled');
		}
	);
	@endif
})
//var staffs = "{{$log->staff_names}}".split(', ');
//$('#staffs').val(staffs).trigger('change');


$(document).ready(function(){
	$('.select-default').css('border','2px solid #007bff');
	$('.select-color').each(function(i, item) {
		$(item).css('border', '2px solid ' + $('option:selected', this).attr('color'));
		$(item).css('color', $('option:selected', this).attr('color'));
	});
	$("select").change(function(){
		if ($(this).val()==""){
			$(this).css({color: "#000"});
		} 
		else{
			$(this).css({color: $('option:selected', this).attr('color')});
			$(this).css({'border': '2px solid ' + $('option:selected', this).attr('color')});
		} 
	});


	var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
}); 


function changeElements(shift, date, day){
	if(shift == 1){
		disableLabRecochet();
		(day == 2) ? enableThursdayWorks() : disableThursdayWorks();
		disable1stWorks();
		disableFridayWorks();
	}else{
		enableLabRecochet();
		(date == '01') ? enable1stWorks() : disable1stWorks();
		(day == 5) ? enableFridayWorks() : disableFridayWorks();
		disableThursdayWorks();
	}
}

function getShift(){
	return $('input[type=radio][name="data[shift]"]:checked').val();
}

function getDate(){
	var dt = $('#ngaytruc').val();
	var d = new Date(dt);
	var dArr = dt.split('-');
	return dArr[2];
}

function getDay(){
	var dt = $('#ngaytruc').val();
	var d = new Date(dt);
	return d.getDay();
}

function validateForm() {
	var ngaytruc 	= $('#ngaytruc').val();
	var manager 	= $('#manager').val();
	var leader 		= $('#leader').val();
	var staffs 		= $('#staffs').val();
	var hd1from 	= $('#hd1-from').val();
	var hd1to 		= $('#hd1-to').val();
	var hd2from 	= $('#hd2-from').val();
	var hd2to 		= $('#hd2-to').val();
	var freehdA		= $('#freehdA').val();
	var freehdB		= $('#freehdB').val();

	removeClass();
	if (ngaytruc == "" || ngaytruc == 'dd/mm/yyyy') {
		return raiseError('ngaytruc','Ngày trực không đúng định dạng');
	}	
	if (manager == '-1') {
		return raiseError('manager','Chưa chọn nhân viên trực khối');
	}
	if (leader == '-1') {
		return raiseError('leader','Chưa chọn nhân viên kíp trưởng');
	}
	if (staffs == '') {
		return raiseError('staffs','Chưa chọn nhân viên trong ca trực');
	}
	if (hd1from == '' ) {
		return raiseError('hd1-from','Thông tin backup HD1 chưa nhập');
	}
	if (hd1to == '' ) {
		return raiseError('hd1-to','Thông tin backup HD1 chưa nhập');
	}
	if (hd2from == '' ) {
		return raiseError('hd2-from','Thông tin backup HD2 chưa nhập');
	}
	if (hd2to == '' ) {
		return raiseError('hd2-to','Thông tin backup HD2 chưa nhập');
	}	
	var shift = $('input[type=radio][name="data[shift]:checked"]').val();
	if (shift == 0 && (freehdA == '' || isNaN(freehdA))) {
		return raiseError('recochetA_hd_free','Dung lượng còn trống HD Recochet A');
	}
	if (shift == 0 && (freehdB == '' || isNaN(freehdB))) {
		return raiseError('recochetB_hd_free','Dung lượng còn trống HD Recochet B');
	}
	if($('#onest').is(':visible'))
	{
		var nb_error = $('#nb_error').val();
		if(nb_error > 100 || nb_error < 0 || nb_error.trim().length === 0){
			return raiseError('nb_error','% Radar NB phải >= 0  và <= 100');
		}
		var rg_error = $('#rg_error').val();
		if(rg_error > 100 || rg_error < 0 || rg_error.trim().length === 0){
			return raiseError('rg_error','% Radar RG phải >= 0  và <= 100');
		}
		var st_error = $('#st_error').val();
		if(st_error > 100 || st_error < 0 || st_error.trim().length === 0){
			return raiseError('st_error','% Radar ST phải >= 0  và <= 100');
		}
		var vi_error = $('#vi_error').val();
		if(vi_error > 100 || vi_error < 0 || vi_error.trim().length === 0){
			return raiseError('vi_error','% Radar VI phải >= 0  và <= 100');
		}
	}
	if($('#friday').is(':visible'))
	{
		var content = $('#compare_config_files').val();
		if(content.trim().length === 0){
			return raiseError('compare_config_files','Nội dung so sánh config files không được để trống');
		}
	}
	return true;
}

function raiseError(element, msg){
	toastr.error(msg);
	if(element != 'staffs'){
		$('#'+element).addClass('is-invalid');
		$('#'+element).focus();
	}else{
		$(".select2-selection--multiple").find("ul").addClass('form-control is-invalid');
		$('#'+element).focus();
	}
	return false;
}

function removeClass(){
	var err = 'is-invalid';
	var elements = ['ngaytruc', 'manager', 'leader', 'staffs', 'hd1-from', 'hd1-to', 'hd2-from', 'hd2-to', 'recochetB_hd_free', 'recochetB_hd_free'];
	for(i = 0; i < elements.length; i++){
		if($('#' + elements[i]).hasClass(err)){ $('#' + elements[i]).removeClass(err);}
	}
}

function enableLabRecochet(){
	showElements('ricochet', ['recochetA_services', 'recochetB_services', 'recochetA_hd_free', 'recochetB_hd_free']);
	showElements('lab', ['lab_servers', 'lab_cwps']);
}

function disableLabRecochet(){
	hideElements('ricochet', ['recochetA_services', 'recochetB_services', 'recochetA_hd_free', 'recochetB_hd_free']);
	hideElements('lab', ['lab_servers', 'lab_cwps']);
}

function enableFridayWorks(){
	showElements('friday', 
	['offices_cleanup', 
	'cabinet_cleanup', 
	'magneticdisc_cleanup', 
	'backedup_dat', 
	'corefiles_cleanup', 
	'plbvoice_working',
	'usb_rpb_cleanup',
	'compare_config_files']);
}

function disableFridayWorks(){
	hideElements('friday', 
	['offices_cleanup', 
	'cabinet_cleanup', 
	'magneticdisc_cleanup', 
	'backedup_dat', 
	'corefiles_cleanup', 
	'plbvoice_working',
	'usb_rpb_cleanup',
	'compare_config_files']);
}

function enable1stWorks(){
	showElements('onest', ['nb_error', 'rg_error', 'st_error', 'vi_error']);
}

function disable1stWorks(){
	hideElements('onest', ['nb_error', 'rg_error', 'st_error', 'vi_error']);
}

function enableThursdayWorks(){
	showElements('thursday', ['dbh_cluster_offline', 'hn3']);
}

function disableThursdayWorks(){
	hideElements('thursday', ['dbh_cluster_offline', 'hn3']);
}

function hideElements(topElement, childElements){
	$('#'+topElement).hide();	
	for (i=0; i < childElements.length; i++) {
    	$('#'+ childElements[i]).attr('disabled', 'disabled');
  	}
}

function showElements(topElement, childElements){
	$('#'+topElement).show();	
	for (i=0; i < childElements.length; i++) {
    	$('#'+ childElements[i]).removeAttr("disabled");
  	}
}


</script>

@endsection
