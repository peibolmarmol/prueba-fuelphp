<h1>Edit Post</h1>
<?php echo Form::open('posts/edit/<?php echo $post->id;?>'); ?>
	<div class="form-group">
		<?php echo Form::label('Title','title'); ?>
		<?php echo Form::input('title', Input::post('title',isset($post) ? $post->title : ''), array('class' => 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo Form::label('Caterory','category'); ?>
		<?php echo Form::select('category', '0',
			array(
				'0'=>'Select Category',
				'Test'=> 'Test',
				'FuelPHP'=> 'FuelPHP'),
			array('class' => 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo Form::label('Body','body'); ?>
		<?php echo Form::textarea('body', Input::post('body',isset($post) ? $post->body : ''), array('class' => 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo Form::label('Tags','tags'); ?>
		<?php echo Form::input('tags', Input::post('tags',isset($post) ? $post->tags : ''), 
		array('class' => 'form-control')); ?>
	</div>

	<input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
	<div class="actions">
		<?php echo Form::submit('send'); ?>
	</div>
<?php echo Form::close(); ?>