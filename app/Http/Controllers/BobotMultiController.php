<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BobotMultiOkr;

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
        $data = BobotMultiOkr::find($id)->delete();
        return redirect()->back();
    }
}
