<?php

namespace emanadigital;

use Illuminate\Support\Facades\App;
use Illuminate\Support\HtmlString;

class LaravelAssetsHelper {
	protected $assetsManifestPath;

	public function __construct() {
		$assetsManifestPath = App::basePath() . '/public/assets/assets.json';

		if (file_exists($assetsManifestPath)) {
			$this->assetsManifestPath = $assetsManifestPath;
		}
	}

	public function scriptTags(string $entryname): HtmlString {
		$linkList = $this->getLinkList($entryname, 'js');

		$scriptTags = array_map(static function ($link) {
			return '<script type="application/javascript" src="' . $link . '"></script>';
		}, $linkList);

		return new HtmlString(implode('', $scriptTags));
	}

	protected function getLinkList(string $entryname, string $linkType) {
		if (isset($this->assetsManifestPath)) {
			$assets = json_decode(file_get_contents($this->assetsManifestPath), true);
			if (isset($assets[$entryname][$linkType])) {
				$linkList = $assets[$entryname][$linkType];
				if (!is_array($linkList)) {
					return [$linkList];
				}

				return $linkList;
			}
		}
		return [];
	}

	public function linkTags(string $entryname): HtmlString {
		$linkList = $this->getLinkList($entryname, 'css');

		$linkTags = array_map(static function ($link) {
			return '<link rel="stylesheet" href="' . $link . '">';
		}, $linkList);

		return new HtmlString(implode('', $linkTags));
	}
}
