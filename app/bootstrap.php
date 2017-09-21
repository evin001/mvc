<?php

use Core\Route;

class Bootstrap
{
	public function run()
	{
		self::registerLoader();
		Route::start();
	}

	private static function registerLoader()
	{
		set_include_path(APP_DIR);
		spl_autoload_extensions('.php');
		spl_autoload_register();
	}
}