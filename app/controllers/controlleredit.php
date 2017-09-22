<?php
namespace Controllers;

use Core\Controller;
use Core\Route;
use Helpers\Auth;
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
		$task = [];
		$taskId = null;

		if (Auth::isLogin() && Auth::isAdmin() && isset($_REQUEST['id'])) {
			$taskId = (int) $_REQUEST['id'];
			$task = $this->model->getTask($taskId);
		}

		if (Route::isPost()) {
			$task = $_POST;
			$image = $_FILES['image'] ?? null;

			try {
				$dbResult = ($taskId) ? $this->model->updateTask($taskId, $_POST, $image) :
					$this->model->addTask($_POST, $image);

				if ($dbResult) {
					Route::redirect();
				}
			} catch (\Exception $exception) {
				$message = $exception->getMessage();
			}
		}

		$this->view->generate('edit_view.php', 'template_view.php', [
			'message' => $message,
			'dataTask' => $task,
		]);
	}
}
