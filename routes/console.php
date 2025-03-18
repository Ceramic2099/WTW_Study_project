<?php

use App\Jobs\UpdateComments;
use App\Jobs\UpdateFilms;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::job(new UpdateFilms)->everyMinute();
Schedule::job(new UpdateComments)->everyMinute();