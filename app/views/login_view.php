<div class="row">
	<div class="col-md-7 fclear center-block">
		<?php if (\Helpers\Auth::isLogin()): ?>
			<div class="ptb_small">
				<div class="alert alert-info">
					Вы уже авторизованы! Вернуться <a href="/">на главную</a>.
				</div>
			</div>
		<?php else: ?>
			<h3>Авторизация</h3>

			<?php if ($message): ?>
				<div class="alert alert-danger"><?=$message;?></div>
			<?php endif; ?>

			<form method="post">
				<div class="form-group">
					<label for="login">Логин</label>
					<input type="text" name="login" id="login" class="form-control" placeholder="Введите ваш логин" required>
				</div>
				<div class="form-group">
					<label for="password">Пароль</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Введите ваш пароль" required>
				</div>

				<button type="submit" class="btn btn-primary">Войти</button>
				<a href="/" class="btn btn-default">На главную</a>
			</form>
		<?php endif; ?>
	</div>
</div>