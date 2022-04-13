<?php namespace Aliakbar\UrlShortener\Controllers\Auth;

use Aliakbar\UrlShortener\Helper\View;

class LoginController extends View{

  public function index()
  {
    $this->render("auth\login.html.php");
  }
}
