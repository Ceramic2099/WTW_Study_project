<?php

namespace App\Http\Controllers;

use App\Http\Responses\Success;
use App\Models\Show;
use App\Services\PosterFetcher;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Show $show
     * @return Success
     */
    public function show(Show $show, PosterFetcher $fetcher)
    {
        $name = $fetcher->getPoster($show->title);

        return $this->success($show);
    }

    public function request(AddShowRequest $request)
    {
        AddShow::dispatch($request->imdb);

        return $this->success(null, 201);

        
    }

}
