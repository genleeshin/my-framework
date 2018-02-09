## Header & Footer
- add header & footer to both home and post controller
- show it's a bad practice to add header and footer in every view
- as using the same code is against oop
- so create separate header & footer files
- now add them to Home and Post Controller

```
`HomeController`
class HomeController{
	public function index()
	{
		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . 'home.php');
		include(DIR_VIEW . 'foot.php');
	}
}
``` 


```
`PostController.php`

class PostController{
	public function index()
	{
		$posts = ['Post 1', 'Post 2'];

		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . 'posts.php');
		include(DIR_VIEW . 'foot.php');
	
	}

	public function create()
	{
		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . 'create-post.php');
		include(DIR_VIEW . 'foot.php');
	}

	public function save()
	{
		var_dump($_POST);
	}
}

```
- so whats the problem here
- we are again repeating codes
- so, how do we solve this problem
- let's create a function `view` in `PostController.php`

```
public function view($file)
{
	include(DIR_VIEW . 'head.php');
	include(DIR_VIEW . $file);
	include(DIR_VIEW . 'foot.php');
}
```
- and change `PostController@create()` as


```
public function create()
{
	$this->view('create-post.php');
}
```

- so the file now looks like

```
class PostController{
	public function index()
	{
		$posts = ['Post 1', 'Post 2'];

		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . 'posts.php');
		include(DIR_VIEW . 'foot.php');
	
	}

	public function create()
	{
		$this->view('create-post.php');
	}

	public function save()
	{
		var_dump($_POST);
	}

	public function view($file)
	{
		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . $file);
		include(DIR_VIEW . 'foot.php');
	}
}

```

- now go to `http://localhost:3000/index.php?page=PostController&action=create`
- it should work as before
- now change `PostController@index()` as

```
public function index()
{
	$posts = ['Post 1', 'Post 2'];

	$this->view('posts.php');

}

```

- and the posts are not visible
- because the `PostController@view` method don't have access to `$posts` variable in `PostController@index`
- so, we have to pass the variable to the function as well
- our new `PostController` class now looks like this

```
class PostController{
	public function index()
	{
		$posts = ['Post 1', 'Post 2'];

		$this->view('posts.php', $posts);
	
	}

	public function create()
	{
		$this->view('create-post.php');
	}

	public function save()
	{
		var_dump($_POST);
	}

	public function view($file, $posts)
	{
		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . $file);
		include(DIR_VIEW . 'foot.php');
	}
}

```

- now change `PostController@create` to

```
public function create()
{
	$form_title = 'Post Form';
	$this->view('create-post.php', $form_title);
}

```

- and add `<h1><?=$form_title?></h1>` at the very top of `pages/create-post.php`
- now this won't work, why?
- because, we are receving this variable as `posts`
- so `$form_title` become `$posts` inside `view` function
- so in `pages/create-post.php`, if we replace 

```
`<h1><?=$form_title?></h1>`

with

`<h1><?=$posts?></h1>`
```

- it whould work
- but this does not look good, does not make sense
- it feels like a array, rather than a title
- also
- lets say we want to send more parameters to view function
- they might become too many
- plus their names become hard to remember
- consider this code

```
class PostController{
	public function index()
	{
		$posts = ['Post 1', 'Post 2'];
		$post_title = 'Posts';
		$post_description = 'Posts list';

		$this->view('posts.php', $posts, $post_title, $post_description);
	
	}

	public function create()
	{
		$form_title = 'Post Form';
		$btn_title = 'Save';
		$this->view('create-post.php', $form_title, $btn_title);
	}

	public function save()
	{
		var_dump($_POST);
	}

	public function view($file, $posts, $post_title, $description)
	{
		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . $file);
		include(DIR_VIEW . 'foot.php');
	}
}
```
- one has 2 params, another 3, another might have 20
- so how do we solve this problem
- let's send them as array
- now our `PostController` looks like this

```
class PostController{
	public function index()
	{
		$posts = ['Post 1', 'Post 2'];
		$post_title = 'Posts';
		$post_description = 'Posts list';

		$data = [
			'posts' => $posts,
			'post_title' => $post_title,
			'post_description' => $post_description
		]

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
		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . $file);
		include(DIR_VIEW . 'foot.php');
	}
}
```

- now we can send as many parameters as we want
- and access them as `$data['varname']`
- but, I still don't like it
- When I send variable `$posts` I want to access it as `$posts` in view file as well
- to solve this we can use `extract` function

```

public function view($file, $data)
{
	extract($data);

	include(DIR_VIEW . 'head.php');
	include(DIR_VIEW . $file);
	include(DIR_VIEW . 'foot.php');
}

```

- explain extract
- now
- create copy `PostController@view` function to `HomeController`
- and render output using the function
- new `HomeController`

```
class HomeController{
	public function index()
	{
		$this->view('home.php');
	}

	public function view($file, $data)
	{
		extract($data);

		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . $file);
		include(DIR_VIEW . 'foot.php');
	}
}

```

- well, duplicate code again
- now, how do we solve this problem
- create a class `Controller.php`
- and let `HomeController` and `PostController` inherit from it
- well, it's still not perfect

## Layout

- it's working
- but that's not how views work
- views usually have a layout file which organizes other views
- here everything is separated
- you have, header, contnet then footer
- & u have to alway main that order
- whenever you include a part it gets rendered immedietly
- you cannot delay the output
- plus lets say your app has plugins
- and those plugins has their own view, how you would manage them
- let's say you have 2 plugins
- one is callbed before you call the controller, which render `welcome to my framework'
- other after you call the controller
- another say 'goodbye! see you again'
- 