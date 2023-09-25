<?php

use App\Http\Controllers\Backend\GroupController;
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
    return view('kiosk.home');
});

Route::get('/', function () {
    return view('layouts.start.start');
});


/** Auth */
Route::get('/LOGIN',function() {
    return redirect()->route("auth.login");
})->name("login");
Route::name("auth.")->group(function() {
    Route::get('/Anmelden',[\App\Http\Controllers\Auth\LoginController::class,'index'])->name("login");
    Route::post('/Anmelden',[\App\Http\Controllers\Auth\LoginController::class,'submit'])->name("login.submit");
});

Route::get('/Present/{display}',[\App\Http\Controllers\PresentController::class,'present'])->name("present");

/** Verwaltung */
Route::name("backend.")->prefix("/Verwaltung")->middleware("auth")->group(function() {

    // Dashboard
    Route::get("/",[\App\Http\Controllers\Backend\DashboardController::class,'index'])->name("dashboard");

    // User
    Route::middleware("define-area:user")->name("user.")->prefix("/Kontenverwaltung")->group(function() {
        Route::get("/Kontenliste",[\App\Http\Controllers\Backend\UserController::class,'list'])->name("list")->middleware("define-area:user.list");
        Route::get('/Konto/{user}',[\App\Http\Controllers\Backend\UserController::class,'show'])->name("show")->middleware("define-area:user.show");
        Route::get('/Neues-Konto-Erstellen',[\App\Http\Controllers\Backend\UserController::class,'createUser'])->name("create-user")->middleware("define-area:user.create");
        Route::post('/Neues-Konto-Erstellen',[\App\Http\Controllers\Backend\UserController::class,'storeUser'])->name("store.create-user")->middleware("define-area:user.create");
        Route::post('/Konto/{user}/Stammdaten',[\App\Http\Controllers\Backend\UserController::class,'storeData'])->name("store.data")->middleware("define-area:user.edit.data");
        Route::post('/Konto/{user}/Passwort',[\App\Http\Controllers\Backend\UserController::class,'storePassword'])->name("store.password")->middleware("define-area:user.edit.password");
        Route::post('/Konto-Loeschen/{user}',[\App\Http\Controllers\Backend\UserController::class,'deleteUser'])->name("delete")->middleware("define-area:user.edit.delete");

        // Benutzerrollen
        Route::middleware("define-area:user.roles")->name("roles.")->prefix("/Rollenverwaltung")->group(function() {
            Route::get('/Liste',[\App\Http\Controllers\Backend\RoleController::class,'list'])->name("list");
            Route::get('/Rolle/{role}',[\App\Http\Controllers\Backend\RoleController::class,'show'])->name("show");
            Route::get('/Neue-Rolle',[\App\Http\Controllers\Backend\RoleController::class,'create'])->name("create");
            Route::post('/Neue-Rolle',[\App\Http\Controllers\Backend\RoleController::class,'store'])->name("store");
        });
    });

    // Benutzergruppen
    Route::middleware("define-area:group")->name("group.")->prefix('/Benutzergruppenverwaltung')->group(function() {
        Route::get('/Neue-Benutzergruppe',[GroupController::class,'showCreateGroupForm'])->name("create")->middleware("define-area:group.create");
        Route::get('/Benutzergruppe/Bearbeiten/{group}',[GroupController::class,'showEditGroupForm'])->name("edit")->middleware("define-area:group.edit");
        Route::post('/Benutzergruppe/Bearbeiten/{group}',[GroupController::class,'updateGroup'])->name("update")->middleware("define-area:group.edit");
        Route::post('/Neue-Benutzergruppe',[GroupController::class,'storeNewGroup'])->name("store")->middleware("define-area:group.create");
        Route::get('/Benutzergruppe',[GroupController::class,'showUserGroupsList'])->name("index");
    });

    // Module
    Route::middleware("define-area:modules")->name("modules.")->prefix('/Modulverwaltung')->group(function() {
        Route::get('/Modulliste',[\App\Http\Controllers\Backend\ModuleController::class,'list'])->name("list");
        Route::get('/Modul/{module}',[\App\Http\Controllers\Backend\ModuleController::class,'show'])->name("show");
    });

    // Display
    Route::middleware("define-area:display")->name("display.")->prefix('/Bildschirmverwaltung')->group(function() {
        Route::get('/Liste',[\App\Http\Controllers\Backend\DisplayController::class,'list'])->name("list")->middleware("define-area:display.list");
        Route::get('/Bildschirm/{display}',[\App\Http\Controllers\Backend\DisplayController::class,'edit'])->middleware("define-area:display.edit")->name("edit");
        Route::get('/Neuer-Bildschirm',[\App\Http\Controllers\Backend\DisplayController::class,'create'])->middleware("define-area:display.create")->name("create");
        Route::get('/Build/{display}',[\App\Http\Controllers\Backend\DisplayController::class,'displayBuilder'])->middleware("define-area:display.edit")->name("build");
    });
});

