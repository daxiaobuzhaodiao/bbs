<?php
	function route_class() {
		return str_replace('.', '-', Route::currentRouteName());
	}

	function make_excerpt($data, $length = 200)
	{
		$excerpt = preg_replace('/\r|\n|\r\n+/', ' ', $data);
		return str_limit($excerpt, $length);
	}