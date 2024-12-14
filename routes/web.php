<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
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
    return view('auth.login');
})->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

    Route::middleware(['auth','check.user.type:admin'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('books', BookController::class)->middleware(['auth','check.user.type:admin']);
    Route::get('grades-by-term/{termId}', [BookController::class, 'getGradesByTerm'])->name('grades.by.term');
    Route::get('grades-by-stage/{stageId}', [BookController::class, 'getGradesByStage'])->name('grades.by.stage');
    Route::get('grades-by-term-stage/{termId}/{stageId}', [BookController::class, 'getGradesByTermAndStage'])->name('grades.by.term.stage');



require __DIR__.'/auth.php';
