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

	/**
	 * A collection of custom properties for the user, that can be populated by
	 * the strategy
	 *
	 * @var mixed[]
	 */
	public $custom = [];

	/**
	* The user's locale setting.
	*
	* @var string
	*/
	public $locale = '';

	/**
	 * Used to return an array representation of the user object. Good for
	 * validators.
	 *
	 * @return mixed[] The properties of the user as an array
	 */
	public function toArray() {
		return [
			'id' => $this->id,
			'displayName' => $this->displayName,
			'username' => $this->username,
			'email' => $this->email,
			'accessToken' => $this->accessToken,
			'firstname' => $this->firstname,
			'lastname' => $this->lastname,
			'custom' => $this->custom,
			'locale' => $this->locale
		];
	}

}
