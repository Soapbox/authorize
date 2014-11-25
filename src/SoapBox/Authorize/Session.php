<?php namespace SoapBox\Authorize;

/**
 * An interface describing the requirements for a session for Authorize
 */
interface Session {

	/**
	 * Used to validate the Session has a stored value for the provided key
	 *
	 * @param string $key The name of the key to which the value should be
	 * bound.
	 *
	 * @return bool Whether or not the store contains the key
	 */
	public function has($key);

	/**
	 * Used to retrieve a stored value for the provided key from the session
	 *
	 * @throws KeyNotFoundException If the provided key has been registered into
	 *	the session.
	 *
	 * @param string $key The name of the key to which the value should be
	 * bound.
	 *
	 * @return mixed The stored value
	 */
	public function get($key);

	/**
	 * Used to store a value for the provided key into the session
	 *
	 * @param string $key The name of the key to which the value should be
	 * bound.
	 * @param mixed $value The value to be stored
	 */
	public function put($key, $value);

}
