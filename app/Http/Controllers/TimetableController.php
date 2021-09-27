<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use Auth;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timetable $timetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        //
    }

    public function dayTimes($day = null) {

        $data = [];
        
        if(!$day) {
            $day = date('Y-m-d H:i:s', strtotime('now 00:00:00'));
        }             
        $data[0]['dateTime'] = date('Y-m-d H:i:s', strtotime($day));
        $data[0]['hour'] = date('H:i', strtotime($day));
        for($i = 1; $i <= 23; $i++ ) {
            $data[$i]['dateTime'] = date('Y-m-d H:i:s', strtotime($data[0]['dateTime']." +".$i." hours"));
            $data[$i]['hour'] = date('H:i', strtotime($data[0]['dateTime']." +".$i." hours"));
        }        

        return $data;
    }

    public function dayUsers($day = null) {        
        
        if(!$day) {
            $day = date('Y-m-d', strtotime('now'));
        }
        $day_next = date('Y-m-d', strtotime($day." +1 day"));
        $data_db = Timetable::where('timetables.datetime', '>=', $day)
                            ->where('timetables.datetime', '<', $day_next)
                            ->join('users', 'timetables.user_id', '=', 'users.id')
                            ->select(['timetables.datetime', 'timetables.user_id', 'users.name'])
                            ->get();

        $data_users = [];
        $data = [];
        
        foreach($data_db as $item) {
            $data_users[$item->datetime][] = $item; 
        }

        $data_times = $this->dayTimes($day);

        for($i = 0; $i <= 23; $i++ ) {
            if(isset($data_users[$data_times[$i]['dateTime']])) {
                $_i = 0;
                foreach($data_users[$data_times[$i]['dateTime']] as $_item) {
                    $data[$i][$_i]['name']  = $_item->name;
                    $data[$i][$_i]['id']  = $_item->user_id;
                    $_i++;
                }
            }
            
        }        

        return $data;        
    }

    public function userHour($data) {       
        
        $data = json_decode($data, true);
        $user_id = Auth::id();

        if($data['type'] == 0) {
            $timetable = new Timetable();
            $timetable->user_id = $user_id;
            $timetable->datetime = $data['time'];
            $timetable->save();
        } else {
            Timetable::where('user_id', $user_id)->where('datetime', $data['time'])->delete();
        }        

        return $data;        
    }

    public function itemUsers($time) {       
        
        $data = [];

        $data_db = Timetable::where('timetables.datetime', '=', $time)                            
                            ->join('users', 'timetables.user_id', '=', 'users.id')
                            ->select(['timetables.user_id', 'users.name'])
                            ->get();

        foreach($data_db as $item) {
            $data[] = [
                'id' => $item->user_id,
                'name' => $item->name
            ];
        }             

        return count($data) ? $data : '';        
    }    
    
    public function currentWeek($dataWeek) {
        
        $dataWeek = json_decode($dataWeek, true);
        $data = [];
        
        if($dataWeek['type'] == 'now') {
            $date = strtotime('monday this week');
        } else {
            if($dataWeek['type'] == 'next') {
                $date = strtotime($dataWeek['current'].' +7 day');
            } else {
                $date = strtotime($dataWeek['current'].' -7 day');
            }
        }        

        for($i = 0; $i < 7; $i++) {
            $data['dates'][$i]['date'] = date("d.m", $date);         
            $data['dates'][$i]['dateFull'] = date("Y-m-d", $date);         
            $date =  strtotime('+1 day', $date);
        }    

        $data['title'] = $data['dates'][0]['date'] .'-'.$data['dates'][6]['date'];

        return $data;        
    }




}
