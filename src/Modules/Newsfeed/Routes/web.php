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

use Modules\Newsfeed\Http\Controllers\ArticleController;
use Modules\Newsfeed\Http\Controllers\NewsfeedController;

Route::middleware("define-area:newsfeed")->name("newsfeed::")->prefix("/Newsfeed")->group(function() {
    Route::get('/',[NewsfeedController::class,'index'])->name("index");
    Route::get('/Newsfeed/New',[NewsfeedController::class,'addNewsfeedForm'])->name("add-newsfeed")->middleware("define-area:newsfeed.create");
    Route::post('/Newsfeed/New',[NewsfeedController::class,'storeNewNewsfeed'])->name("add-newsfeed.store")->middleware("define-area:newsfeed.create");
    Route::get('/Newsfeed/{newsfeed}',[NewsfeedController::class,'showNewsfeedSettings'])->name("show");
    Route::get('/Newsfeed/{newsfeed}/Dashboard',[NewsfeedController::class,'showNewsfeedDashbaord'])->name("dashbaord");
    Route::post('/Newsfeed/{newsfeed}',[NewsfeedController::class,'updateSettings'])->name("update-settings");
    Route::get('/Article/New/{newsfeed}',[ArticleController::class,'createNewArticle'])->name("article.create");
    Route::post('/Article/Publish/{article}',[ArticleController::class,'publishArticle'])->name("article.publish");
    Route::get('/Article/Article-Editor/{article?}',[ArticleController::class,'showArticleEditor'])->name("article.editor");
    Route::post('/Article/Store/{article}',[ArticleController::class,'store'])->name("article.store");
});

