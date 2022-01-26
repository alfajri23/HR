<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\Track;
use App\Helpers\Rank;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\User;
use App\Models\Keyresult;
use App\Models\ListIbadah;
use App\Models\Objective;
use App\Models\OkrTracking;
use App\Models\TopOfMount;
use App\Models\Absensi;
use Carbon\Carbon;
use App\Models\ListIbadahUser;

class DashboardController extends Controller
{
    //menampilkan rank kumulatif saja
    public function index(){

        $rank = Rank::rank_kumulatif(date('m'));
        //dd($rank);

        $divisi = count(Divisi::all());
        $user = count(User::all());

        //okr pribadi
        $data_pekan = Track::track(date('m'));

        //okr divisi
        $divisi_data = Track::track_divisi($data_pekan);

        //ibadah
        $ibadah = ListIbadahUser::where('bulan',date('m'))
        ->whereYear('created_at',date('Y'))
        ->orderBy('point','desc')
        ->get();

        //absensi
        $absensi = Absensi::where('bulan',date('m'))
        ->whereYear('created_at',date('Y'))
        ->orderBy('hasil','desc')
        ->get();


        

        if(auth()->user()->hasrole('admin')){
            return view('content.admin.dashboard',compact('data_pekan','divisi',
                                                        'user','divisi_data',
                                                        'ibadah','absensi','rank'));
        }else{
            return view('content.user.dashboard',compact('data_pekan','divisi',
                                                        'user','divisi_data',
                                                        'ibadah','absensi','rank'));
        }


        
    }

    //menampikan rank detail
    public function detail($m){
        $divisi = count(Divisi::all());
        $user = count(User::all());

        //okr pribadi
        $data_pekan = Track::track($m);

        //okr divisi
        $divisi_data = Track::track_divisi($data_pekan);

        //ibadah
        $ibadah = ListIbadahUser::where('bulan',$m)
        ->whereYear('created_at',date('Y'))
        ->orderBy('point','desc')
        ->get();

        //absensi
        $absensi = Absensi::where('bulan',$m)
        ->whereYear('created_at',date('Y'))
        ->orderBy('hasil','desc')
        ->get();

        if(auth()->user()->hasrole('admin')){
            return view('content.admin.dashboard_detail',compact('data_pekan','divisi',
                                                        'user','divisi_data',
                                                        'ibadah','absensi'));
        }else{
            return view('content.user.dashboard_detail',compact('data_pekan','divisi',
                                                        'user','divisi_data',
                                                        'ibadah','absensi'));
        }

    }

    //menampilkan bulan rank
    public function list_histori(){
        $bulan = array('1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');
        $top = TopOfMount::all();
        //dd($bulan);
        //dd($top);
        //dd($top[1]);
        return view('content.rank.rank_list',compact('bulan','top'));
    }

    //menampilkan rank kumulatif perbulan
    public function histori_rank($id){
        $data_pekan = Track::track($id);
        $divisi_data = Track::track_divisi($data_pekan);
        $bulan = Track::get_bulan($id);

        $rank = Rank::rank_kumulatif($id);

        return view('content.rank.rank_detail',compact('data_pekan','divisi_data',
                                                        'rank','bulan','id'));

    }

    
}
