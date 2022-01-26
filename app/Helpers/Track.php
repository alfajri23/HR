<?php

namespace App\Helpers;

use App\Models\OkrTracking;
use Carbon\Carbon;

class Track
{
    public static function track($id){
        $track = OkrTracking::latest()->get();
        $track = collect($track);

        //grup per-user
        $track_user = $track->where('bulan', $id)
        ->groupBy('username');
        //dd($track_user);
  
        //per-user
        $data_pekan = [];
        $progres = 0;
        $user = '';

        foreach($track_user as $tm){
            //dd($tm);
            $progres = 0;
            foreach($tm as $tr){
                $user = $tr;
                $progres += $tr->progres;
            }
            $data_pekan[]=[
                'id_user' => $user->user->id,
                'user' => $user->user,
                'progres' => $progres,
                'id_divisi' => $tr->user->id_divisi
            ];

        }

        $data_pekan = collect($data_pekan);
        $data_pekan = $data_pekan->sortByDesc('progres');
        //dd($data_pekan);
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

    public static function get_bulan($month)
    {
        switch ($month) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;
            default:
                return 0;
                break;
        }
    }

    public static function weekOfYear($date) {
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

    public static function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return Self::weekOfYear($date) - Self::weekOfYear($firstOfMonth) + 1;
    }
}
 

?>