<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Mail;
use App\Mail\MailNotify;

class EmailController extends Controller
{
    
     public function SendEmail(){
          $data = [];
          Mail::send('email.email',$data,function($message){
              $message-> from('cntt.hoso@btpholdings.vn','Quản lý Hồ sơ BTP Holdings');
              $message-> to('cntt.phanmem@btpholdings.vn','Quản lý Hồ sơ BTP Holdings');
              $message-> subject('Email test');
          }
          );
     }

}
