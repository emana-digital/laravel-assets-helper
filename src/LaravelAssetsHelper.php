<?php

namespace emanadigital;

use Illuminate\Support\Facades\App;
use Illuminate\Support\HtmlString;

class LaravelAssetsHelper {
	protected $assetsManifestPath;

	public function __construct() {
		$this->assetsManifestPath = App::basePath() . '/public/assets/assets.json';
	}

	public function scriptTags(string $entryname): HtmlString {
		$linkList = $this->getLinkList($entryname, 'js');

		$scriptTags = array_map(static function ($link) {
			return '<script type="application/javascript" src="' . $link . '"></script>';
		}, $linkList);

		return new HtmlString(implode('', $scriptTags));
	}

	protected function getLinkList(string $entryname, string $linkType) {
		$assets = json_decode(file_get_contents($this->assetsManifestPath), true);

		$linkList = $assets[$entryname][$linkType];

		if (!is_array($linkList)) {
			return [$linkList];
		}

		return $linkList;
	}

	public function linkTags(string $entryname): HtmlString {
		$linkList = $this->getLinkList($entryname, 'css');

		$linkTags = array_map(static function ($link) {
			return '<link rel="stylesheet" href="' . $link . '">';
		}, $linkList);

		return new HtmlString(implode('', $linkTags));
	}
}
