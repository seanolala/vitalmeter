<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| APIs for user's meters.
|--------------------------------------------------------------------------
|
*/
Route::group(array('prefix' => '/meter'), function() {
    Route::resource('glucose', 'Meter\GlucoseMeterController');
});



/*
|--------------------------------------------------------------------------
| APIs for user's vital record.
|--------------------------------------------------------------------------
|
*/
Route::group(array('prefix' => '/vital'), function() {
    Route::resource('glucose', 'Vital\GlucoseVitalController');
});