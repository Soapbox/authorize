<?php namespace SoapBox\Authorize\Strategies;

use SoapBox\Authorize\Session;
use SoapBox\Authorize\Router;
use SoapBox\Authorize\Strategy;
use SoapBox\Authorize\Exceptions\NotSupportedException;

/**
 * Provides an abstraction of the SingleSignOn (SSO) paradigm. Examples of the
 * SSO paradigm include Facebook, Google, Twitter, etc. all via OAuth.
 */
abstract class SingleSignOnStrategy implements Strategy {

	/**
	 * Used to construct the strategy and initialize any internal settings.
	 *
	 * @param array $settings The settings that will be required to setup this
	 *	strategy. (i.e. OpenId settings)
	 * @param Session $session Provides the strategy a place to store / retrieve data
	 * @param Router $router Provides the strategy a mechanism to redirect users
	 *	provided key.
	 */
	public abstract function __construct(array $settings, Session $session, Router $router);

	/**
	 * Returns a list of items that the strategy expects from the input.
	 *
	 * @return string[] A list of parameters that the strategy is expecting.
	 */
	public abstract function expects();

	/**
	 * Used to attempt an authentication against the strategy.
	 *
	 * @throws AuthenticationException If the provided parameters do not
	 *	successfully authenticate.
	 *
	 * @param mixed[] $parameters The parameters requried to authenticate
	 *	against this strategy. (i.e. username, password, etc)
	 *
	 * @return User The user retrieved from the Strategy
	 */
	public abstract function login(array $parameters);

	/**
	 * Used to retrieve the user from the strategy.
	 *
	 * @throws AuthenticationException If the provided parameters do not
	 *	successfully authenticate.
	 *
	 * @param mixed[] $parameters The parameters required to authenticate
	 * against this strategy. (i.e. accessToken)
	 *
	 * @return User The user retieved from the Strategy
	 */
	public abstract function getUser(array $parameters);

	/**
	 * Used to retrieve the social network from the strategy.
	 *
	 * @throws AuthenticationException If the provider parameters do not
	 *	successfully authenticate.
	 * @throws NotSupportedException If the provider has no mechanism to
	 *	retreive a list of friends this exception will be thrown.
	 *
	 * @param mixed[] $parameters The parameters required to authenticate
	 *	against this strategy. (i.e. accessToken)
	 *
	 * @return Contact[] A list of contacts that are friends of this user.
	 */
	public function getFriends(array $parameters) {
		throw new NotSupportedException();
	}

}
