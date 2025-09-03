<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('users:update-states')->daily(); //everyMinute()

//crontab -e | * * * * * cd /home/carlos/Documentos/VS\ CODE/fitweblaravel && php artisan schedule:run >> /dev/null 2>&1 
// /usr/local/bin/ea-php81 /home/fitwebli/public_html/artisan schedule:run >> /dev/null 2>&1
