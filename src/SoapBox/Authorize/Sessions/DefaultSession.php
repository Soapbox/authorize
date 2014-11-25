<?php namespace SoapBox\Authorize\Sessions;

use SoapBox\Authorize\Session;

/**
 * Utilizes native php sessions to provide a session implementation
 */
class DefaultSession implements Session {

	/**
	 * Used to construct the session and initialize the session
	 */
	public function __construct() {
		if ((function_exists('session_status') && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
			session_start();
		}
	}

	/**
	 * Used to validate the Session has a stored value for the provided key
	 *
	 * @param string $key The name of the key to which the value should be
	 * bound.
	 *
	 * @return bool Whether or not the store contains the key
	 */
	public function has($key) {
		return isset($_SESSION[$key]);
	}

	/**
	 * Used to retrieve a stored value for the provided key from the session
	 *
	 * @param string $key The name of the key to which the value should be
	 * bound.
	 *
	 * @return mixed The stored value
	 */
	public function get($key) {
		if ($this->has($key)) {
			return $_SESSION[$key];
		}
		throw new KeyNotFoundException("The requested key ($key) could not be found in the session");
	}

	/**
	 * Used to store a value for the provided key into the session
	 *
	 * @param string $key The name of the key to which the value should be
	 * bound.
	 * @param mixed $value The value to be stored
	 */
	public function put($key, $value) {
		$_SESSION[$key] = $value;
	}

}
