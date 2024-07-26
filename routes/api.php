<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

Route::post('/call-token/{id}', [TokenController::class, 'callToken']);
Route::get('/current-token', [TokenController::class, 'currentToken']);
