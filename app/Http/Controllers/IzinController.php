<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\User;
use App\Models\Notifikasi;
use App\Helpers\Track;
use DateInterval;
use DatePeriod;

class IzinController extends Controller
{
    public function __construct()
    {    
        $this->middleware('role:admin')->only(['admin','admin_sakit']);
    }

    public function index(Request $request){
        
        $izin = Izin::where('id_user',session('id_user'))
        ->where('bulan',date('m'))
        ->where('tipe','!=','cuti')
        ->get();

        $izins = Izin::where([
            'id_user' => session('id_user'),
            'status' => 1,
            'ganti_jam' =>1,
            'bulan' => date('m')
        ])
        ->where('tipe','!=','cuti')
        ->get();

        $jam = 0;
        foreach($izins as $iz){
            $jam = $jam + $iz->jam;
        }

        return view('content.user.izin.izin',compact('izin','jam'));
    }

    public function sakit(Request $request){
        
        $izin = Izin::where('id_user',session('id_user'))
        ->where('bulan',date('m'))
        ->where('tipe','like','%sakit%')
        ->where('tipe','!=','cuti')
        ->get();

        $izins = Izin::where([
            'id_user' => session('id_user'),
            'status' => 1,
            'ganti_jam' =>1,
            'bulan' => date('m')
        ])
        ->where('tipe','!=','cuti')
        ->get();

        return view('content.user.izin.sakit',compact('izin'));
    }

    public function histori(Request $request){
        if(empty($request->bulan)){
            $m = date('m');
        }else{
            $m = $request->bulan;
        }

        $bulan = Track::get_bulan($m);

        $izin = Izin::orderBy('status')
        ->where('bulan',$m)
        ->where('tipe','!=','cuti')
        ->get();

        return view('content.admin.izin.histori',compact('izin','bulan'));
    }

    public function admin(Request $request){
            $user = User::all();
            $izin = Izin::orderBy('status')
            ->where('bulan',date('m'))
            ->where('tipe','!=','cuti')
            ->get();
            return view('content.admin.izin.izin',compact('izin','user'));   
    }

    public function admin_sakit(Request $request){
        $user = User::all();
        $izin = Izin::orderBy('status')
        ->where('bulan',date('m'))
        ->where('tipe','like','%sakit%')
        ->where('tipe','!=','cuti')
        ->get();
        return view('content.admin.izin.sakit',compact('izin','user'));   
    }

    public function check_date($date){
        $date_stamp = strtotime(date('Y-m-d', strtotime($date)));
        return $stamp = date('l', $date_stamp);
    }

    public function request(Request $request){
        $hari=1;
        $halfDay = '0';
        $tgl_akhir = $request->tgl_mulai;
        $status = 0;
        $jam = 0;
        $ganti_jam = '0';
        $dinas = '0';
        $user = '';
        $files = '';

        $this->validate($request, [
			'bukti' => 'sometimes|mimes:jpeg,png,jpg,doc,docx,pdf|max:2048',
		]);
		// menyimpan data file yang diupload ke variabel $file
		$bukti = $request->file('bukti');
        //dd($request->bukti);

        if(!empty($request->bukti)){
            $nama_file = time()."_".$bukti->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload_server = public_path('asset/img/izin');
            $tujuan_upload = 'asset/img/izin';
            $files = $tujuan_upload . '/'. $nama_file;
            $bukti->move($tujuan_upload_server,$nama_file);  
        }

        if($request->hari == 1 ){
            $hari = 1 + round(abs(strtotime($request->tgl_akhir) - strtotime($request->tgl_mulai))/86400);
            $tgl_akhir = $request->tgl_akhir;
            $jam = $hari*7;

            $start_date = date_create($request->tgl_mulai);
            $end_date   = date_create($request->tgl_akhir);

            //cek hari sabtu minggu
            $interval = DateInterval::createFromDateString('1 day');
            $daterange = new DatePeriod($start_date, $interval ,$end_date);
            $sabtu = 0;
            $minggu = 0;
            foreach($daterange as $date1){
                $date1 = $date1->format('Y-m-d');
                $date_stamp = strtotime(date('Y-m-d', strtotime($date1)));
                $stamp = date('l', $date_stamp); 

                if($stamp == "Saturday"){
                    $sabtu++;
                }elseif($stamp == "Sunday"){
                    $minggu++;
                }
            }
            $minggu = $minggu*7;
            $sabtu = $sabtu*2;
            $jam = $jam-$sabtu-$minggu;


        }else{
            //cek hari sabtu
            $date_stamp = strtotime(date('Y-m-d', strtotime($request->tgl_mulai)));
            $stamp = date('l', $date_stamp); 

            if($stamp == "Saturday"){
                $jam = 5;
            }else{
                $jam =7;
            }
            
        }

        if(auth()->user()->hasrole('admin')){
            $status = 1;
            $user = $request->id_user;

            if($request->jenis == 'cuti'){
                $userz = User::find($request->id_user);
                $dd = (int)$userz->cuti-$hari;
                //dd($dd);
                $dd = intval($dd);
                
                $userz->cuti = $dd;
                $userz->save();
            }
            
        }else{
            $user = session('id_user');
            $users = User::find($user);

            Notifikasi::create([
                'nama' => "".$users->nama . " mengajukan ijin, mohon konfirmasi",
                'status' => 1,
                'tipe' => 2,
                'filter' => $request->filter,
            ]);
        }

        if($request->half == 1 ){
            $halfDay = '1';
            $start = strtotime($request->jam_mulai);
            $end = strtotime($request->jam_akhir);
            $jam = ($end - $start)/3600;
        }

        if($request->ganti == 1 ){
            $ganti_jam = '1';
        }

        if($request->dinas == 1 ){
            $jam = $jam/2;
            $dinas = '1';
        }

        $result = Izin::updateOrCreate(['id' => $request->id],[
            'id_user' => $user,
            'hari' => $hari,
            'tipe' => $request->jenis,
            'alasan' => $request->alasan,
            'setengah_hari' => $halfDay,
            'tanggal_mulai' => $request->tgl_mulai,
            'tanggal_akhir' => $tgl_akhir,
            'status' => $status,
            'jam' => $jam,
            'ganti_jam' => $ganti_jam,
            'dinas' => $dinas,
            'bulan' => date('m'),
            'bukti' => $files
        ]);

        return redirect()->back();
    }

    public function show(Request $request){
        $id = $request->id;
        $data = Izin::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function delete(Request $request){
        $id = $request->id;
        $data = Izin::find($id);
        $data->delete();

        return response()->json([
            'data' => 'sukses'
        ]);
    }

    public function accept(Request $request){
        $id = $request->id;
        $data = Izin::find($id);
        $data->status = 1;
        $data->save();

        if($data->tipe == 'cuti'){
            $user = User::find($data->id_user);

            $user->cuti = $user->cuti - $data->hari;
            $user->save();
        }

        return response()->json([
            'data' => 'sukses'
        ]);
    }

    public function reject(Request $request){
        $id = $request->id;
        $data = Izin::find($id);
        $data->status = 2;
        $data->save();

        return response()->json([
            'data' => 'sukses'
        ]);
    }
}
