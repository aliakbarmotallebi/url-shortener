<?php namespace Aliakbar\UrlShortener\Facades;

use Aliakbar\UrlShortener\Lib\Cache;

class FileCache {

    public static function __callStatic($method, $params)
    {
        $instance = Cache::class;
        $class    = new $instance;
        return $class->$method(...array_values($params));
    }

}
