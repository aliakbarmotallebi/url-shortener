<?php namespace Aliakbar\UrlShortener\Controllers\Auth;

use Aliakbar\UrlShortener\Helper\View;
use Aliakbar\UrlShortener\Models\User;

class LoginController extends View{


  public function index()
  {
    return $this->render("auth\login.html.php");
  }

  public function login()
  {
      if(! request()->isPost()){
        return redirect(route('login.index'));
      }

      $user = new User;
      $user->username = request('username');
      $user->password = request('passcode');

      var_dump($user->login());die;

      return redirect(route('login.index'));
  }
}
