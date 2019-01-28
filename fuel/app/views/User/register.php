<div class="col-md-8"><h3>Register</h3></div>

<div class="col-md-8">

	<div class="card-sharp pad">
		<!----------form------------->
		<?php echo Form::open('/user/register'); ?>
		<!----------username-->
		<div class="form-group">
			<?php echo Form::label('Username', 'username'); ?>
			<?php echo Form::input('username', Input::post('username'),['class' => 'form-control']); ?>
		</div>
		<!----------email-->
		<div class="form-group">
			<?php echo Form::label('Email', 'email'); ?>
			<?php echo Form::input('email', Input::post('email'),['class' => 'form-control']); ?>
		</div>
		<!----------password--->
		<div class="form-group">
			<?php echo Form::label('PASSWORD', 'password'); ?>
			<?php echo Form::input('password', Input::post('password'),['class' => 'form-control']); ?>
		</div>
		<!----------confirmar password--->
		<div class="form-group">
			<?php echo Form::label('Confirm password', 'password'); ?>
			<?php echo Form::input('password_confirm', Input::post('password_confirm'),['class' => 'form-control']); ?>
		</div>
		<!----------enviar-------->
		<div class="actions">
			<?php echo Form::submit('REGISTER','REGISTER', ['class' => 'btn btn-primary'] ); ?>
		</div>
		<!----------cerrar---------->
		<?php echo Form::close('/user/register'); ?>

		<p> ¿Ya tienes una cuenta? <a href="/user/login">Login</a>
	</div>
</div>