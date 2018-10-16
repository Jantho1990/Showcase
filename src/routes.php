<?php

Route::group([
    'middleware' => config('showcase.middleware', ['web', 'auth']),
    'prefix' => config('showcase.route_prefix', 'showcase'),
    'as' => config('showcase.route_prefix', 'showcase') . '.'
], function () {
    Route::get('/', function () {
        return redirect()->route('showcase.displays.index');
    })->name('home');
    Route::resource('displays', '\Showcase\App\Http\Controllers\DisplayController');
    Route::resource('trophies', '\Showcase\App\Http\Controllers\TrophyController');
});
