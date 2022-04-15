<?php namespace Aliakbar\UrlShortener\Facades;

use Aliakbar\UrlShortener\Helper\View;

class ViewLoader {

    public static function __callStatic($method, $params)
    {
        $instance = View::class;
        $class    = new $instance;
        return $class->$method(...array_values($params));
    }

}


