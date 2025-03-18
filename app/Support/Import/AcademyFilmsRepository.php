<?php


namespace App\Support\Import;

use App\Models\Film;
use Illuminate\Support\Facades\Http;

class AcademyFilmsRepository implements FilmsRepository
{
    /**
     * @inheritDoc
     */
    public function getFilm(string $imdbId)
    {
        $response = Http::get(config('services.academy.films.url') . '/' . $imdbId);
        $data = json_decode($response->body(), true);
  
        if ($response->clientError()) {
            dd($response->clientError());
            return null;
        }

        $film = Film::firstOrNew(['imdb_id' => $imdbId]);

        $film->fill([
            'name' => $data['name'],
            'description' => $data['description'],
            'director' => $data['director'],
            'starring' => $data['starring'],
            'run_time' => $data['runTime'],
            'released' => $data['released'],
        ]);

        $links = [
            'poster_image' => $data['posterImage'],
            'preview_image' => $data['previewImage'],
            'background_image' => $data['backgroundImage'],
            'video_link' => $data['videoLink'],
            'preview_video_link' => $data['previewVideoLink'],
        ];

        return [
            'film' => $film,
            'genres' => $data['genre'],
            'links' => $links,
        ];
    }
}
