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
use PhpParser\Node\Expr\AssignOp\Div;

class TrackController extends Controller
{
    public function user($id,$m)
    {
        $user = User::find($id);
        $track = OkrTracking::where('id_user',$id)
        ->where('bulan',$m)
        ->get();

        $key = $user->divisi->id;
        
        $key = Objective::where('id_divisi',$key)->pluck('kode');
        
        $key = Keyresult::whereIn('kode_obj',$key)->get();
        
        return view('content.admin.track.track-user',compact('user','track','key'));
    }

    public function divisi($id)
    {
        $divisi = Divisi::find($id);
        $data = Track::track();
        $data = $data->where('id_divisi',$id);
    //dd($data);
        
        return view('content.admin.track.track-divisi',compact('data','divisi'));
    }

    
    public function create(Request $request)
    {
        $user = User::find($request->id_user);
        //dd($user);
        $user = $user->username;
        OkrTracking::updateOrCreate(['id' => $request->id],[
            'username' => $user,
            'kode_key' => $request->key,
    		'target' => $request->target,
    		'start' => $request->start,
    		'bobot'	=> $request->bobot,
            'id_user' => $request->id_user,
            'bulan' => $request->bulan
    	]);

        $result = KeyResultUser::where([
                    'username' => $user,
                    'kode_key' => $request->key,
                ])->whereYear('created_at', date('Y'))
                ->get();

        if(count($result)<1){
            $target = [0,0,0,0,0,0,0,0,0,0,0,0];
            $target[$request->bulan-1] = $request->target;
            $new_target = implode(",",$target);
            KeyResultUser::create([
                'username' => $user,
                'kode_key' => $request->key,
                'bobot' => $request->bobot,
                'target_1' => $new_target
            ]);

        }else{
            //dd($result);
            $result = $result[0];
            $target = $result->target_1;
            $target = explode(",",$target);
            $target[$request->bulan-1] = $request->target;
            $new_target = implode(",",$target);
            //dd($new_target);
            $result->target_1 = $new_target;
            $result->save();

        }

        return redirect()->back();
    }

    public function update(Request $request){
        $track = OkrTracking::find($request->id);
        //dd($track);
        $data_week = $track->week_1;
        //dd($data_week);
        $data_week = explode(',',$data_week);
        
        $week_no = $request->week_no;

        $data_week[$week_no] = $request->week_val;
        $data_week = implode(",",$data_week);
        //dd($data_week);

        $track->week_1 = $data_week;
        //dd($data_week);
        $track->save();

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
