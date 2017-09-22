<?php
namespace Models;

use Core\Model;
use Helpers\Validate;

class ModelUsers extends Model
{
	public function validateLogin(array $data)
	{
		Validate::checkRequired($data, 'login', 'Логин не заполнен.');
		Validate::checkRequired($data, 'password', 'Пароль не заполнен.');
	}

	public function getUser(string $login)
	{
		$sql = 'SELECT login, password, admin FROM '.$this->getTableName().' WHERE login = ?';

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(1, $login);

		if ($stmt->execute()) {
			return $stmt->fetch(\PDO::FETCH_ASSOC);
		}

		return null;
	}

	protected function getTableName()
	{
		return 'users';
	}
}
