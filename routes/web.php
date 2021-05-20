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

Route::get('/', 'PollController@index');
Route::post('poll-submission', 'PollController@pollSubmission')->name('poll.submission');
Route::get('poll-result/{trx}', 'PollController@pollResult')->name('poll.result');
