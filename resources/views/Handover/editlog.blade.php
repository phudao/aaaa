
@extends('layouts.master')


@section('content')
<div>&nbsp;</div>
<section class="content">
      <div class="container-fluid">

	  <div class="card">
              <div class="card-header" style="color:white; background-color:#dc3545">
                <h3 class="card-title">SỬA NHẬT KÝ</h3>
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
								<p style="margin-top: 10px; margin-bottom: 0px;">Ngày trực: </p>
								<input class="form-control select-default" value="{{ $log->date_working }}" type="date" name="data[date_working]" id="ngaytruc">
							</div>
							</div>
							<div class="col1 col-sm-1">
								<p style="margin-top: 10px; margin-bottom: 0px;">Ca trực: </p>
								<input type="radio" name="data[shift]" value="0" @if($log->shift == 0) checked @endif>Ngày&nbsp;&nbsp; 
								<input type="radio" name="data[shift]" value="1" @if($log->shift == 1) checked @endif>Đêm
								</p>
							</div>
							
						    
							<div class="col-12 col-sm-2">
							
								<p style="margin-top: 10px; margin-bottom: 0px;">Trực trung tâm:</p>
								<select class="form-control select-default" id="manager" class="operator" name="data[manager_id]">
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
								<p style="margin-top: 10px; margin-bottom: 0px;">Kíp trưởng: </p>
								<select class="form-control select-default" id="leader" class="operator" name="data[leader_id]">
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
								<p style="margin-top: 10px; margin-bottom: 0px;">Kíp viên: </p>
								<select class="form-control select2bs4 select-default" id="staffs" multiple="multiple" name="data[staff_names][]">
								@foreach ($staffs as $staff)
									 
									<option value="{{ $staff->name }}" @if(strpos($staff->name, $log->staff_names) !== false ) @php echo 'selected'; @endphp @endif>{{ $staff->name }}</option>
								@endforeach
								</select>
							</div>
						
						</div>
						
						<h4 style="color:#000; margin-top:10px"><hr>A. Hệ thống server ATM<hr></h4>
						
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">1. RFE 1/2 ( màu sắc trên CMS)</p>
						<div class="row">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[rf12_mst]">
							    <option value="1" @if($log->rf12_mst == 1) selected @endif>1</option>
							    <option value="2" @if($log->rf12_mst == 2) selected @endif>2</option>
							</select>
							</div>
						
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">NB: </p>
						  		<select class="form-control select-color" id="nb" name="data[nb]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">CM: </p>
						  		<select class="form-control select-color" id="cm" name="data[cm]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">ST: </p>
						  		<select class="form-control select-color" id="st" name="data[st]">
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
					    
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">2. RFE 3/4 ( màu sắc trên CMS)</></p>
							  <div class="row justify-content-start select-2">
							  <div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[rf34_mst]">
							    <option value="3" @if($log->rf34_mst == 3) selected @endif>3</option>
							    <option value="4" @if($log->rf34_mst == 4) selected @endif>4</option>
							</select>
								</div>
						
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">VI: </p>
						  		<select class="form-control select-color" id="vi" name="data[vi]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">TN: </p>
						  		<select class="form-control select-color" id="tn" name="data[tn]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">VC: </p>
						  		<select class="form-control select-color" id="vc" name="data[vc]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BH: </p>
						  		<select class="form-control select-color" id="bh" name="data[bh]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BI: </p>
						  		<select class="form-control select-color" id="bi" name="data[bi]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BN: </p>
						  		<select class="form-control select-color" id="bn" name="data[bn]">
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
					    
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">3. RFE 5/6 ( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							  <div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[rf56_mst]">
							  	<option value="5" @if($log->rf56_mst == 5) selected @endif>5</option>
							    <option value="6" @if($log->rf56_mst == 6) selected @endif>6</option>
							</select>
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">NT: </p>
						  		<select class="form-control select-color" id="nt" name="data[nt]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">NH: </p>
						  		<select class="form-control select-color" id="nh" name="data[nh]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BS: </p>
						  		<select class="form-control select-color" id="bs" name="data[bs]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BO: </p>
						  		<select class="form-control select-color" id="bo" name="data[bo]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BT: </p>
						  		<select class="form-control select-color" id="bt" name="data[bt]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BR: </p>
						  		<select class="form-control select-color" id="br" name="data[br]">
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
					    
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">4. RFE 7/8 ( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[rf78_mst]">
							  	<option value="7" @if($log->rf78_mst == 7) selected @endif>7</option>
							    <option value="8" @if($log->rf78_mst == 8) selected @endif>8</option>
							</select>
						
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BV: </p>
						  		<select class="form-control select-color" id="bv" name="data[bv]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">RG: </p>
						  		<select class="form-control select-color" id="rg" name="data[rg]">
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
						
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">5. MSF ( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[ms_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">MSF: </p>
						  		<select class="form-control select-color" id="msf" name="data[msf]">
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
						
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">6. SafeNet - MONA( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[sf_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
						
								</div >
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">STCA: </p>
						  		<select class="form-control select-color" id="stca" name="data[stca]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">MSAW: </p>
						  		<select class="form-control select-color" id="msaw" name="data[msaw]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">DAIW: </p>
						  		<select class="form-control select-color" id="daiw" name="data[daiw]">
								  @foreach ($colors as $color)
								  @if($log->daiw == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">11. MNA MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[mn_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
							</div>

						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">MONA: </p>
						  		<select class="form-control select-color" id="mn" name="data[mona]">
								  @foreach ($colors as $color)
								  @if($log->mona == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
						</div>
						
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">7. RPB ( màu sắc trên CMS)</p>
						<div class="row justify-content-start">
						<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[rp_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
						
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">REC,BCK: </p>
						  		<select class="form-control select-color" id="rpb" name="data[rec_bck]">
								@foreach ($colors as $color)
								@if($log->rec_bck == $color->key)
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}" selected>{{ $color->title }}</option>
									@else
										<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
									@endif
								@endforeach
								</select>
							</div><div class="col-12  col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">Backuped USB </p>
						  		<select class="form-control select-color" id="bck-usb" name="data[backed_up]">
								@foreach ($dones as $done)
								@if($log->backed_up == $done->key)
										<option style="color:{{ $done->color }}" value="{{ $done->key }}" color="{{ $done->color }}" selected>{{ $done->title }}</option>
									@else
										<option style="color:{{ $done->color }}" value="{{ $done->key }}" color="{{ $done->color }}">{{ $done->title }}</option>
									@endif
								@endforeach
								</select>
							</div>
							
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">HD1 from: </p>
						  		<input class="form-control select-default" type="datetime-local" id="hd1-from" value="{{ $log->hd1_from }}" name="data[hd1_from]">
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">HD1 to</p>
						  		<input class="form-control select-default" type="datetime-local" id="hd1-to" value="{{ $log->hd1_to }}" name="data[hd1_to]">
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">HD2 from: </p>
						  		<input class="form-control select-default" type="datetime-local" id="hd2-from" value="{{ $log->hd2_from }}" name="data[hd2_from]">
								  </div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">HD2 to </p>
						  		<input class="form-control select-default" type="datetime-local" id="hd2-to" value="{{ $log->hd2_to }}" name="data[hd2_to]">
							</div>
							
						</div>
						<div class="row justify-content-start">
						<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">8. GTW MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[gw_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">GDO, GRC: </p>
						  		<select class="form-control select-color" id="gtw" name="data[gdo_grc]">
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
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">9. FDP MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[fp_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">AFS: </p>
						  		<select class="form-control select-color" id="gtw" name="data[afs]">
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
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">10. DBH MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[db_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">DBH: </p>
						  		<select class="form-control select-color" id="dbh" name="data[dbh]">
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
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">12. MTCD MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[mt_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
							</div>

						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">MTCD: </p>
						  		<select class="form-control select-color" id="mt" name="data[mtcd]">
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
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">13. IDS MST:</p>
				  			<select class="form-control select-default" id="mst" name="data[id_mst]">
							    <option value="1">1</option>
							    <option value="2">2</option>
							</select>
							</div >	
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">Nhận điện?: </p>
						  		<select class="form-control select-color" id="ids" name="data[id_data_received]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">14.D36-ADMAN</p>
						  		<select class="form-control select-color" id="adman1" name="data[adman_client]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">Input vàng ?: </p>
						  		<select class="form-control select-color" id="adman2" name="data[fpl_track_met]">
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
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">15. Shared device. </p>	
						<div class="row justify-content-start">

						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">DBH:</p>
						  		<select class="form-control select-color" id="sharedbh" name="data[shd_dbh]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">RPB:</p>
						  		<select class="form-control select-color" id="sharerpb" name="data[shd_rpb]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">IDS:</p>
						  		<select class="form-control select-color" id="shareids" name="data[shd_ids]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">16. DEC:</p>
						  		<select class="form-control select-color" id="dec" name="data[dec]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">17. Clocks lệch</p>
						  		<select class="form-control select-color" id="clockwall" name="data[clocks]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">18. DAS-Web</p>
						  		<select class="form-control select-color" id="webserver" name="data[das_webserver]">
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
						  		<p style="margin-top: 10px; margin-bottom: 0px;">Oracle DAS:</p>
						  		<select class="form-control select-color" id="oracledas" name="data[das_oracledb]">
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
							<h4 style="color:#000; margin-top:10px"><hr>B. Hệ thống thiết bị phòng LAB<hr></h4>
							<div class="row justify-content-start">	
								<div class="col-12 col-sm-6">
									<p style="margin-top: 10px; margin-bottom: 0px;">Thiết bị tại tủ server: </p>
									<textarea class="form-control" name="data[lab_servers]" type="text" class="form-control" id="thietbi1">{{$log->lab_servers}}</textarea>
								</div><div class="col-12 col-sm-6">
									<p style="margin-top: 10px; margin-bottom: 0px;">Thiết bị tại vị trí giảng viên/học viên: </p>
									<textarea class="form-control" name="data[lab_cpws]" type="text" class="form-control" id="thietbi2">{{$log->lab_cpws}}</textarea>
								</div>		
							</div>							
						</div>
						
						<div id="ricochet">
							<h4 style="color:#000; margin-top:10px"><hr>C. Hệ thống Ricochet<hr></h4>
							<div class="row justify-content-start">
								
					                <div class="col-12 col-sm-2 ricochet1">
					                    <p style="margin-top: 10px; margin-bottom: 0px;">Server A: </p>
					                    <select class="form-control select-color" id="recochetA_services" name="data[recochetA_services]">
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
									<p style="margin-top: 10px; margin-bottom: 0px;">(GB)</p>
					                  <input class="form-control select-default" id="recochetA_hd_free" value="{{ $log->recochetA_hd_free }}" type="text" value name="data[recochetA_hd_free]" placeholder="Dung lượng free ổ cứng">
					                  
					                </div>
					                <div class="col-12 col-sm-2 ricochet1">
					                    <p style="margin-top: 10px; margin-bottom: 0px;">Server B: </p>
					                    <select class="form-control select-color" id="recochetB_services" name="data[recochetB_services]">
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
									<p style="margin-top: 10px; margin-bottom: 0px;">(GB)</p>
					                  <input class="form-control select-default" id="recochetB_hd_free" type="text" value="{{ $log->recochetB_hd_free }}" name="data[recochetB_hd_free]" placeholder="Dung lượng free ổ cứng">
								</div>
					          
							</div>
						</div>

						<div id="friday" style="display:none">
							<h4 style="color:#000; margin-top:10px"><hr>Công việc ca ngày thứ 6 hàng tuần<hr></h4>
							<div class="row justify-content-start">
								<div class="col-12 col-sm-4">
					                <div class="form-check">
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked value="đã làm" id="offices_cleanup" name="data[offices_cleanup]"> Vệ sinh ACC, phòng trực, phòng T&E, Sim 3D</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked value="đã làm" id="cabinet_cleanup" name="data[cabinet_cleanup]"> Vệ sinh công nghiệp bên ngoài các khe thiết bị, tủ rack</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked value="đã làm" id="magneticdisc_cleanup" name="data[magneticdisc_cleanup]"> Lau đầu từ</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked value="đã làm" id="backedup_dat" name="data[backedup_dat]"> Backup băng DAT nếu có HD đầy mà chưa backup</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked value="đã làm" id="corefiles_cleanup" name="data[corefiles_cleanup]"> Kiểm tra và xóa bớt core file trên các máy chủ, các CWP</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked value="hoạt động" id="plbvoice_working" name="data[plbvoice_working]"> Kiểm tra PLB+voice có hoạt động không</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked value="đã làm" id="usb_rpb_cleanup" name="data[usb_rpb_cleanup]"> Xóa bớt dữ liệu trong USB cắm ngoài của RPB nếu quá 85%</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;">Thay đổi trong file cấu hình: <input class="form-control select-default" type="text" id="compare_config_files" name="data[compare_config_files]" placeholder=""></p>		
					                </div>
					            </div>
					        </div>
						</div>
						
						<div id="thursday" style="display:none">
							<h4 style="color:#000; margin-top:10px"><hr>Công việc ca đêm thứ 3 hàng tuần<hr></h4>
							<div class="row justify-content-start">
								<div class="col-12 col-sm-1">
							  		<p style="margin-top: 10px; margin-bottom: 0px;">Cluster DBH:</p>
							  		<select class="form-control select-color" id="dbh_cluster_offline" name="data[dbh_cluster_offline]">
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
							  		<p style="margin-top: 10px; margin-bottom: 0px;">Kiểm tra HN3:</p>
							  		<select class="form-control select-color" id="hn3" name="data[hn3]">
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
							<h4 style="color:#000; margin-top:10px"><hr>Công việc ca ngày 01 đầu tháng<hr></h4>
							<p style="margin-top: 10px; margin-bottom: 0px;">Dùng SAM kiểm tra các đường radar:</p>
							<div class="row justify-content-start">
							
									<div class="col-12 col-sm-2">
										<p style="margin-top: 10px; margin-bottom: 0px;">Radar NB (% lỗi đường kém nhất): <input class="form-control select-default" type="text" id="nb_error" name="data[nb_error]" placeholder="0"></p>
								</div><div class="col-12 col-sm-2">
					                <p style="margin-top: 10px; margin-bottom: 0px;">Radar RG (% lỗi đường kém nhất): <input class="form-control select-default" type="text" id="rg_error" name="data[rg_error]" placeholder="0"></p>
									</div>
					                <div class="col-12 col-sm-2">
					                	<p style="margin-top: 10px; margin-bottom: 0px;">Radar ST(% lỗi đường kém nhất): <input class="form-control select-default" type="text" id="st_error" name="data[st_error]" placeholder="0"></p>
										</div><div class="col-12 col-sm-2">
					                <p style="margin-top: 10px; margin-bottom: 0px;">Radar VI (% lỗi đường kém nhất): <input class="form-control select-default" type="text" id="vi_error" name="data[vi_error]" placeholder="0"></p>
					                </div>
					        </div>
					    </div>
 
				    	<div id=ghichu >
				    		<div class="row justify-content-start">
					    		<div class="col-12 col-sm-12">
					    			<p style="margin-top: 10px; margin-bottom: 0px;">Ghi chú ca làm việc: </p>
						    		<textarea class="form-control" name="data[note]" type="text" id="ghichu">{{$log->note}}</textarea>
					    		</div>
					    	</div>				    	
				    	</div>
				    	
				    	<div id=save>
							<div class="row justify-content-start">
					    		<div class="col-12 col-sm-1"><BR/>
				    			<input class="form-control btn btn-sm btn-primary" type="submit" value="Save" id="input-submit" alt="Save">
								<input type="hidden" name="data[id]" value="{{ $log->id }}">
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
})
var staffs = "{{$log->staff_names}}".split(', ');
$('#staffs').val(staffs).trigger('change');


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
	showElements('lab', ['lab_servers', 'lab_servers', 'lab_cwps']);
}

function disableLabRecochet(){
	hideElements('ricochet', ['recochetA_services', 'recochetB_services', 'recochetA_hd_free', 'recochetB_hd_free']);
	hideElements('lab', ['lab_servers', 'lab_servers', 'lab_cwps']);
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
	showElements('thursday', ['clusterdbh', 'hn3']);
}

function disableThursdayWorks(){
	hideElements('thursday', ['clusterdbh', 'hn3']);
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
