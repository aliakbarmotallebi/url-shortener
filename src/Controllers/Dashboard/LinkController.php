<?php namespace Aliakbar\UrlShortener\Controllers\Dashboard;

use Aliakbar\UrlShortener\Controllers\AbstractController;
use Aliakbar\UrlShortener\Models\Link;

class LinkController extends AbstractController{

  public function __construct()
  {
    if( !auth()->check() ){
      return $this->redirectToRoute(route('auth.index'));
    }

  }

  public function index()
  {
    $links = (new Link())->latest()->get();
    $this->renderView("dashboard\index.html.php", compact('links'));
  }

  public function delete($param)
	{
      try{
          (new Link)->delete($param->id);
          return redirect(route('dashboard.links.index'));

      }catch(\Exception $e){}
	}
}
