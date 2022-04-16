<?php namespace Aliakbar\UrlShortener\Controllers\Api\Auth;

use Aliakbar\UrlShortener\Controllers\Api\ApiController;
use Aliakbar\UrlShortener\Lib\JWTAuth;
use Aliakbar\UrlShortener\Models\User;

class LoginController extends ApiController{

  public function login()
  {
    if(! request()->isPost()){
      return false;
    }

    $user = new User;
    $user->username = request('username');
    $user->passcode = request('passcode');

    try {
        if (!$token =  JWTAuth::attempt($user)) {
            return $this->error(
                'Invalid login',
                401);
        }
    } catch (\Exception $e) {
        return $this->error(
            'error JWT',
            500);
    }

    return $this->success([
      'token' => $token
    ]);

  }
}
