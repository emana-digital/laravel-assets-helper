<?php

namespace emanadigital;

use Illuminate\Support\Facades\Blade;

class LaravelAssetsHelperProvider {
	protected $assetsHelper;

	public function __construct() {
		$this->assetsHelper = new LaravelAssetsHelper();
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
