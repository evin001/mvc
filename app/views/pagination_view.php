<?php if ($page->totalCountRow): ?>
	<nav aria-label="page navigation">
		<ul class="pagination">
			<li<?php if (!$page->firstLink): ?> class="disabled"<?php endif; ?>>
				<?php if ($page->firstLink): ?>
					<a href="<?=Helpers\Url::urlBag($page->link, 'page', 1);?>">
						<span>В начало</span>
					</a>
				<?php else: ?>
					<span>В начало</span>
				<?php endif; ?>
			</li>

			<li <?php if (!$page->leftArrow): ?> class="disabled"<?php endif; ?>>
				<?php if ($page->leftArrow): ?>
					<a href="<?=Helpers\Url::urlBag($page->link, 'page', $page->lastPagePrevBlock);?>">
						<span>&laquo;</span>
					</a>
				<?php else: ?>
					<span>&laquo;</span>
				<?php endif; ?>
			</li>

			<?php for ($number = $page->lowerBound; $number <= $page->upperBound; $number++): ?>
				<li<?php if ($page->numberCurrentPage == $number): ?> class="active"<?php endif; ?>>
					<?php if ($page->numberCurrentPage != $number): ?>
						<a href="<?=Helpers\Url::urlBag($page->link, 'page', $number);?>"><?=$number?></a>
					<?php else: ?>
						<span><?=$number?></span>
					<?php endif; ?>
				</li>
			<?php endfor; ?>

			<li<?php if (!$page->rightArrow): ?> class="disabled"<?php endif; ?>>
				<?php if ($page->rightArrow): ?>
					<a href="<?=Helpers\Url::urlBag($page->link, 'page', $page->firstPageNextBlock);?>">
						<span>&raquo;</span>
					</a>
				<?php else: ?>
					<span>&raquo;</span>
				<?php endif; ?>
			</li>

			<li<?php if (!$page->lastLink): ?> class="disabled"<?php endif; ?>>
				<?php if ($page->lastLink): ?>
					<a href="<?=Helpers\Url::urlBag($page->link, 'page', $page->numberLastPage);?>">
						<span>В конец</span>
					</a>
				<?php else: ?>
					<span>В конец</span>
				<?php endif; ?>
			</li>
		</ul>
	</nav>
<?php endif ?>