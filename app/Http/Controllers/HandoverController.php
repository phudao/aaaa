<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Atmlog;
use App\User;
use Carbon\Carbon;
use Auth;
use Mail;
use App\Mail\UserEmail;
use PDF;
class HandoverController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function switchshift()
    {
        return view('Handover.switchshift');
    }

    public function addexchangeworklog(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $dataExchange = $request->input('data');
            if(isset($dataExchange['doitlater']) && $dataExchange['doitlater'] == 'on')
            {
                $dataExchange['doitlater'] = 1;
            }
            $dataExchange['created_at'] = Carbon::now();
            
            try{
                DB::table('exchangeworklog')->insert($dataExchange);
                return redirect('/calendar');
            }catch(Exception $e){

            }
        }
    }

    public function editexchange($id)
    {
        try{
            $data = DB::table('exchangeworklog')->where('id', $id)->get();
            //print_r($data);die;
            if(count($data) > 0){
                $sen['success'] = true;
                $sen['result'] = $data;
                //print_r($sen);die;
                return Response::json( $sen );
            }
        }catch(Exception $e){

        }
    }

    public function delaaa($id)
    {            
        try{
            //$userId = Auth::id();
            DB::table('exchangeworklog')->where('id', $id)->delete();
            return redirect('/calendar');
        }catch(Exception $e){

        }
    }

    public function calendar()
    {
        // history -> current :database'
        //current  -> future: calculate
        $colors = ['#28a745', '#669900', '#007bff', '#6699ff'];
        $teams = config('constants.teams');
        $shifts = config('constants.shifts');
        $form = config('constants.form');
        $start_date = config('constants.start_date');
        
        $data = [];
        $curDay = (int)date('d');
        $curMonth = (int)date('m');
        $curYear =  date('Y');
        $d1 = cal_days_in_month(CAL_GREGORIAN, $curMonth, $curYear);
        $d2 = cal_days_in_month(CAL_GREGORIAN, $curMonth + 1, $curYear);
        $d3 = cal_days_in_month(CAL_GREGORIAN, $curMonth + 2, $curYear);
        $maxDays = $d1 + $d2 + $d3;
        $data['teams'] = [];

        $indexForm  = 0;
        $indexShift = 0;
        $z = 0;
        for($index = 1; $index <= $maxDays; $index++)
        {
            if($indexForm >= count($form)) 
            {
                $indexForm = 0;
            }
            for($i = 0; $i < $shifts; $i++)
            {   
                if($indexShift >= $shifts) 
                {
                    $indexShift = 0;
                }
                //need to refactor
                if($index >= $curDay)
                {
                    $names = User::whereIn('id', $teams[$form[$indexForm][$indexShift]])->select('name')->get()->toArray();
                    $team = $this->getTeam($names);
                    $data['teams'][$z]['title'] = implode(', ', $team);
                    $data['teams'][$z]['D']     = $index;
                    //$data['teams'][]['start'] = 'new Date(y, m, '.$index.')';
                    $data['teams'][$z]['backgroundColor'] = $colors[$form[$indexForm][$indexShift]];
                    $data['teams'][$z]['borderColor'] = $colors[$form[$indexForm][$indexShift]];
                    //$data['teams'][]['allDay'] = 'true';
                    $indexShift++;
                    $z++;
                }
            }
            $indexForm++;


            $logs = DB::table('atmlogs as m')
            ->join('users as b', 'b.id', '=', 'm.leader_id')
            ->select('m.date_working as date_working', 
                    'm.shift as shift', DB::raw("CONCAT(b.name, ', ' , m.staff_names) AS team"))
            ->orderBy('m.id', 'desc')
            ->paginate(60);

            $data['logs'] = [];
            $kk = 0;
            foreach($logs as $log)
            {
                $members = explode(', ', $log->team);
                $mems = [];
                foreach($members as $member)
                {
                    $a = explode(' ', $member);
                    $mems[] = end($a);
                }
                $data['logs'][$kk]['title'] = implode(', ', $mems);
                $data['logs'][$kk]['shift'] = $log->shift;
                $data['logs'][$kk]['date'] = $log->date_working;
                $data['logs'][$kk]['backgroundColor'] = '#666699';
                $data['logs'][$kk]['borderColor'] = '#666699';
                $kk++;
            }
            
            //echo '<pre>';
            //print_r($data['logs']);
            //die;
            
        }
        $data['exchanges'] = DB::table('exchangeworklog as e')
                        ->join('users as s', 's.id', '=', 'e.changer_id')
                        ->join('users as x', 'x.id', '=', 'e.replacer_id')
                        ->where('s.active', '1')
                        ->where('x.active', '1')
                        ->select('e.id as id', 's.name as change_name', 'x.name as replace_name', 
                        'e.date_change as date_change', 'e.date_replace as date_replace', 
                        'e.shift_change as shift_change', 'e.shift_replace as shift_replace')
                        ->orderBy('e.id', 'desc')
                        ->paginate(20);

        $data['staffs'] = DB::table('users as u')
                        ->join('users_types as t', 'u.id', '=', 't.user_id')
                        ->join('types as s', 's.id', '=', 't.type_id')
                        ->where('t.type_id', 1)
                        ->where('u.active', '1')
                        ->select('u.id as id', 'u.name as name')->get();
        //echo '<pre>';
        //print_r($data['teams']);die;
        return view('Handover.calendar', $data);
    }

    public function printexchangework($id)
    {
        $data = DB::table('exchangeworklog as a')
            ->join('users as u1', 'a.changer_id', '=', 'u1.id')
            ->join('users as u2', 'a.replacer_id', '=', 'u2.id')
            ->where('a.id', $id)
            ->select('u1.name as changer', 'u2.name as replacer', 
            'a.date_change as date_change', 'a.date_replace as date_replace',
            'a.shift_change as shift_change', 'a.shift_replace as shift_replace', 
            'a.doitlater as doitlater', 'a.created_at as created_at')->first();

        
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontSize(12);
        $phpWord->setDefaultFontName('Times New Roman');
                
        $predefinedMultilevelStyle = ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED];
        $l = array("align" => "left");
        $r = array("align" => "right");
        $c = array('align' => 'center');
        $i = array('italic'=> true);
        $bb = array('bold' => true);
        $b   = array('bold' => true, 'underline' => 'single');
        $section = $phpWord->addSection();

        $fancyTableStyle = [
            'borderSize' => 0, 
            'borderColor' => 'white', 
            'cellMargin' => 0, 
            'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
            'cellSpacing' => 2,
            'tableWidth' => array('type' =>'pct', 'value' => 100 ),
        ];
        $table = $section->addTable($fancyTableStyle);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addText('CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM', $bb, $c);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addText('Độc lập - Tự do - Hạnh phúc', $bb, $c);
        
        $dates = explode('-', explode(' ', $data->created_at)[0]);
        $section->addText('Hà Nội, ngày '.$dates[2].' tháng '.$dates[1].' năm '.$dates[0], $i, $r);
        $section->addText('PHIẾU ĐĂNG KÝ ĐỔI CA TRỰC', $bb, $c);
        $section->addText('Kính gửi: - Trung tâm Bảo đảm kỹ thuật', $bb, $c);
        $section->addText('                 - Đội trưởng Đội: Công nghệ thông tin', $bb, $c);
        $section->addText('Tên người xin đổi: '. $data->changer);
        $section->addText('Tên người làm thay: '. $data->replacer);

        if($data->doitlater == 0)
        {
            $shiftc = ($data->shift_change == 0) ? 'ngày' : 'đêm';
            $shiftr = ($data->shift_replace == 0) ? 'ngày' : 'đêm';
            $datec = explode('-', $data->date_change);
            $dater = explode('-', $data->date_replace);
            $section->addText('Tôi xin đổi trực: ca '.$shiftc.' '.$datec[2].' tháng '.$datec[1].' năm '.$datec[0].' sang ca trực '.$shiftr.' '.$dater[2].' tháng '.$dater[1].' năm '.$dater[0]);
            $section->addText('Người làm thay trực: ca '.$shiftc.' '.$datec[2].' tháng '.$datec[1].' năm '.$datec[0].' thay cho ca trực '.$shiftr.' '.$dater[2].' tháng '.$dater[1].' năm '.$dater[0]);
        }
        else
        {
            $shiftc = ($data->shift_change == 0) ? 'ngày' : 'đêm';
            $datec = explode('-', $data->date_change);
            $section->addText('Tôi xin đổi trực: ca '.$shiftc.' '.$datec[2].' tháng '.$datec[1].' năm '.$datec[0].' sang ca trực ….. tháng ….. năm …..');
            $section->addText('Người làm thay trực: ca '.$shiftc.' '.$datec[2].' tháng '.$datec[1].' năm '.$datec[0].' thay cho ca trực ….. tháng ….. năm …..');
        }
        
        $section->addText('Lý do đổi trực: Bận việc gia đình');
        $section->addText('Chúng tôi cam kết làm đúng ca đổi đã đăng ký. Tuyệt đối phục tùng sự phân công và điều động của Kíp trưởng đương nhiệm. Nếu sai chúng tôi xin hoàn toàn chịu trách nhiệm.');
        $section->addText('Xin chân thành cám ơn!');

        $table = $section->addTable($fancyTableStyle);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addText('Người xin đổi', ['bold' => true], $c);
        $table->addCell(9000, ['align' => 'center'])->addText('Người làm thay', ['bold' => true], $c);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addText('(Ký và ghi rõ họ tên)', ['bold' => false], $c);
        $table->addCell(9000, ['align' => 'center'])->addText('(Ký và ghi rõ họ tên)', ['bold' => false], $c);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addTextBreak(2);
        $table->addCell(9000, ['align' => 'center'])->addTextBreak(2);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addText('Kíp trưởng Kíp đổi trực', ['bold' => true], $c);
        $table->addCell(9000, ['align' => 'center'])->addText('Kíp trưởng Kíp làm thay', ['bold' => true], $c);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addText('Tôi đồng ý và chịu trách nhiệm và đảm bảo việc thay đổi ca trực trên không ảnh hưởng tới nhiệm vụ của ca trực do tôi phụ trách.
        Lúc …….., ngày ….. tháng ….. năm …..
        ', $i, $c);
        $table->addCell(9000, ['align' => 'center'])->addText('Tôi đồng ý và chịu trách nhiệm và đảm bảo việc thay đổi ca trực trên không ảnh hưởng tới nhiệm vụ của ca trực do tôi phụ trách.
        Lúc …….., ngày ….. tháng ….. năm …..
        ', $i, $c);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addText('(Ký và ghi rõ họ tên)', ['bold' => false], $c);
        $table->addCell(9000, ['align' => 'center'])->addText('(Ký và ghi rõ họ tên)', ['bold' => false], $c);
        $table->addRow();
        $table->addCell(9000, ['align' => 'center'])->addTextBreak(2);
        $table->addCell(9000, ['align' => 'center'])->addTextBreak(2);
        $section->addText('ĐỘI TRƯỞNG XÁC NHẬN',  ['bold' => true], $c);


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try 
        {
            $objWriter->save(storage_path('phieudoica.docx'));
        } 
        catch (Exception $e) 
        {

        }
        return response()->download(storage_path('phieudoica.docx'));
    }

    private function getTeam($names)
    {
        $team = [];
        foreach($names as $name)
        {
            $n = explode(' ', $name['name']);
            $team[] = end($n);
        }
        return array_reverse($team);
    }

    private function isInserted($date, $shift)
    {
        $count = DB::table('atmlogs')->where('date_working', $date)->where('shift', $shift)->count();
        if($count > 0)
            return true;
        else
            return false;
    }

    //tu gio tro di test add log, bo gui send email
    public function addlog(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            //$ngaytruc = $request->input('ngaytruc');
            // echo '<pre>';
            // print_r($request->input('data'));
            // die;
            try
            {
                $data = $request->input('data');
                //check error Undefined index: staff_names
                //$data['staff_names'] = implode(', ', $data['staff_names']);
                $names = $ids = [];
                foreach($data['staff_names'] as $staff)
                {
                    $staffs = explode(':', $staff);
                    $ids[] = $staffs[0];
                    $names[] = $staffs[1];
                }
                $data['staff_ids'] = implode(',', $ids);
                $data['staff_names'] = implode(', ', $names);
                $data['created_at'] = Carbon::now();
                $data['user_id']    = Auth::id();
                //check inserted...date and shift
                if($this->isInserted($data['date_working'], $data['shift']) == false)
                {
                    DB::table('atmlogs')->insert($data);
                    $lastId = Atmlog::orderBy('id', 'desc')->pluck('id')[0];    
                    $this->generatepdf($lastId);
                    $this->sendEmail();
                    return redirect('/list')->with('success', 'Thêm mới thành công');
                }
                else
                {
                    return redirect('/list')->with('error', 'Dữ liệu ca làm việc đã có');
                }
                //$data =  Atmlog::orderBy('id', 'desc')->first();
                //$data->trace = serialize($data->toArray());
                //$data->save();
            }
            catch(Exception $e)
            {
                return back()->with('error', $e->getMessage());
            }
        }
        else
        {
            $data['staffs']     = DB::table('users as u')
                        ->join('users_types as t', 'u.id', '=', 't.user_id')
                        ->join('types as s', 's.id', '=', 't.type_id')
                        ->where('t.type_id', 1)
                        ->where('u.active', '1')
                        ->select('u.id as id', 'u.name as name')
                        ->get();
            $data['leaders']    = DB::table('users as u')
                        ->join('users_types as t', 'u.id', '=', 't.user_id')
                        ->join('types as s', 's.id', '=', 't.type_id')
                        ->where('t.type_id', 2)
                        ->where('u.active', '1')
                        ->select('u.id as id', 'u.name as name')
                        ->get();
            $data['managers']   = DB::table('users as u')
                        ->join('users_types as t', 'u.id', '=', 't.user_id')
                        ->join('types as s', 's.id', '=', 't.type_id')
                        ->where('t.type_id', 3)
                        ->where('u.active', '1')
                        ->select('u.id as id', 'u.name as name')
                        ->get();

            // dang sua lai dateworking va shift khi khong co du lieu -> null, sua rong js blade nua
            //
            $data['last']= DB::table('atmlogs')
                                ->select('date_working', 
                                        'shift', 
                                        'rf12_mst', 
                                        'rf34_mst', 
                                        'rf56_mst', 
                                        'rf78_mst', 
                                        'ms_mst', 
                                        'sf_mst', 
                                        'rp_mst', 
                                        'gw_mst', 
                                        'fp_mst', 
                                        'db_mst', 
                                        'mn_mst', 
                                        'mt_mst', 
                                        'id_mst', 'hd1_from', 'hd1_to', 'hd2_from', 'hd2_to')->orderBy('id', 'desc')->first();
            if($data['last'] != null)
            {
                $data['num']                = DB::table('atmlogs')->where('date_working', $data['last']->date_working)->count();
                $data['date_working']       = $data['last']->date_working;
                $data['shift']              = $data['last']->shift;
            }
            else{
                $data['num']            = 0;
                $data['date_working']   = '';
                $data['shift']          = '';
            }

            $data['colors']     = DB::table('configs')->where('group', 'color')->get();                  
            $data['onoffs']     = DB::table('configs')->where('group', 'onoff')->get();
            $data['bools']      = DB::table('configs')->where('group', 'bool')->get();
            $data['runstops']   = DB::table('configs')->where('group', 'runstop')->get();
            $data['goods']      = DB::table('configs')->where('group', 'good')->get();
            $data['admans']     = DB::table('configs')->where('group', 'adman')->get();        
            $data['dones']      = DB::table('configs')->where('group', 'done')->get();      
            $data['user_id']    = Auth::id();
            return view('Handover.addlog', $data);
        }
        
    }

    // private function getDataDiff($id)
    // {
    //     $traces = DB::table('atmlogs')->where('id', $id)->pluck('trace');
    //     if(isset($traces[0]))
    //     {
    //         $traces = explode(':::', $traces[0]);
    //     }
    //     else{
    //         return [];
    //     }
    //     $arrDiff = [];
    //     //echo '<pre>';
    //     if($traces >= 2)
    //     {
    //         $arrTraces = [];
    //         foreach($traces as $trace)
    //         {
    //             //print_r($trace);
    //             //echo "<br>";
    //             $arrTraces[] = unserialize($trace);
    //             //print_r($arrTraces[0]);die;
    //         }
    //         //die;
    //         $index = 0;
    //         foreach($arrTraces as $arr)
    //         {
    //             if($index >= 1)
    //             {
    //                 $arrDiff[]['update_at'] = $arr['update_at'];
    //                 $arrDiff[]['username'] = DB::table('users')->where('id', $id)->pluck('name');
    //                 $arrDiff[]['diff'] = array_diff($arrTraces[$index], $arrTraces[$index-1]);
    //             }
    //         }
    //     }
    //     //echo '<pre>';
    //     //print_r($arrDiff[0]['diff']);die;
    //     return $arrDiff;
    // }

    public function editlog($id)
    {
        $data['diffs']  = [] ;//$this->getDataDiff($id);
        $data['staffs'] = DB::table('users as u')
                        ->join('users_types as t', 'u.id', '=', 't.user_id')
                        ->join('types as s', 's.id', '=', 't.type_id')
                        ->where('t.type_id', 1)
                        ->where('u.active', '1')
                        ->select('u.id as id', 'u.name as name')
                        ->get();
        $data['leaders'] = DB::table('users as u')
                        ->join('users_types as t', 'u.id', '=', 't.user_id')
                        ->join('types as s', 's.id', '=', 't.type_id')
                        ->where('t.type_id', 2)
                        ->where('u.active', '1')
                        ->select('u.id as id', 'u.name as name')
                        ->get();
        $data['managers'] = DB::table('users as u')
                        ->join('users_types as t', 'u.id', '=', 't.user_id')
                        ->join('types as s', 's.id', '=', 't.type_id')
                        ->where('t.type_id', 3)
                        ->where('u.active', '1')
                        ->select('u.id as id', 'u.name as name')
                        ->get();

        $data['colors']     = DB::table('configs')->where('group', 'color')->get();                  
        $data['onoffs']     = DB::table('configs')->where('group', 'onoff')->get();
        $data['bools']      = DB::table('configs')->where('group', 'bool')->get();
        $data['runstops']   = DB::table('configs')->where('group', 'runstop')->get();
        $data['goods']      = DB::table('configs')->where('group', 'good')->get();
        $data['admans']     = DB::table('configs')->where('group', 'adman')->get();        
        $data['dones']      = DB::table('configs')->where('group', 'done')->get();
        $data['log']        = DB::table('atmlogs')->where('id', $id)->first();
        $leaderid           = DB::table('atmlogs')->where('id', $id)->pluck('leader_id')[0];
        $staffids           = DB::table('atmlogs')->where('id', $id)->pluck('staff_ids')[0];
        $logerid            = DB::table('atmlogs')->where('id', $id)->pluck('user_id')[0];
        $data['auth_ids']   = [];
        
        if($staffids != ''){
            $staff_ids          = explode(',', $staffids);
            array_push($staff_ids, $leaderid);
            $data['auth_ids']   = $staff_ids;
        }else{
            $data['auth_ids']   = array($leaderid, $logerid);
        }
        if (!in_array(Auth::id(), $data['auth_ids']))
        {
            $data['title'] = 'CHI TIẾT NHẬT KÍ';
        }
        else
        {
            $data['title'] = 'SỬA NHẬT KÝ';
        }
        //echo '<pre>';
        //print_r(Auth::id());
        //print_r($data['auth_ids']);
        //echo '<pre>';
        //print_r($data['log']);die;
        return view('Handover.editlog', $data);
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            try
            {
                $data = $request->input('data');
                //print_r($data);
                $names = $ids = [];
                foreach($data['staff_names'] as $staff)
                {
                    //print_r($staff);
                    $staffs = explode(':', $staff);
                    //print_r($staffs);die;
                    $ids[] = $staffs[0];
                    $names[] = $staffs[1];
                }
                $data['staff_ids'] = implode(',', $ids);
                $data['staff_names'] = implode(', ', $names);
                $log = Atmlog::where('id', $data['id'])->first();
                //echo '<pre>';
                //print_r($log);
                $diff = 0;
                foreach($data as $key => $val)
                {
                    if($key == 'hd1_from' || $key == 'hd1_to' || $key == 'hd2_from' || $key == 'hd2_to')
                    {
                        $arrVals = explode('T', $val);
                        if(strlen($arrVals[1]) == 5)
                        {
                            $arrVals[1] = $arrVals[1] . ':00';
                        }
                        $val = implode(' ', $arrVals);
                    }
                    if ($log->{$key} != $val)
                    {
                        //print_r($key);
                        $diff += 1;
                        $log->{$key} = $val;
                    }
                }
                //die;
                if($diff > 0)
                {

                    $log->user_id = Auth::id();
                    //$log->trace = empty($log->trace) ? serialize($log->toArray()) : $log->trace.':::'.serialize($log->toArray());
                    $log->save();
                    return redirect('/list')->with('success', 'Cập nhật thành công');
                }
                else
                {
                    return redirect('/list')->with('info', 'Không có dữ liệu được thay đổi');
                }
            }
            catch(Exception $e)
            {
                return redirect('/addlog')->with('error', $e->getMessage());
            }
        }
    }

    public function detail($id)
    {
        $data = $this->getDataDetail($id);
        return view('Handover.detail', $data);
    }

    public function listlog(Request $request)
    {
        $keyword = '';
        if ($request->isMethod('post')) 
        {
            $keyword = $request->input('keyword');
        }
        if($keyword == '')
        {
            $data['logs'] = DB::table('atmlogs as m')
                        ->join('users as a', 'a.id', '=', 'm.user_id')
                        ->join('users as b', 'b.id', '=', 'm.leader_id')
                        ->join('users as c', 'c.id', '=', 'm.manager_id')
                        ->select('m.id as id',
                                'm.date_working as date_working', 
                                'm.shift as shift', 
                                'a.name as user', 
                                'b.name as leader', 
                                'c.name as manager', 
                                'm.staff_names as staff_names',
                                'm.note as note',
                                'm.updated_at as updated_at',
                                'm.created_at as created_at')
                        ->orderBy('m.id', 'desc')->paginate(14);
            return view('Handover.list', $data);
        }else
        {
            $data['logs'] = DB::table('atmlogs as m')
                        ->join('users as a', 'a.id', '=', 'm.user_id')
                        ->join('users as b', 'b.id', '=', 'm.leader_id')
                        ->join('users as c', 'c.id', '=', 'm.manager_id')
                        ->select('m.id as id',
                                'm.date_working as date_working', 
                                'm.shift as shift', 
                                'a.name as user', 
                                'b.name as leader', 
                                'c.name as manager', 
                                'm.staff_names as staff_names',
                                'm.note as note',
                                'm.updated_at as updated_at',
                                'm.created_at as created_at')
                        ->where('note', 'like', "%$keyword%")
                        ->orderBy('m.id', 'desc')->paginate(100);
            return view('Handover.list', $data);
        }
    }

    public function listuser()
    {
        $data['users'] = DB::table('users')->paginate(14);
        return view('Handover.user', $data);
    }

    //https://phpword.readthedocs.io/en/latest/styles.html#table
    public function reportWeekly(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $post = $request->input();
            $notes = DB::table('atmlogs')
                            ->where('date_working', '>=', $request->input('from'))
                            ->where('date_working', '<=', $request->input('to'))
                            ->select('date_working', 'shift', 'note')
                            ->get();

            $datefrom = explode('-', $request->input('from'));
            $dateto = explode('-', $request->input('to'));
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $phpWord->setDefaultFontSize(13);
            $phpWord->setDefaultFontName('Times New Roman');
                    
            $predefinedMultilevelStyle = ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED];
            $l = array("align" => "left");
            $r = array("align" => "right");
            $c = array('align' => 'center');
            $bb = array('bold' => true);
            $b   = array('bold' => true, 'underline' => 'single');
            $section = $phpWord->addSection();
            //$section->addText('', $b, $l);
            //$section->addText('CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM', $b, $r);

            $fancyTableStyle = [
                'width'         => 50,
                'borderSize'  => 0,
                'borderColor' => 'white',
                'cellMargin'  => 80,
                'alignment'   => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
                //'layout'      => \PhpOffice\PhpWord\Style\Table::LAYOUT_FIXED,
            ];
            $fancyTableStyle = [
                'borderSize' => 6, 
                'borderColor' => '006699', 
                'cellMargin' => 80, 
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
                'cellSpacing' => 10,
                'tableWidth' => array('type' =>'pct', 'value' => 100 ),
                'position' =>array('left' => 10, 'top'=> 10),
            ];
            $table = $section->addTable($fancyTableStyle);
            $table->addRow();
            $table->addCell(9000, ['valign' => 'center'])->addText('TRUNG TÂM BẢO ĐẢM KỸ THUẬT', ['bold' => true]);
            $table->addCell(9000, ['valign' => 'center'])->addText('CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM', ['bold' => true]);
            $table->addRow();
            $table->addCell(9000, ['valign' => 'center'])->addText('ĐỘI CÔNG NGHỆ THÔNG TIN', ['bold' => true]);
            $table->addCell(9000, ['valign' => 'center'])->addText('Độc lập - Tự do - Hạnh phúc', ['bold' => true]);
            
            $section->addText(strtoupper($request->input('name')), $b, $c);
            $section->addText('Từ ngày '.$datefrom[2].' tháng '.$datefrom[1].' năm '.$datefrom[0].' đến ngày '.$dateto[2].' tháng '.$dateto[1].' năm '.$dateto[0].'', [], $c);
            $section->addTextBreak(1);
            $section->addText('Kính gửi: Trung tâm Bảo đảm kỹ thuật', [], $c);
            $section->addText('- Căn cứ báo cáo tình trạng kỹ thuật các trang thiết bị thuộc quyền quản lý của Công nghệ thông tin');
            $section->addText('- Căn cứ chức năng, nhiệm vụ của Đội Công nghệ thông tin');
            $section->addText('Đội Công nghệ thông tin báo cáo kỹ thuật tuần từ ngày '.$datefrom[2].' tháng '.$datefrom[1].' năm '.$datefrom[0].' đến ngày '.$dateto[2].' tháng '.$dateto[1].' năm '.$dateto[0].' như sau:');
            $section->addTextBreak(1);
            $section->addListItem('Về công tác tổ chức, duy trì kỷ luật lao động', 0, $b, [], []);
            $section->addListItem('Tình hình chấp hành kỹ luật lao động: các kíp, thực hiện nghiêm túc chế độ trực, chấp hành tốt kỷ luật lao động theo chức trách nhiệm vụ của mình', 1);
            $section->addListItem('trường hợp vi phạm kỷ luật hoặc sự vụ đặc biệt', 1);
            $section->addListItem('Các trường hợp tự ý đổi ca, bỏ vị trí trực: Không', 2);
            $section->addListItem('Sự vụ đặc biệt: (ốm đau đột xuất, việc đột xuất, muộn giờ…): Không', 2);
            $section->addTextBreak(1);
            $section->addListItem('Tình trạng các phương tiện kỹ thuật phục vụ điều hành bay:', 0, $b, [], []);
            $section->addListItem('Hệ thống ATM', 1, $bb, [], []);
            foreach($notes as $note)
            {
                if( trim($note->note) !=  '')
                {
                    $date = 'Ngày ' . $note->date_working . ': ' ;
                    $section->addListItem($date, 2, $b);
                    $section->addText($note->note, [], array('indentation' => array('left' => 2000, 'right' => 0)));
                }
            }
            $section->addListItem('Các công việc khác đã làm trong tuần', 0, $b, [], []);
            $section->addListItem('Triển khai công văn trên văn phòng điện tử đến các kíp trực', 1);          
            $section->addListItem('Việc thực hiện đột xuất do Trưởng Trung tâm/lãnh đạo công ty giao Đội/hoặc cán bộ Đội', 0, $b, [], []);
            $section->addListItem('Quản lý chất lượng', 0, $b, [], []);
            $section->addListItem('Tuân thủ quy trình.', 1);
            $section->addListItem('Các công việc Đội dự kiến thực hiện trong tuần tiếp theo:', 0, $b, [], []);         
            $section->addTextBreak(1);
            $table = $section->addTable();
            $table->addRow();
            $table->addCell(9000, ['valign' => 'center'])->addText('');
            $table->addCell(9000, ['valign' => 'center'])->addText('ĐỘI TRƯỞNG', ['bold' => true], ["align" => "right", 'indentation' => array('left' => 0, 'right' => 250)]);
            $table->addRow();
            $table->addCell(9000, ['valign' => 'center'])->addText('Nơi nhận:
                                                                    - Như kính gửi;
                                                                    - Lưu: Đội CNTT(Du2b)
                                                                    ');
            $table->addCell(9000, ['valign' => 'center'])->addText('Nguyễn Duy Dũng', ['bold' => true], ["align" => "right"]);

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            try 
            {
                $objWriter->save(storage_path('baocao.docx'));
            } 
            catch (Exception $e) 
            {

            }
            return response()->download(storage_path('baocao.docx'));
        }
        else{
            return view('Handover.report_weekly', []);
        }
    }

    public function sendEmail()
    {
        $users = ['vietdungnorats@gmail.com', 'hahungit@gmail.com', 'tunglt.vatm@gmail.com', 'daovietphu@gmail.com'];
        Mail::to('nguyenvangiang1109@gmail.com')->cc($users)->send(new UserEmail());
        //$users = [];
        //Mail::to('daovietphu@gmail.com')->cc($users)->send(new UserEmail());
        
    }

    private function getDataDetail($id)
    {
        $data['log']    = DB::table('atmlogs')->where('id', $id)->first();
        $data['users']  = DB::table('atmlogs as a')
                            ->join('users as u1', 'a.manager_id', '=', 'u1.id')
                            ->join('users as u2', 'a.leader_id', '=', 'u2.id')
                            ->where('a.id', $id)
                            ->select('u1.name as manager', 'u2.name as leader', 'a.staff_names as staff_names')->first();
        $data['staffs'] = explode(', ', $data['users']->staff_names);
        $timestamp = strtotime($data['log']->date_working);
        $day = date('w', $timestamp);
        $data['day'] = $day;
        $data['date'] = explode('-', $data['log']->date_working);
        switch ($day)
        {
            case 0: $data['date'][] = 'C.Nhật'; break;
            case 1: $data['date'][] = 'Thứ 2'; break;
            case 2: $data['date'][] = 'Thứ 3'; break;
            case 3: $data['date'][] = 'Thứ 4'; break;
            case 4: $data['date'][] = 'Thứ 5'; break;
            case 5: $data['date'][] = 'Thứ 6'; break;
            case 6: $data['date'][] = 'Thứ 7'; break;
        }
        return $data;
    }

    public function generatepdf($id)
    {
        try
        {
            $data = $this->getDataDetail($id);
            $pdf = PDF::loadView('Handover.detail', $data);
            $pdf->setPaper('A4', 'Portrait');
            $pdf->set_option('isHtml5ParserEnabled', true);
            $pdf->render();
            $output = $pdf->output();
            file_put_contents('bienban_giaoca.pdf', $output);
        }
        catch(Exception $e)
        {
            
        }
        
    }
}
