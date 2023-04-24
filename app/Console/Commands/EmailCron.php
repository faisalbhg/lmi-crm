<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CrmReminder;
use App\Models\User;
use Carbon\Carbon;

use Mail;
use App\Mail\SendEmail;

class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email from CRM';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        info("Cron Job running at ". now());
    
        /*------------------------------------------
        --------------------------------------------
        Write Your Logic Here....
        I am getting users and create new users if not exist....
        --------------------------------------------
        --------------------------------------------*/
        $reminders = CrmReminder::where('date_on','<=', \Carbon\Carbon::now())->where('is_send',0)
                ->get();
  
        if ($reminders->count() > 0) {
            foreach ($reminders as $reminder) {
                $mailData = [
                    'name' => $reminder->toName,
                    'body' => $reminder->message,
                    'title' => $reminder->subject,
                    'email' => $reminder->toEmail,
                ];
                $files = null;

                

                Mail::send('emails.crm_email', $mailData, function($message)use($mailData, $files) {
                    $message->subject($mailData['title']);
                    $message->to($mailData["email"]);
         
                    if($files){
                        foreach ($files as $file){
                            $message->attach($file);
                        }
                    }            
                });
                CrmReminder::find($reminder->id)->update(['is_send'=>1]);
            }
        }
    
        
    }
}
