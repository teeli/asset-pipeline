<?php

namespace Codesleeve\AssetPipeline\Directives;

class BaseDirective extends \Codesleeve\AssetPipeline\SprocketsBase {

	public function __construct($app, $manifestFile)
	{
		parent::__construct($app);
		$this->manifestFile = $manifestFile;
	}

	/**
	 * When we do like require file, we want to filter certain paths for 
	 * javascripts and stylesheets, e.g. if we had smoke.css and smoke.js
	 * if we did not do this then smoke.js would show up in application.css
	 * when we do ...	*= require smoke ... in the application.css manifest
	 * 
	 * @return [type] [description]
	 */
	protected function getIncludePaths()
	{
		if (pathinfo($this->manifestFile, PATHINFO_EXTENSION) == 'js' || 
			strpos('.js', $this->manifestFile) !== false) {
			return 'javascripts';
		}

		else if (pathinfo($this->manifestFile, PATHINFO_EXTENSION) == 'css' ||
				 strpos('.js', $this->manifestFile) !== false ||
				 pathinfo($this->manifestFile, PATHINFO_EXTENSION) == 'less') {
			return 'stylesheets';
		}

		return 'all';
	}
}