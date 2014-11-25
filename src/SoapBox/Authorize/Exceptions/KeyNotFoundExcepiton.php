<?php namespace SoapBox\Authorize\Exceptions;

use \Exception;

/**
 * Signals that the requested key was not available in the session.
 */
class KeyNotFoundException extends Exception {
}
