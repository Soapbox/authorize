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
	 * Stores the provided value in our session
	 *
	 * @param string $key The dictionary location where we would like to store the value
	 * @param mixed $value The value we wish to store
	 */
	protected function store($key, $value) {
		if ((function_exists('session_status') && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
			session_start();
		}
		$_SESSION[$key] = $value;
	}

	/**
	 * Retrieves the previously stored value from our session
	 *
	 * @param string $key The key with which we have binded the value we are retrieving
	 *
	 * @return mixed The stored value
	 */
	protected function load($key) {
		if ((function_exists('session_status') && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
			session_start();
		}
		return $_SESSION[$key];
	}

	/**
	 * Redirect the application to the provided url
	 *
	 * @param string $url The url you wish to redirect a browser to
	 */
	protected function redirect($url) {
		header("Location: $url");
		die();
	}

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
	public function __construct($strategy, $settings = []) {
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
	 * @return bool True if the user is logged in, redirect otherwise.
	 */
	public function authenticate($parameters = []) {
		return $this->strategy->login($parameters, $this->store, $this->redirect);
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
		return $this->strategy->getUser($parameters, $this->load);
	}

}
