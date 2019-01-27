<div class="blog-post">
        <h2 class="blog-post-title"><?php echo $post->title;?></h2>
        <p class="blog-post-meta"><?php echo $post->create_date; ?> <a href="#">Mark</a></p>
        <?php echo $post->body; ?>
        <br>
        <ul>
        	<li> Category: <?php echo $post->category; ?> </li>
        	<li> Tags: <?php echo $post->tags; ?> </li>
        </ul>

</div><!-- /.blog-post -->

<hr>
<a class="btn btn-default" href="/posts/edit/<?php echo $post->id; ?>"> Editar</a>
<a class="btn btn-default" href="/posts/delete/<?php echo $post->id; ?>"> Delete</a>
<br><br>