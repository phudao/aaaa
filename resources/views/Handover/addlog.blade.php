
@extends('layouts.master')


@section('content')
<div>&nbsp;</div>
<section class="content">
      <div class="container-fluid">

	  <div class="card">
              <div class="card-header">
                <h3 class="card-title">GHI NHẬT KÝ</h3>
              </div>
                
              <!-- /.card-header -->
              <div class="card-body p-1">

			<div id="giaoca" class="row">
				<!-- <div class="col-2 col-s-2"></div> -->
			  	<div class="col-12 col-s-12 gc">
					<form class="" action="" method="post" id="logForm" onsubmit="return validateForm()">
                        @csrf
						<div class="row justify-content-start">
						  	<div class="col2 col-sm-2">
							  <div class="form-group">
								<p style="margin-top: 10px; margin-bottom: 0px;">Ngày trực: </p>
								<input class="form-control form-control-sm select-default"  type="date" name="data[date_working]" id="ngaytruc">
							</div>
							</div>
							<div class="col1 col-sm-1">
								<div class="form-group">
								<p style="margin-top: 10px; margin-bottom: 0px;">Ca trực: </p>
								<input type="radio" name="data[shift]" id="shift" value="0" checked>Ngày&nbsp;&nbsp; 
								<input type="radio" name="data[shift]" value="1" id="shif">Đêm
								</p>
							</div>
							</div>
							
						    
							<div class="col2 col-sm-2">
							
								<p style="margin-top: 10px; margin-bottom: 0px;">Trực trung tâm:</p>
								<select class="form-control form-control-sm select-default"  id="manager" class="operator" name="data[manager_id]">
									<option value="-1">---Trực Trung Tâm---</option>
									@foreach ($managers as $manager)
									<option value="{{ $manager->id }}">{{ $manager->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col2 col-sm-2">
								<p style="margin-top: 10px; margin-bottom: 0px;">Kíp trưởng: </p>
								<select class="form-control form-control-sm select-default"  id="leader" class="operator" name="data[leader_id]">
									<option value="-1">---Chọn Kíp trưởng---</option>
									@foreach ($leaders as $leader)
									<option value="{{ $leader->id }}">{{ $leader->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col5 col-sm-5">
								<p style="margin-top: 10px; margin-bottom: 0px;">Kíp viên: </p>
								<select class="form-control select2bs4 select-default form-control-sm" id="staffs" multiple="multiple" name="data[staff_names][]">
								@foreach ($staffs as $staff)
									<option value="{{ $staff->id }}:{{ $staff->name }}">{{ $staff->name }}</option>
								@endforeach
								</select>
							</div>
						
						</div>
						
						


						<h4 style="margin-top:10px"><hr>A. Hệ thống ATM<hr></h4>
						<div class="row">
							<div class="col-12 col-sm-2">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">Thiết bị trên ACC h/đ tốt không?</p>
							  <select class="form-control form-control-sm select-color" id="acc_devices" name="data[acc_devices]">
								@foreach ($bools as $bool)
									<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}">{{ $bool->title }}</option>
									@endforeach
								</select>
							</div>
							
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">CWP TEST on ACC: </p>
						  		<select class="form-control form-control-sm select-color" id="acc_cwps_test" name="data[acc_cwps_test]">
									@foreach ($onoffs as $onoff)
									<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}">{{ $onoff->title }}</option>
								@endforeach
								</select>
							</div>
						</div>
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">1. RFE 1/2 (màu sắc trên CMS)</p>
						<div class="row">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[rf12_mst]">
							    <option value="1" @if($last->rf12_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->rf12_mst == 2) selected @endif>2</option>
							</select>
							</div>
						
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">NB: </p>
						  		<select class="form-control form-control-sm select-color" id="nb" name="data[nb]">
								@foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">CM: </p>
						  		<select class="form-control form-control-sm select-color" id="cm" name="data[cm]">
								@foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">ST: </p>
						  		<select class="form-control form-control-sm select-color" id="st" name="data[st]">
								@foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
					    </div>
					    
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">2. RFE 3/4 (màu sắc trên CMS)</></p>
							  <div class="row justify-content-start select-2">
							  <div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[rf34_mst]">
							    <option value="3" @if($last->rf34_mst == 3) selected @endif>3</option>
							    <option value="4" @if($last->rf34_mst == 4) selected @endif>4</option>
							</select>
								</div>
						
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">VI: </p>
						  		<select class="form-control form-control-sm select-color" id="vi" name="data[vi]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">TN: </p>
						  		<select class="form-control form-control-sm select-color" id="tn" name="data[tn]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">VC: </p>
						  		<select class="form-control form-control-sm select-color" id="vc" name="data[vc]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BH: </p>
						  		<select class="form-control form-control-sm select-color" id="bh" name="data[bh]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BI: </p>
						  		<select class="form-control form-control-sm select-color" id="bi" name="data[bi]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BN: </p>
						  		<select class="form-control form-control-sm select-color" id="bn" name="data[bn]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
					    </div>
					    
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">3. RFE 5/6 (màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							  <div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[rf56_mst]">
							    <option value="5" @if($last->rf56_mst == 5) selected @endif>5</option>
							    <option value="6" @if($last->rf56_mst == 6) selected @endif>6</option>
							</select>
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">NT: </p>
						  		<select class="form-control form-control-sm select-color" id="nt" name="data[nt]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">NH: </p>
						  		<select class="form-control form-control-sm select-color" id="nh" name="data[nh]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BS: </p>
						  		<select class="form-control form-control-sm select-color" id="bs" name="data[bs]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BO: </p>
						  		<select class="form-control form-control-sm select-color" id="bo" name="data[bo]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BT: </p>
						  		<select class="form-control form-control-sm select-color" id="bt" name="data[bt]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BR: </p>
						  		<select class="form-control form-control-sm select-color" id="br" name="data[br]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
					    </div>
					    
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">4. RFE 7/8 (màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[rf78_mst]">
							    <option value="7" @if($last->rf78_mst == 7) selected @endif>7</option>
							    <option value="8" @if($last->rf78_mst == 8) selected @endif>8</option>
							</select>
						
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">BV: </p>
						  		<select class="form-control form-control-sm select-color" id="bv" name="data[bv]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">RG: </p>
						  		<select class="form-control form-control-sm select-color" id="rg" name="data[rg]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
						</div>
						
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">5. MSF (trạng thái màu sắc trên CMS)</p>
						<div class="row justify-content-start">
						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[ms_mst]">
							    <option value="1" @if($last->ms_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->ms_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">MSF: </p>
						  		<select class="form-control form-control-sm select-color" id="msf" name="data[msf]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
						</div>
						
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">6. SafeNet (màu sắc trên CMS)</p>
						<div class="row justify-content-start">
							<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[sf_mst]">
							    <option value="1" @if($last->sf_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->sf_mst == 2) selected @endif>2</option>
							</select>
						
								</div >
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">STCA: </p>
						  		<select class="form-control form-control-sm select-color" id="stca" name="data[stca]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
					    	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">MSAW: </p>
						  		<select class="form-control form-control-sm select-color" id="msaw" name="data[msaw]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">DAIW: </p>
						  		<select class="form-control form-control-sm select-color" id="daiw" name="data[daiw]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							
						</div>
						
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">7. RPB (màu sắc trên CMS)</p>
						<div class="row justify-content-start">
						<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px;">MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[rp_mst]">
							    <option value="1" @if($last->rp_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->rp_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">REC,BCK</p>
						  		<select class="form-control form-control-sm select-color" id="rpb" name="data[rec_bck]">
								@foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">USB </p>
						  		<select class="form-control form-control-sm select-color" id="bck-usb" name="data[backed_up]">
								@foreach ($dones as $done)
									<option style="color:{{ $done->color }}" value="{{ $done->key }}" color="{{ $done->color }}">{{ $done->title }}</option>
								@endforeach
								</select>
							</div>
							
					    	<div class="col-12 col-sm-2">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">HD1 from: </p>
						  		<input class="form-control form-control-sm select-default"  type="datetime-local" id="hd1-from" value="{{$last->hd1_from}}" name="data[hd1_from]" step="1" >
							</div>
							<div class="col-12 col-sm-2">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">HD1 to</p>
						  		<input class="form-control form-control-sm select-default"  type="datetime-local" id="hd1-to" value="{{$last->hd1_to}}" name="data[hd1_to]" step="1" >
							</div>
							<div class="col-12 col-sm-2">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">HD2 from: </p>
						  		<input class="form-control form-control-sm select-default"  type="datetime-local" id="hd2-from" value="{{$last->hd2_from}}" name="data[hd2_from]" step="1" >
								  </div>
							<div class="col-12 col-sm-2">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">HD2 to </p>
						  		<input class="form-control form-control-sm select-default"  type="datetime-local" id="hd2-to" value="{{$last->hd2_to}}" name="data[hd2_to]" step="1" >
							</div>
							
						</div>
						
						<div class="row justify-content-start">
						<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">8. GTW MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[gw_mst]">
							    <option value="1" @if($last->gw_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->gw_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">GDO, GRC: </p>
						  		<select class="form-control form-control-sm select-color" id="gtw" name="data[gdo_grc]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							</div>
						
						<div class="row justify-content-start">
						<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">9. FDP MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[fp_mst]">
							    <option value="1" @if($last->fp_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->fp_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">AFS: </p>
						  		<select class="form-control form-control-sm select-color" id="gtw" name="data[afs]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
						
						

						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">10. DBH MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[db_mst]">
							    <option value="1" @if($last->db_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->db_mst == 2) selected @endif>2</option>
							</select>
						
								</div>
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">DBH: </p>
						  		<select class="form-control form-control-sm select-color" id="dbh" name="data[dbh]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>

						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">11. MNA MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[mn_mst]">
							    <option value="1" @if($last->mn_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->mn_mst == 2) selected @endif>2</option>
							</select>
							</div>

						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">MONA: </p>
						  		<select class="form-control form-control-sm select-color" id="mn" name="data[mona]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>

						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">12. MTCD MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[mt_mst]">
							    <option value="1" @if($last->mt_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->mt_mst == 2) selected @endif>2</option>
							</select>
							</div>

						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">MTCD: </p>
						  		<select class="form-control form-control-sm select-color" id="mt" name="data[mtcd]">
								@foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>

						  	<div class="col-12 col-sm-1">
				  			<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">13. IDS MST:</p>
				  			<select class="form-control form-control-sm select-default"  id="mst" name="data[id_mst]">
							    <option value="1" @if($last->id_mst == 1) selected @endif>1</option>
							    <option value="2" @if($last->id_mst == 2) selected @endif>2</option>
							</select>
							</div >	
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">Nhận điện?: </p>
						  		<select class="form-control form-control-sm select-color" id="ids" name="data[id_data_received]">
								@foreach ($bools as $bool)
									<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}">{{ $bool->title }}</option>
								@endforeach
								</select>
							</div>

							</div>
						
						<div class="row justify-content-start">
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">14.D36-ADMAN ?</p>
						  		<select class="form-control form-control-sm select-color" id="adman1" name="data[adman_client]">
								  @foreach ($bools as $bool)
									<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}">{{ $bool->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">Input vàng ?: </p>
						  		<select class="form-control form-control-sm select-color" id="adman2" name="data[fpl_track_met]">
								@foreach ($admans as $adman)
									<option style="color:{{ $adman->color }}" value="{{ $adman->key }}" color="{{ $adman->color }}">{{ $adman->title }}</option>
								@endforeach
								</select>
							</div>
						</div>
						
						<p style="margin-top: 10px; margin-bottom: 0px; font-weight:bold">15. Shared device. </p>
						
						<div class="row justify-content-start">
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">DBH:</p>
						  		<select class="form-control form-control-sm select-color" id="sharedbh" name="data[shd_dbh]">
								@foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">RPB:</p>
						  		<select class="form-control form-control-sm select-color" id="sharerpb" name="data[shd_rpb]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">IDS:</p>
						  		<select class="form-control form-control-sm select-color" id="shareids" name="data[shd_ids]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
						
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">16. DEC:</p>
						  		<select class="form-control form-control-sm select-color" id="dec" name="data[dec]">
								  @foreach ($colors as $color)
									<option style="color:{{ $color->color }}" value="{{ $color->key }}" color="{{ $color->color }}">{{ $color->title }}</option>
								@endforeach
								</select>
							</div>
						
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">17. Clocks đ.bộ?</p>
						  		<select class="form-control form-control-sm select-color" id="clockwall" name="data[clocks]">
								  @foreach ($bools as $bool)
									<option style="color:{{ $bool->color }}" value="{{ $bool->key }}" color="{{ $bool->color }}">{{ $bool->title }}</option>
								@endforeach
								</select>
							</div>
						
						  	<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">18. DAS-Web</p>
						  		<select class="form-control form-control-sm select-color" id="webserver" name="data[das_webserver]">
								@foreach ($onoffs as $onoff)
									<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}">{{ $onoff->title }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-12 col-sm-1">
						  		<p style="margin-top: 10px; margin-bottom: 0px;">Oracle DAS:</p>
						  		<select class="form-control form-control-sm select-color" id="oracledas" name="data[das_oracledb]">
								@foreach ($onoffs as $onoff)
									<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}">{{ $onoff->title }}</option>
								@endforeach
								</select>
							</div>
						</div>

						<div id="lab" >
						<h4 style="margin-top:10px"><hr>B. Hệ thống thiết bị phòng LAB<hr></h4>
							<div class="row justify-content-start">	
								<div class="col-12 col-sm-6">
									<p style="margin-top: 10px; margin-bottom: 0px;">Thiết bị tại tủ server: </p>
									<textarea class="form-control" name="data[lab_servers]" type="text" class="form-control" id="thietbi1">Hoạt động tốt</textarea>
								</div><div class="col-12 col-sm-6">
									<p style="margin-top: 10px; margin-bottom: 0px;">Thiết bị tại vị trí giảng viên/học viên: </p>
									<textarea class="form-control" name="data[lab_cpws]" type="text" class="form-control" id="thietbi2">Hoạt động tốt</textarea>
								</div>		
							</div>							
						</div>

						<div id="ricochet">
						<h4 style="margin-top:10px"><hr>C. Hệ thống Ricochet<hr></h4>
							<div class="row justify-content-start">
								
					                <div class="col-12 col-sm-2 ricochet1">
					                    <p style="margin-top: 10px; margin-bottom: 0px;">Server A: </p>
					                    <select class="form-control form-control-sm select-color" id="recochetA_services" name="data[recochetA_services]">
										@foreach ($runstops as $runstop)
											<option style="color:{{ $runstop->color }}" value="{{ $runstop->key }}" color="{{ $runstop->color }}">{{ $runstop->title }}</option>
										@endforeach
					                  </select>               
					                </div>
									
					                <div class="col-12 col-sm-2 ricochet1">
									<p style="margin-top: 10px; margin-bottom: 0px;">(GB)</p>
					                  <input class="form-control form-control-sm select-default"  id="recochetA_hd_free" min="0" step="0.1" type="number" name="data[recochetA_hd_free]" placeholder="Dung lượng free ổ cứng">
					                  
					                </div>
					                <div class="col-12 col-sm-2 ricochet1">
					                    <p style="margin-top: 10px; margin-bottom: 0px;">Server B: </p>
					                    <select class="form-control form-control-sm select-color" id="recochetB_services" name="data[recochetB_services]">
										@foreach ($runstops as $runstop)
											<option style="color:{{ $runstop->color }}" value="{{ $runstop->key }}" color="{{ $runstop->color }}">{{ $runstop->title }}</option>
										@endforeach
					                  </select>               
					                </div>
									
					                <div class="col-12 col-sm-2 ricochet1">
									<p style="margin-top: 10px; margin-bottom: 0px;">(GB)</p>
					                  <input class="form-control form-control-sm select-default"  id="recochetB_hd_free" min="0" step="0.1" type="number" name="data[recochetB_hd_free]" placeholder="Dung lượng free ổ cứng">
								</div>
					          
							</div>
						</div>

						<div id="friday" style="display:none">
						<h4 style="margin-top:10px"><hr>Công việc ca ngày thứ 6 hàng tuần<hr></h4>
							<div class="row justify-content-start">
								<div class="col-12 col-sm-4">
					                <div class="form-check">
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked id="offices_cleanup" name="data[offices_cleanup]"> Vệ sinh ACC, phòng trực, phòng T&E, Sim 3D</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked id="cabinet_cleanup" name="data[cabinet_cleanup]"> Vệ sinh công nghiệp bên ngoài các khe thiết bị, tủ rack</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked id="magneticdisc_cleanup" name="data[magneticdisc_cleanup]"> Lau đầu từ</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked id="backedup_dat" name="data[backedup_dat]"> Backup băng DAT nếu có HD đầy mà chưa backup</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked id="corefiles_cleanup" name="data[corefiles_cleanup]"> Kiểm tra và xóa bớt core file trên các máy chủ, các CWP</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked id="plbvoice_working" name="data[plbvoice_working]"> Kiểm tra PLB+voice có hoạt động không</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;"><input type="checkbox" checked id="usb_rpb_cleanup" name="data[usb_rpb_cleanup]"> Xóa bớt dữ liệu trong USB cắm ngoài của RPB nếu quá 85%</p>
					                  <p style="margin-top: 10px; margin-bottom: 0px;">Thay đổi trong file cấu hình: <input id="compare_config_files"  class="form-control form-control-sm select-default"  type="text" name="data[compare_config_files]" placeholder=""></p>		
					                </div>
					            </div>
					        </div>
						</div>
						
						<div id="thursday" style="display:none">
						<h4 style="margin-top:10px"><hr>Công việc ca đêm thứ 3 hàng tuần<hr></h4>
							<div class="row justify-content-start">
								<div class="col-12 col-sm-1">
							  		<p style="margin-top: 10px; margin-bottom: 0px;">Cluster DBH:</p>
							  		<select class="form-control form-control-sm select-color" id="clusterdbh" name="data[dbh_cluster_offline]">
									  @foreach ($onoffs as $onoff)
										<option style="color:{{ $onoff->color }}" value="{{ $onoff->key }}" color="{{ $onoff->color }}">{{ $onoff->title }}</option>
									@endforeach
									</select>
								</div>
								<div class="col-12 col-sm-1">
							  		<p style="margin-top: 10px; margin-bottom: 0px;">Kiểm tra HN3:</p>
							  		<select class="form-control form-control-sm select-color" id="hn3" name="data[hn3]">
									  @foreach ($goods as $good)
										<option style="color:{{ $good->color }}" value="{{ $good->key }}" color="{{ $good->color }}">{{ $good->title }}</option>
									@endforeach
									</select>
								</div>
							</div>
						</div>

						<div id="onest" style="display:none">
						<h4 style="margin-top:10px"><hr>Công việc ca ngày 01 đầu tháng<hr></h4>
							<p style="margin-top: 10px; margin-bottom: 0px;">Dùng SAM kiểm tra các đường radar:</p>
							<div class="row justify-content-start">
							
									<div class="col-12 col-sm-2">
										<p style="margin-top: 10px; margin-bottom: 0px;">Radar NB (% lỗi đường kém nhất): <input class="form-control form-control-sm select-default"  type="number" min="0" max="100" step="0.00001" id="nb_error" name="data[nb_error]" placeholder="0"></p>
								</div><div class="col-12 col-sm-2">
					                <p style="margin-top: 10px; margin-bottom: 0px;">Radar RG (% lỗi đường kém nhất): <input class="form-control form-control-sm select-default"  type="number"  min="0" max="100" step="0.00001" id="rg_error" name="data[rg_error]" placeholder="0"></p>
									</div>
					                <div class="col-12 col-sm-2">
					                	<p style="margin-top: 10px; margin-bottom: 0px;">Radar ST(% lỗi đường kém nhất): <input class="form-control form-control-sm select-default"  type="number"  min="0" max="100" step="0.00001" id="st_error" name="data[st_error]" placeholder="0"></p>
										</div><div class="col-12 col-sm-2">
					                <p style="margin-top: 10px; margin-bottom: 0px;">Radar VI (% lỗi đường kém nhất): <input class="form-control form-control-sm select-default"  type="number" min="0" max="100" step="0.00001" id="vi_error" name="data[vi_error]" placeholder="0"></p>
					                </div>
					        </div>
					    </div>
 
				    	<div id=ghichu >
				    		<div class="row justify-content-start">
					    		<div class="col-12 col-sm-12">
					    			<p style="margin-top: 10px; margin-bottom: 0px;">Ghi chú ca làm việc: </p>
						    		<textarea class="form-control" name="data[note]" type="text" id="ghichu"></textarea>
					    		</div>
					    	</div>				    	
				    	</div>
				    	
				    	<div id=save>
						<div class="row justify-content-start">
					    		<div class="col-12 col-sm-1"><BR/>
				    			<input class="form-control btn btn-sm btn-primary" type="submit" value="Save" id="input-submit" alt="Save">
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

	Date.prototype.toDateInputValue = (function() {
		var local = new Date(this);
		local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
		return local.toJSON().slice(0,10);
	});

	$('#ngaytruc').val(new Date().toDateInputValue());

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
});

$(document).ready(function(){
	$('.select-default').css('border','2px solid #007bff');
	$('.select-color').css('color','green');
	$('.select-color').css('border','2px solid');
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
	
	var shift 		= $('input[type=radio][name="data[shift]"]:checked').val();
	var ngaytruc 	= $('#ngaytruc').val();
	var manager 	= $('#manager').val();
	var leader 		= $('#leader').val();
	var staffs 		= $('#staffs').val();
	var hd1from 	= $('#hd1-from').val();
	var hd1to 		= $('#hd1-to').val();
	var hd2from 	= $('#hd2-from').val();
	var hd2to 		= $('#hd2-to').val();
	var freehdA		= $('#recochetA_hd_free').val();
	var freehdB		= $('#recochetB_hd_free').val();//freehdB
	var lShift		= "{{$shift}}";
	var lDateWork	= "{{$date_working}}";
	var lnumShift 	= "{{$num}}";
	
	const date1 	= new Date(ngaytruc);
	const date2 	= new Date(lDateWork);
	const diffTime 	= Math.abs(date1 - date2);
	const diffDays 	= Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
	
	removeClass();
	
	if(lShift != '' && lDateWork != ''){
		if(shift == lShift){
			return raiseError('shift','Ca trực liên tục không được giống nhau');	
		}
		if(diffDays != 1  && diffDays != 0){
			return raiseError('ngaytruc', 'Ngày trực nhập không đúng');
		}
		if(shift == 1 && diffDays != 0)
		{
			return raiseError('ngaytruc', 'Ngày trực hoặc ca trực không hợp lệ');
		}
		if(shift == 0 && diffDays != 1)
		{
			return raiseError('ngaytruc', 'Ngày trực hoặc ca trực không hợp lệ');
		}
	}
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
	 hd1from = hd1from.replace('T', ' ').trim();
	 hd1to = hd1to.replace('T', ' ').trim();
	 hd2from = hd2from.replace('T', ' ').trim();
	 hd2to = hd2to.replace('T', ' ').trim();

	 if(hd1from.length == 16){ hd1from = hd1from + ':00'}
	 if(hd1to.length == 16){ hd1to = hd1to + ':00'}
	 if(hd2from.length == 16){ hd2from = hd2from + ':00'}
	 if(hd2to.length == 16){ hd2to = hd2to + ':00'}

	if( hd1from == '{{$last->hd1_from}}'){
		if( hd1to == '{{$last->hd1_to}}'){
			if( hd2from == '{{$last->hd2_from}}'){
				if( hd2to == '{{$last->hd2_to}}' ){
					return raiseError('hd2-from','Thông tin HD1, HD2 chưa đúng');
				}
			}
		}
	}

	if (shift == 0 && freehdA == '') {
		return raiseError('recochetA_hd_free','Dung lượng còn trống HD Recochet A');
	}
	if (shift == 0 && freehdB == '') {
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
	var elements = ['ngaytruc', 'manager', 'leader', 'staffs', 'hd1-from', 'hd1-to', 'hd2-from', 'hd2-to', 'recochetA_hd_free', 'recochetB_hd_free'];
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
