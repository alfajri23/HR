<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\User;
use App\Models\Objective;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'file' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back();
            dd($validator->messages()->first()); 
        }

        $datas = [
            'nama' => $request->nama,
    		'deskripsi' => $request->deskripsi,
    		'id_manager' => $request->id_manager,
        ];
        

        if(!empty($request->file)){
            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload_server = public_path('asset/img/divisi');
            $tujuan_upload = 'asset/img/divisi';
            $files = $tujuan_upload . '/'. $nama_file;
            $file->move($tujuan_upload_server,$nama_file);
            $datas['logo'] = $files;
        }

    	Divisi::updateOrCreate(['id' => $request->id],[
    		
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
        //dd($id);
        $member = User::where('id_divisi',$id)->get();
        //dd($member);
        //dd($data);
        return view('content.admin.divisi.divisi-detail',compact('data','obj','divisi','member'));

    }

    public function destroy($id)
    {
        $data = Divisi::find($id);
        $data->delete();

        return redirect()->back();
    }
}
