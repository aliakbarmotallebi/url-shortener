<?php


if ( ! function_exists('asset'))
{
	function asset($path)
	{
      $DS  = DIRECTORY_SEPARATOR;
		  return getenv('APP_URL') . $DS . "public" . $DS . $path;
	}
}
