<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Keyresult;
use App\Models\Objective;
use App\Models\OkrTracking;
use App\Models\KeyResultUser;
use App\Helpers\Track;
use App\Helpers\MultiOkr;
use PhpParser\Node\Expr\AssignOp\Div;
use Carbon\Carbon;
use App\Models\Subdivisi;

class TrackController extends Controller
{
    //untuk admin
    public function user($id,$m)
    {
        $user = User::find($id);
        $track = OkrTracking::where('id_user',$id)
        ->where('bulan',$m)
        ->get();

        $multi = null;
        $bulan = Track::get_bulan($m);
        $key = $user->divisi->id;
        $key = Objective::where('id_divisi',$key)->pluck('kode');
        $key = Keyresult::whereIn('kode_obj',$key)->get();
        $tracks = collect($track);
        
        //cek jika track ada
        if(count($tracks) > 1){
            if($tracks[0]['multi'] != null){
                $multi = MultiOkr::user($tracks);
            } 
        }
        $tracks = $tracks->groupBy('multi');
       
        //multiokr
        $subs = Subdivisi::all();
        
        
        return view('content.admin.track.track-user',compact('user','tracks',
                                                            'key','bulan',
                                                            'multi','subs'));
    }

    public function divisi($id)
    {
        $divisi = Divisi::find($id);
        $data = Track::track(date('m'));
        $data = $data->where('id_divisi',$id);
        
        return view('content.admin.track.track-divisi',compact('data','divisi'));
    }

    public function divisiMount($id,$m)
    {
        $divisi = Divisi::find($id);
        $data = Track::track($m);
        $data = $data->where('id_divisi',$id);
        
        return view('content.admin.track.track-divisi',compact('data','divisi'));
    }

    public function list(){
        $bulan = array('1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');
        return view('content.user.okr_list',compact('bulan'));

    }

    //unutk user ( readonly )
    public function user_track($m){
        $data = User::find(session('id_user'));
        $track = OkrTracking::where('id_user',session('id_user'))
        ->where('bulan',$m)
        ->get();
        $bulan = Track::get_bulan($m);

        $multi = null;

        $tracks = collect($track);
        
        //cek jika track ada
        if(count($tracks) > 1){
            if($tracks[0]['multi'] != null){
                $multi = MultiOkr::user($tracks);
            } 
        }
        $tracks = $tracks->groupBy('multi');

        //dd($tracks);
        //dd($multi);


        return view('content.user.okr_detail',compact('data','bulan','tracks','multi'));
    }

    public function histori_track_user(){
        $track_tahun = Track::track_tahun(session('id_user'));
        $track_tahun = implode(",",$track_tahun);

        return view('content.user.okr_histori',compact('track_tahun'));
    }

    
    public function create(Request $request)
    {
        $user = User::find($request->id_user);
        $user = $user->id;
        //untuk budimark karena banyak okr
        $multi = null;
        if($request->multi != null){
            $multi = $request->multi;
        }
        OkrTracking::updateOrCreate(['id' => $request->id],[
            'multi' => $multi,
            'kode_key' => $request->key,
    		'target' => $request->target,
    		'start' => $request->start,
    		'bobot'	=> $request->bobot,
            'id_user' => $request->id_user,
            'bulan' => $request->bulan
    	]);

        $result = KeyResultUser::where([
                    'id_user'  => $user,
                    'kode_key' => $request->key,
                ])->whereYear('created_at', date('Y'))
                ->get();

        if(count($result)<1){
            $target = [0,0,0,0,0,0,0,0,0,0,0,0];
            $target[$request->bulan-1] = $request->target;
            $new_target = implode(",",$target);
            KeyResultUser::create([
                'id_user' => $request->id_user,
                'kode_key' => $request->key,
                'bobot' => $request->bobot,
                'target_1' => $new_target
            ]);

        }else{
            $result = $result[0];
            $target = $result->target_1;
            $target = explode(",",$target);
            $target[$request->bulan-1] = $request->target;
            $new_target = implode(",",$target);
            $result->target_1 = $new_target;
            $result->save();

        }

        return redirect()->back();
    }

    public function update(Request $request){
        $total = empty($request->total) ? null : $request->total;
        $track = OkrTracking::find($request->id);
    
        $data_week = $track->week_1;
        $data_week = explode(',',$data_week);
        $progres = 0;
        $data_progres = 0;
        $pekan = 0;
        for($i = 0; $i < count($request->week_no); $i++){
            $data_week[$request->week_no[$i]] = $request->week_val[$i];
        }

        for($y=0 ; $y<count($data_week); $y++){
            if($data_week[$y] == null){
                $data_progres = $data_week[$y-1];
                break;
            }else{
                $data_progres = $data_week[$y];
            }
        }

        $data_week = implode(",",$data_week);

        if(empty($total)){
            $progres = $data_progres/$track->target * $track->bobot;
        }else{
            $progres = $total/$track->target * $track->bobot;
        }

        

        
        $track->total = $total;
        $track->week_1 = $data_week;
        $track->progres = $progres;

        $track->save();  
        
        //key result user
        $usr = $track->id_user;
        $key = $track->kode_key;

        $result = KeyResultUser::where([
            'id_user' => $usr,
            'kode_key' => $key,
        ])->whereYear('created_at', date('Y'))
        ->get();

        $result = $result[0];

        $target = $result->target_1;
        $target = explode(",",$target);
        $target[date('m')-1] = $progres;
        $new_target = implode(",",$target);
        $result->target_1 = $new_target;
        $result->save();

        return redirect()->back();
    }

    public function show(Request $request)
    {
        $data = OkrTracking::find($request->id);
        return response()->json([
            'data' => $data
        ]);

    }

    public function destroy($id)
    {
        $data = OkrTracking::find($id);
        $data->delete();

        return redirect()->back();

    }

    
}
