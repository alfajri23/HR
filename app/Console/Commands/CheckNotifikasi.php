<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Notifikasi;

class CheckNotifikasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:notifikasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek ulang tahun dan kontrak habis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = User::whereDay('tgl_lahir', date('d'))
            ->whereMonth('tgl_lahir',date('m'))
            ->get();

        $datas = User::where('reminder_habis_kontrak', now()->format('Y-m-d'))->get();

        //dd($datas);

        if(count($datas) > 0){
            $pesan = '';
            foreach($data as $dt){
                $pesan = "Reminder kontrak,$dt->nama akan berakhir pada $dt->habis_kontrak";

                Notifikasi::create([
                    'nama' => $pesan,
                    'status' => 1,
                    'tipe' => 2,
                    'filter' => 'reminder'
                ]);
            }
        }

        if(count($data) > 0){
            $pesan = '';
            foreach($data as $dt){
                $pesan = "$dt->nama berulang tahun hari ini,ucapkan salam";

                Notifikasi::create([
                    'nama' => $pesan,
                    'status' => 1,
                    'tipe' => 1,
                    'filter' => 'reminder'
                ]);
            }
        }

        return 0;


    }
}
