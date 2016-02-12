<?php namespace Vsch\UserPrivilegeMapper;

use Illuminate\Support\ServiceProvider;

class UserPrivilegeMapperServiceProvider extends ServiceProvider {

	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerUserPrivilegeMapper();
	}

	/**
	 * Register the Privilege privilege mapper instance.
	 *
	 * @return void
	 */
	protected function registerUserPrivilegeMapper()
	{
		$this->app->singleton('privilege', function($app)
		{
			return new UserPrivilegeMapper($app);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('privilege');
	}

}
