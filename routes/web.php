<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadFile;


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
})->name('welcome');

// Route::get('upload-file', function () {
//     $response = \Storage::disk('google')->download('google-drive.txt');
//     $response->send();

//     dd('Đã upload file lên google drive thành công!');
// });

Route::post('upload-file', [UploadFile::class, 'uploadFile'])->name('upload');
Route::get('get-list-file', [UploadFile::class, 'getListFile'])->name('get-list-file');
Route::get('download/{name}', [UploadFile::class, 'downloadFile'])->name('download');
Route::get('delete/{name}', [UploadFile::class, 'removeFile'])->name('delete');


