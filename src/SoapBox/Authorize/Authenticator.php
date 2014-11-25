<?php namespace SoapBox\Authorize;

use SoapBox\Authorize\Session;
use SoapBox\Authorize\Router;

/**
 * The entry point into the Authorize library that enables the validation of a
 * user against a strategy.
 */
class Authenticator {

	/**
	 * The strategy that will be using to authenticate against
	 *
	 * @var Strategy
	 */
	private $strategy;

	/**
	 * The session we can use to store and manage session based
	 * information
	 *
	 * @var Session
	 */
	private $session;

	/**
	 * The router we can use to redirect the user
	 *
	 * @var Router
	 */
	private $router;

	/**
	 * Initializes internal varaibles to prepare the class to preform our
	 * authentication against the provided strategy.
	 *
	 * @param string $strategy The name of the strategy. (i.e. facebook)
	 * @param mixed[] $settings A collection of settings required to initialize the
	 *	provided strategy.
	 *
	 * @throws InvalidStrategyException If the provided strategy is not valid
	 *	or supported.
	 */
	public function __construct($strategy, array $settings = null, Session $session = null, Router $router = null) {
		$settings = (!is_null($settings)) ?: [];
		$this->session = (!is_null($session)) ?: new DefaultSession();
		$this->router = (!is_null($router)) ?: new DefaultRouter();

		$this->strategy = StrategyFactory::get($strategy, $settings, $this->session, $this->router);
	}

	/**
	 * Returns a list of items that the strategy expects from the input.
	 *
	 * @return string[] A list of parameters that the strategy is expecting.
	 */
	public function expects() {
		return $this->strategy->expects();
	}

	/**
	 * Used to attempt an authentication against the provided strategy.
	 *
	 * @param mixed[] $parameters The parameters requried to authenticate
	 *	against this strategy. (i.e. username, password, etc)
	 *
	 * @throws AuthenticationException If the provided parameters do not
	 *	successfully authenticate.
	 *
	 * @return bool True if the user is logged in, redirect otherwise.
	 */
	public function authenticate($parameters = []) {
		return $this->strategy->login($parameters);
	}

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
	public function getUser($parameters = []) {
		return $this->strategy->getUser($parameters);
	}

}
