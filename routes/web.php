<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    dd(1);
    return view('welcome');
});
Route::get('/sd', function () {
    $dl = new \Download($url = "https://www.youtube.com/watch?v=ye5BuYf8q4o", $format = "mp3", $download_path = "music" );

    //Saves the file to specified directory
    $media_info = $dl->download();
    $media_info = $media_info->first();

    // Return as a download
    return response()->download($media_info['file']->getPathname());

});
