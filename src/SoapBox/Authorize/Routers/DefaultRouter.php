<?php namespace SoapBox\Authorize\Routers;

use SoapBox\Authorize\Router;

/**
 * A default router to redirect our users
 */
class DefaultRouter implements Router {

	/**
	 * Used to redirect the user to a new URL
	 *
	 * @param string $url The url where you would like to redirect the user
	 */
	public function redirect($url) {
		header("Location: $url");
		die();
	}

}
