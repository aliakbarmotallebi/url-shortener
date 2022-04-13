<?php namespace Aliakbar\UrlShortener\Controllers\Auth;

use Aliakbar\UrlShortener\Helper\View;
use Aliakbar\UrlShortener\Models\User;

class LoginController extends View{

  public function index()
  {
    $this->render("auth\login.html.php");
  }
}
