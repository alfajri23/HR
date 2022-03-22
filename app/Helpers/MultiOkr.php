<?php

namespace App\Helpers;
use App\Helpers\Track;
use App\Models\BobotMultiOkr;
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

    //input kalau sudah peruser
    static public function users($tracks){      //* Menampilkan progres akhir setelah ada bobot persub
        $data_multi = [];
        $tracks = $tracks->groupBy('multi');   //dipisah per sub divisi || mysch,mm,jk

        $totalAkhirPersub= 0;
        foreach ($tracks as $okrsPerSub){               
            //dd($okrsPerSub);                            //mysch -> 3 okr
            $total_persub=0;  
            $bobot_sub = BobotMultiOkr::where([
                'subdivisi' => $okrsPerSub[0]['multi'],
                'bulan' => $okrsPerSub[0]['bulan'],
                'id_user' => $okrsPerSub[0]['id_user'],
            ])->first();
            
            foreach ($okrsPerSub as $okrPerSub){        //looping okr my sch
                $total_persub += $okrPerSub['progres']; //total progres okr mysch
            }

            $totalAkhirPersub = $totalAkhirPersub + $total_persub * ( empty($bobot_sub->bobot) ? 0 : $bobot_sub->bobot / 100 );       
        }

        return $totalAkhirPersub;
    }

    static public function inputUser($tracks){      //* Menampilkan progres akhir setelah ada bobot persub
        $data_multi = [];
        $tracks = $tracks->groupBy('multi');   //dipisah per sub divisi || mysch,mm,jk

        $totalAkhirPersub= 0;
        foreach ($tracks as $okrsPerSub){               
            //dd($okrsPerSub);                            //mysch -> 3 okr
            $total_persub=0; 
            $nama_persub=0;   
            $bobot_sub = BobotMultiOkr::where([
                'subdivisi' => $okrsPerSub[0]['multi'],
                'bulan' => $okrsPerSub[0]['bulan'],
                'id_user' => $okrsPerSub[0]['id_user'],
            ])->first();

            $bobot = empty($bobot_sub->bobot) ? 0 : $bobot_sub->bobot;
            $id_bobot = empty($bobot_sub->id) ? 0 : $bobot_sub->id;

            //dd(empty($bobot_sub) ? 'ada' : $bobot_sub );
            
            foreach ($okrsPerSub as $okrPerSub){        //looping okr my sch
                $nama_persub = $okrPerSub['multi'];
                $total_persub += $okrPerSub['progres']; //total progres okr mysch
            }

            $data_multi[] = [
                'subdivisi' => $nama_persub,
                'hasil' => $total_persub,
                'bobot' => $bobot,
                'id' => $id_bobot,
                'total' => $total_persub * ( $bobot / 100 )
            ];

            $totalAkhirPersub = $totalAkhirPersub + $total_persub * ( $bobot / 100 );       
        }

        //dd($data_multi);

        return $data_multi;
    }

}