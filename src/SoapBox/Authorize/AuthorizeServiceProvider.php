<?php namespace SoapBox\Authorize;

use Illuminate\Support\ServiceProvider;

/**
 * Used to register Authroize with service providers, mainly for Laravel.
 */
class AuthorizeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot() {
		$this->package('soapbox/authorize');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind(
			'soapbox.authorize',
			'SoapBox\Authorize\Authorize'
		);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return ['soapbox.authorize'];
	}

}
