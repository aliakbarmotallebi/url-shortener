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

    public function getOrignalURL(string $code)
    {
        $url = $this->find($code, 'code');
        if(!$url) return false;
        return $url;
    }

    public function generateCode($idOfRow = 5)
    {
        $idOfRow += 10000000;
        return base_convert($idOfRow, 10, 36);
    }
}
