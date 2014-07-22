<?php namespace SoapBox\Authorize;

use SoapBox\Authorize\Exceptions\InvalidStrategyException;

class StrategyFactory {

	/**
	 * Used to retrieve the specified strategy for authenticating.
	 *
	 * @param string $strategy The name of the strategy. (i.e. facebook)
	 * @param array $settings The settings the strategy requires to initialize.
	 *
	 * @throws InvalidStrategyException If the provided strategy is not valid
	 *	or supported.
	 *
	 * @return Strategy An instance of the strategy requested.
	 */
	public static function get($strategy, $settings = array()) {
		if (!in_array('SoapBox\Authorize\Strategy', class_implements($strategy))) {
			throw new InvalidStrategyException();
		}
		return new $strategy[$strategy]($settings);
	}

}
