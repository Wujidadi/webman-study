<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Webman\Route;

Route::group('/api', function () {
    Route::any('', function ($request) {
        return redirect('/api/');
    });
    Route::any('/{path:.*}', function ($request, $path) {
        return 'Here is the domain for API, but the path is ' . $path;
    });
});

Route::any('/{path:.*}', function ($request, $path) {
    return response($path . ', ' . $request->input('id'));
});

Route::disableDefaultRoute();