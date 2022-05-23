<?php

namespace App\Console\Commands;

use App\Mail\NewsLetter;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class SendNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsLater';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter email to subscribers';

    /**
     * How offten to send newsletter email.
     *
     * @var integer
     */
    protected $days = 7;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   // We send email to subscribers but what we will send it's not clear.
        // So logic will be implemented depending on what we will send.
        // Just to keep it simple, i am sending simple newsletter once in a week.
        // It can be more dynamic depending on newsletter content.
        if (Cache::has('newsLetterSent')) {
            return false;
        } 
        
        Subscriber::active()->chunk(500, function($subscribers) {
            foreach ($subscribers as $subscriber) {
                // This NewsLetter mail implements ShouldQueue so it will be queued by default
                Mail::to($subscriber->email)->send(new NewsLetter());
            }
        });

        Cache::put('newsLetterSent', true, 60*24*$this->days);
    }
}
