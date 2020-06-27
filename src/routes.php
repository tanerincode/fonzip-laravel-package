<?php

use Illuminate\Support\Facades\Route;

/**
 * ATTENTION : DO NOT CHANGE THIS ROUTES
 *
 * If you using any authorization, close route share options.
 * if you can't see route share option in your app config please running `php artisan vendor:publish` and select `fonzip` config file
 *
 * ps : This route just be running default controller of package. if you need any changes please contact me <tombastaner@gmail.com>.
 * */




Route::get('/payment-screen', 'FonzipController@showPaymentForm');
Route::post('/send-payment', 'FonzipController@sendPayment');
