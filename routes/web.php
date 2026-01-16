<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('/time', function () {
    return date('Y-m-d H:i:s', time());
});

Route::get('/opcache', function () {
    return opcache_get_status();
});
