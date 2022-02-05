<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListIbadah;
use App\Models\ListIbadahUser;
use App\Helpers\Track;
use Carbon\Carbon;

class ListIbadahUserController extends Controller
{
    public function index(){
        $data = ListIbadah::all();
        $ibadah = ListIbadahUser::where('id_user',session('id_user'))->first();
        
        if(empty($ibadah)){
            $pekan = 1;
        }else{
            $pekan = count(explode(",",$ibadah->pekan));
            $pekan++;
        }

        // if(now()->format('l') == "Friday" || now()->format('l') == "Saturday"){
        //     $status = 1;
        //     //dd("good");
        // }else{
        //     $status = 0;
        //     //dd("bad");
        // }
        $status=1;
        return view('content.user.ibadah_input',compact('data','status','pekan'));
    }

    public function store(Request $request){
        $ibadah = ListIbadah::all();
        $ibadah = count($ibadah)*10;
        $request = $request->all();
        $point = 0;
        foreach($request as $req){
            if($req == 1){
                $point++;
            }
        }

        $point = ($point*10/$ibadah) * 100;

        //$point = $point/80*100;
        
        $data = ListIbadahUser::where([
            'id_user' => session('id_user'),
            'bulan'   => date('m')
        ])
        ->whereYear('created_at',date('Y'))
        ->get();


        if(count($data) <= 0){       
            $nilai = $point;
            ListIbadahUser::create([
                'id_user' => session('id_user'),
                'bulan' => date('m'),
                'pekan' => $nilai,
                'point' => $point
            ]);
        }else{
            $pointTot = 0;
            //ambil data sebelumnya
            $nilai = $data[0]->pekan;
            $nilai = explode(",",$nilai);
            //masukkan nilai baru
            array_push($nilai,$point);
            //dd($nilai);

            foreach($nilai as $n){
                $pointTot += (int)$n;
            }
            //dd($pointTot);

            $pointTot = ($pointTot/(count($nilai)));
            //dd($pointTot);
            $nilai = implode(",",$nilai);
            $data[0]->point = $pointTot;
            $data[0]->pekan = $nilai;
            $data[0]->save();
        }

        return redirect()->back();

    }

    public function history(){
        $ibadah = ListIbadahUser::where([
            'id_user' => session('id_user'),
        ])->get();

        $ibadah = collect($ibadah)->groupBy('bulan')->sortDesc();
        //dd($ibadah);


        return view('content.user.ibadah_history',compact('ibadah'));
    }

    public function edit(Request $request){
        $data = ListIbadahUser::find($request->id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(Request $request){
        $index = $request->pekan_no;
        $val = $request->pekan_val;

        // var_dump($index);
        // var_dump($val);
        
        $old_data = ListIbadahUser::find($request->id);

        $progres = 0;
        foreach($val as $value){
            $progres += $value;
        }

        $progres = $progres / count($val);
        $val = implode(",",$val);
        //dd($val);
        
        $old_data->pekan = $val;
        $old_data->point = $progres;
        $old_data->save();

        return redirect()->back();
    }
}
