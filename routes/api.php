<?php

use App\Http\Controllers\Api\General\TimelineController;
use App\Http\Controllers\Api\LMS\CourseController;
use App\MCP\PlatformMcpServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Mcp\Facades\Mcp;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// MCP Server
Mcp::web('/mcp', PlatformMcpServer::class);

// LMS Routes
Route::controller(CourseController::class)
    ->prefix('courses')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{course}', 'show');
    });

// Timeline Routes
Route::controller(TimelineController::class)
    ->prefix('timelines')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{timeline}', 'show');
    });
