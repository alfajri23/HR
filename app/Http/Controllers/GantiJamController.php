<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\User;
use App\Models\GantiJam;
use App\Models\LemburKerja;
use App\Helpers\Track;

class GantiJamController extends Controller
{
    public function index(){
        //IZIN
        $izin = Izin::where([
            'id_user' => session('id_user'),
            'status' => 1,
            'ganti_jam' =>1,
            'bulan' => date('m')
        ])
        ->get();

        $jam = 0;
        foreach($izin as $iz){
            $jam = $jam + $iz->jam;
        }
        $ijin = $jam;

        //LEMBUR
        $lembur = LemburKerja::where([
            'id_user' => session('id_user'),
            'bulan' => date('m')
        ])
        ->get();

        $lemburs = 0;
        foreach($lembur as $iz){
            $jam = $jam - $iz->jam;
            $lemburs = $lemburs + $iz->jam;
        }

        //GANTI JAM
        $ganti = GantiJam::where([
            'id_user' => session('id_user'),
            'bulan' => date('m')
        ])->get();

        $jam_total = $jam;
        foreach($ganti as $gt){
            $jam_total = $jam_total - $gt->jam;
        }

        return view('content.user.ganti_jam.jam',compact('izin','jam',
                                                        'ganti','ijin',
                                                        'lemburs','jam_total'));
    }

    public function admin(){
        $user = User::all();
        $ganti = GantiJam::where([
            'bulan' => date('m')
        ])->get();

        return view('content.admin.ganti_jam.jam',compact('ganti','user'));
    }

    public function histori(Request $request){
        if(empty($request->bulan)){
            $m = date('m');
        }else{
            $m = $request->bulan;
        }

        $bulan = Track::get_bulan($m);

        $ganti = GantiJam::where([
            'bulan' => $m
        ])->get();

        return view('content.admin.ganti_jam.histori',compact('ganti','bulan'));
    }

    public function store(Request $request){
        $user = '';

        if(auth()->user()->hasrole('admin')){
            $user = $request->id_user;
        }else{
            $user = session('id_user');
        }

        $result = GantiJam::updateOrCreate(['id' => $request->id],[
            'id_user' => $user,
            'hari' => now()->format('Y-m-d'),
            'jam' => $request->jam,
            'bulan' => date('m')
        ]);

        return redirect()->back();
    }

    public function show(Request $request){
        $id = $request->id;
        $data = GantiJam::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function delete(Request $request){
        $id = $request->id;
        $data = GantiJam::find($id);
        $data->delete();

        return response()->json([
            'data' => 'sukses'
        ]);
    }
}
