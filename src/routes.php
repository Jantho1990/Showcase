<?php

Route::group([
    'middleware' => config('showcase.middleware', ['web', 'auth']),
    'prefix' => 'showcase'
], function () {
    Route::get('/', function () {
        return redirect()->route('displays.index');
    })->name('showcase');
    Route::resource('displays', '\Showcase\App\Http\Controllers\DisplayController');
    Route::resource('trophies', '\Showcase\App\Http\Controllers\TrophyController');
});
