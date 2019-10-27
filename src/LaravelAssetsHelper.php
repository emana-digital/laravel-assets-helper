<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace emanadigital;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\App;

class LaravelAssetsHelper
{
	protected $assetsManifestPath;

	public function __construct()
	{
		$this->assetsManifestPath = App::basePath() . '/public/assets/assets.json';
	}

	public function linkTags(string $entryname): HtmlString
	{
		$linkList = $this->getLinkList($entryname, 'css');

		$linkTags = array_map(function ($link) {
			return '<link rel="stylesheet" href="' . $link . '">';
		}, $linkList);

		return new HtmlString(implode('', $linkTags));
	}

	protected function getLinkList(string $entryname, string $linkType)
	{
		if (file_exists($this->assetsManifestPath)) {
			$assets = json_decode(file_get_contents($this->assetsManifestPath), true);

			if (isset($assets)) {
				if (Arr::has($assets, $entryname)) {
					if (Arr::has($assets[$entryname], $linkType)) {
						return $assets[$entryname][$linkType];
					} else {
						throw new Exception("Tipo $linkType do $entryname no assets.json não encontrada");
					}
				};
				throw new Exception("Entrada $entryname no assets.json não encontrada");
			} else {
				throw new Exception('Arquivo assets.json vazio');
			}

		} else {
			throw new Exception('Arquivo assets.json não encontrado');
		}
	}

	public function scriptTags(string $entryname): HtmlString
	{
		$linkList = $this->getLinkList($entryname, 'js');

		$scriptTags = array_map(function ($link) {
			return '<script type="application/javascript" src="' . $link . '"></script>';
		}, $linkList);

		return new HtmlString(implode('', $scriptTags));
	}
}
