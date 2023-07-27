<?php

namespace app\controller\Api;

use support\Request;
use support\Response;

class IndexController
{
    public function index(Request $request): Response
    {
        if ($request->method() == 'GET') {
            return response('API')->header('Content-Type', 'text/plain');
        }
        return response(status: 404);
    }
}