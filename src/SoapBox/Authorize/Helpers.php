<?php namespace SoapBox\Authorize;

class Helpers {

	/**
	 * Helper to redirect the a given url
	 */
	public static function redirect($url) {
		header("Location: $url");
		die();
	}
}
