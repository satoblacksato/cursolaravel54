<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\SendMail;
use App\Mail\BookNotificationMark;
use Illuminate\Support\Facades\Mail;
class NotificationSuscript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:suscript';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se envia un email a los usuarios suscritos en las categorias cuando se agrega un libro';

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
     * @return mixed
     */
    public function handle()
    {
       
       //$nombre=$this->ask("Cual es tu nombre");
       //$this->info("hola $nombre");
        $this->info("Proceso de envio de email empieza: ".Carbon::now()->toDateTimeString());
        $emails=SendMail::orderBy('created_at','asc')->limit(5)->get();

        foreach ($emails as $objEmail) {
          try{

                 Mail::send(new BookNotificationMark($objEmail));
                  $this->info("Se envio email a: ".$objEmail->to ." a la fecha: ".Carbon::now()->toDateTimeString());

$objEmail->delete();
          }catch(\Exception $ex){

            $this->info($ex);
          }
            
        }

        $this->info("Proceso de envio de email finaliza: ".Carbon::now()->toDateTimeString());
    }
}
