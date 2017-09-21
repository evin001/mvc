<?php
namespace Controllers;

use Core\Controller;
use Helpers\Paginator;
use Helpers\Url;
use Models\ModelTasks;

class ControllerMain extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->model = new ModelTasks();
	}

	public function actionIndex()
	{
		$numberCurrentPage = ( isset($_GET['page']) ) ? (int) $_GET['page'] : 1;

		$order = $_GET['order'] ?? '';
		$direct = $_GET['direct'] ?? 'desc';
		$switch = ( isset($_GET['switch']) ) ? true : false;

		if ($switch) {
			$direct = ($direct == 'desc') ? 'asc' : 'desc';
		}

		Url::addVars('order', $order);
		Url::addVars('direct', $direct);

		$offset = Paginator::NUMBER_ITEM_PAGE * $numberCurrentPage - Paginator::NUMBER_ITEM_PAGE;

		$dataTasks = $this->model->getData(Paginator::NUMBER_ITEM_PAGE, $offset, $order, $direct);

		$page = new Paginator($numberCurrentPage, $this->model->getTotalRowCount(), '/');
		$page->shapePage();

		$this->view->generate(
			'main_view.php',
			'template_view.php',
			[
				'data' => $dataTasks,
				'page' => $page,
				'order' => $order,
				'direct' => $direct,
				'sort' => [
					'field' => $this->model->getSortedField(),
					'label' =>$this->model->getSortedTranslate(),
				]
			]
		);
	}
}