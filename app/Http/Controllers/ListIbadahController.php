<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListIbadah;

class ListIbadahController extends Controller
{
    public function index(){
        $data = ListIbadah::all();
        return view('content.admin.ibadah.ibadah_list',compact('data'));
    }

    public function create(Request $request)
    {
        $data = ListIbadah::updateOrCreate(['id' => $request->id],[
    		'nama' => $request->nama,
    	]);

        return response()->json([
            'data' => 'success',
            'code' => $data
        ]);
    }

    public function show(Request $request){
        $id = $request->id;
        $data = ListIbadah::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(Request $request)
    {
        $data = ListIbadah::find($request->id);
        $data->delete();

        return response()->json([
            'data' => 'sukses'
        ]);
    }


}
