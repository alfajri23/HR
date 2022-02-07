<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Facade\FlareClient\View;

use App\Models\Notifikasi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View()->composer('includes.navbar.nav_admin', function ($view) {
            // $user = auth()->user()->role('admin');
            // dd($user);
            if(auth()->user()->hasRole('admin')){
                $noti = Notifikasi::where('status',1)->get();
            }else{
                $noti = Notifikasi::where(['status' => 1,'tipe' => 1])->get();
            }

            $noti = collect($noti);
            $noti = $noti->groupBy('filter');
            
            $view->with('noti', $noti);
        });
    }
}
