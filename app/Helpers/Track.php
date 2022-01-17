<?php

namespace App\Helpers;

use App\Models\OkrTracking;
use Carbon\Carbon;

class Track
{
    public static function track(){
        $track = OkrTracking::latest()->get();
        $track = collect($track);

        //grup per-user
        $track_user = $track->where('bulan', date('m'))
        ->groupBy('username');
  
        $now = Carbon::now()->format('Y-m-d');
        //$pekan = $this->weekOfMonth(strtotime($now));
        
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
        return $data_pekan;
    }  

    public static function track_divisi($data){
        $data_divisi = $data->groupBy('id_divisi');
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
        return $divisi_data;
    }
}
 

?>