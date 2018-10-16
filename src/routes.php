<?php

Route::middleware(config('showcase.middleware', ['web', 'auth']))->group(function () {
    Route::get('showcase', function () {
        return redirect()->route('displays.index');
    });
    Route::resource('displays', 'Showcase\App\Http\Controllers\DisplayController');
    Route::resource('trophies', 'Showcase\App\Http\Controllers\TrophyController');
});
