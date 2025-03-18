<?php


namespace App\Support\Import;

use App\Models\Comment;
use App\Models\Film;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AcademyCommentsRepository implements CommentsRepository
{

    /**
     * @inheritDoc
     */
    public function getComments(string $imdbId): ?Collection
    {
        $data = Http::get(config('services.academy.comments.url') . '/' . $imdbId);
        // $data = json_decode($response->body(), true);
        
        if ($data->clientError()) {
            return null;
        }
        
        return $data->collect()->map(function ($value) {
            return Comment::firstOrNew([
                'text' => $value['comment'],
                'created_at' => Carbon::parse($value['date'])->toDateTimeString(),
            ]);
        });
    }
}