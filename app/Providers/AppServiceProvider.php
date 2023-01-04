<?php
namespace App\Providers;
use App\Config\PengajuanAksi;
use App\Config\Role;
use App\Http\Services\Pegawai\PengajuanService;
use App\Models\Pengajuan;
use App\Models\PengajuanHistori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
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
     
   }
}
