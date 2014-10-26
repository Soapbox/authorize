# SoapBox/Authorize: Inspired by [OmniAuth](https://github.com/intridea/omniauth)

** SoapBox/Authorize is still in beta and is under development. No promises are
made about the structure of the interfaces as we may change them for increased
readability, or adding functionality. **

## Motivation
Authorize was created because the many popular libraries I came across did so
much more than simple authorization and proved to be overkill. As a result
Authroize was born to provide a simple interface to build other authorizations
against. The goal here is to interfere as little as possible with your
application and provide a gateway for your application to authorize against 3rd
party providers.

## Introduction
Every Strategy for Authorize lives as an independent package on any number of
package hosting services. As such you'll be required to add each Strategy you
wish to use to your composer. On it's own Authroize will not provide you the
ability to Authorize against 3rd parties.

## Some providers to get you started
[Facebook](https://github.com/SoapBox/authorize-facebook)
[Google](https://github.com/SoapBox/authorize-google)
[League - Eventbrite, Github, LinkedIn, Microsoft](https://github.com/Soapbox/authorize-league)

## Usage
The goal of using Authorize is to leave all the heavy lifting to the various
authorization libraries. Please check their documentation for the specifics of
what they require.

### Authorizing with the Strategy (Laravel Example ... )
```php
use SoapBox\Authroize\Authenticator;
use SoapBox\Authorize\Exceptions\InvalidStrategyException;
...
Route::get('social/{provider}/{action?}', function($provider, $action = null) {
	//Get the configuration settings for the provider from any source of your
	//choice. This could be a config file, db, etc. (It could even be different
	//for each provider you choose to support)
	$settings =
		['id' => 'abc', 'secret' => 'xyz', 'redirect_url' => 'google.com'];

	//If you have any parameters required for authentication, i.e. accessToken
	//for OAuth, this is where you'd provide it to the Strategy. Again you can
	//pull this in from any source you have.
	$parameters =
		['accessToken' => 'sometoken'];

	try {
		$strategy = new Authenticator($provider, $settings);
		if ($action == 'callback') {
			$user = $strategy->getUser([]);
		} else {
			$user = $strategy->authenticate($parameters);
		}
	} catch (InvalidStrategyException $ex) {
		//You probably didn't install a 3rd party library for this strategy, or
		//someone is trying to access a random route.
	}
});
```

## Installation

### composer.json
Add the following to your `composer.json`
```
"require": {
	...
	"soapbox/authorize": "1.0.*",
	...
}
```

### app/config/app.php
Add the following to your `app.php`, note this will be removed in future
versions since it couples us with Laravel, and it isn't required for the library
to function
```
'providers' => array(
	...
	"SoapBox\Authorize\AuthorizeServiceProvider",
	...
)
```

That's it. =)
