<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LemburKerja;
use App\Models\User;
use App\Helpers\Track;

class LemburController extends Controller
{

    public function admin(){
        $user = User::all();
        $lembur = LemburKerja::where('bulan',date('m'))
        ->get();
        return view('content.admin.lembur.lembur',compact('lembur','user'));
    }

    public function histori(Request $request){
        if(empty($request->bulan)){
            $m = date('m');
        }else{
            $m = $request->bulan;
        }

        $bulan = Track::get_bulan($m);

        $lembur = LemburKerja::where('bulan',$m)
        ->get();

        return view('content.admin.lembur.histori',compact('lembur','bulan'));
    }

    public function index(){
        
        $lembur = LemburKerja::where([
            'id_user' => session('id_user'),
            'bulan' => date('m')
        ])
        ->get();

        return view('content.user.lembur.lembur',compact('lembur'));
    }

    public function store(Request $request){
        $user = '';

        if(auth()->user()->hasrole('admin')){
            $user = $request->id_user;
        }else{
            $user = session('id_user');
        }

        $result = LemburKerja::updateOrCreate(['id' => $request->id],[
            'id_user' => $user,
            'hari' => $request->tgl,
            'jam' => $request->jam,
            'alasan' => $request->keterangan,
            'bulan' => date('m')
        ]);

        return redirect()->back();
    }

    public function show(Request $request){
        $id = $request->id;
        $data = LemburKerja::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function delete(Request $request){
        $id = $request->id;
        $data = LemburKerja::find($id);
        $data->delete();

        return response()->json([
            'data' => 'sukses'
        ]);
    }
}
