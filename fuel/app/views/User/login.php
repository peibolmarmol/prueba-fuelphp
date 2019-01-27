<div class="col-md-8"><h3>Login</h3></div>

<div class="col-md-8">

	<div class="card-sharp pad">
		<!----------form------------->
		<?php echo Form::open('/user/login'); ?>
		<!----------username-->
		<div class="form-group">
			<?php echo Form::label('Email', 'email'); ?>
			<?php echo Form::input('email', Input::post('email'),['class' => 'form-control']); ?>
		</div>
		<!----------password--->
		<div class="form-group">
			<?php echo Form::label('PASSWORD', 'password'); ?>
			<?php echo Form::input('password', Input::post('password'),['class' => 'form-control']); ?>
		</div>
		<!----------enviar-------->
		<div class="actions">
			<?php echo Form::submit('login','LOGIN', ['class' => 'btn btn-primary'] ); ?>
		</div>
		<!----------cerrar---------->
		<?php echo Form::close('/user/login'); ?>

		<p> ¿No eres usuario? <a href="/user/register">Regístrate</a>
	</div>
</div>