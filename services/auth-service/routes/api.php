<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::post('/auth/register', [AuthController::class, 'register']);

Route::get('/health', function () {
    try {
        DB::connection()->getPdo();
        $database = 'connected';
    } catch (\Exception $e) {
        $database = 'disconnected';
    }

    return response()->json([
        'success' => true,
        'data' => [
            'service'   => 'auth-service',
            'status'    => 'running',
            'database'  => $database,
            'timestamp' => now()->toIso8601String(),
        ],
        'message' => 'Service opérationnel',
    ]);
});