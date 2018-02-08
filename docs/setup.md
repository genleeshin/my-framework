## Initial Setup
| public
	| index.php
	| HomeController.php
	| AboutController.php
	| ContactController.php

| views
	| about.php
	| contact.php
	| home.php

# Index

```
// inddex.php
include('../pages/index.php');

// view: pages/index.php
<ul>
	<li><a href="/HomeController.php">Home</a></li>
	<li><a href="/AboutController.php">About</a></li>
	<li><a href="/ContactController.php">Contact</a></li>
</ul>
```

## Homepage

```

// HomeController.php
include('../pages/home.php');

// pages/home.php
<h1>Homepage</h1>>

```

## Contact Page
```
// ContactController.php
include('../pages/home.php');

// pages/contact.php

<h1>Contact page</h1>
```

## About Page
```

```
// ContactController.php
include('../pages/home.php');

// pages/about.php

<h1>About page</h1>
```

## Problem with this setup

- you have no control
- many doors to your application
- you have to authenticate in every pages that requires authentications
- you have to establish database connection in each pages
- in case of any system change, you have to update every page
- Let's say for some reason you want to change your `pages` folder name to `views`
- now you have to open every page and change path `../pages/page.php` to `../views/page.php` 
- also you want to take your site for maintenance
	- you have to take every page offline

## solving this problem
- have one single file which is door to you whole application
- route everything through this door
- to do this
- make `index.php` is the door to your whole application
- every request will go through this, and pass all tests before reaching any other pages 
- now rewrite your `index.php` so that will capture and serve all requests 

```
	
	// define view directory
	define('DIR_VIEW', '../pages/');

	// check which page we are requesting
	$page = isset($_GET['page']) ? $_GET['page'] : 'HomeController';

	// render page
	include($page. '.php');

```

