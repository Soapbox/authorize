<?php namespace SoapBox;

class StrategyFactory {

	/**
	 * Named array of registered strategies available for authentication.
	 *
	 * @var array Available strategies
	 */
	private static $strategies = array();

	/**
	 * Used to register new authentication strategies with the StrategyFactory
	 *
	 * @param string $name The name of the strategy (i.e. facebook)
	 * @param string $class The fully qualified classname that implements the
	 *	Strategy
	 */
	public static function register($name, $class) {
		$this->$strategies[$name] = $class;
	}

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
		if (!array_key_exists($strategy, self::$strategies)) {
			throw new InvalidStrategyException();
		}

		return new self::$strategies[$strategy]($settings);
	}

}
