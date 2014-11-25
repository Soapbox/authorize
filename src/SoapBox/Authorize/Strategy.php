<?php namespace SoapBox\Authorize;

use SoapBox\Authorize\Session;
use SoapBox\Authorize\Router;

/**
 * An interface describing the minimum requirements to authorize against a
 * Strategy.
 */
interface Strategy {

	/**
	 * Used to construct the strategy and initialize any internal settings.
	 *
	 * @param array $settings The settings that will be required to setup this
	 *	strategy. (i.e. OpenId settings)
	 * @param Session $session Provides the strategy a place to store / retrieve data
	 * @param Router $router Provides the strategy a mechanism to redirect users
	 *	provided key.
	 */
	public function __construct(array $settings, Session $session, Router $router);

	/**
	 * Used to attempt an authentication against the strategy.
	 *
	 * @param mixed[] $parameters The parameters requried to authenticate
	 *	against this strategy. (i.e. username, password, etc)
	 *
	 * @throws AuthenticationException If the provided parameters do not
	 *	successfully authenticate.
	 *
	 * @return User The user retrieved from the Strategy
	 */
	public function login(array $parameters);

	/**
	 * Used to retrieve the user from the strategy.
	 *
	 * @param mixed[] $parameters The parameters required to authenticate
	 * against this strategy. (i.e. accessToken)
	 *
	 * @throws AuthenticationException If the provided parameters do not
	 *	successfully authenticate.
	 *
	 * @return User The user retieved from the Strategy
	 */
	public function getUser(array $parameters);

	/**
	 * Returns a list of items that the strategy expects from the input.
	 *
	 * @return string[] A list of parameters that the strategy is expecting.
	 */
	public function expects();

}
