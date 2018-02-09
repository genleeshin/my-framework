<p><a class="btn btn-primary" href="/index.php?page=PostController&action=create">Create Post</a></p>
<h1><?=$post_title?></h1>
<p><small><?=$post_description?></small></p>
<ul>
<?php foreach($posts as $post) : ?>
	<li><?=$post?></li>
<?php endforeach; ?>
</ul>