<?php

use App\Models\Cooperative;
use App\Models\CooperativeMember;
use App\Models\Education;
use App\Models\Job;
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
    return redirect()->route('religion.index');
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

// Job Route
Route::prefix('job')->name('job.')->group(function () {
    Route::get('/', function () {
        $page_title = 'Job';
        return view('job.index', compact('page_title'));
    })->name('index');

    Route::get('/create', function () {
        $page_title = 'Create Job';
        return view('job.create', compact('page_title'));
    })->name('create');

    Route::get('/edit/{id}', function ($id) {
        $page_title = 'Edit Job';
        $job = Job::findOrFail($id);
        return view('job.edit', compact('job', 'page_title'));
    })->name('edit');
});

// Cooperative Route
Route::prefix('cooperative')->name('cooperative.')->group(function () {
    Route::get('/', function () {
        $page_title = 'Cooperative';
        return view('cooperative.index', compact('page_title'));
    })->name('index');

    Route::get('/create', function () {
        $page_title = 'Create Cooperative';
        return view('cooperative.create', compact('page_title'));
    })->name('create');

    Route::get('/edit/{id}', function ($id) {
        $page_title = 'Edit Cooperative';
        $cooperative = Cooperative::findOrFail($id);
        return view('cooperative.edit', compact('cooperative', 'page_title'));
    })->name('edit');
});

// Cooperative Member Route
Route::prefix('cooperative-member')->name('cooperative-member.')->group(function () {
    Route::get('/', function () {
        $page_title = 'Cooperative Member';
        return view('cooperative-member.index', compact('page_title'));
    })->name('index');

    Route::get('/create', function () {
        $data['page_title'] = 'Create Cooperative Member';
        $data['educations'] = Education::get();
        $data['jobs'] = Job::get();
        $data['religions'] = Religion::get();
        $data['cooperatives'] = Cooperative::get();
        return view('cooperative-member.create', $data);
    })->name('create');

    Route::get('/edit/{id}', function ($id) {
        $data['page_title'] = 'Edit Cooperative';
        $data['educations'] = Education::get();
        $data['jobs'] = Job::get();
        $data['religions'] = Religion::get();
        $data['cooperatives'] = Cooperative::get();
        $data['cooperativeMember'] = CooperativeMember::findOrFail($id);
        return view('cooperative-member.edit', $data);
    })->name('edit');
});
