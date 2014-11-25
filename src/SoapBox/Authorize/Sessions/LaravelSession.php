<?php namespace SoapBox\Authorize\Sessions;

use SoapBox\Authorize\Session;
use SoapBox\Authorize\Exceptions\MissingArgumentsException;
use SoapBox\Authorize\Exceptions\KeyNotFoundException;

/**
 * An adapter for the Laravel Session
 */
class LaravelSession implements Session {

	/**
	 * The session that will be doing all the heavy lifting for us
	 */
	private $session;

	/**
	 * Used to construct the session and initialize the session
	 */
	public function __construct(Illuminate\Session\Store $session) {
		if (is_null($session) || !isset($session)) {
			throw new MissingArgumentsException('$session is a required parameter');
		}
		$this->session = $session;
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
		return $this->session->has($key);
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
			return $this->session->get($key);
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
		$this->session->put($key, $value);
	}

}
