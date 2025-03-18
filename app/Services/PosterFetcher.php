<?php
namespace App\Services;

class PosterFetcher
{
    public function getPoster($name)
    {
        return 'https://place-hold.it/500?name=' . urlencode($name);
    }
}
