<?php namespace SoapBox\Authorize\Test;

use \Mockery;
use SoapBox\Authorize\Authenticator;

class AuthenticatorMock extends Authenticator {
	public function __construct() {
	}
}

class AuthenticatorTest extends TestCase {

	public function testAuthenticateDelegatesToStrategyLoginMethod() {
		$expected = 'expected';
		$parameters = array('username' => 'username', 'password' => 'password');

		$strategy = $this->getMock('SoapBox\Authorize\Strategy');
		$strategy->expects($this->once())
			->method('login')
			->with($this->equalTo($parameters))
			->willReturn($expected);

		$authenticator = new AuthenticatorMock();

		$authenticator->strategy = $strategy;

		$actual = $authenticator->authenticate($parameters);

		$this->assertEquals($expected, $actual);
	}

}
