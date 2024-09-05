<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExamCourseController;
use App\Http\Controllers\ExamGradeController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\fileUploadController;
use App\Http\Controllers\OlevelController;
use App\Http\Controllers\UtmeResultController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [Controller::class, 'login']);
Route::get('/exam-types', [ExamTypeController::class, 'index']);
Route::get('/exam-types/{id}', [ExamTypeController::class, 'show']);


// ---------------UTME ENDPOINTS

// ---------------UTME ENDPOINTS
Route::post('utme_login', [UtmeResultController::class, 'utme_login']);
Route::post('utme_create', [UtmeResultController::class, 'utme_create']);
Route::post('create_new_utme', [UtmeResultController::class, 'create_new_utme']);
Route::post('eligibility', [UtmeResultController::class, 'show']);
Route::get('get_single_utme_results/{reg_number}', [UtmeResultController::class, 'get']);
Route::post('update-utme/{reg_number}', [UtmeResultController::class, 'update']);
Route::post('update-utme-details/{reg_number}', [UtmeResultController::class, 'update_utme']);
Route::apiResource('olevel', OlevelController::class);
Route::put('olevel-update-1/{reg_number}', [OlevelController::class, 'update_ol1']);
Route::put('olevel-update-2/{reg_number}', [OlevelController::class, 'update_ol2']);
Route::apiResource('courses', ExamCourseController::class);
Route::apiResource('utme_results', UtmeResultController::class);


Route::apiResource('de_results', DeResultController::class);
Route::post('de_results/import', [DeResultController::class, 'import']);

Route::get('/exam-grades', [ExamGradeController::class, 'index']);
Route::get('/exam-grades/{id}', [ExamGradeController::class, 'show']);

// FILE UPLOAD APIS
Route::post('import/olevel', [OlevelController::class, 'import']);
Route::post('import/utme_results', [UtmeResultController::class, 'import']);
Route::post('/upload', [FileUploadController::class, 'upload'])->name('file.upload');
Route::post('/multi-upload', [FileUploadController::class, 'multiUpload']);

Route::get('/file/get/{filename}/{visibility?}', [FileUploadController::class, 'getFile'])->name('file.get');