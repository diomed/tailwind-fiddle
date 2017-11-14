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
