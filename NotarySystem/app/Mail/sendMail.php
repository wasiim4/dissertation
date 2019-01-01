<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($genPass,$email,$fname,$lname)
    {
        $this->genPass=$genPass;
        $this->email=$email;
        $this->fname=$fname;
        $this->lname=$lname;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hi@example.com','Notary System')
         ->to($this->email)
         ->subject('Generated Password')
         ->view('emails.email_shipped')->with(['genPass'=>$this->genPass,'fname'=>$this->fname,'lname'=>$this->lname]);
    }
}
