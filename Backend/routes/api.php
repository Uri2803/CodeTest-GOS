<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;

Route::get('/scores/{sbd}', [ScoreController::class, 'searchBySbd']);

Route::get('/report/score-distribution', [ScoreController::class, 'scoreDistribution']);



Route::get('/top-students/{block}', [ScoreController::class, 'topStudentsByBlock']);
Route::get('/', function () {
    return 'API is working';
});