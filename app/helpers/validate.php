<?php
namespace Helpers;

class Validate
{
	/**
	 * Проверка корректности формата изображения.
	 *
	 * @param string   $imageFile Путь к файлу с изображением.
	 * @param int|null $imageType Тип файла.
	 *
	 * @return bool Истина в случае успеха, иначе ошибка.
	 *
	 * @throws \Exception Некорректный формат изображения.
	 */
	public static function checkImageType($imageFile, &$imageType = null)
	{
		$imageType = exif_imagetype($imageFile);

		if (!in_array($imageType, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG])) {
			throw new \Exception('Некорректный формат изображения.');
		}

		return true;
	}

	/**
	 * Проверка заполнено ли поле в массиве.
	 *
	 * @param array  $data    Массив с данными.
	 * @param string $field   Проверяемое поле.
	 * @param string $message Сообщение об ошибке.
	 *
	 * @return bool Истина в случае успеха, иначе ошибка.
	 *
	 * @throws \Exception Поле не заполнено или отсутствует.
	 */
	public static function checkRequired(array $data, string $field, string $message)
	{
		if ( !isset($data[$field]) || empty($data[$field]) ) {
			throw new \Exception($message);
		}

		return true;
	}

	/**
	 * Проверка корректности электроннаго адреса.
	 *
	 * @param string $email Электронный адрес.
	 *
	 * @return bool Истина в случае успеха, иначе ошибка.
	 *
	 * @throws \Exception Некорректный электронный адрес.
	 */
	public static function checkEmail(string $email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			throw new \Exception('Некорректный email адрес.');
		}

		return true;
	}
}