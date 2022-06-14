<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BobotMultiOkr;
use App\Models\OkrTracking;

class BobotMultiController extends Controller
{
    public function store(Request $request){
        BobotMultiOkr::create([
            'id_user' => $request->id_user,
            'bulan' => $request->bulan,
            'subdivisi' => $request->subdivisi,
            'bobot' => $request->bobot
        ]);

        return redirect()->back();

        return response()->json([
            'data' => 'berhasil'
        ]);
    }

    public function edit(Request $request){
        //dd($request->all());
        BobotMultiOkr::updateOrCreate(['id' => $request->id],[
            'bobot' => $request->bobot
        ]);

        return redirect()->back();

        return response()->json([
            'data' => 'berhasil'
        ]);
    }

    public function delete($id){
        $data = BobotMultiOkr::find($id);

        $okr = OkrTracking::where([
            'id_user' => $data->id_user,
            'bulan' => $data->bulan,
            'multi' => $data->subdivisi
        ])->get();

        $okr->delete();
        $data->delete();

        return redirect()->back();
    }
}
