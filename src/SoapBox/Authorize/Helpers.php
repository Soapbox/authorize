<?php namespace SoapBox\Authorize;

/**
 * A static collection of methods to aid in development. Methods that are
 * helpful across multiple strategies will be moved here.
 */
class Helpers {

	public static $redirect;
	public static $store;
	public static $load;

	/**
	 * Helper to redirect the a given url
	 *
	 * @param string $url The url you wish to redirect a browser to
	 */
	public static function redirect($url) {
		$redirect = Helpers::$redirect;
		$redirect($url);
	}

	/**
	 * Stores the provided value in our session
	 *
	 * @param string $key The dictionary location where we would like to store the value
	 * @param mixed $value The value we wish to store
	 */
	public static function store($key, $value) {
		$store = Helpers::$store;
		$store($key, $value);
	}

	/**
	 * Retrieves the previously stored value from our session
	 *
	 * @param string $key The key with which we have binded the value we are retrieving
	 *
	 * @return mixed The stored value
	 */
	public static function load($key) {
		$load = Helpers::$load;
		return $load($key);
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
		if ($index !== null) {
			if (isset($value) && isset($value[$index])) {
				return $value[$index];
			}
		}
		if (isset($value)) {
			return $value;
		}
		return $default;
	}

}
