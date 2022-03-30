<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSertifikat;

class UserSertifikatController extends Controller
{
    public function store(Request $request){

        $this->validate($request, [
			'sertifikat' => 'file|mimes:pdf|max:2048',
		]);

        $file = $request->file('sertifikat');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload_server = public_path('asset/sertifikat');
        $tujuan_upload = 'asset/sertifikat';
        $files = $tujuan_upload . '/'. $nama_file;
        $file->move($tujuan_upload_server,$nama_file);

        $data = UserSertifikat::create([
            'id_user' => $request->id,
            'nama' => $request->nama,
            'file' => $files 
        ]);

        return redirect()->back();
    }

    public function delete(Request $request){
        $data = UserSertifikat::find($request->id)->delete();
        return redirect()->back();
    }
}
