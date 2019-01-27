<?php if(Session::get_flash('success')) : ?>

	<div class="alert alert-success"> <?php echo Session::get_flash('success'); ?> </div>

<?php endif;?>
<?php if(Session::get_flash('error')) : ?>

	<div class="alert alert-success"> <?php echo Session::get_flash('error'); ?> </div>

<?php endif;?>
<?php foreach($posts as $post) : ?>

<div class="blog-post">
        <h2 class="blog-post-title"><?php echo $post->title;?></h2>
        <p class="blog-post-meta"><?php echo $post->create_date; ?> <a href="#">Mark</a></p>
        <?php echo Str::truncate($post->body, 200); ?>
        <br>
        <a class="btn btn-default" href="posts/view/<?php echo $post->id;?>">Ver Post</a>
      </div><!-- /.blog-post -->
<?php endforeach; ?>