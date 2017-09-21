<?php
namespace Helpers;

class Url
{
	/**
	 * @var array
	 */
	private static $vars;

	/**
	 * Добавление параметра в url адрес с учётом сохранённых ранее переменных.
	 *
	 * @param string $url     Url адрес.
	 * @param string $param   Имя добавляемого параметра.
	 * @param mixed  $value   Значение добавляемого параметра.
	 *
	 * @return string Url адрес.
	 */
	public static function urlBag(string $url, string $param, $value)
	{
		self::addVars($param, $value);

		return $url.'?'.http_build_query(self::$vars);
	}

	public static function addVars($param, $value)
	{
		self::$vars[$param] = $value;
	}
}
