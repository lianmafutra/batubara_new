<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpseclib3\Net\SSH2;

class deploy extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'deploy';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Command description';

   /**
    * Execute the console command.
    *
    * @return int
    */
   public function handle()
   {

      $ssh = new SSH2('103.31.39.193', '22');
      if (!$ssh->login('lianmafutra', 'Sistemapp112277')) {
         throw new \Exception('Login failed');
      }

      $pass = $this->secret('Masukan Password untuk deploy :');
      if ($pass == "lian112277") {
         $this->info("Auth sukses");
         sleep(2);
         $this->info("Waiting to push ...");
         sleep(2);
         $this->output->progressStart(3);

         for ($i = 0; $i < 3; $i++) {
             sleep(1);
             $this->output->progressAdvance();
         }
     
         $this->output->progressFinish();

         $this->info("git ftp push");
         $data = exec('git ftp push', $output, $return);
         if ($return != 0) {
            $this->error("git ftp push failed");
            return 1;
         } else {
            $this->info("Running : php artisan optimize");
            $this->info($ssh->exec('cd /www/wwwroot/duaputraraden.my.id/ && sudo php artisan optimize'));
            $this->info("Running : php artisan view:clear");
            $this->info($ssh->exec('cd /www/wwwroot/duaputraraden.my.id/ && sudo php artisan view:clear'));
            $this->info("Running : php artisan view:cache");
            $this->info($ssh->exec('cd /www/wwwroot/duaputraraden.my.id/ && sudo php artisan view:cache'));
            $this->info("Success deploy to production");
         }
      } else {
         $this->error("password salah");
      }
   }
}
