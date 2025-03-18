<?php

namespace Tests\Unit;

use App\Services\PosterFetcher;
use PHPUnit\Framework\TestCase;

class PosterFetcherTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_fetcher()
    {
        $fetcher = new PosterFetcher;
        $url = $fetcher->getPoster('The Departed');

        $this->assertIsString($url);

        $arr = getimagesize($url);
        $this->assertIsArray($arr);
    }
}
