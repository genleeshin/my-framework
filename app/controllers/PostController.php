<?php 

require('Controller.php');

class PostController extends Controller{
	public function index()
	{
		$posts = ['Post 1', 'Post 2'];
		$post_title = 'Posts';
		$post_description = 'Posts list';

		$data = [
			'posts' => $posts,
			'post_title' => $post_title,
			'post_description' => $post_description
		];

		$this->view('posts.php', $data);
	
	}

	public function create()
	{
		$form_title = 'Post Form';
		$btn_title = 'Save';
		$this->view('create-post.php', [
			'form_title' => $form_title,
			'btn_title' => $btn_title
		]);
	}

	public function save()
	{
		var_dump($_POST);
	}

	public function view($file, $data)
	{
		extract($data);

		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . $file);
		include(DIR_VIEW . 'foot.php');
	}
}