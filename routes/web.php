<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::view('/', 'demo');

Route::post('upload-file', function (Request $request) {
    $request->validate(['file' => 'required|file']);
    $request->file('file')->storeAs('/', $request->file('file')->getClientOriginalName());
    return back()->with('success', 'Your file was successfully uploaded');
})->name('file-upload');

Route::get('download-file/{file}', function (Request $request, $file) {
    return response()->streamDownload(function () use ($file) {
        fclose(tap(Storage::readStream($file), function ($stream) {
            fpassthru($stream);
        }));
    }, $file);
})->name('download-file');

Route::get('delete-file/{file}', function (Request $request, $file) {
    Storage::delete($file);
    return back()->with('success', 'Your file was successfully deleted');
})->name('delete-file');
