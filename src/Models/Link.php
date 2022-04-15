<?php namespace Aliakbar\UrlShortener\Models;

use Aliakbar\UrlShortener\Helper\Database;

class Link extends Database {

    protected $table = "links";

    public $id;

    public $url;

    public $code;

    public $created_at;


    public function getUrlShort()
    {
        return url($this->code);
    }
}
