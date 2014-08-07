<?php namespace SoapBox\Authorize\Exceptions;

use \InvalidArgumentException;

/**
 * Signals that some required arguments for a function are missing. This usually
 * happens when an array ($settings / $parameters) is missing some values.
 */
class MissingArgumentsException extends InvalidArgumentException {
}
