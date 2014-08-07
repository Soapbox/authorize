<?php namespace SoapBox\Authorize;

/**
 * Used as a unified definition of a user across multiple Strategies.
 */
class User {

	/**
	 * A unique identifier for the user
	 *
	 * @var mixed
	 */
	public $id;

	/**
	 * The name that the user displays on the Strategy
	 *
	 * @var string
	 */
	public $displayName;

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
