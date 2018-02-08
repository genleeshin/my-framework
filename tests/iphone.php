<?php 

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
		echo self::$displaySize . "\n";
	}
}

$sayems = new iPhoneX('Sayem');

// $adnans = new iPhoneX('Adnan');

// // sayem taking pictures
// $sayems->takePicture('sam1.jpg');
// $sayems->takePicture('sam2.jpg');

// // adnan taking pictures
// $adnans->takePicture('adnan1.jpg');
// $adnans->takePicture('adnan2.jpg');

// // get saymes pictures

// $sayems->photoGallery();
// // $adnans->photoGallery();

// won't work
$sayems->displaySize();

// works
$sayems::displaySize();
iPhoneX::displaySize();