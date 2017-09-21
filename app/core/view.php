<?php
namespace Core;

class View
{
	/**
	 * Формирование представления.
	 *
	 * @param string     $contentFile  Вид отображающий контент страницы;
	 * @param string     $templateFile Общий для всех страниц шаблон;
	 * @param null|array $data         Массив, содержащий элементы контента страницы.
	 */
	public function generate($contentFile, $templateFile, $data = null)
	{
		if (is_array($data)) {
			extract($data);
		}

		include 'app/views/'.$templateFile;
	}
}