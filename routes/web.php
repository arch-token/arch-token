<?php

use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\CustomerRelationshipExecutiveController;
use App\Http\Controllers\TokenController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('receptionist/create', [ReceptionistController::class, 'create'])->name('receptionist.create');
Route::post('receptionist/store', [ReceptionistController::class, 'store'])->name('receptionist.store');

Route::get('cre', [CustomerRelationshipExecutiveController::class, 'index'])->name('cre.index');
Route::post('cre/call/{id}', [CustomerRelationshipExecutiveController::class, 'callToken'])->name('cre.call');
Route::post('cre/finish/{id}', [CustomerRelationshipExecutiveController::class, 'finishToken'])->name('cre.finish');

// Define the print route for receptionist
Route::get('receptionist/print/{id}', [ReceptionistController::class, 'printToken'])->name('receptionist.print');
Route::get('reception/display', [ReceptionistController::class, 'display'])->name('reception.display');
Route::post('/api/call-token/{id}', [TokenController::class, 'callToken']);
Route::get('/api/current-token', [TokenController::class, 'currentToken']);
Route::post('/api/reset-tokens', [TokenController::class, 'resetTokens']);