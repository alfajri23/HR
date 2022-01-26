<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Rank;
use App\Models\TopOfMount;
use App\Models\ListIbadahUser;
use Carbon\Carbon;

class CheckTopMount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:topmount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $now = Carbon::now()->format('d-m-Y');
        $nows = Carbon::now();

        $end = $nows->firstOfMonth(Carbon::SATURDAY)->format('d-m-Y');

        if($now == $end){
            $rank = Rank::rank_kumulatif(date('m')-1)->first();

        
            TopOfMount::create([
                'id_user' => $rank['user']->id,
                'point' => $rank['hasil'],
                'bulan' => date('m')-1,
                'tahun' => date('Y')
            ]);

           
        }

        return 0;

    }
}
