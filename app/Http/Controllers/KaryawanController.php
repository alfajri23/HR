<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Karyawan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Divisi;
use App\Helpers\Track;
use Illuminate\Support\Facades\Session;
use App\Models\OkrTracking;
use App\Models\Keyresult;
use App\Models\Objective;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except(['input_okr','profile','update']);
    }

    public function index()
    {
        $user = User::all(); 
        $divisi = Divisi::all();
        //$user = KaryawanCollection::collection($user);
        //dd($user);
        return view('content.admin.karyawan.karyawan',compact('user','divisi'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
			'file' => 'file|image|mimes:jpeg,png,jpg|max:2048',
		]);
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');

        if(empty($request->file)){
            $foto = User::find($request->id);
            $files = $foto->foto;
        }else{
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'asset/img/profile';
            $files = $tujuan_upload . '/'. $nama_file;
            $file->move($tujuan_upload,$nama_file);
        }

        //dd($request->nama);

    	$user = User::updateOrCreate(['id' => $request->id],[
    		'nama' => $request->nama,
    		'username' => $request->username,
    		'foto' => $files,
    		'email'	=> $request->email,
            'password'	=> bcrypt($request->password),
            'jenkel'	=> $request->jenkel,
            'id_divisi'	=> $request->id_divisi,
    	]);

        $user->assignRole('user');

        Session::flash('message', 'Sukses menambahkan data');

        return redirect()->back();
    }

    public function update(Request $request){

        $this->validate($request, [
			'file' => 'file|image|mimes:jpeg,png,jpg|max:2048',
		]);
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');

        if(empty($request->file)){
            $foto = User::find($request->id);
            $files = $foto->foto;
        }else{
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'asset/img/profile';
            $files = $tujuan_upload . '/'. $nama_file;
            $file->move($tujuan_upload,$nama_file);
        }

        $data = User::find($request->id);
        $data->nama = $request->nama; 
        // $data->nik = $request->nik; //
        // $data->pangkat = $request->pangkat;
        // $data->jabatan = $request->jabatan;
        // $data->fungsi = $request->fungsi;
        // $data->usia = $request->usia;
        // $data->status_kerja = $request->status_kerja;
        // $data->tgl_masuk_grup = $request->tgl_masuk_grup;
        // $data->tgl_masuk = $request->tgl_masuk; //
        // $data->email = $request->email;
        // $data->telepon = $request->telepon;
        // $data->username = $request->username;
        // $data->id_divisi = $request->id_divisi;
        // $data->alamat = $request->alamat;
           $data->foto = $files;
        // $data->habis_kontrak = $request->habis_kontrak; 
        // $data->reminder_habis_kontrak = $request->reminder_habis_kontrak; 
        // $data->tmpt_lahir = $request->tmpt_lahir; 
        // $data->tgl_lahir = $request->tgl_lahir;  
        // $data->pendidikan = $request->pendidikan; 
        // $data->sekolah = $request->sekolah; 
        // $data->jurusan = $request->jurusan; 
        // $data->npwp = $request->npwp; 
        // $data->bpjs_kes = $request->bpjs_kes; 
        // $data->bpjs_tk = $request->bpjs_tk; 
        // $data->status_keluarga = $request->status_keluarga; 
        // $data->jenkel = $request->jenkel;  
        // $data->edukasi_pekanan = $request->edukasi_pekanan; 
        $data->save();

        return redirect()->back();

    }

   
    public function show($id)
    {
        $data = User::find($id);
        $divisi = Divisi::all();
        $bulan = array('1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');
        

        $track = OkrTracking::where('id_user',$id)
        ->where('bulan',date('m'))
        ->get();

        //dd($track);

        
        return view('content.admin.karyawan.karyawan-detail',compact('data','divisi','bulan','track'));
        

    }

    public function profile(){
        $data = User::find(session('id_user'));
        $track = OkrTracking::where('id_user',session('id_user'))
        ->where('bulan',date('m'))
        ->get();
        $divisi = Divisi::all();
        $bulan = array('1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');

        return view('content.user.detail',compact('data','bulan','track','divisi'));


    }

    public function input_okr()
    {
        $data = User::find(session('id_user'));
        $divisi = Divisi::all();
        //$bulan = array('1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');
        $bulan = Track::get_bulan(date('m'));

        $track = OkrTracking::where('id_user',session('id_user'))
        ->where('bulan',date('m'))
        ->get();

        //$track = collect($track);
        //$track = $track->groupBy('');

       // dd($track); 
        return view('content.user.okr_input',compact('data','divisi','bulan','track'));
        
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect()->back();
    }
}
