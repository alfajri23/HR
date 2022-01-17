<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\User;
use App\Models\Objective;

class DivisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('index');
    }

    public function index()
    {
        $data = Divisi::all();
        $user = User::all();
        //dd($user);

        return view('content.admin.divisi.divisi',compact('data','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $this->validate($request, [
			'file' => 'file|image|mimes:jpeg,png,jpg|max:2048',
		]);
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');

        if(empty($request->file)){
            $foto = Divisi::find($request->id);
            $files = $foto->logo;
        }else{
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'asset/img/divisi';
            $files = $tujuan_upload . '/'. $nama_file;
            $file->move($tujuan_upload,$nama_file);
        }

        //dd($files);

    	Divisi::updateOrCreate(['id' => $request->id],[
    		'nama' => $request->nama,
    		'deskripsi' => $request->deskripsi,
    		'id_manager' => $request->id_manager,
    		'logo'		=> $files,
    	]);
    	
    	return redirect()->back();
    }

    public function show(Request $request)
    {
        $data = Divisi::find($request->id);
        return response()->json([
            'data' => $data
        ]);

    }

    public function detail($id)
    {
        $data = Divisi::find($id);
        $obj = Objective::where('id_divisi',$id)->get();
        $divisi = Divisi::all();
        //dd($obj);
        //dd($data);
        return view('content.admin.divisi.divisi-detail',compact('data','obj','divisi'));

    }

    public function destroy($id)
    {
        $data = Divisi::find($id);
        $data->delete();

        return redirect()->back();
    }
}
