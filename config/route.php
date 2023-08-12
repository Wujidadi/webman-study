<?php

use support\constant\Response as ResCst;
use support\Request;
use Webman\Route;

Route::fallback(function (Request $request) {
    return json(ResCst::AJAX_404);
});

// API
Route::group('/api', function () {
    Route::get('', [app\api\controller\IndexController::class, 'index']);
    // Route::get('ooo', [app\api\controller\IndexController::class, 'ooo']);
});

// Web
Route::get('/{path:.*}', [app\web\controller\IndexController::class, 'index']);

Route::disableDefaultRoute();
