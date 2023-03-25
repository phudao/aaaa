<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
  body { font-family: DejaVu Sans, sans-serif; font-size: 13px}
</style>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center" style="float:left;width:100%;font-size:18px;"><strong>SỔ KIỂM TRA KỸ THUẬT CNTT ATCC</strong></div>
  <div style="clear:both;">
    <div style="float:left;width:50%">Người trực: {{$users->manager}}</div>
    <div align="right" style="float:left;width:50%">{{$date[3]}}  ngày {{$date[2]}} tháng {{$date[1]}} năm {{$date[0]}}</div>
  </div>
  <div style="clear:both"></div>
    <table width="100%" border="1" style="border-collapse:collapse;" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" colspan="3"><div align="center" style="font-size:18px"><strong>HỆ THỐNG ATM QUẢN LÝ KHÔNG LƯU TỰ ĐỘNG</strong></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="center"><strong>THỰC HIỆN</strong></div></td>
        <td><div align="center"><strong>CA @if( $log->shift == 0) NGÀY @else ĐÊM @endif</strong></div></td>
      </tr>
      <tr>
        <td width="13%"><strong>ACC</strong></td>
        <td width="50%">Màn, chuột phím, CWP nào trên ACC bị treo ko?(<em>ko/có</em>)</td>
        <td width="37%">&nbsp;@if ($log->acc_devices == 1) Không
                              @elseif ($log->acc_devices == 2) Có @endif</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>CWP T&amp;E trên ACC (<em>ON/OFF</em>)</td>
        <td>&nbsp;@if ($log->acc_cwps_test == 1) ON
                  @elseif ($log->acc_cwps_test == 2) OFF @endif
      </tr>
      <tr>
        <td><strong>REF1/2</strong></td>
        <td>NB trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->nb == 1) Xanh lá
          @elseif ($log->nb == 2) Đỏ
          @elseif ($log->nb == 3) Cam
          @elseif ($log->nb == 4) Tím
          @elseif ($log->nb == 5) Cyan
          @elseif ($log->nb == 6) Trắng
          @endif
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST: {{$log->rf12_mst}}
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>CM trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->cm == 1) Xanh lá
          @elseif ($log->cm == 2) Đỏ
          @elseif ($log->cm == 3) Cam
          @elseif ($log->cm == 4) Tím
          @elseif ($log->cm == 5) Cyan
          @elseif ($log->cm == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>ST trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->st == 1) Xanh lá
          @elseif ($log->st == 2) Đỏ
          @elseif ($log->st == 3) Cam
          @elseif ($log->st == 4) Tím
          @elseif ($log->st == 5) Cyan
          @elseif ($log->st == 6) Trắng
          @endif
      </td>
      </tr>
      <tr>
        <td><strong>RFE3/4</strong></td>
        <td>VI trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->vi == 1) Xanh lá
          @elseif ($log->vi == 2) Đỏ
          @elseif ($log->vi == 3) Cam
          @elseif ($log->vi == 4) Tím
          @elseif ($log->vi == 5) Cyan
          @elseif ($log->vi == 6) Trắng
          @endif
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST:{{$log->rf34_mst}}
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>TN trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->tn == 1) Xanh lá
          @elseif ($log->tn == 2) Đỏ
          @elseif ($log->tn == 3) Cam
          @elseif ($log->tn == 4) Tím
          @elseif ($log->tn == 5) Cyan
          @elseif ($log->tn == 6) Trắng
          @endif
      </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>VC trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->tn == 1) Xanh lá
          @elseif ($log->tn == 2) Đỏ
          @elseif ($log->tn == 3) Cam
          @elseif ($log->tn == 4) Tím
          @elseif ($log->tn == 5) Cyan
          @elseif ($log->tn == 6) Trắng
          @endif
      </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>BH trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->bh == 1) Xanh lá
          @elseif ($log->bh == 2) Đỏ
          @elseif ($log->bh == 3) Cam
          @elseif ($log->bh == 4) Tím
          @elseif ($log->bh == 5) Cyan
          @elseif ($log->bh == 6) Trắng
          @endif
  </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>BI trên CMS (<em>màu?</em>)</td>
        <td>&nbsp; @if ($log->bi == 1) Xanh lá
          @elseif ($log->bi == 2) Đỏ
          @elseif ($log->bi == 3) Cam
          @elseif ($log->bi == 4) Tím
          @elseif ($log->bi == 5) Cyan
          @elseif ($log->bi == 6) Trắng
          @endif
          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>BN trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->bn == 1) Xanh lá
          @elseif ($log->bn == 2) Đỏ
          @elseif ($log->bn == 3) Cam
          @elseif ($log->bn == 4) Tím
          @elseif ($log->bn == 5) Cyan
          @elseif ($log->bn == 6) Trắng
          @endif
          </td>
      </tr>
      <tr>
        <td><strong>RFE5/6</strong></td>
        <td>NT trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->nt == 1) Xanh lá
          @elseif ($log->nt == 2) Đỏ
          @elseif ($log->nt == 3) Cam
          @elseif ($log->nt == 4) Tím
          @elseif ($log->nt == 5) Cyan
          @elseif ($log->nt == 6) Trắng
          @endif
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST: {{$log->rf56_mst}}</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>NH trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->nh == 1) Xanh lá
          @elseif ($log->nh == 2) Đỏ
          @elseif ($log->nh == 3) Cam
          @elseif ($log->nh == 4) Tím
          @elseif ($log->nh == 5) Cyan
          @elseif ($log->nh == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>BS trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->bs == 1) Xanh lá
          @elseif ($log->bs == 2) Đỏ
          @elseif ($log->bs == 3) Cam
          @elseif ($log->bs == 4) Tím
          @elseif ($log->bs == 5) Cyan
          @elseif ($log->bs == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>BO trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->bo == 1) Xanh lá
          @elseif ($log->bo == 2) Đỏ
          @elseif ($log->bo == 3) Cam
          @elseif ($log->bo == 4) Tím
          @elseif ($log->bo == 5) Cyan
          @elseif ($log->bo == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>BT trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->bt == 1) Xanh lá
          @elseif ($log->bt == 2) Đỏ
          @elseif ($log->bt == 3) Cam
          @elseif ($log->bt == 4) Tím
          @elseif ($log->bt == 5) Cyan
          @elseif ($log->bt == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>BR trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->br == 1) Xanh lá
          @elseif ($log->br == 2) Đỏ
          @elseif ($log->br == 3) Cam
          @elseif ($log->br == 4) Tím
          @elseif ($log->br == 5) Cyan
          @elseif ($log->br == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td><strong>RFE7/8</strong></td>
        <td>BV trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->br == 1) Xanh lá
          @elseif ($log->br == 2) Đỏ
          @elseif ($log->br == 3) Cam
          @elseif ($log->br == 4) Tím
          @elseif ($log->br == 5) Cyan
          @elseif ($log->br == 6) Trắng
          @endif
  
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST: {{$log->rf78_mst}}</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>RG trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;@if ($log->rg == 1) Xanh lá
          @elseif ($log->rg == 2) Đỏ
          @elseif ($log->rg == 3) Cam
          @elseif ($log->rg == 4) Tím
          @elseif ($log->rg == 5) Cyan
          @elseif ($log->rg == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td><strong>MS1/2</strong></td>
        <td>FPT trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->nt == 1) Xanh lá
          @elseif ($log->nt == 2) Đỏ
          @elseif ($log->nt == 3) Cam
          @elseif ($log->nt == 4) Tím
          @elseif ($log->nt == 5) Cyan
          @elseif ($log->nt == 6) Trắng
          @endif
  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
          MST:{{$log->ms_mst}}</td>
      </tr>
      <tr>
        <td><strong>SF1/2</strong></td>
        <td>STCA trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->stca == 1) Xanh lá
          @elseif ($log->stca == 2) Đỏ
          @elseif ($log->stca == 3) Cam
          @elseif ($log->stca == 4) Tím
          @elseif ($log->stca == 5) Cyan
          @elseif ($log->stca == 6) Trắng
          @endif
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
          MST:{{$log->sf_mst}}
  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>MASW trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->msaw == 1) Xanh lá
          @elseif ($log->msaw == 2) Đỏ
          @elseif ($log->msaw == 3) Cam
          @elseif ($log->msaw == 4) Tím
          @elseif ($log->msaw == 5) Cyan
          @elseif ($log->msaw == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>DAIW trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->daiw == 1) Xanh lá
          @elseif ($log->daiw == 2) Đỏ
          @elseif ($log->daiw == 3) Cam
          @elseif ($log->daiw == 4) Tím
          @elseif ($log->daiw == 5) Cyan
          @elseif ($log->daiw == 6) Trắng
          @endif
  </td>
      </tr>
      <tr>
        <td><strong>RP1/2</strong></td>
        <td>REC, BCK trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->rec_bck == 1) Xanh lá
          @elseif ($log->rec_bck == 2) Đỏ
          @elseif ($log->rec_bck == 3) Cam
          @elseif ($log->rec_bck == 4) Tím
          @elseif ($log->rec_bck == 5) Cyan
          @elseif ($log->rec_bck == 6) Trắng
          @endif
  
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
          MST: {{$log->rp_mst}}</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Khoảng thời gian dữ liệu lưu trên HD1 và HD2</td>
        <td>HD1: {{$log->hd1_from}} đến {{$log->hd1_to}}
        HD2: {{$log->hd2_from}} đến {{$log->hd2_to}}</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Dữ liệu đã backup xuống HDD box chưa?(<em>đã backup/chưa</em>)</td>
        <td>&nbsp; @if ($log->backed_up == 1) Đã backup
          @elseif ($log->backed_up == 2) Chưa
          @endif
      </td>
      </tr>
      <tr>
        <td><strong>GW1/2</strong></td>
        <td>GDO, GRC trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->gdo_grc == 1) Xanh lá
          @elseif ($log->gdo_grc == 2) Đỏ
          @elseif ($log->gdo_grc == 3) Cam
          @elseif ($log->gdo_grc == 4) Tím
          @elseif ($log->gdo_grc == 5) Cyan
          @elseif ($log->gdo_grc == 6) Trắng
          @endif
  
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST: {{$log->gw_mst}}</td>
      </tr>
      <tr>
        <td><strong>FP1/2</strong></td>
        <td>AFS trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->afs == 1) Xanh lá
          @elseif ($log->afs == 2) Đỏ
          @elseif ($log->afs == 3) Cam
          @elseif ($log->afs == 4) Tím
          @elseif ($log->afs == 5) Cyan
          @elseif ($log->afs == 6) Trắng
          @endif
  
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST: {{$log->fp_mst}}</td>
      </tr>
      <tr>
        <td><strong>DB1/2</strong></td>
        <td>DBH trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->dbh == 1) Xanh lá
          @elseif ($log->dbh == 2) Đỏ
          @elseif ($log->dbh == 3) Cam
          @elseif ($log->dbh == 4) Tím
          @elseif ($log->dbh == 5) Cyan
          @elseif ($log->dbh == 6) Trắng
          @endif
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST:
          {{$log->db_mst}}</td>
      </tr>
      <tr>
        <td><strong>MN1/2</strong></td>
        <td>MONA trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->mona == 1) Xanh lá
          @elseif ($log->mona == 2) Đỏ
          @elseif ($log->mona == 3) Cam
          @elseif ($log->mona == 4) Tím
          @elseif ($log->mona == 5) Cyan
          @elseif ($log->mona == 6) Trắng
          @endif
  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST:
          {{$log->mn_mst}} </td>
      </tr>
      <tr>
        <td><strong>MT1/2</strong></td>
        <td>MTCD trên CMS (<em>màu?</em>)</td>
        <td>&nbsp;
          @if ($log->mtcd == 1) Xanh lá
          @elseif ($log->mtcd == 2) Đỏ
          @elseif ($log->mtcd == 3) Cam
          @elseif ($log->mtcd == 4) Tím
          @elseif ($log->mtcd == 5) Cyan
          @elseif ($log->mtcd == 6) Trắng
          @endif
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST: {{$log->mt_mst}}</td>
      </tr>
      <tr>
        <td><strong>ID1/2</strong></td>
        <td>IDS client nhận điện không(<em>có/ko</em>)</td>
        <td>&nbsp;
          @if ($log->id_data_received == 1) Có
          @elseif ($log->id_data_received == 2) Không
          @endif
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          MST: {{$log->id_mst}}</td>
      </tr>
      <tr>
        <td><strong>AM1/2</strong></td>
        <td>A/DMAN client D36 kết nối server?(<em>ko/kết nối</em>)</td>
        <td>&nbsp;
          @if ($log->adman_client == 1) Kết nối
          @elseif ($log->adman_client == 2) Không
          @endif
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>FPL, TRACK cái nào màu vàng trên A/DMAN client(<em>ko/ghi tên</em>)</td>
        <td>&nbsp;
          @if ($log->fpl_track_met == 1) Không có
          @elseif ($log->fpl_track_met == 2) MET
          @elseif ($log->fpl_track_met == 3) FPL
          @elseif ($log->fpl_track_met == 4) TRACK
          @elseif ($log->fpl_track_met == 5) FPL & TRACK
          @endif
        </td>
      </tr>
      <tr>
        <td><strong>Shared Devices</strong></td>
        <td>Đèn trạng thái ổ cứng trên Shared Device DBH, RPB, IDS (<em>màu gì</em>)</td>
        <td>&nbsp;
          @if ($log->shd_dbh == 1) Xanh lá
          @elseif ($log->shd_dbh == 2) Đỏ
          @elseif ($log->shd_dbh == 3) Cam
          @elseif ($log->shd_dbh == 4) Tím
          @elseif ($log->shd_dbh == 5) Cyan
          @elseif ($log->shd_dbh == 6) Trắng
          @endif ,
          @if ($log->shd_rpb == 1) Xanh lá
          @elseif ($log->shd_rpb == 2) Đỏ
          @elseif ($log->shd_rpb == 3) Cam
          @elseif ($log->shd_rpb == 4) Tím
          @elseif ($log->shd_rpb == 5) Cyan
          @elseif ($log->shd_rpb == 6) Trắng
          @endif, 
          @if ($log->shd_ids == 1) Xanh lá
          @elseif ($log->shd_ids == 2) Đỏ
          @elseif ($log->shd_ids == 3) Cam
          @elseif ($log->shd_ids == 4) Tím
          @elseif ($log->shd_ids == 5) Cyan
          @elseif ($log->shd_ids == 6) Trắng
          @endif
      </td>
      </tr>
      <tr>
        <td><strong>DEC</strong></td>
        <td>Đèn trạng thái (<em>màu</em>)</td>
        <td>&nbsp;
          @if ($log->dec == 1) Xanh lá
          @elseif ($log->dec == 2) Đỏ
          @elseif ($log->dec == 3) Cam
          @elseif ($log->dec == 4) Tím
          @elseif ($log->dec == 5) Cyan
          @elseif ($log->dec == 6) Trắng
          @endif</td>
      </tr>
      <tr>
        <td height="50"><p><strong>Clockwall/Console</strong></p></td>
        <td>Có vị trí nào bị lệch thời gian (có/không)</td>
        <td>&nbsp; @if ($log->clocks == 1) Không
          @elseif ($log->clocks == 2) Có
          @endif</td>
      </tr>
      <tr>
        <td><strong>DAS</strong></td>
        <td>Trạng thái của Webserver (ON/OFF)</td>
        <td>&nbsp;@if ($log->das_webserver == 1) ON
          @elseif ($log->das_webserver == 2) OFF
          @endif</td>
      </tr>
      <tr >
        <td>&nbsp;</td>
        <td>Trạng thái của Oracle DAS (ON/OFF)</td>
        <td>&nbsp;@if ($log->das_oracledb == 1) ON
          @elseif ($log->das_oracledb == 2) OFF
          @endif</td>
      </tr>
    </table>
  <br/>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
    @if($log->shift == 0)
    <tr>
      <td height="30" colspan="4"><div align="center"><strong>HỆ THỐNG RECOCHET(ca ngày hàng ngày)</strong></div></td>
    </tr>
    <tr>
      <td width="36%">Service nào trên Server 1, Server 2 bị Stop? (<em>không/có</em>)</td>
      <td width="15%">@if ($log->recochetA_services == 1) Không
          @elseif ($log->recochetA_services == 2) Có
          @endif
      -
      @if ($log->recochetB_services == 1) Không
      @elseif ($log->recochetB_services == 2) Có
      @endif</td>
      <td width="36%">Dung lượng free của ổ cứng backup Server1 Recochet?(<em>bao nhiêu GB</em>)</td>
      <td width="13%">&nbsp;{{$log->recochetA_hd_free}}</td>
    </tr>
    <tr>
      <td>Dung lượng free của ổ cứng backup Server1 Recochet?(<em>bao nhiêu GB</em>)</td>
      <td>&nbsp;{{$log->recochetB_hd_free}}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="26" colspan="4"><div align="center"><strong>HỆ THỐNG THIẾT BỊ PHÒNG LAB</strong></div></td>
    </tr>
    <tr>
      <td>Thiết bị tại tủ Server</td>
      <td>&nbsp;{{$log->lab_servers}}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Thiết bị vị trí giảng viên/học viên</td>
      <td>&nbsp;{{$log->lab_cpws}}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endif
    
    @if($log->shift == 0 && $day == 5)
    <tr>
      <td height="28" colspan="4"><div align="center"><strong>CA NGÀY THỨ 6 HÀNG TUẦN</strong></div></td>
    </tr>
    <tr>
      <td>Vệ sinh ACC, phòng trực, phòng T&amp;E, SIM3D(<em>đã làm/chưa</em>)</td>
      <td>&nbsp;@if($log->offices_cleanup =='on') Đã làm @else Chưa làm @endif</td>
      <td>Kiểm tra xóa bớt core file trên các máy chỉ, các CWP(<em>đã xóa/ chưa</em>)</td>
      <td>&nbsp;@if($log->corefiles_cleanup =='on') Đã làm @else Chưa làm @endif</td>
    </tr>
    <tr>
      <td>Vệ sinh công nghiệp bên ngoài các khe thiết bị, tủ rack(<em>đã làm/chưa</em>)</td>
      <td>&nbsp;@if($log->cabinet_cleanup =='on') Đã làm @else Chưa làm @endif</td>
      <td>PLB + voice có hoạt động không?(<em>có/không</em>)</td>
      <td>&nbsp;@if($log->plbvoice_working =='on') Đã làm @else Chưa làm @endif</td>
    </tr>
    <tr>
      <td>Lau đầu từ(<em>đã làm/chưa</em>)</td>
      <td>&nbsp;@if($log->magneticdisc_cleanup =='on') Đã làm @else Chưa làm @endif</td>
      <td>Thay đổi trong file cấu hình?(<em>có/không</em>)</td>
      <td>&nbsp;@if($log->compare_config_files =='on') Đã làm @else Chưa làm @endif</td>
    </tr>
    <tr>
      <td>Backup băng DAT nếu đã có HD đầy mà chưa backup(<em>đã làm/chưa làm</em>)</td>
      <td>&nbsp;@if($log->backedup_dat =='on') Đã làm @else Chưa làm @endif</td>
      <td>Xóa bớt dữ liệu trong USB cắm ngoài của RPB nếu quá 85%(<em>đã làm/chưa</em>)</td>
      <td>&nbsp;@if($log->usb_rpb_cleanup =='on') Đã làm @else Chưa làm @endif</td>
    </tr>
    <tr>
      <td><!--Dung lượng đã sử dụng USB cắm ngoài của RPB master(<em>%</em>)--></td>
      <td><!--&nbsp;@if($log->corefiles_cleanup =='on') Đã làm @else Chưa làm @endif--></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endif
    @if($log->shift == 1 && $day == 2)
    <tr>
      <td height="27" colspan="4"><div align="center"><strong>CA ĐÊM THỨ 3 HÀNG TUẦN</strong></div></td>
    </tr>
    <tr>
      <td>Cluster của DBH online?(<em>có/không</em>)</td>
      <td>&nbsp;@if ($log->dbh_cluster_offline == 1) Có
          @elseif ($log->dbh_cluster_offline == 2) Không
          @endif</td>
      <td>Kiểm tra HN3(<em>tốt/không tôt</em>)</td>
      <td>&nbsp;@if ($log->hn3 == 1) Tốt
          @elseif ($log->hn3 == 2) Không tốt
          @endif</td>
    </tr>
    @endif

    @if($date[2] == '01')
    <tr>
      <td height="28" colspan="4"><div align="center"><strong>CA NGÀY (NGÀY 01 ĐẦU THÁNG</strong>)</div></td>
    </tr>
    <tr>
      <td>Dùng SAM kiểm tra các đường radar NB(<em>% lỗi đường kém nhất</em>)</td>
      <td>&nbsp;{{$log->nb_error}}</td>
      <td>Dùng SAM kiểm tra các đường radar ST(<em>% lỗi đường kém nhất</em>)</td>
      <td>&nbsp;{{$log->st_error}}</td>
    </tr>
    <tr>
      <td>Dùng SAM kiểm tra các đường radar VI(<em>% lỗi đường kém nhất</em>)</td>
      <td>&nbsp; {{$log->vi_error}}</td>
      <td>Dùng SAM kiểm tra các đường radar RG(<em>% lỗi đường kém nhất</em>)</td>
      <td>&nbsp;{{$log->rg_error}}</td>
    </tr>
    @endif
    <tr style="border-bottom: 0px;">
      <td height="113" colspan="4">&nbsp;<textarea style="border: 0px;font-family: DejaVu Sans, sans-serif;" name="textarea3" id="textarea3" cols="90" rows="3">Ghi chú: {{$log->note}}</textarea></td>
    </tr>
  </table>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
    <tr>
      <td colspan="2"><div align="center"><strong>CA @if( $log->shift == 0) NGÀY @else ĐÊM @endif</strong></div></td>
    </tr>
    <tr>
      <td width="24%" height="100" valign="top">
      <div style="vertical-align:top; text-align:center;">KÍP TRƯỞNG</div>
      <div style="padding-top:50px;text-align:center;">{{$users->leader}}</div>
    </td>
      <td width="26%" valign="top" >
        <div align="center"><span>KÍP VIÊN 1</span></div>
        <div style="padding-top:50px;text-align:center;">@php if(isset($staffs[0])) echo $staffs[0]; @endphp </div></td>
    </tr>
    <tr >
      <td height="100" valign="top"><div align="center">KÍP VIÊN 2</div>
        <div style="padding-top:50px;text-align:center;">@php if(isset($staffs[1])) echo $staffs[1]; @endphp</div></td>
      <td valign="top"><div align="center">KÍP VIÊN 3</div>
        <div style="padding-top:50px;text-align:center;">@php if(isset($staffs[2])) echo $staffs[2]; @endphp</div></td>
    </tr>
  </table>
  </form>
</body>
</html>