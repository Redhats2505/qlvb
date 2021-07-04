<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mail;
class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $data; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this ->subject = "[Hoso.btpholdings.vn] Thông báo cảnh báo đến hạn gia hạn hồ sơ";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.email');
    }
    
}
