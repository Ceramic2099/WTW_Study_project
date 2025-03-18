<?php

namespace App\Jobs;

use App\Models\Film;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Support\Import\AcademyCommentsRepository;

use App\Services\FilmService;
use App\Support\Import\AcademyFilmsRepository;

class UpdateComments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Film::select('*')->chunk(1000, function ($films) {
            /** @var Film $film */
            // dd($films);
            
            foreach ($films as $film) {
                GetComments::dispatch($film);
            }
        });
    }
}
