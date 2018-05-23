<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
 
use App\khuyen_mai;
use App\phim;
use App\User;
use App\nhan_vien;
use Auth;
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
            $newest = phim::where('batdau','>',$currentDate)->take(2)->get();

            //NHAN VIEN KHONG DUOC MUA VE
            $la_nv = null;
            if(Auth::user()){
                $user_id = Auth::user()->id;     
                                
                $obj_user = User::find($user_id); 
                $la_nv = nhan_vien::where('idnv',$user_id)->count();
                //dd($la_nv); 
            }
            
            $muave = 1;
            if($la_nv){
                $muave = 0;
            }
           // dd($muave);
            $view->with('khuyenmai',$khuyenmai)
                 ->with('muave',$muave)
                 ->with('newest',$newest);
        });

        view()->composer('topbar', function($view){
            $la_nv = null;
            if(Auth::user()){
                $user_id = Auth::user()->id;                       
                $obj_user = User::find($user_id);
                $la_nv = nhan_vien::where('idnv',$obj_user->id)->count();
            }
            
            $routepf = "profile";
            if($la_nv){
                $routepf = "profilenhanvien";
            }
             
            $view->with('routepf',$routepf);
                 
        });

        view()->composer('footer', function($view){
            $la_nv = null;
            if(Auth::user()){
                $user_id = Auth::user()->id;                       
                $obj_user = User::find($user_id);
                $la_nv = nhan_vien::where('idnv',$obj_user->id)->count();
            }
            
            $footerx = 0;
            if($la_nv){
                $footerx = 1;
            }
             
            $view->with('footerx',$footerx);
                 
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
