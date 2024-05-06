<?php

use App\Http\Controllers\Api\CooperativeController;
use App\Http\Controllers\Api\CooperativeMemberController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ReligionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Education Endpoint
Route::get('getEducation', [EducationController::class, 'getEducation']);
Route::post('storeEducation', [EducationController::class, 'store']);
Route::patch('updateEducation/{id}', [EducationController::class, 'update']);
Route::delete('deleteEducation/{id}', [EducationController::class, 'destroy']);

// Religion Endpoint
Route::get('getReligion', [ReligionController::class, 'getReligion']);
Route::post('storeReligion', [ReligionController::class, 'store']);
Route::patch('updateReligion/{id}', [ReligionController::class, 'update']);
Route::delete('deleteReligion/{id}', [ReligionController::class, 'destroy']);

// Job Endpoint
Route::get('getJob', [JobController::class, 'getJob']);
Route::post('storeJob', [JobController::class, 'store']);
Route::patch('updateJob/{id}', [JobController::class, 'update']);
Route::delete('deleteJob/{id}', [JobController::class, 'destroy']);

// Cooperative Endpoint
Route::get('getCooperative', [CooperativeController::class, 'getCooperative']);
Route::post('storeCooperative', [CooperativeController::class, 'store']);
Route::patch('updateCooperative/{id}', [CooperativeController::class, 'update']);
Route::delete('deleteCooperative/{id}', [CooperativeController::class, 'destroy']);

// Cooperative Member Endpoint
Route::get('getCooperativeMember', [CooperativeMemberController::class, 'getCooperativeMember']);
Route::post('storeCooperativeMember', [CooperativeMemberController::class, 'store']);
Route::patch('updateCooperativeMember/{id}', [CooperativeMemberController::class, 'update']);
Route::delete('deleteCooperativeMember/{id}', [CooperativeMemberController::class, 'destroy']);
