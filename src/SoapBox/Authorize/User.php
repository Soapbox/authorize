<?php namespace SoapBox\Authorize;

class User {

	/**
	 * A unique identifier for the user
	 *
	 * @var mixed
	 */
	public $id;

	/**
	 * The username representing the user on the system
	 *
	 * @var string
	 */
	public $username;

	/**
	 * The users email address
	 *
	 * @var string
	 */
	public $email;

	/**
	 * The access token for this user as provided by the strategy.
	 *
	 * @var string
	 */
	public $accessToken;

	/**
	 * The users firstname
	 *
	 * @var string
	 */
	public $firstname;

	/**
	 * The users lastname
	 *
	 * @var string
	 */
	public $lastname;

}
