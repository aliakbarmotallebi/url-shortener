<?php namespace Aliakbar\UrlShortener\Controllers\Dashboard;

use Aliakbar\UrlShortener\Controllers\AbstractController;

class DashboardController extends AbstractController{

  public function __construct()
  {

    if(! auth()->check() ){

      return $this->redirectToRoute(route('auth.index'));
    }

  }

}
