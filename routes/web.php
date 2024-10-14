<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPdf\Enums\Format;
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
// use Spatie\LaravelPdf\Facades\Pdf;
// Route::get('/pdf', function () {
//     Pdf::html('<h1>Hello world!!</h1>')->format(Format::A4)->save('/some/directory/invoice.pdf');
//     return "test";
// });
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/pdf', function () {
    $pdf = Pdf::loadView('pdf.invoice');
     $pdf->download('invoice.pdf');
    return "pass";
});
Route::get('/excel', [ProfileController::class, 'export']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
