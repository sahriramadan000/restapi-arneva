<?php

use App\Models\Education;
use App\Models\Religion;
use Illuminate\Support\Facades\Route;

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
    return route('religion.index');
});

// Religion Route
Route::prefix('religion')->name('religion.')->group(function () {
    Route::get('/', function () {
        $page_title = 'Religion';
        return view('religion.index', compact('page_title'));
    })->name('index');

    Route::get('/create', function () {
        $page_title = 'Create Religion';
        return view('religion.create', compact('page_title'));
    })->name('create');

    Route::get('/edit/{id}', function ($id) {
        $page_title = 'Edit Religion';
        $religion = Religion::findOrFail($id);
        return view('religion.edit', compact('religion', 'page_title'));
    })->name('edit');
});

// Education Route
Route::prefix('education')->name('education.')->group(function () {
    Route::get('/', function () {
        $page_title = 'Education';
        return view('education.index', compact('page_title'));
    })->name('index');

    Route::get('/create', function () {
        $page_title = 'Create Education';
        return view('education.create', compact('page_title'));
    })->name('create');

    Route::get('/edit/{id}', function ($id) {
        $page_title = 'Edit Education';
        $education = Education::findOrFail($id);
        return view('education.edit', compact('education', 'page_title'));
    })->name('edit');
});
