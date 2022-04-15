<?php namespace Aliakbar\UrlShortener\Controllers;

use Aliakbar\UrlShortener\Helper\View;

abstract class AbstractController {

    protected function renderView(string $view, array $parameters = [])
    {
        return (new View)->render($view, $parameters);
    }

    protected function json($data = [], int $status = 200)
    {
        return json_response($data, $status);
    }

    protected function redirectToRoute(string $route)
    {
        return redirect($route);
    }

}
