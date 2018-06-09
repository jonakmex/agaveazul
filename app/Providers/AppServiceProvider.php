<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('coach_max_rec', function($attribute, $value, $parameters, $validator) {
            $coach = DB::table('coach')->where('herbalife_id',$value)->first();
            
            if($coach){
                $users = DB::table('users')->where('coach_id',$coach->id)->get();
                if($coach->max_recs < 0 || $coach->max_recs > count($users)  ){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
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
