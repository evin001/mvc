<?php
namespace Controllers;

use Core\Controller;
use Core\Route;
use Models\ModelTasks;

class ControllerEdit extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->model = new ModelTasks();
	}

	public function actionIndex()
	{
		$message = '';

		if (Route::isPost()) {
			$image = $_FILES['image'] ?? null;

			try {
				if ($this->model->addTask($_POST, $image)) {
					Route::redirect();
				}
			} catch (\Exception $exception) {
				$message = $exception->getMessage();
			}
		}

		$this->view->generate('edit_view.php', 'template_view.php', [
			'message' => $message,
		]);
	}
}
