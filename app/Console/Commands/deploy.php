<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpseclib3\Net\SSH2;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class deploy extends Command
{
   protected $signature = 'deploy';

   public function __construct()
   {
      parent::__construct();
   }

   protected $description = 'Command description';


   public function handle()
   {
      $ssh = new SSH2('103.31.39.193', '22');
      $path_project = "/www/wwwroot/duaputraraden.my.id/";

      if (!$ssh->login('lianmafutra', 'Sistemapp112277')) {
         throw new \Exception('Login failed');
      }
      $pass = $this->secret('Masukan Password');
      if ($pass == "lian112277") {
         $this->line("<bg=green>  Auth Success  </>\n");
         sleep(1);
         $choice = $this->choice(
            "Select Action ",
            [
               1 =>    'Deploy Full',
               2 =>    'Only Optimize',
               3 =>    'Rollback Previous',
               4 =>    'See Last Deploy',
               5 =>    'DB sync to Local',
            ],
         );
         if ($this->confirm('Are you sure you want to choose ' . $choice . '?', true)) {
            if ($choice == 'Deploy Full') {
               $this->info("Waiting to push ...");
               sleep(1.5);
               $this->output->progressStart(3);
               for ($i = 0; $i < 3; $i++) {
                  sleep(0.5);
                  $this->output->progressAdvance();
               }
               $this->output->progressFinish();
               $this->info("git ftp start ...");
               $this->info("Runinng : git ftp push" . PHP_EOL);
               // Command to execute
               $command = 'git ftp push';
               // Initialize progress bar
               $output = new ConsoleOutput();
               $progressBar = new ProgressBar($output);
               // 
               // Execute command and capture output
               $output = exec($command, $outputLines, $return);
               $progressBar->start(100);
               foreach ($outputLines as $index => $result) {
                  if ($index == 0) {
                     $this->line(PHP_EOL);
                  }
                  usleep(420);
                  $progressBar->advance();
                  $this->line("<fg=yellow;>" . $result . "</>");
               }
               if ($return != 0) {
                  $progressBar->finish();
                  $this->error(PHP_EOL . PHP_EOL . "git ftp push failed \n");
                  return 1;
               } else {
                  $progressBar->finish();
                  $this->line(PHP_EOL . PHP_EOL . "<bg=green> git ftp success </>\n");
                  sleep(1.5);
                  
                  $this->info("Running : php artisan down");
                  $this->info($ssh->exec('cd '.$path_project.' && sudo php artisan down'));
                  
                  $this->info("Running : php artisan optimize");
                  $this->info($ssh->exec('cd '.$path_project.' && sudo php artisan optimize'));
                  $this->info("Running : php artisan view:clear");
                  $this->info($ssh->exec('cd '.$path_project.' && sudo php artisan view:clear'));
                  $this->info("Running : php artisan view:cache");
                  $this->info($ssh->exec('cd '.$path_project.' && sudo php artisan view:cache'));

                  // $this->info("Running : php artisan view:cache");
                  // $this->info($ssh->exec('cd '.$path_project.' && sudo composer install --no-interaction --prefer-dist --optimize-autoloader'));
           
                  sleep(3);
                  $this->info("Running : php artisan up");
                  $this->info($ssh->exec('cd '.$path_project.' && sudo php artisan up'));

                  $this->line("<bg=blue;options=blink;>  Success deploy to production  </>\n");
               }
            }
            if ($choice == 'Only Optimize') {
               $this->info("Running : php artisan optimize");
               $this->info($ssh->exec('cd '.$path_project.' && sudo php artisan optimize'));
               $this->info("Running : php artisan view:clear");
               $this->info($ssh->exec('cd '.$path_project.' && sudo php artisan view:clear'));
               $this->info("Running : php artisan view:cache");
               $this->info($ssh->exec('cd '.$path_project.' && sudo php artisan view:cache'));
               $this->line("<bg=blue;options=blink;> Success optimize on production  </>\n");
            }
         } else {
            $this->error("password salah");
         }
      }
   }
}
