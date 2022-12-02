<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\User;

class AbsensiController extends Controller
{

    public function store(Request $request){
        // if(!empty(session('jam_max'))){
        //     $max = session('jam_max');
        // }else{
        //     $max = $request->max;
        //     session()->put('jam_max',$max);
        // }

        $max = session('jam_max');
        
        $hasil_tot = $request->tot/$max*50;
        $hasil_jam = 0;

        $akhir = substr($request->jam,3);
        $akhir = ((int)$akhir);
        $point= 0;

        // if($request->jam[1] == '8'){
        //     if($akhir > 0 && $akhir < 10){
        //         $point = 40;
        //     }elseif($akhir >= 10 && $akhir < 20){
        //         $point = 30;
        //     }elseif($akhir >= 20 && $akhir < 30){
        //         $point = 20;
        //     }elseif($akhir >= 30){
        //         $point = 10;
        //     }elseif($akhir == 0){
        //         $point = 50;
        //     }
        // }else{
        //     if($akhir <= 59 && $akhir > 50){
        //         $point = 50;
        //     }elseif($akhir <= 50 && $akhir >=40){
        //         $point = 60;
        //     }elseif($akhir <= 40 && $akhir >=30){
        //         $point = 70;
        //     }elseif($akhir <= 30 && $akhir >=20){
        //         $point = 80;
        //     }
        // }

        if($request->jam[1] == '7'){
            if($akhir >= 0 && $akhir < 10){
                $point = 70;
            }elseif($akhir >= 10 && $akhir < 20){
                $point = 60;
            }elseif($akhir >= 20 && $akhir < 30){
                $point = 50;
            }elseif($akhir >= 30 && $akhir < 40){
                $point = 40;
            }elseif($akhir >= 40 && $akhir < 50){
                $point = 30;
            }
            elseif($akhir >= 50){
                $point = 20;
            }
        }

        $point = $point+$hasil_tot;
        

        if($request->id != null){

            Absensi::updateOrCreate(['id'=>$request->id],[
                'total_jam' => $request->tot,
                'jam_masuk' => $request->jam,
                'hasil' => $point
            ]);
        }else{

            Absensi::updateOrCreate(['id'=>$request->id],[
                'id_user' => $request->id_user,
                'bulan' => $request->bulan,
                'total_jam' => $request->tot,
                'jam_masuk' => $request->jam,
                'hasil' => $point
            ]);
        }
        return redirect()->back();
    }

    public function edit(Request $request){
        $data = Absensi::find($request->id);
        return response()->json([
            'data' => $data
        ]);
    }
}
