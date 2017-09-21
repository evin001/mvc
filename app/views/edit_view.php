<div class="row">
	<h3>Новая задача</h3>

	<form method="post" enctype="multipart/form-data">
		<?php if ($message): ?>
			<div class="alert alert-danger"><?=$message;?></div>
		<?php endif; ?>

		<div class="form-group">
			<label for="name">Имя <span class="text-danger">*</span></label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Представьтесь" required>
		</div>
		<div class="form-group">
			<label for="email">Email <span class="text-danger">*</span></label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Ваш email" required>
		</div>
		<div class="form-group">
			<label for="text">Текст задачи <span class="text-danger">*</span></label>
			<textarea rows="10" class="form-control" id="text" name="text" placeholder="Условия задачи" required></textarea>
		</div>
		<div class="form-group">
			<label for="image">Изображение</label>
			<input type="file" id="image" name="image">
			<p class="help-block">Формат JPG/GIF/PNG, не более 320х240 пикселей</p>
		</div>

		<button type="submit" class="btn btn-default">Сохранить</button>
		<a href="/" class="btn btn-default">Отменить</a>
		<button type="button" class="btn btn-primary" id="preview">Предварительный просмотр</button>
	</form>
</div>

<div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Предпросмотр</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-3">
						<img src="/img/empty.png" id="previewImage" class="img-responsive img-rounded">
					</div>
					<div class="col-md-9">
						<p>
							<strong>Имя:</strong> <span id="previewName"></span> |
							<strong>Email:</strong> <span id="previewEmail"></span> |
							<strong>Статус:</strong> <i class="glyphicon glyphicon-remove complete_no"></i></p>
						<p id="previewText"></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>