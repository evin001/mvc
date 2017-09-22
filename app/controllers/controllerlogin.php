<?php
namespace Controllers;

use Core\Controller;
use Core\Route;
use Helpers\Auth;
use Models\ModelUsers;

class ControllerLogin extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->model = new ModelUsers();
	}

	public function actionIndex()
	{
		$message = '';
		$error = false;

		if (Route::isPost()) {
			try {
				$this->model->validateLogin($_POST);
				$user = $this->model->getUser($_POST['login']);

				if ($user) {
					if ( Auth::verifyPassword($_POST['password'], $user['password']) ) {
						Auth::login($user);
						Route::redirect();
					} else {
						$error = true;
					}
				} else {
					$error = true;
				}

				if ($error) {
					$message = 'Неверный логин/пароль.';
				}
			} catch (\Exception $exception) {
				$message = $exception->getMessage();
			}
		}

		$this->view->generate(
			'login_view.php',
			'template_view.php',
			[
				'message' => $message,
			]
		);
	}

	public function actionLogout()
	{
		Auth::logout();
		Route::redirect();
	}
}
