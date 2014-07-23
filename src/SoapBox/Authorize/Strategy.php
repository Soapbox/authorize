<?php namespace SoapBox\Authorize;

interface Strategy {

	/**
	 * Used to construct the strategy and initialize any internal settings.
	 *
	 * @param array $settings The settings that will be required to setup this
	 *	strategy. (i.e. OpenId settings)
	 */
	public function __construct($settings = array());

	/**
	 * Used to attempt an authentication against the strategy.
	 *
	 * @param array parameters The parameters requried to authenticate against
	 *	this strategy. (i.e. username, password, etc)
	 *
	 * @throws AuthenticationException If the provided parameters do not
	 *	successfully authenticate.
	 *
	 * @return User A mixed array repreesnting the authenticated user.
	 */
	public function login($parameters = array());

}
