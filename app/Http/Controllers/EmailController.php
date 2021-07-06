<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades;


class EmailController extends Controller
{
    
     public function SendEmail(){

   //  $date = getdate();
   //  $date_now = date('Y-m-d',strtotime('now'));
 
     $documents_data = DB::table('documents')
	->select('id','title as title','description','document','date_expried','notif_date','email_notif')
    ->whereRaw('DATEDIFF(date_expried,now()) <= notif_date')
    ->where([
        ['status', '<>', '3'],
        ['status', '<>', '4'],
            ])->get()-> ToArray();           
     foreach($documents_data as $key => $docs){
         $title = ($docs->title);
         $email_notif = ($docs->email_notif);

         //$path_file = Config::get('custom_path.certificates').'/'. $certificate->image;
         $data = ['title' => $title, 'email_notif' => $email_notif];
        $test = Mail::send('email.email', $data, function($message) use ($title,$email_notif) {
          $message->to($email_notif);
          $message->subject('Email cảnh báo hết hạn tài liệu');
          $message->from('cntt.hoso@btpholdings.vn','Quản lý Hồ sơ BTP Holdings');
        });    
           //echo $data;              
    }
     }
}