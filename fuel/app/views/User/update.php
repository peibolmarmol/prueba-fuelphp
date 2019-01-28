<div class="col-md-8"><h3>Editar usuario</h3></div>

<div class="col-md-8">

	<div class="card-sharp pad">
		<!----------form------------->
		<?php echo Form::open('/user/update'); ?>
		<!----------email-->
		<div class="form-group">
			<?php echo Form::label('Email', 'email'); ?>
			<?php echo Form::input('email', Input::post('email'),['class' => 'form-control']); ?>
		</div>
		<!----------old password--->
		<div class="form-group">
			<?php echo Form::label('Old password', 'password'); ?>
			<?php echo Form::input('old_password', Input::post('old_password'),['class' => 'form-control']); ?>
		</div>
		<!----------password--->
		<div class="form-group">
			<?php echo Form::label('New password', 'password'); ?>
			<?php echo Form::input('password', Input::post('password'),['class' => 'form-control']); ?>
		</div>
		<!----------enviar-------->
		<div class="actions">
			<?php echo Form::submit('update','update', ['class' => 'btn btn-primary'] ); ?>
		</div>
		<!----------cerrar---------->
		<?php echo Form::close('/user/update'); ?>
	</div>
</div>