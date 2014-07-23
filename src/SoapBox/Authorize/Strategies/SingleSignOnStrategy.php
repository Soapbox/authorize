<?php namespace SoapBox\Authorize\Strategies;

abstract class SingleSignOnStrategy implements Strategy {

	/**
	 * Used to construct the strategy and initialize any internal settings.
	 *
	 * @param array $settings The settings that will be required to setup this
	 *	strategy. (i.e. OpenId settings)
	 */
	public abstract function __construct($settings = array());

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
	public abstract function login($parameters = array());

	/**
	 * Used to handle tasks after login. This could include retrieving our users
	 * token after a successful authentication.
	 *
	 * @return array Mixed array of the tokens and other components that
	 *	validate our user.
	 */
	public abstract function endpoint();

}
