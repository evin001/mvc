<div class="row">
	<h3>Список задач</h3>
</div>

<div class="row ptb_small">
	<div class="pull-left">
		Сортировать:
		<?php foreach ($sort['field'] as $itemSort): ?>
			<a href="/?order=<?=$itemSort;?>&direct=<?=$direct;?>&switch"><?=$sort['label'][$itemSort] ?></a>

			<?php if ($order == $itemSort): ?>
				<?php if ($direct == 'asc'): ?>
					<i class="glyphicon glyphicon-sort-by-alphabet"></i>
				<?php else: ?>
					<i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div class="pull-right">
		<a href="/edit/index">Новая задача <i class="glyphicon glyphicon-plus"></i></a>
	</div>
</div>

<?php foreach ($data as $task): ?>
	<div class="row">
		<div class="col-md-3">
			<img src="/img/<?php if ($task['image']):?><?=$task['image'];?><?php else: ?>empty.png<?php endif ?>"
			     class="img-responsive img-rounded">
		</div>
		<div class="col-md-9">
			<p>
				<strong>Автор:</strong> <?=$task['name']?> |
				<strong>Email:</strong> <?=$task['email']?> |
				<strong>Выполнено:</strong>
				<?php if ($task['complete']): ?>
					<i class="glyphicon glyphicon-ok complete_yes"></i>
				<?php else: ?>
					<i class="glyphicon glyphicon-remove complete_no"></i>
				<?php endif ?>
			</p>
			<p><?=$task['text']?></p>
		</div>
	</div>
	<hr>
<?php endforeach; ?>

<?php include "app/views/pagination_view.php"; ?>
