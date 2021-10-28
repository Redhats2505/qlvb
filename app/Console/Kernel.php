<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

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
            ->select('id','title as title','description','document','date_expried','notif_date','email_notif')
            ->whereRaw('DATEDIFF(date_expried,now()) <= notif_date')
            ->where([
                ['status', '<>', '3'],
                ['status', '<>', '4'],
                    ])->get()-> ToArray();           
             foreach($documents_data as $key => $docs){
                 $title = ($docs->title);
                 $email_notif = str_replace(' ','',$docs->email_notif);
                 $email_notif = explode(',',($email_notif));
        
                 //$path_file = Config::get('custom_path.certificates').'/'. $certificate->image;
                 $data = ['title' => $title, 'email_notif' => $email_notif];
                $test = Mail::send('email.email', $data, function($message) use ($title,$email_notif) {
                  //$message->to(['cntt.phanmem@btpholdings.vn','cntt.hethong@btpholdings.vn']);
                  $message->to($email_notif);
                  $message->subject('Email cảnh báo hết hạn tài liệu');
                  $message->from('hoso@btpholdings.vn','Quản lý Hồ sơ BTP Holdings');
                });                          
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
