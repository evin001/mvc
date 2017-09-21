<?php
namespace Core;

abstract class Model
{
	protected $db;

	public function __construct()
	{
		$dbConfig = parse_ini_file(APP_DIR.'/config/db.ini');

		if ($dbConfig) {
			$this->db = new \PDO(
				'mysql:host=localhost;dbname='.$dbConfig['db_name'],
				$dbConfig['db_user'],
				$dbConfig['db_password']
			);
		} else {
			throw new \Exception('Could not load the database configuration file');
		}
	}

	/**
	 * Возвращает общее число строк в таблиц.
	 *
	 * @return int Общее число строк в таблице.
	 */
	public function getTotalRowCount()
	{
		$sql = 'SELECT COUNT(*) FROM '.$this->getTableName();

		if ($result = $this->db->query($sql)) {
			return intval( $result->fetchColumn() );
		}

		return 0;
	}

	/**
	 * Получение данных.
	 *
	 * @param int    $limit  Ограничение по числу записей.
	 * @param int    $offset Смещение.
	 * @param string $order  Поле по которому нужно сортировать.
	 * @param string $direct Направление сортировки.
	 */
	public function getData($limit = 3, $offset = 0, $order = '', $direct = 'desc')
	{
	}

	/**
	 * Имя таблицы в БД связанной с моделью.
	 *
	 * @return string
	 */
	abstract protected function getTableName();
}