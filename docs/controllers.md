# Controller

## Move controller to it's own directory
- so now we have index as our door & everything goes through it
- but we still can directly access to `controllers` files by typing their name in browser
- e.g `http://localhost:3000/HomeController.php`
- which is not secure
- to solve this
	- take them out of public folder
	- create `app/controllers` folders
	- we will have all our controllers in this folder
- our `index.php` now looks like this

``` 
	// define view directory
	define('DIR_VIEW', '../pages/');
	// define controllers directory
	define('DIR_CONTROLLERS', '../app/controllers/');

	// check which page we are requesting
	$page = isset($_GET['page']) ? $_GET['page'] : 'HomeController';

	// now send output
	include(DIR_CONTROLLERS . $page. '.php');

```

## Controller Class
- now our controller class is very basic and one dimensional
- you include it and every codes get executed line by line
- we can't pick & choose what to execute
- let's say we have a `PostController`
- we want some section to view, some tocreate new post, some to update & some to delete
- to solve this
	- we will convert our controllers to `class`
	- & we will have, methods for diff crud ops

- now before classify controller
- explain how class & inheritance works
- use `class.md`

- Converting `HomeController` to class

```
class HomeController{
	public function index()
	{
		include(DIR_VIEW . 'home.php');
	}
}
```

- this won't work
- because it is not enough to just include class you have to instantiate it
- change `index.php` to

```

// define view directory
define('DIR_VIEW', '../pages/');
// define controllers directory
define('DIR_CONTROLLERS', '../app/controllers/');

// check which page we are requesting
$page = isset($_GET['page']) ? $_GET['page'] : 'HomeController';

// now send output
include(DIR_CONTROLLERS . $page. '.php');
// classify
+ $controller = new $page;
+ $controller->index();

```

## Post Controller
- create a new controller `PostController`

```
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

```
- now it works, for `index.php?page=PostController`
- but how do you call create & save method
- by default it call's controller's `index` method
- how to tell the app which method to call
- it can't read our mind
- ask him to think of an way
- to solve
	- lets add a parameter 'action' to the request
	- e.g: http://localhost:3000/index.php?page=PostController&action=create
	- so `action` here is the method name
- but typing this url with action loads the same view and calls the same method
- so how do we tell index.php to call `create` method when we pass `action=create` parameter
- or `save` method when `action=save` parameter
- change `index.php` to achieve this

```
	// define view directory
	define('DIR_VIEW', '../pages/');
	// define controllers directory
	define('DIR_CONTROLLERS', '../app/controllers/');

	// check which page we are requesting
	$page = isset($_GET['page']) ? $_GET['page'] : 'HomeController';

	// capture action params
	++ $action = isset($_GET['action']) ? $_GET['action'] : 'index';

	// now send output
	include(DIR_CONTROLLERS . $page. '.php');
	// classify
	$controller = new $page;
	-- // $controller->index();
	++ $controller->{$action}();

```
- now explain how can we call the 'save' method