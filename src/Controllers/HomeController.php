<?php namespace Aliakbar\UrlShortener\Controllers;

use Aliakbar\UrlShortener\Controllers\AbstractController;

class HomeController extends AbstractController{

  public function index()
  {
    $this->renderView("index.html.php");
  }

  public function logout()
  {
    auth()->logout();
    return $this->redirectToRoute(route('index'));
  }
}
