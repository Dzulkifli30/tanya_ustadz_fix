<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/detail/{id}', [ContentController::class, 'show'])->name('content.show');

Route::get('/', [ContentController::class, 'index'])->name('content.index');

Route::get('/tanya', [ContentController::class, 'create'])->name('content.create');

Route::post('/tanya/store', [ContentController::class, 'store'])->name('content.store');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dash-admin', [HomeController::class, 'admin'])->name('dash.admin');
    Route::post('/dash-admin/add-user', [HomeController::class, 'addUser'])->name('add.ustadz');
});

Route::group(['middleware' => ['role:ustadz']], function () {
    Route::get('/dash-ustadz', [HomeController::class, 'ustadz'])->name('dash.ustadz');
    Route::get('/jawab/{id}', [ContentController::class, 'jawab'])->name('content.jawab');
    Route::post('/submit-jawaban', [ContentController::class, 'kirimJawaban'])->name('kirim.jawaban');
});
