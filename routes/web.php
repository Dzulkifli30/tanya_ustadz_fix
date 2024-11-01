<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dash.admin');
    } else {
        return redirect()->route('content.index');
    }
})->name('welcome');

Route::get('/detail/{id}', [ContentController::class, 'show'])->name('content.show');

Route::get('/home', [ContentController::class, 'index'])->name('content.index');

Route::get('/tanya', [ContentController::class, 'create'])->name('content.create');

Route::post('/tanya/store', [ContentController::class, 'store'])->name('content.store');

Route::get('/search', [ContentController::class, 'search'])->name('content.search');

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dash-admin', [HomeController::class, 'admin'])->name('dash.admin');
    Route::post('/dash-admin/add-user', [HomeController::class, 'addUser'])->name('add.ustadz');
    Route::delete('/dash-admin/delete/{id}', [HomeController::class, 'destroy'])->name('ustadz.destroy');
});

Route::group(['middleware' => ['role:ustadz']], function () {
    Route::get('/dash-ustadz', [HomeController::class, 'ustadz'])->name('dash.ustadz');
    Route::get('/jawab/{id}', [ContentController::class, 'jawab'])->name('content.jawab');
    Route::post('/submit-jawaban', [ContentController::class, 'kirimJawaban'])->name('kirim.jawaban');
    Route::post('/update-user', [HomeController::class, 'updateUser'])->name('ustadz.update');
});
