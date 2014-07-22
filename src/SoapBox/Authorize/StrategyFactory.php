<?php namespace SoapBox\Authorize;

use Illuminate\Support\Facades\Lang as Lang;
use SoapBox\Authorize\Exceptions\DuplicateStrategyException;
use SoapBox\Authorize\Exceptions\InvalidStrategyException;

class StrategyFactory {

	/**
	 * The strategies that have been registered with the factory.
	 *
	 * @var array $strategies Named array of strategies
	 */
	private static $strategies = array();

	/**
	 * Used to register a new strategy with Authorize
	 *
	 * @throws DuplicateStrategyException If the provided strategy has been
	 *	previously registered.
	 * @throws InvalidStrategyException If the provided strategy is not valid,
	 *	it is not implementing the Strategy interface.
	 *
	 * @param string $name The friendly name of the class that is being
	 *	registered
	 * @param string $klass The class with namespace that is being registered
	 */
	public static function register($name, $klass) {
		if (array_key_exists($name, self::$strategies)) {
			throw new DuplicateStrategyException(
				"The $name key has already been registered."
			);
		}
		if (!in_array('SoapBox\Authorize\Strategy', class_implements($klass))) {
			throw new InvalidStrategyException(
				"The provided class does not implement the 'SoapBox\Authorize\Strategy' interface."
			);
		}
		self::$strategies[$name] = $klass;
	}

	/**
	 * Used to retrieve the specified strategy for authenticating.
	 *
	 * @param string $strategy The name of the strategy. (i.e. facebook)
	 * @param array $settings The settings the strategy requires to initialize.
	 *
	 * @return Strategy An instance of the strategy requested.
	 */
	public static function get($strategy, $settings = array()) {
		if (!array_key_exists($strategy, self::$strategies)) {
			throw new InvalidStrategyException(
				"$strategy strategy has not been registered."
			);
		}
		return new self::$strategies[$strategy]($settings);
	}

}