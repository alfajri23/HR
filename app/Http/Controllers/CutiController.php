<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\User;
use App\Helpers\Track;
use App\Models\Notifikasi;

class CutiController extends Controller
{
    public function __construct()
    {    
        $this->middleware('role:admin')->only(['admin']);
    }

    public function index(){
        $izin = Izin::where('id_user',session('id_user'))
        ->where('bulan',date('m'))
        ->where('tipe','like','%cuti%')
        ->get();

        return view('content.user.cuti.cuti',compact('izin'));
    }

    public function histori(Request $request){
        if(empty($request->bulan)){
            $m = date('m');
        }else{
            $m = $request->bulan;
        }
        $bulan = Track::get_bulan($m);

        $izin = Izin::orderBy('status')
        ->where('bulan',$m)
        ->where('tipe','like','%cuti%')
        ->get();

        return view('content.admin.cuti.histori',compact('izin','bulan'));
    }

    public function admin(Request $request){
        $user = User::all();
        $izin = Izin::orderBy('status')
        ->where('bulan',date('m'))
        ->where('tipe','like','%cuti%')
        ->get();
        return view('content.admin.cuti.cuti',compact('izin','user'));
    
}
}
