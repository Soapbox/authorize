<?php namespace SoapBox\Authorize\Strategies;

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
	 * @param mixed[] $settings Array of settings that will be required to setup
	 *	this strategy. (i.e. OpenId settings)
	 */
	public abstract function __construct($settings = array());

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
	public abstract function login($parameters = array());

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
	public function getUser($parameters = array()) {
		throw new NotSupportedException();
	}

	/**
	 * Used to retrieve the social network from the strategy.
	 *
	 * @param mixed[] $parameters The parameters required to authenticate
	 *	against this strategy. (i.e. accessToken)
	 *
	 * @throws AuthenticationException If the provided parameters do not
	 *	successfully authenticate.
	 *
	 * @return Contact[] A list of contacts that are friends of this user.
	 */
	public function getFriends($parameters = array()) {
		throw new NotSupportedException();
	}

	/**
	 * Used to handle tasks after login. This could include retrieving our users
	 * token after a successful authentication.
	 *
	 * @return mixed[] Array of the tokens and other components that validate
	 *	our user.
	 */
	public abstract function endpoint();

}
