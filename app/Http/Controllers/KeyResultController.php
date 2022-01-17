<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keyresult;

class KeyResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = Keyresult::updateOrCreate(['id' => $request->id],[
    		'nama' => $request->nama,
    		'deskripsi' => $request->deskripsi,
    		'kode_obj' => $request->kode_obj,
    		'kode'		=> $request->kode,
    	]);

        return response()->json([
            'data' => 'success',
            'code' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Keyresult::find($request->id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(Request $request)
    {
        $data = Keyresult::find($request->id);
        $obj = $data->kode_obj;
        $data->delete();

        return response()->json([
            'data' => $obj
        ]);
    }
}
