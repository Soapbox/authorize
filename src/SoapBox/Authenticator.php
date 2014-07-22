<?php namespace SoapBox;

class Authenticator {

	/**
	 * The strategy that will be using to authenticate against
	 *
	 * @var Strategy
	 */
	private $strategy;

	/**
	 * Initializes internal varaibles to prepare the class to preform our
	 * authentication against the provided strategy.
	 *
	 * @param string $strategy The name of the strategy we are using to
	 *	authenticate
	 * @param array $settings The configurations required for the provided
	 *	strategy
	 *
	 * @throws InvalidStrategyException If the provided strategy is not valid
	 *	or supported.
	 */
	public function __construct($strategy, $settings = array()) {
		$this->strategy = StrategyFactory::get($strategy, $settings);
	}

	/**
	 * Used to attempt an authentication against the provided strategy.
	 *
	 * @param array parameters The parameters requried to authenticate against
	 *	this strategy. (i.e. username, password, etc)
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
