<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ping', function() {
    return [
        "message" => "Hello Rizki Adrian"
    ];
});
