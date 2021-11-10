<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileManager;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/file-upload', [FileManager::class, 'createForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/upload-file', [FileManager::class, 'fileUpload'])->name('fileUpload');
Route::get('/delete{id}', [FileManager::class, 'deleteFile'])->name('delete');
Route::post('/search', [FileManager::class, 'searchFile'])->name('search');
