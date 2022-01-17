<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Track;

class DashboardController extends Controller
{
    public function index(){
        $data_pekan = Track::track();
        
        $divisi_data = Track::track_divisi($data_pekan);
        //dd($divisi_data);

        return view('content.user.dashboard',compact('data_pekan','divisi_data'));
        
    }
}
