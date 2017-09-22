<?php
namespace Models;

use Core\Model;
use Helpers\Validate;

class ModelTasks extends Model
{
	const IMAGE_MAX_WIDTH = 320;
	const IMAGE_MAX_HEIGHT = 240;

	public function addTask(array $data, $image = null)
	{
		$this->validate($data);
		$this->filtered($data);

		$imagePath = $this->saveImage($image);

		$sql = 'INSERT INTO '
			.$this->getTableName()
			.'(name, email, text, image) VALUES(?, ?, ?, ?)';

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(1, $data['name']);
		$stmt->bindParam(2, $data['email']);
		$stmt->bindParam(3, $data['text']);
		$stmt->bindParam(4, $imagePath);

		$stmt->execute();

		return $this->db->lastInsertId();
	}

	public function getData($limit = 3, $offset = 0, $order = '', $direct = 'desc')
	{
		/* @var \PDO $db */
		$db = $this->db;

		$sql = 'SELECT name, email, text, image, complete FROM tasks';

		if ($order && in_array($order, $this->getSortedField())) {
			if ( !in_array($direct, ['asc', 'desc']) ) {
				$direct = 'desc';
			}
			$sql .= " ORDER BY {$order} {$direct}";
		}

		$sql .= ' LIMIT :limit OFFSET :offset';

		$stmt = $db->prepare($sql);
		$stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getSortedField()
	{
		return ['name', 'email', 'complete'];
	}

	public function getSortedTranslate()
	{
		return [
			'name' => 'по автору',
			'email' => 'по email',
			'complete' => 'по статусу',
		];
	}

	protected function getTableName()
	{
		return 'tasks';
	}

	private function saveImage($image = null)
	{
		if (!$image || !$image['size']) {
			return;
		}

		Validate::checkImageType($image['tmp_name'], $imageType);
		list($width, $height, $newWidth, $newHeight) = $this->getRatioSize($image['tmp_name']);

		$sourceImage = $this->createImage($image['tmp_name'], $imageType);
		$newImage = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled(
			$newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height
		);

		$imagePath = ROOT_DIR.'/img/'.$image['name'];
		$this->writeImage($newImage, $imageType, $imagePath);

		return $image['name'];
	}

	private function writeImage($image, $imageType, $path)
	{
		switch ($imageType) {
			case IMAGETYPE_GIF:
				return imagegif($image, $path);
			case IMAGETYPE_PNG:
				return imagepng($image, $path);
				break;
			default:
				return imagejpeg($image, $path);
		}
	}

	private function createImage($file, $imageType)
	{
		switch ($imageType) {
			case IMAGETYPE_GIF:
				return imagecreatefromgif($file);
			case IMAGETYPE_PNG:
				return imagecreatefrompng($file);
			default:
				return imagecreatefromjpeg($file);
		}
	}

	private function getRatioSize($imageFile)
	{
		list($width, $height) = getimagesize($imageFile);

		$newWidth = $width;
		$newHeight = $height;

		if ($newWidth > self::IMAGE_MAX_WIDTH && $newHeight > self::IMAGE_MAX_HEIGHT) {
			$percentWidth = self::IMAGE_MAX_WIDTH / $width;
			$percentHeight = self::IMAGE_MAX_HEIGHT / $height ;

			$percent = min($percentWidth, $percentHeight);

			$newWidth = (int) floor( $width * $percent );
			$newHeight = (int) floor( $height * $percent );
		} else if ($newWidth > self::IMAGE_MAX_WIDTH) {
			$newWidth = self::IMAGE_MAX_WIDTH;
			$newHeight = (int) floor( (self::IMAGE_MAX_WIDTH / $width)  * $height );
		} else if ($newHeight > self::IMAGE_MAX_HEIGHT) {
			$newHeight = self::IMAGE_MAX_HEIGHT;
			$newWidth = (int) floor( (self::IMAGE_MAX_HEIGHT / $height)  * $width );
		}

		return [$width, $height, $newWidth, $newHeight];
	}

	private function filtered(array &$data)
	{
		$data['name'] = mb_substr( htmlspecialchars($data['name']), 0, 100 );
		$data['email'] = mb_substr( htmlspecialchars($data['email']), 0, 100 );
		$data['text'] = htmlspecialchars($data['text']);
	}

	private function validate(array $data)
	{
		Validate::checkRequired($data, 'name', 'Имя не заполнено.');

		Validate::checkRequired($data, 'email', 'Email не заполнен.');
		Validate::checkEmail($data['email']);

		Validate::checkRequired($data, 'text', 'Текст задачи не заполнен.');
	}
}
