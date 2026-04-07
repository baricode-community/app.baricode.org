<?php

use App\Http\Controllers\Api\General\TimelineController;
use App\MCP\PlatformMcpServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Mcp\Facades\Mcp;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// MCP Server
Mcp::web('/mcp', PlatformMcpServer::class);

// Timeline Routes
Route::controller(TimelineController::class)
    ->prefix('timelines')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{timeline}', 'show');
    });
