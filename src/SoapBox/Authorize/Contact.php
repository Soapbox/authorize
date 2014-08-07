<?php namespace SoapBox\Authorize;

/**
 * Used to define a user that has a relationship with the authenticated user.
 */
class Contact {

	/**
	 * A unique identifier for the Contact
	 *
	 * @var mixed
	 */
	public $id;

	/**
	 * The users email address
	 *
	 * @var string
	 */
	public $email;

	/**
	 * The profile url for the user on the Strategy
	 *
	 * @var string
	 */
	public $profileUrl;

	/**
	 * The users display name
	 *
	 * @var string
	 */
	public $displayName;

	/**
	 * The url of the users display picture
	 *
	 * @var string
	 */
	public $displayPicture;

	/**
	 * The url for the contacts website
	 *
	 * @var string
	 */
	public $website;

}
