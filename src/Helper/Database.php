<?php namespace Aliakbar\UrlShortener\Helper;


class Database {

    protected $pdo;

    protected $table;

    public function __construct()
    {
				$DB_HOST     = getenv('DB_HOST');
				$DB_DATABASE = getenv('DB_DATABASE');
				$DB_USERNAME = getenv('DB_USERNAME');
				$DB_PASSWORD = getenv('DB_PASSWORD');

        try {
            $this->pdo = new \PDO("mysql:host={$DB_HOST};dbname={$DB_DATABASE};charset=utf8",$DB_USERNAME , $DB_PASSWORD);

        } catch (\Exception $e) {
           die('Error : ' . $e->getMessage());
        }
    }


		public function select()
    {
        # code...
    }
}

