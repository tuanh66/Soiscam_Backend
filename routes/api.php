<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Admin
Route::post('/admin/login', [UserController::class, 'login']);
Route::get('/admin/check-token', [UserController::class, 'checkToken']);
Route::get('/admin/data-report-approve-0', [ReportController::class, 'dataReportApprove0'])->middleware('userMiddle');
Route::get('/admin/data-report-approve-1', [ReportController::class, 'dataReportApprove1'])->middleware('userMiddle');
Route::post('/admin/update-report-approve-1', [ReportController::class, 'updateApprove'])->middleware('userMiddle');
Route::post('/admin/delete-report', [ReportController::class, 'deleteReport'])->middleware('userMiddle');

// Client
Route::get('/client/data-report-today', [ReportController::class, 'dataReportToday']);
Route::get('/client/data-report-all', [ReportController::class, 'dataReportAll']);
Route::post('/client/create-report-approve-0', [ReportController::class, 'createReport']);
