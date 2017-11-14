<?php

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
    request()->headers->set('Referer', 'https://gist.github.com/adamwathan/513d476de6c5d6213c0cd9c62f4ac154');

    $referrer = request()->headers->get('Referer');
    $gist = '';

    if (isset($referrer) && starts_with($referrer, 'https://gist.github.com/')) {
        // TODO: replace with proper regex
        $gist = str_after($referrer, 'https://gist.github.com/');
        $gist = str_after($gist, '/');
        $gist = str_before($gist, '/');
    }

    return view('welcome', ['gistId' => $gist]);
});
