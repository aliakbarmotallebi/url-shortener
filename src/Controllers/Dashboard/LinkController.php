<?php namespace Aliakbar\UrlShortener\Controllers\Dashboard;

use Aliakbar\UrlShortener\Controllers\AbstractController;
use Aliakbar\UrlShortener\Facades\FileCache;
use Aliakbar\UrlShortener\Models\Link;

class LinkController extends AbstractController{

  protected $cacheName = 'list_links';

  public function __construct()
  {
    if( !auth()->check() ){
      return $this->redirectToRoute(route('auth.index'));
    }
  }

  public function index()
  {
    $links = FileCache::remember($this->cacheName, 3600, function (){
        return (new Link())->latest()->get();
    });

    $this->renderView("dashboard\index.html.php", compact('links'));
  }

  public function store()
	{
      if(! request()->isPost()){
          return false;
      }

      if(request()->has('url') && preg_match('|^https?://|', request('url')))
      {
        $link = (new Link);
        $link->create( array_merge(
                request()->all(),
                [
                  'code' => $link->generateCode(),
                  'user_id' => auth()->user()->id
                ]
            )
        );
      }

      FileCache::delete($this->cacheName);
      return $this->redirectToRoute(route('dashboard.links.index'));
  }

  public function delete($param)
	{
      try{
          (new Link)->delete($param->id);
          FileCache::delete($this->cacheName);
      }catch(\Exception $e){}

      return $this->redirectToRoute(route('dashboard.links.index'));
	}
}
