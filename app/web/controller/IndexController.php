<?php

namespace app\web\controller;

use support\Request;
use support\Response;

class IndexController
{
    public function index(Request $request, string $path): Response
    {
        return view('index/view');
    }
}
