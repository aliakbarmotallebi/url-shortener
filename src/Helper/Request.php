<?php namespace  Aliakbar\UrlShortener\Helper;


use  Aliakbar\UrlShortener\Contracts\RequestInterface;

class Request implements RequestInterface
{

    public function input($filed, $post = true)
    {
        if ($this->isPost() && $post)
            return isset($_POST[$filed]) ? $_POST[$filed] : "";

        return isset($_GET[$filed]) ? htmlspecialchars($_GET[$filed]) : "";
    }

    public function all($post = true)
    {
        if ($this->isPost() && $post)
            return isset($_POST) ? $_POST : null;

        return isset($_GET) ?array_map('htmlspecialchars' , $_GET) : null;
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

}
