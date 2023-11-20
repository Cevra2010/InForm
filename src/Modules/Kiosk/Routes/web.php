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

use Modules\Kiosk\Http\Controllers\DisplayController;
use Modules\Kiosk\Http\Controllers\PresentController;

Route::name("kiosk::")->prefix('/Kiosk')->group(function() {
    Route::get('/Kiosk/Present/{display}',[PresentController::class,'present'])->name("present");
    Route::middleware("define-area:display")->name("display.")->prefix('/Bildschirmverwaltung')->group(function() {
        Route::get('/Liste',[DisplayController::class,'list'])->name("list")->middleware("define-area:display.list");
        Route::get('/Bildschirm/{display}',[DisplayController::class,'edit'])->middleware("define-area:display.edit")->name("edit");
        Route::get('/Neuer-Bildschirm',[DisplayController::class,'create'])->middleware("define-area:display.create")->name("create");
        Route::get('/Build/{display}',[DisplayController::class,'displayBuilder'])->middleware("define-area:display.edit")->name("build");
    });
});
