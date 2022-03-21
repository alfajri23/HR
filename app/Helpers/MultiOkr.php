<?php

namespace App\Helpers;
use App\Helpers\Track;
use App\Models\Keyresult;


class MultiOkr
{

    public function map_array($num,$dif){
        $data = [];
        echo $num;
        echo $dif;
    }

    //input kalau sudah peruser
    static public function user($tracks){
        $data_multi = [];
        $tracks = $tracks->groupBy('kode_key');
        
        

        //progres = 0;
        foreach($tracks as $key => $kode){
           //dd($kode);
            //MY-2.2 [progres = 30 , week_1 = [20,34,21],bobot= 8]
            //MY-2.2 [progres = 30 , week_1 = [20,34,21]]
            //MY-2.2 [progres = 30 , week_1 = [20,34,21]]
            $progrest = 0;
            $data_pekan = [0,0,0,0,0];
            $pembagi = [0,0,0,0,0];
            $bagi_progres = 0;
            $total = 0;
            foreach($kode as $map => $progres){
                //dd($progres);
                //MY-2.2 [progres = 30 , week_1 = [20,34,21],bobot =8]
                // echo $progres;
                // echo "<br>";
                $total += $progres->total;
                if($progres->bobot != 0){
                    $progrest += $progres->progres;  //disini
                    $bagi_progres++;
                    $week = explode(",",$progres->week_1);
                    foreach($week as $keys => $we){
                        $data_pekan[$keys] += (int)$we;
                        $pembagi[$keys] += 1;
                    }   
                }
            }

            $bagi = 1;
            foreach($data_pekan as $keys => $dt){
                if($pembagi[$keys] == 0){
                    $bagi = 1;
                }else{
                    $bagi = $pembagi[$keys];
                }
                 $data_pekan[$keys] = $data_pekan[$keys]/$bagi;
                 
            }

            $nama = Keyresult::where('kode',$key)->pluck('nama')->first();

            $data_multi[]=[
                'kode_key' => $key,
                'nama'      => $nama,
                'progres'   => $progrest/$bagi_progres,
                'data_pekan'=> $data_pekan,
                'total' =>  $total,
            ];
        }

        //dd($data_multi);
        return $data_multi;

    }
}