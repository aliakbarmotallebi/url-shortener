<?php

use \Aliakbar\UrlShortener\Helper\{
	Request,
	Session
};

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
			$url = ($_SERVER['HTTP_HOST']. '/');
			return rtrim($url . $http);
	}
}


