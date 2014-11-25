<?php namespace SoapBox\Authorize;

use SoapBox\Authorize\Strategies\SingleSignOnStrategy;

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

	private function setRedirect($redirect) {
		if ($redirect === null) {
			Helpers::$redirect = function ($url) {
				header("Location: $url");
				die();
			};
		} else {
			Helpers::$redirect = $redirect;
		}
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
	public function __construct($strategy, array $settings = null, Session $session = null, $redirect = null) {
		$settings = (!is_null($settings)) ?: [];
		$this->session = (!is_null($session)) ?: new DefaultSession();

		$this->setRedirect($redirect);
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
		return $this->strategy->login($parameters, $this->session, $this->redirect);
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
		return $this->strategy->getUser($parameters, $this->session);
	}

}
