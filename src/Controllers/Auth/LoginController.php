<?php namespace Aliakbar\UrlShortener\Controllers\Auth;

use Aliakbar\UrlShortener\Controllers\AbstractController;
use Aliakbar\UrlShortener\Models\User;

class LoginController extends AbstractController{


  public function __construct()
  {
    if( auth()->check() ){
      return $this->redirectToRoute(route('dashboard.links.index'));
    }
  }

  public function index()
  {
    return $this->renderView("auth\login.html.php");
  }

  public function login()
  {
      if(! request()->isPost()){
        return $this->redirectToRoute(route('auth.index'));
      }

      $user = new User;
      $user->username = request('username');
      $user->passcode = request('passcode');

      $user->login();
      // var_dump($user->hash('123456'));die;
      // var_dump($user->login());die;

      return $this->redirectToRoute(route('auth.index'));
  }
}
