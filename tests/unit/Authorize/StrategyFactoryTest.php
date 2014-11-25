<?php namespace SoapBox\Authorize\Test;

use SoapBox\Authorize\Session;
use SoapBox\Authorize\Router;
use SoapBox\Authorize\Sessions\DefaultSession;
use SoapBox\Authorize\Routers\DefaultRouter;
use SoapBox\Authorize\User;
use SoapBox\Authorize\Strategy;
use SoapBox\Authorize\StrategyFactory;

class FakeStrategy implements Strategy {

	public function __construct(array $settings = [], Session $session = null, Router $router = null) {
	}

	public function login(array $parameters = []) {
		return true;
	}

	public function getUser(array $parameters = []) {
		return new User;
	}

	public function expects() {
		return [];
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
		$this->assertTrue(StrategyFactory::get('Fake', [], new DefaultSession(), new DefaultRouter()) instanceof FakeStrategy);
	}

	/**
	 * @expectedException SoapBox\Authorize\Exceptions\InvalidStrategyException
	 */
	public function testInvalidStrategyExceptionWhenTryingToRetrieveUnregisteredStrategy() {
		StrategyFactory::get('Fake', [], new DefaultSession(), new DefaultRouter());
	}

}
