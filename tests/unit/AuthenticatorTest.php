<?php namespace SoapBox\Authorize\Test;

use \Mockery;
use SoapBox\Authorize\Authenticator;

class AuthenticatorTest extends TestCase {

	public function testAuthenticateDelegatesToStrategyLoginMethod() {
		$expected = 'expected';
		$parameters = array('username' => 'username', 'password' => 'password');

		$strategy = $this->getMock('SoapBox\Authorize\Strategy');
		$strategy->expects($this->once())
			->method('login')
			->with($this->equalTo($parameters))
			->willReturn($expected);

		$authenticator = new Authenticator($strategy);

		$actual = $authenticator->authenticate($parameters);

		$this->assertEquals($expected, $actual);
	}

}
