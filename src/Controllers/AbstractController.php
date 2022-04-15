<?php namespace Aliakbar\UrlShortener\Controllers;

use Aliakbar\UrlShortener\Facades\ViewLoader;

abstract class AbstractController {

    protected function renderView(string $view, array $parameters = [])
    {
        return ViewLoader::render($view, $parameters);
    }

    protected function json($data = [], int $status = 200)
    {
        return json_response($data, $status);
    }

    protected function redirectToRoute(string $route = "index")
    {
        return redirect($route);
    }

}
