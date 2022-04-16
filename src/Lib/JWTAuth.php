<?php namespace Aliakbar\UrlShortener\Lib;

use Aliakbar\UrlShortener\Models\User;

class JWTAuth {

  private static $secrect = '123456';


  public static function attempt(User $user)
  {

      $model = (new User)->where('username', $user->username)->first();
      if(! $model )
      { return false; }

      if(! password_verify($user->passcode, $model->passcode))
      { return false; }

      $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
      ];

      //Payload - Content
      $payload = [
        'id'       => $model->id,
        'username' => $model->username,
      ];


      if ( $token = self::encode($header, $payload) ){
          $model->update($payload['id'], [
              'token' => $token
          ]);
          return $token;
      }

      return false;

  }


  public static function checkAuth()
  {
      $http_header = apache_request_headers();

      if (isset($http_header['Authorization']) && $http_header['Authorization'] != null) {
          $bearer = explode (' ', $http_header['Authorization']);
          $jwt = $bearer[1] ?? null;

          $model = (new User)->where('token', $jwt)->first();
          if($model)
          { return true; }

      }
      return false;
  }

  public static function encode($header, $payload)
  {

      $header = json_encode($header);
      $payload = json_encode($payload);

      $header = self::base64UrlEncode($header);
      $payload = self::base64UrlEncode($payload);

      $sign = hash_hmac('sha256', $header . "." . $payload, self::$secrect, true);
      $sign = self::base64UrlEncode($sign);

      return "{$header}{$payload}{$sign}";
  }

  public static function decode($jwt)
  {}

  private static function base64UrlEncode($data)
  {
      $b64 = base64_encode($data);

      if ($b64 === false) {
          return false;}
      $url = strtr($b64, '+/', '-_');

      return rtrim($url, '=');
  }

}
