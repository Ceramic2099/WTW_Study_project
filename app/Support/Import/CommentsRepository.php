<?php

namespace App\Support\Import;

use Illuminate\Support\Collection;

interface CommentsRepository
{
    /**
     * Получение комментариев к фильму.
     *
     * @param string $imdbId
     * @return Collection|null
     */
    public function getComments(string $imdbId): ?Collection;
}
