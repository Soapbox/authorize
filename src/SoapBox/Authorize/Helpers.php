<?php namespace SoapBox\Authorize;

/**
 * A static collection of methods to aid in development. Methods that are
 * helpful across multiple strategies will be moved here.
 */
class Helpers {

	/**
	 * Helper to redirect the a given url
	 *
	 * @param string $url The url you wish to redirect a browser to
	 */
	public static function redirect($url) {
		header("Location: $url");
		die();
	}

	/**
	 * Returns the default if the value is not set.
	 *
	 * @param mixed $value The value you wish to validate.
	 * @param mixed $default The value you wish to get if value is not set
	 * @param integer $index The index to search for the value.
	 *
	 * @return mixed
	 */
	public static function getValueOrDefault($value, $default, $index = null) {
		if ($index == null) {
			if (isset($value)) {
				return $value;
			}
		}
		if (isset($value) && isset($value[$index])) {
			return $value[$index];
		}
		return $default;
	}

}
