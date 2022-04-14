<?php namespace Aliakbar\UrlShortener\Controllers\Dashboard;

use Aliakbar\UrlShortener\Helper\View;
use Aliakbar\UrlShortener\Models\Link;

class LinkController extends View{

  public function index()
  {
    $links = (new Link())->latest()->get();
    $this->render("dashboard\index.html.php", compact('links'));
  }
}
