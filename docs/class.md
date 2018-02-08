## Concept
- think about iphone x
- you have one & adnan have one, same exact iphone version, screen, ram etc
- what's the difference between your's and adnan's
- what makes your's, your's & adnan's adnan's
- and the answer is data, or objects
- class is all about objects they hold
- example

```
<?php 

class iPhoneX{

	public $name = null;

	// pictures holder
	protected $pictures = [];

	public function __construct($name){
		$this->name = $name;
	}

	public function owner(){
		return $this->name;
	}

	public function takePicture($pictureName)
	{
		array_push($this->pictures, $pictureName);
	}

	public function photoGallery()
	{
		foreach($this->pictures as $picture){
			echo $picture . "\n";
		}
	}
}

$sayems = new iPhoneX('Sayem');

$adnans = new iPhoneX('Adnan');

// sayem taking pictures
$sayems->takePicture('sam1.jpg');
$sayems->takePicture('sam2.jpg');

// adnan taking pictures
$adnans->takePicture('adnan1.jpg');
$adnans->takePicture('adnan2.jpg');

// get saymes pictures

$sayems->photoGallery();
// $adnans->photoGallery();

```

- now look what happens if I make `picture` variable static

```
<?php 

class iPhoneX{

	public $name = null;

	// pictures holder
	protected static $pictures = [];

	public function __construct($name){
		$this->name = $name;
	}

	public function owner(){
		return $this->name;
	}

	public function takePicture($pictureName)
	{
		array_push(static::$pictures, $pictureName);
	}

	public function photoGallery()
	{
		foreach(static::$pictures as $picture){
			echo $picture . "\n";
		}
	}
}

$sayems = new iPhoneX('Sayem');

$adnans = new iPhoneX('Adnan');

// sayem taking pictures
$sayems->takePicture('sam1.jpg');
$sayems->takePicture('sam2.jpg');

// adnan taking pictures
$adnans->takePicture('adnan1.jpg');
$adnans->takePicture('adnan2.jpg');

// get saymes pictures

$sayems->photoGallery();
// $adnans->photoGallery();

```
- now your's and adnan's phones are in sync
- you take pictures and it immedietly appears on adnans
- so data are always same, but you can perform diff actions
```
protected static num1=10;
protected static num2=5;

public static function add(){
	echo ($num1 + $num2) . "\n";
}

public static function sub(){
	echo ($num1 - $num2) . "\n";
}

```
- so altho data is same, you can perform different actions at the same time
- note static won't have access to instanctiated variables or methods
- this won't work inside static methods
- altho, instantiated methods have access to static methods & variables
- so when to use static
- consider this
- let's add a static function 'displaySize'
- now why make it static
	- cause a phone's display will always remain the same, you can make it bigger or shorter
	- it's same for sayme's and adnan's iphoneX
	- so, we will define it a static
	- another benefit of static file is, it is only initialized once, the first time
	- they share the same memory address in all instance
- cons
	- you can't access it from instance objects, vars etc


```
class iPhoneX{

	public $name = null;

	// cannot be changed
	protected static $displaySize = '6-inch';

	// pictures holder
	// protected $pictures = [];
	protected static $pictures = [];

	public function __construct($name){
		$this->name = $name;
	}

	public function owner(){
		return $this->name;
	}

	public function takePicture($pictureName)
	{
		// array_push($this->pictures, $pictureName);
		array_push(static::$pictures, $pictureName);
	}

	public function photoGallery()
	{

		/*foreach($this->pictures as $picture){
			echo $picture . "\n";
		}*/

		foreach(static::$pictures as $picture){
			echo $picture . "\n";
		}
	}

	public static function displaySize()
	{
		echo self::displaySize . "\n";
	}

	public static function myName()
	{
		// won't work
		ehco $this->name . "\n";
	}
}

$sayems = new iPhoneX('Sayem');

$adnans = new iPhoneX('Adnan'

// won't work
$sayems->displaySize();

// works
$sayems::displaySize();
iPhoneX::displaySize();

```

## extends