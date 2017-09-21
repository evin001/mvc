<?php
namespace Helpers;

class Paginator
{
	/**
	 * Количество страниц в блоке.
	 *
	 * @const int
	 */
	const NUMBER_PAGE_BLOCK = 5;

	/**
	 * Количество элементов на странице.
	 *
	 * @const int
	 */
	const NUMBER_ITEM_PAGE = 3;

	/**
	 * Номер текущей страницы.
	 *
	 * @var int
	 */
	public $numberCurrentPage;

	/**
	 * Общее число записей.
	 *
	 * @var int
	 */
	public $totalCountRow;

	/**
	 * Флаг необходимости ссылки на первую страницу.
	 *
	 * @var int
	 */
	public $firstLink;

	/**
	 * Флаг необходимости ссылки на последнюю страницу.
	 *
	 * @var bool
	 */
	public $lastLink;

	/**
	 * Номер последней страницы.
	 *
	 * @var int
	 */
	public $numberLastPage;

	/**
	 * Верхняя граница.
	 *
	 * @var int
	 */
	public $upperBound;

	/**
	 * Нижняя граница.
	 *
	 * @var int
	 */
	public $lowerBound;

	/**
	 * Флаг необходимости ссылки для левой стрелки.
	 *
	 * @var bool
	 */
	public $leftArrow;

	/**
	 * Флаг необходимости ссылки для правой стрелки.
	 *
	 * @var bool
	 */
	public $rightArrow;

	/**
	 * Номер последней страницы предыдущего блока.
	 *
	 * @var int
	 */
	public $lastPagePrevBlock;

	/**
	 * Номер первой страницы следующего блока.
	 *
	 * @var int
	 */
	public $firstPageNextBlock;

	/**
	 * Ссылка навигации.
	 *
	 * @var string
	 */
	public $link;

	public function __construct($currentPage, $totalCountRow, $link)
	{
		$this->numberCurrentPage = ($currentPage) ? $currentPage : 1;
		$this->totalCountRow = $totalCountRow;
		$this->link = $link;
	}

	public function shapePage()
	{
		$this->shapeLastLink();

		if ($this->numberCurrentPage > $this->numberLastPage) {
			$this->numberCurrentPage = $this->numberLastPage;
		}

		$this->shapeBounded();
		$this->shapeLeftArrow();
		$this->shapeRightArrow();
		$this->shapeFirstLink();
	}

	private function shapeFirstLink()
	{
		$this->firstLink = ($this->numberCurrentPage != 1) ? true : false;
	}

	private function shapeRightArrow()
	{
		$this->firstPageNextBlock = $this->upperBound + 1;

		$totalRangeNumber = (int) ceil(
			$this->totalCountRow / (self::NUMBER_PAGE_BLOCK * self::NUMBER_ITEM_PAGE)
		);
		$rangeNumber = $this->getRangeNumber();

		$this->rightArrow = ($rangeNumber < $totalRangeNumber) ? true : false;
	}

	private function shapeLeftArrow()
	{
		$this->lastPagePrevBlock = $this->lowerBound - 1;

		$rangeNumber = $this->getRangeNumber();
		$this->leftArrow = ($rangeNumber > 1) ? true : false;
	}

	private function shapeLastLink()
	{
		$this->numberLastPage = (int) ceil($this->totalCountRow / self::NUMBER_ITEM_PAGE);
		$this->lastLink = ($this->numberCurrentPage != $this->numberLastPage) ? true : false;
	}

	private function shapeBounded()
	{
		$rangeNumber = $this->getRangeNumber();
		$this->upperBound = $rangeNumber * self::NUMBER_PAGE_BLOCK;
		$this->lowerBound = $this->upperBound - self::NUMBER_PAGE_BLOCK + 1;

		if ($this->numberLastPage < $this->upperBound) {
			$this->upperBound = $this->numberLastPage;
		}
	}

	private function getRangeNumber()
	{
		return (int) ceil($this->numberCurrentPage / self::NUMBER_PAGE_BLOCK);
	}
}
