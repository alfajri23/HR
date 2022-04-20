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
use App\Models\BobotMultiOkr;
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
        ->orderBy('kode_key')
        ->get();

        $multi = null;
        $bulan = Track::get_bulan($m);                              //bulan
        $key = $user->divisi->id;                                   //id divisi user
        $key = Objective::where('id_divisi',$key)->get();           //ambil objectives team
        //$key = Keyresult::whereIn('kode_obj',$key)->get();        //ambil key team
        $tracks = collect($track);
        // $tracks = $tracks->groupBy('')

        //cek jika track ada
        if(count($tracks) > 1){
            if($tracks[0]['multi'] != null){
                //$multi = MultiOkr::user($tracks);                  // Yang dulu ( ada track setiap key , tp belum ada bobot persub )
                //$multi = MultiOkr::users($tracks);                   // Hanya mengembalikan 1 nilai akhir, butuh detailnya
                $multi = MultiOkr::inputUser($tracks);
            } 
        }
        $tracks = $tracks->groupBy('multi');
        
        //bobot multi okr 
        $bobotMulti = BobotMultiOkr::where([
            'id_user' => $id,
            'bulan' => $m
        ])->get();

        $subs = Subdivisi::all();
        
        return view('content.admin.track.track-user',compact('user','tracks',
                                                            'key','bulan',
                                                            'multi','subs',
                                                            'bobotMulti'
                                                        ));
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
        ->orderBy('kode_key')
        ->get();
        $bulan = Track::get_bulan($m);

        $multi = null;


        $tracks = collect($track);
        
        //cek jika track ada
        if(count($tracks) > 1){
            if($tracks[0]['multi'] != null){
                //$multi = MultiOkr::user($tracks);  //Dulu
                $multi = MultiOkr::inputUser($tracks);
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

        //dd($request);

        //dd($request->week_val);
        //$nominal    = str_replace(",", "", $request->bayar);
        
        $data_week = $track->week_1;
        $data_week = explode(',',$data_week);
        $progres = 0;
        $data_progres = 0;
        $pekan = 0;

        if($data_week[0] != ""){

            for($i = 0; $i < count($request->week_no); $i++){
                if($request->week_val[$i] != null){
                    $data_week[$request->week_no[$i]] = str_replace(",", "", $request->week_val[$i]);
                }else{
                    $data_week[$request->week_no[$i]] = $request->week_val[$i];
                }  
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

        }else{
            $data_week = null;
        }

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

    //Fungsi untuk copy okr
    public function copy(Request $request){
        $bulan = $request->bulan;
        $user = $request->user;
        $bulan_ini = $request->bulan_ini;

        //dd($bulan);

        $data = OkrTracking::where([
            'id_user' => $user,
            'bulan'   => $bulan
        ])->get();

        foreach($data as $dt){
            $copy = $dt->replicate();
            $copy->bulan = $bulan_ini;
            $copy->week_1 = null;
            $copy->progres = null;
            $copy->save();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = OkrTracking::find($id);
        $data->delete();

        return redirect()->back();

    }

    
}
