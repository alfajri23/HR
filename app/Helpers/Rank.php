<?php

namespace App\Helpers;

use App\Models\OkrTracking;
use App\Models\ListIbadahUser;
use App\Models\Absensi;
use App\Models\User;
use Carbon\Carbon;

class Rank
{
    public function rank_kumulatif($m){
        $data_pekan = Track::track($m);
        
        $user = User::all();
        //dd($user);
        $rank=[];
        $ibadah = 0;
        $absensi = 0;
        $okr = 0;
        foreach($user as $id){
            $ibadah = ListIbadahUser::where([
                'id_user' => $id->id,
                'bulan' => $m
            ])
            ->whereYear('created_at',date('Y'))
            ->first();

            if($ibadah != null){
                $ibadah = $ibadah->point;
            }else{
                $ibadah = 0;
            }
            
            $absensi = Absensi::where([
                'id_user' => $id->id,
                'bulan' => $m
            ])
            ->whereYear('created_at',date('Y'))
            ->first();

            if($absensi != null){
                $absensi = $absensi->hasil;
            }else{
                $absensi = 0;
            }

            $okr = $data_pekan->where('id_user',$id->id)->first();
        
            if(empty($okr)){
                $okrs = 0;
            }else{
                $okrs = $okr['progres'];
            }
            
            $rank[]=[
                'user' => $id,
                'hasil' => ($okrs*0.8)+($ibadah*0.1)+($absensi*0.1),
            ];

        }

        $rank = collect($rank);
        $rank = $rank->sortByDesc('hasil');

        return $rank;
    }
}