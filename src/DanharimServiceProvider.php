<?php

namespace Linshunwei\Daharim;

use Illuminate\Support\ServiceProvider;

class DanharimServiceProvider extends ServiceProvider
{
	public function boot()
	{
		//
	}

	public function register()
	{
		$this->app->singleton('danharim', function () {
			return new Danharim;
		});
	}
}