<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\khuyen_mai;
use Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('menubar', function($view){
            $currentDate = Carbon\Carbon::now()->toDateString();
            $khuyenmai = khuyen_mai::where('ketthuc','>',$currentDate)->take(4)->get();
            $view->with('khuyenmai',$khuyenmai);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
