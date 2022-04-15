<?php namespace Aliakbar\UrlShortener\Controllers;

use Aliakbar\UrlShortener\Controllers\AbstractController;
use Aliakbar\UrlShortener\Lib\Cache;
use Aliakbar\UrlShortener\Models\Link;

class HomeController extends AbstractController{

  public function index()
  {
    return $this->renderView('index.html.php');
  }

  public function getShortURL($param)
  {
    $orignalUrl = (new Link)->getOrignalURL($param->code);

    if($orignalUrl)
      die(header("Location: {$orignalUrl->url}"));

    return $this->redirectToRoute(route('dashbaord.links.index'));
  }

  public function logout()
  {
    auth()->logout();
    return $this->redirectToRoute(route('index'));
  }
}
