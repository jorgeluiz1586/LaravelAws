<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::post('image/upload', function (Request $request) {
    try {
        $request->file->storeAs('example', $request->file->getClientOriginalName(), 's3');
        return response(["message" => "Arquivo armazenado com sucesso"], 200);
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }
});
