<?php namespace  Aliakbar\UrlShortener\Helper;


use  Aliakbar\UrlShortener\Contracts\RequestInterface;

class Request implements RequestInterface
{

    public function input($field, $post = true)
    {
        if ($this->isPost() && $post)
            return isset($_POST[$field]) ? $_POST[$field] : "";

        return isset($_GET[$field]) ? htmlspecialchars($_GET[$field]) : "";
    }

    public function has($field)
    {
        return (bool) !empty($this->input($field));
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

    public function ajax()
    {
        return $this->isXmlHttpRequest();
    }

    public function isXmlHttpRequest(): bool
    {
        return 'XMLHttpRequest' == ($_SERVER['X-Requested-With'] ?? null);
    }

}
