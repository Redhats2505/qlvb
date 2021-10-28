<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Mail;
use App\Mail\MailNotify;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
   // protected $commands = [
        
   // ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        $schedule->call(function(){
            $documents_data = DB::table('documents')
            ->select('id','title as title','descriptions','document','expried_date','notif_date','notif_email')
            ->whereRaw('DATEDIFF(expried_date,now()) <= notif_date')
            ->where([
                ['status', '<>', '3'],
                ['status', '<>', '4'],
                    ])->get()-> ToArray();           
             foreach($documents_data as $key => $docs){
                 $title = ($docs->title);
                 $notif_email = str_replace(' ','',$docs->notif_email);
                 $notif_email = explode(',',($notif_email));
        
                 //$path_file = Config::get('custom_path.certificates').'/'. $certificate->image;
                 $data = ['title' => $title, 'notif_email' => $notif_email];
                $test = Mail::send('email.email', $data, function($message) use ($title,$notif_email) {
                  //$message->to(['cntt.phanmem@btpholdings.vn','cntt.hethong@btpholdings.vn']);
                  $message->to($notif_email);
                  $message->subject('Email cảnh báo hết hạn tài liệu');
                  $message->from('hoso@btpholdings.vn','Quản lý Hồ sơ BTP Holdings');
                });                          
            }
        })->daily();
        
        //$schedule->call('App\Http\Controllers\EmailController@SendEmail')->everyMinute();
    }
    
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
       // $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
