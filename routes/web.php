<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mimo/{mamba}/{jumbo}', function ($mamba, $jumbo) {
    return $mamba . ' ' . $jumbo;
});