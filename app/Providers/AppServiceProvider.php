<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;  //dbせってい
use Illuminate\Support\Facades\URL;    //この行を追加 [本のため]
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
        //
        Schema::defaultStringLength(191); //dbせってい
        // URL::forceScheme('https');          //boot()内に、この行を追加 [本のため] //vagrant環境の場合sslだとうまくいかないためコメントアウト
    }
}
