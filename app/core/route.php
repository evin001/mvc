<?php
namespace Core;

class Route
{
	/**
	 * Метод вызывающий соответствующий запросу контроллер.
	 */
	static function start()
	{
		$controllerName = 'Main';
		$actionName = 'index';

		$routers = explode( '/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) );

		if ( !empty($routers[1]) ) {
			$controllerName = $routers[1];
		}
		if ( !empty($routers[2]) ) {
			$actionName = $routers[2];
		}

		$controllerName = 'Controller'.ucfirst($controllerName);
		$actionName = 'action'.ucfirst($actionName);

		$controllerFile = strtolower($controllerName).'.php';
		$controllerPath = 'app/controllers/'.$controllerFile;
		if (!file_exists($controllerPath)) {
			Route::errorPage404();
		}

		$nsController = 'Controllers\\'.$controllerName;
		$controller = new $nsController;
		$action = $actionName;

		if (method_exists($controller, $action)) {
			$controller->$action();
		} else {
			Route::errorPage404();
		}
	}

	/**
	 * Переадресация на страницу с ошибкой 404.
	 */
	static function errorPage404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';

		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
	}

	static function redirect($uri = '')
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/'.$uri;

		header('Location:'.$host);
	}

	static function isPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}
}