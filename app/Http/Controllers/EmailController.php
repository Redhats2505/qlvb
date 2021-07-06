<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Mail;
use App\Mail\MailNotify;


class EmailController extends Controller
{
    
     public function SendEmail(){
     $getData = DB::table('documents')
	->select('id','title','description','document','date_expried','notif_date','email_notif')
     ->where([
           ['status', '<>', '3'],
           ['status', '<>', '4'],
               ])
     ->get();
     return $data = $getData();
	//foreach ($getData as $key => $tailieu) {
      //   $t1 = $getData->date_expried;
      //    $t2 = date();
      //    $ss= $t1->diff($t2);
      //    $cons_t= $getData->notif_date;
     //     If ($ss<$cons_t) {
	//
          Mail::send('email.email',$data->title,function($message){
              $message->from('cntt.hoso@btpholdings.vn','Quản lý Hồ sơ BTP Holdings');
              $message->to(['cntt.phanmem@btpholdings.vn']);
              $message->subject('Email cảnh báo hết hạn tài liệu');
          });
     //}
    // }
     }
}