<?php

Route::group([
    'middleware' => config('showcase.middleware', ['web', 'auth']),
    'prefix' => config('showcase.route_prefix', 'showcase'),
    'as' => config('showcase.route_prefix', 'showcase') . '_'
], function () {
    Route::get('/', function () {
        return redirect()->route('displays.index');
    })->name('home');
    Route::resource('displays', '\Showcase\App\Http\Controllers\DisplayController');
    Route::resource('trophies', '\Showcase\App\Http\Controllers\TrophyController');
});
