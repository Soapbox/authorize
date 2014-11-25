<?php namespace SoapBox\Authorize;

/**
 * An interface describing the requirements for a router for Authorize
 */
interface Router {

	/**
	 * Used to redirect the user to a new URL
	 *
	 * @param string $url The url where you would like to redirect the user
	 */
	public function redirect($url);

}
