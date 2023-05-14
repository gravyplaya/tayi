<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ChatApiController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
   
Route::middleware('auth:api')->group( function () {
    Route::get('all_framework_chats', [ChatApiController::class, 'all_framework_chats']);
    Route::post('open_framework_chat', [ChatApiController::class, 'open_framework_chat']);
    Route::post('chat_completions', [ChatApiController::class, 'chat_completions']);

    Route::post('audio_to_text', [ChatApiController::class, 'audio_to_text']);
});