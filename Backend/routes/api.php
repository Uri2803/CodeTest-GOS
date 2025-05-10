<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;

Route::get('/scores/{sbd}', [ScoreController::class, 'searchBySbd']);

Route::get('/example', function () {
    return response()->json(['message' => 'Hello, API!']);
});
