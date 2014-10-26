<?php namespace SoapBox\Authorize;

use SoapBox\Authorize\Strategies\SingleSignOnStrategy;

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
	 * @param mixed[] $settings A collection of settings required to initialize the
	 *	provided strategy.
	 *
	 * @throws InvalidStrategyException If the provided strategy is not valid
	 *	or supported.
	 */
	public function __construct($strategy, $settings) {
		$this->strategy = StrategyFactory::get($strategy, $settings);
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
	 * @return mixed[] A mixed array representing the authenticated user.
	 */
	public function authenticate($parameters = array()) {
		return $this->strategy->login($parameters);
	}

}
