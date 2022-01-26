<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function baca(Request $request)
    {
        $data = Notifikasi::find($request->id);
        $data->status = 0;
        $data->save();

        return response()->json([
            'data' => 'sukses'
        ]);

    }
}
