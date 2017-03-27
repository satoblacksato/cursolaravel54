<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\SendMail;

class BookNotificationMark extends Mailable
{
    use Queueable, SerializesModels;

    public $sendMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SendMail $sendMail)
    {
        $this->sendMail=$sendMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->sendMail->subject);
        $this->to($this->sendMail->to);
        return $this->markdown('emails.markdown.booknotifaction');
    }
}
