<?php

namespace support\middleware;

use support\constant\Response as ResCst;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class ApiFallback implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (str_starts_with($request->path(), '/api/')) {
            return json(ResCst::AJAX_404);
        }

        $response = $handler($request);

        return $response;
    }
}
