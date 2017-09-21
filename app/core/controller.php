<?php
namespace Core;

class Controller
{
	protected $model;
	protected $view;

	public function __construct()
	{
		$this->view = new View();
	}

	public function actionIndex()
	{
	}
}