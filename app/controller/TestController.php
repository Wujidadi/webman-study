<?php

namespace app\controller;

use support\Request;

class TestController
{
    public function index(Request $request)
    {
        return response(config('app.name'));
    }
}