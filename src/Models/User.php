<?php namespace Aliakbar\UrlShortener\Models;

use Aliakbar\UrlShortener\Helper\Database;

class User extends Database {

    protected $table = "users";

    public $username;

    public $passcode;

    public function login(){
        return 'Logging in with a vengeange ...';
    }
}
