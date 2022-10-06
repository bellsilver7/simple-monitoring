<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (\App\Services\UrlChecker $urlChecker) {
    $urls = \App\Models\Url::all();
    $urls->each(function($url) {
        event(new \App\Events\CheckSite($url->url));
    });
});
