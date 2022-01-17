<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\User;
use App\Models\Keyresult;
use App\Models\Objective;
use App\Models\OkrTracking;
use App\Models\KeyResultUser;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $track = OkrTracking::latest()->get();
        $track = collect($track);

        //grup per-user
        $track_user = $track->where('bulan', date('m'))
        ->groupBy('username');
  
        $now = Carbon::now()->format('Y-m-d');
        $pekan = $this->weekOfMonth(strtotime($now));
        
        //per-user
        $data_pekan = [];
        $progres = 0;
        foreach($track_user as $tm){
            $progres = 0;
            foreach($tm as $tr){
                $week = explode(",",$tr->week_1);
                foreach($week as $w){
                    $progres += (int)$w;
                }
                $progres = ($progres/$tr->target)*$tr->bobot;
            }
            $data_pekan[]=[
                'user' => $tr->user,
                'progres' => round($progres),
                'id_divisi' => $tr->user->id_divisi
            ];
        }

        $data_pekan = collect($data_pekan);
        $data_pekan = $data_pekan->sortByDesc('progres');
        //dd($data_pekan);
        
        //per-divisi
        $data_divisi = $data_pekan->groupBy('id_divisi');
        $divisi_data = [];
        $progres_divisi = 0;
        $daftar_user = 0;
        $nama_divisi = '';
        foreach($data_divisi as $key => $datas){
            $divisi = '';
            $progres_divisi = 0;
            $daftar_user = 0;
            $daftar_user = count($datas);
            foreach($datas as $dt){
                $divisi = $dt['user']->divisi;
                $progres_divisi += $dt['progres'];  
            }
            $divisi_data [] = [
                'divisi' => $divisi,
                'progres' => round($progres_divisi/$daftar_user)
            ];
        }
        $divisi_data = collect($divisi_data);
        $divisi_data = $divisi_data->sortByDesc('progres');
        //dd($divisi_data);

        return view('content.admin.dashboard',compact('data_pekan','divisi_data'));
    }

    public function weekOfYear($date) {
        $weekOfYear = intval(date("W", $date));
        if (date('n', $date) == "1" && $weekOfYear > 51) {
            // It's the last week of the previos year.
            return 0;
        }
        else if (date('n', $date) == "12" && $weekOfYear == 1) {
            // It's the first week of the next year.
            return 53;
        }
        else {
            // It's a "normal" week.
            return $weekOfYear;
        }
    }

    public function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return $this->weekOfYear($date) - $this->weekOfYear($firstOfMonth) + 1;
    }
    
    
}
