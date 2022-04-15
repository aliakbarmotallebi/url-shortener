<?php namespace Aliakbar\UrlShortener\Models;

use Aliakbar\UrlShortener\Helper\Database;
use Aliakbar\UrlShortener\Traits\Authentication;

class User extends Database {

    use Authentication;

    protected $table = "users";

    public $id;

    public $username;

    public $passcode;
}
