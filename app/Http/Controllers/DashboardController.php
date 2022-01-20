<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\Track;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\User;
use App\Models\Keyresult;
use App\Models\Objective;
use App\Models\OkrTracking;
use App\Models\KeyResultUser;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index(){

        $divisi = count(Divisi::all());
        $user = count(User::all());

        $data_pekan = Track::track(date('m'));
        $divisi_data = Track::track_divisi($data_pekan);

        return view('content.admin.dashboard',compact('data_pekan','divisi','user','divisi_data'));
    }

    public function list_histori(){
        $bulan = array('1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');
        
        return view('content.rank.rank_list',compact('bulan'));
    }

    public function histori_rank($id){
        $data_pekan = Track::track($id);
        $divisi_data = Track::track_divisi($data_pekan);
        $bulan = Track::get_bulan($id);

        return view('content.rank.rank_detail',compact('data_pekan','divisi_data','bulan'));

    }

    
}
