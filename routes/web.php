<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoreController;


Route::get('/', [CoreController::class, 'index']);
Route::get('cores/{core}/restore',[CoreController::class, 'restore'])->name("cores.restore");
Route::resource('cores',CoreController::class);
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');