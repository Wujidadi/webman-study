<?php

use Webman\Route;

// API
Route::group('/api', function () {
    Route::get('', [app\controller\Api\IndexController::class, 'index']);
});

// Web
Route::get('/{path:.*}', [app\controller\Web\IndexController::class, 'index']);

Route::disableDefaultRoute();