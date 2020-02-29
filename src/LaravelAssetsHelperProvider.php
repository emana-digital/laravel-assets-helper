<?php

namespace emanadigital;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LaravelAssetsHelperProvider extends ServiceProvider {
	protected $assetsHelper;

	public function __construct($app) {
		$this->assetsHelper = new LaravelAssetsHelper();
		ServiceProvider::__construct($app);
	}

	public function boot(): void {
		Blade::directive('assetsHelperScriptTags', function ($entryname) {
			return $this->assetsHelper->scriptTags($entryname);
		});
		Blade::directive('assetsHelperLinkTags', function ($entryname) {
			return $this->assetsHelper->linkTags($entryname);
		});
	}
}
