<?php namespace SoapBox\Authorize\Test;

use SoapBox\Authorize\User;
use SoapBox\Authorize\Strategy;
use SoapBox\Authorize\StrategyFactory;

class FakeStrategy implements Strategy {

	public function __construct($settings = array()) {
	}

	public function login($parameters = array()) {
		return true;
	}

	public function getUser($parameters = array()) {
		return new User;
	}
}

class StrategyFactoryTest extends TestCase {

	/**
	 * @expectedException SoapBox\Authorize\Exceptions\DuplicateStrategyException
	 */
	public function testRegisterThrowsDuplicateStrategyExceptionWithDuplicateKeys() {
		StrategyFactory::register('Fake', 'SoapBox\Authorize\Test\FakeStrategy');
		StrategyFactory::register('Fake', 'SoapBox\Authorize\Test\FakeStrategy');
	}

	/**
	 * @expectedException SoapBox\Authorize\Exceptions\InvalidStrategyException
	 */
	public function testRegisterThrowsInvalidStrategyExceptionWhenRegisteringAnInvalidKlass() {
		StrategyFactory::register('Fake', 'SoapBox\Authorize\Test\StrategyFactoryTest');
	}

	public function testRegisterStoresStrategy() {
		StrategyFactory::register('Fake', 'SoapBox\Authorize\Test\FakeStrategy');
		$this->assertTrue(StrategyFactory::get('Fake') instanceof FakeStrategy);
	}

	/**
	 * @expectedException SoapBox\Authorize\Exceptions\InvalidStrategyException
	 */
	public function testInvalidStrategyExceptionWhenTryingToRetrieveUnregisteredStrategy() {
		StrategyFactory::get('Fake');
	}

}
