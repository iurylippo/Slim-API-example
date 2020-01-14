<?php

namespace App\Controllers;

use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class ProductController
{
    public function getProducts(Request $request, Response $response, array $args) : Response
    {
        $response = $response->withJson([
            "message" => "Hello World"
        ]);

        return $response;
    }
}
