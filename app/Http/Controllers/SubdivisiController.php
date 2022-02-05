<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdivisi;

class SubdivisiController extends Controller
{
    
    public function index()
    {
        $subdiv = Subdivisi::all();
        return view('content.admin.subdivisi.subdivisi',compact('subdiv'));
    }

    
    public function store(Request $request)
    {
        Subdivisi::updateOrCreate(['id' => $request->id],[
            'nama' => $request->nama
        ]);

        return redirect()->back();
    }

    
    public function show(Request $request)
    {
        $data = Subdivisi::find($request->id);

        return response()->json([
            'data' => $data
        ]);
    }

    
    public function destroy($id)
    {
        $data = Subdivisi::find($id);
        $data->delete();

        return redirect()->back();
    }
}
