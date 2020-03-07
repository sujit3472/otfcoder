<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistrationMail extends Mailable
{
    //use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');

        $strSubject = 'Verify Email';
        
        return $this->subject($strSubject)->view('emails.user_registration_email')
        ->with([
            'name' => $this->user->full_name,
            'email_confirmation_code' => $this->user->email_confirmation,
        ]);
    }
}
