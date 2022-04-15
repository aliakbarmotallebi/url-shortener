<?php namespace Aliakbar\UrlShortener\Traits;


trait ApiResponser
{

	protected function success($data= [], string $message = null, int $code = 200)
	{
		return json_response([
			'status' => 'Success',
			'message' => $message,
			'data' => $data
		], $code);
	}

	protected function error(string $message = null, int $code, $data = null)
	{
		return json_response([
			'status' => 'Error',
			'message' => $message,
			'data' => $data
		], $code);
	}

}
