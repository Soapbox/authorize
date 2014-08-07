<?php namespace SoapBox\Authorize\Exceptions;

use \Exception;

/**
 * Signals that the Strategy that is being registered has previously been
 * registered, resulting in a conflict.
 */
class DuplicateStrategyException extends Exception {
}
