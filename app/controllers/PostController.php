<?php 

class PostController{
	public function index()
	{
		$posts = ['Post 1', 'Post 2'];
		
		include(DIR_VIEW . 'posts.php');
	}

	public function create()
	{
		include(DIR_VIEW . 'create-post.php');
	}

	public function save()
	{
		var_dump($_POST);
	}
}