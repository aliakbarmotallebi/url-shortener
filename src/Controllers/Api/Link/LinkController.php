<?php namespace Aliakbar\UrlShortener\Controllers\Api\Link;

use Aliakbar\UrlShortener\Controllers\Api\ApiController;
use Aliakbar\UrlShortener\Facades\FileCache;
use Aliakbar\UrlShortener\Lib\JWTAuth;
use Aliakbar\UrlShortener\Models\Link;

class LinkController extends ApiController{

  protected $cacheKey = 'list_links';

  public function __construct()
  {
      if( !JWTAuth::checkAuth() ){
        exit($this->error(
          'Unauthorized',
          500));
      }
  }

  public function index()
  {
    $links = FileCache::remember($this->cacheKey, 3600, function (){
        return (new Link())->latest()->toArray()->get();
    });

    return $this->success($links);
  }


  public function store()
  {
    if(! request()->isPost()){
      return false;
    }

    if( !request()->has('url') ||
        !preg_match('|^https?://|', request('url')))
    {
      return $this->error('Invalid address', 403);
    }

      $link = (new Link);
      $data = array_merge(
          request()->all(),
          [
            'code' => $link->generateCode(),
            'user_id' => 1
          ]
      );

      $result = $link->create($data);

      if( !$result ){
        return $this->error('Problem saving', 500);
      }

      FileCache::delete($this->cacheKey);
      return $this->success($data, 'Created successfully', 201);

  }

  public function update($param)
	{
      if(! request()->isPost()){
        return false;
      }

      if( !request()->has('url') ||
      !preg_match('|^https?://|', request('url')))
      {
        return $this->error('Invalid address', 403);
      }

      try{
          (new Link)->update($param->id, [
            'url' => request('url')
          ]);

          FileCache::delete($this->cacheKey);
      }catch(\Exception $e){
        return $this->error('Problem saving', 500);
      }

      return $this->success(null, 'Edited successfully');

	}


  public function delete($param)
  {
      if(! request()->isPost()){
        return false;
      }

      try{
          (new Link)->delete($param->id);
          FileCache::delete($this->cacheKey);
      }catch(\Exception $e){
        return $this->error('Problem saving', 500);
      }

      return $this->success(null, 'The record was deleted');
  }


}
