<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Atmlog;
use Carbon\Carbon;
class HandoverController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function addlog(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            //$ngaytruc = $request->input('ngaytruc');
            //echo '<pre>';
            //print_r($request->input('data'));
            try
            {
                $data = $request->input('data');
                //check error Undefined index: staff_names
                $data['staff_names'] = implode(', ', $data['staff_names']);
                $data['created_at'] = Carbon::now();
                DB::table('atmlogs')->insert($data);
                return redirect('/list');
            }
            catch(Exception $e)
            {

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
            $data['last']       = DB::table('atmlogs')->select('date_working', 'shift')->orderBy('id', 'desc')->first();
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
            
            return view('Handover.addlog', $data);
        }
        
    }

    public function editlog($id)
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


        $data['colors']     = DB::table('configs')->where('group', 'color')->get();                  
        $data['onoffs']     = DB::table('configs')->where('group', 'onoff')->get();
        $data['bools']      = DB::table('configs')->where('group', 'bool')->get();
        $data['runstops']   = DB::table('configs')->where('group', 'runstop')->get();
        $data['goods']      = DB::table('configs')->where('group', 'good')->get();
        $data['admans']     = DB::table('configs')->where('group', 'adman')->get();        
        $data['dones']      = DB::table('configs')->where('group', 'done')->get();
        $data['log']        = DB::table('atmlogs')->where('id', $id)->first();
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
                //echo '<pre>';
                //print_r($data);
                //die;
                $data['staff_names'] = implode(', ', $data['staff_names']);
                $log = Atmlog::where('id', $data['id'])->first();
                foreach($data as $key => $val)
                {
                    if ($log->{$key} != $val)
                    {
                        $log->{$key} = $val;
                    }
                }
                $log->save();
                return redirect('/list');
            }
            catch(Exception $e)
            {
                print_r($e);
            }
        }
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
        $data['users'] = DB::table('users')->paginate(10);
        return view('Handover.user', $data);
    }
}
