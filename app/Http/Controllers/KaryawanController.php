<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Karyawan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Divisi;
use App\Helpers\Track;
use Illuminate\Support\Facades\Session;
use App\Models\OkrTracking;
use App\Models\Absensi;
use App\Models\Izin;
use App\Models\LemburKerja;
use App\Models\GantiJam;
use App\Models\ListIbadahUser;
use App\Helpers\MultiOkr;
use App\Models\Keyresult;
use App\Models\Objective;

class KaryawanController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:admin')->except(['input_okr','profile','update']);
        $this->middleware('role:admin')->only(['index','store','destroy']);
        //$this->middleware('role:user_manager')->only(['show']);
        //$this->middleware('role:user')->except(['show']);
    }

    public function index()
    {
        //$user = User::all(); 
        $user = User::whereHas("roles", function($q){ $q->where("name","!=", "Admin"); })
        ->where('id_divisi','!=',null)
        ->get();
        $divisi = Divisi::all();
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

    	$user = User::updateOrCreate(['id' => $request->id],[
    		'nama' => $request->nama,
    		'username' => $request->username,
    		'foto' => $files,
    		'email'	=> $request->email,
            'password'	=> bcrypt($request->password),
            'jenkel'	=> $request->jenkel,
            'id_divisi'	=> $request->id_divisi,
    	]);
        
        switch ($request->role) {
            case 1:
                $user->assignRole('user');
                break;
            case 2:
                $user->assignRole('user_manager');
                break;
            case 3:
                $user->assignRole('user');
                break;
        }

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
            // isi dengan nama folder tempat kemana file diuploadpublic_path('\img\uploads')
            $tujuan_upload_server = public_path('asset/img/profile');
            $tujuan_upload = 'asset/img/profile';
            //dd($tujuan_upload);
            $files = $tujuan_upload . '/'. $nama_file;
            $file->move($tujuan_upload_server,$nama_file);
            // $request->file('file')->store(
            //     'asset/img/profile', 'public'
            // );
        }

        if(empty($request->password)){
            $foto = User::find($request->id);
            $password = $foto->password;
        }else{
            $password = bcrypt($request->password);
        }

        //dd($password);

        //dd($request->reminder_kontrak);

        $data = User::find($request->id);
        $data->nama = $request->nama; 
        $data->password = $password; 
        $data->cuti = $request->cuti; 
        $data->nik = $request->nik; //
        $data->pangkat = $request->pangkat;
        $data->jabatan = $request->jabatan;
        $data->usia = $request->usia;
        $data->status_kerja = $request->status_kerja;
        $data->tgl_masuk_grup = $request->tgl_masuk_grup;
        $data->tgl_masuk = $request->tgl_masuk; //
        $data->email = $request->email;
        $data->telepon = $request->telepon;
        $data->telepon_wa = $request->telepon_wa;
        $data->username = $request->username;
        $data->id_divisi = $request->id_divisi;
        $data->alamat = $request->alamat;
        $data->alamat_ktp = $request->alamat_ktp;
        $data->foto = $files;
        $data->habis_kontrak = $request->habis_kontrak; 
        $data->reminder_habis_kontrak = $request->reminder_habis_kontrak; 
        $data->tmpt_lahir = $request->tmpt_lahir; 
        $data->tgl_lahir = $request->tgl_lahir;  
        $data->pendidikan = $request->pendidikan; 
        $data->sekolah = $request->sekolah; 
        $data->jurusan = $request->jurusan; 
        $data->npwp = $request->npwp; 
        $data->level = $request->level; 
        $data->rekening = $request->rekening; 
        $data->bpjs_kes = $request->bpjs_kes; 
        $data->bpjs_tk = $request->bpjs_tk; 
        $data->status_keluarga = $request->status_keluarga; 
        $data->jenkel = $request->jenkel;  
        $data->edukasi_pekanan = $request->edukasi_pekanan; 
        $data->save();

        return redirect()->back();

    }

    public function show($id)
    {
        
        $multi = null;
        $data = User::find($id);
        $divisi = Divisi::all();
        $bulan = array('1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');
        $absen = Absensi::where('id_user',$id)->get();
        

        $track = OkrTracking::where('id_user',$id)
        ->where('bulan',date('m'))
        ->get();

        $tracks = collect($track);
        
        //cek jika track ada
        if(count($tracks) > 1){
            if($tracks[0]['multi'] != null){
                $multi = MultiOkr::user($tracks);
            } 
        }
        $tracks = $tracks->groupBy('multi');
        //dd($tracks);

        $track_tahun = Track::track_tahun($id);
        $track_tahun = implode(",",$track_tahun);

        $cuti = Izin::where('id_user',$id)
        ->where('bulan',date('m'))
        ->where('tipe','like','%cuti%')
        ->where('status',1)
        ->get();

        $izin = Izin::where([
            'id_user' => $id,
            'status' => 1,
            'bulan' => date('m')
        ])
        ->where('tipe','!=','cuti')
        ->get();

        $jam = 0;
        foreach($izin as $iz){
            if($iz->ganti_jam == 1){
                $jam = $jam + $iz->jam;
            }  
        }
        $ijin = $jam;

        $lembur = LemburKerja::where([
            'id_user' => $id,
            'bulan' => date('m')
        ])
        ->get();

        foreach($lembur as $iz){
            $jam = $jam - $iz->jam;
        }

        $ganti = GantiJam::where([
            'id_user' => $id,
            'bulan' => date('m')
        ])->get();

        foreach($ganti as $gt){
            $jam = $jam - $gt->jam;
        }
    
        //dd($tracks);
        if(auth()->user()->hasrole('user_manager')){
            return view('content.user.karyawan-detail',compact('data','divisi',
                                                                'bulan','track','tracks',
                                                                'absen','izin',
                                                                'lembur','ganti',
                                                                'jam','ijin',
                                                                'cuti','track_tahun',
                                                                'multi'));

        }

        
        return view('content.admin.karyawan.karyawan-detail',compact('data','divisi',
                                                                    'bulan','track','tracks',
                                                                    'absen','izin',
                                                                    'lembur','ganti',
                                                                    'jam','ijin',
                                                                    'cuti','track_tahun',
                                                                    'multi'));
        

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
        $bulan = Track::get_bulan(date('m'));
        $multi = '';

        $track = OkrTracking::where('id_user',session('id_user'))
        ->where('bulan',date('m'))
        ->orderBy('updated_at')
        ->get();

        

        if(count($track)>0){
            //cek apakah sudah input okr belum
            $dd = $track[0]->week_1;
            $dd = explode(",",$dd);
            

            $attempt = 0;
            foreach($dd as $dt){
                if($dt != ""){
                    $attempt++;
                }
            }
        }else{
            $attempt = 0;
        }

        //dd($attempt);


        $ibadah = ListIbadahUser::where([
            'id_user' => session('id_user'),
            'bulan'   => date('m')
        ])
        ->whereYear('created_at',date('Y'))
        ->get();
        

        if(count($ibadah)>0){

            $ibadah = $ibadah[0]->pekan;
            $ibadah = explode(",",$ibadah);
            $ibadah = count($ibadah);
            //dd($ibadah);

        }else{
            $ibadah = 0;
        }

        if($ibadah < $attempt){
            $status = 0;
        }else{
            $status = 1;
        }

        $tracks = collect($track);
        if(count($tracks) > 1){
            if($tracks[0]['multi'] != null){
                $multi = MultiOkr::user($tracks);
            } 
        }
        $tracks = $tracks->groupBy('multi');

        

        return view('content.user.okr_input',compact('tracks','data',
                                                    'divisi','bulan',
                                                    'track','status',
                                                    'multi'));
        
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect()->back();
    }
}
