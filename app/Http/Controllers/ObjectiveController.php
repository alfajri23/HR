<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objective;
use App\Models\User;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user($id,$m)
    {
        $user = User::find($id);
        $okr = Objective::where('');
    }

    public function create(Request $request)
    {

        Objective::updateOrCreate(['id' => $request->id],[
    		'nama' => $request->nama,
    		'deskripsi' => $request->deskripsi,
    		'id_divisi' => $request->id_divisi,
    		'kode'		=> $request->kode,
    	]);

        return redirect()->back();
    	
    }

    
    public function show(Request $request)
    {
        $data = Objective::find($request->id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = Objective::find($id);
        $data->delete();

        return redirect()->back();

    }
}
