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
	 * @return bool Indicates if login was successful
	 */
	public function login($parameters = array());

	/**
	 * Used to retrieve a user using this Strategy.
	 *
	 * @param array parameters The parameters requried to authenticate against
	 *	this strategy. (i.e. username, password, etc)
	 *
	 * @throws AuthenticationException If you attempt to retrieve a user profile
	 *	but do not pass authentication.
	 *
	 * @return User A mixed array repreesnting the authenticated user.
	 */
	public function getUser($parameters = array());

	/**
	 * Used to handle tasks prior to login. In the case of OAuth this would be
	 * to generate our token before redirecting to the strategy site.
	 */
	public function beforeLogin();

	/**
	 * Used to handle tasks after login. This could include retrieving our users
	 * token after a successful authentication.
	 *
	 * @return array Mixed array of the tokens and other components that
	 *	validate our user.
	 */
	public function afterLogin();
}
