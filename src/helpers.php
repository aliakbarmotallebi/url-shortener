<?php

use \Aliakbar\UrlShortener\Helper\{
	Request,
	Session
};

use Aliakbar\UrlShortener\Models\User;

if ( ! function_exists('asset'))
{
	function asset($path)
	{
      $DS  = DIRECTORY_SEPARATOR;
		  return getenv('APP_URL') . $DS . "public" . $DS . $path;
	}
}


if (! function_exists('request')) {

	function request($field = null) {

			$request = new Request();

			if(is_null($field))
					return $request;

			return $request->input($field);
	}
}

if (! function_exists('session')) {

	function session($key = null) {
			$session = new Session();
			if(is_null($key))
					return $session;

			return $session->get($key);
	}
}

if (! function_exists('redirect')) {

	function redirect($param = null) {
			return exit(header('location:'. url($param) ));
	}
}


if (! function_exists('url')) {

	function url($http = null) {
			$url = 'http://'.($_SERVER['HTTP_HOST']). '/';
			$http = ltrim($http, '/');
			return ($url . $http);
	}
}

if (! function_exists('auth')) {

	function auth() {
			return (new User);
	}
}

if (! function_exists('json_response')) {

	function json_response(array $message = null, $code = 200)
	{
			header_remove();

			http_response_code($code);

			header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
			header('Content-Type: application/json');

			$status = [
					200 => '200 OK',
					400 => '400 Bad Request',
					422 => 'Unprocessable Entity',
					500 => '500 Internal Server Error'
				];

			header('Status: '.$status[$code]);

			return json_encode($message);
	}

}

