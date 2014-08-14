<?php namespace SoapBox\Authorize;

/**
 * The entry point into the Authroize library that enables the validation of a
 * user against a strategy.
 */
class Authenticator {

	/**
	 * The strategy that will be using to authenticate against
	 *
	 * @var Strategy
	 */
	public $strategy;

	/**
	 * Initializes internal varaibles to prepare the class to preform our
	 * authentication against the provided strategy.
	 *
	 * @param string $strategy The name of the strategy. (i.e. facebook)
	 * @param mixed[] $settings The settings the strategy requires to initialize.
	 * @param callable $store A callback that will store a KVP (Key Value Pair).
	 * @param callable $load A callback that will return a value stored with the
	 *	provided key.
	 *
	 * @throws InvalidStrategyException If the provided strategy is not valid
	 *	or supported.
	 */
	public function __construct($strategy, $settings = array(), $store = null, $load = null) {
		$this->strategy = StrategyFactory::get($strategy, $settings, $store, $load);
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
	 * @return mixed[] A mixed array representing the authenticated user.
	 */
	public function authenticate($parameters = array()) {
		return $this->strategy->login($parameters);
	}

}
