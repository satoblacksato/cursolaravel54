<?php

namespace App\Listeners;

use App\Events\BookActionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\CategoryUser;
use App\SendMail;
use Carbon\Carbon;

class BookActionEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookActionEvent  $event
     * @return void
     */
    public function handle(BookActionEvent $event)
    {
        $book=$event->book;
        $objCategory=$book->category;

       

       $collection=User::whereIn('id',
                                    CategoryUser::where('category_id','=',$objCategory->id)->pluck('user_id')->toArray()
                                )->get();

      $arrayInsert=[];
$now=Carbon::now()->toDateTimeString();
      foreach ($collection as $user) {
          $arrayInsert[]=[
            'to'=>$user->email,
            'template'=>'emails.emailsuscripcion',
            'names'=>$user->name,
            'subject'=>'Publicacion de nuevo libro',
            'files'=>'',
            'parameters'=> json_encode(['route'=>route('categorybookdetail',[$objCategory->slug,$book->slug]),
                                        'libro'=> $book->title,
                                        'user'=>$book->user->name
                                        ]),
            'created_at'=>$now,
            'updated_at'=>$now
            ];
      }

      if(count($arrayInsert)>0){
                SendMail::insert($arrayInsert);
        }
        return true;
    }
}
