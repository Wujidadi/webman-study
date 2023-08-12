<?php

namespace app\api\controller;

use support\Request;
use support\Response;

class IndexController
{
    public function index(Request $request): Response
    {
        return response('API')->header('Content-Type', 'text/plain');
    }
}
