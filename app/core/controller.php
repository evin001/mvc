<?php
namespace Core;

use Helpers\Auth;

class Controller
{
	protected $model;
	protected $view;

	public function __construct()
	{
		Auth::startSession();

		$this->view = new View();
	}

	public function actionIndex()
	{
	}
}