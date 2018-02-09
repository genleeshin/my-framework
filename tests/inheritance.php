<?php 

class iPhone{
	// defaults
	public $name = 'iPhone Unknown';
	public $displaySize = 'xx-inch';
	public $ram = 'xxmb';

	public function getRam()
	{
		echo $this->name . ' has '. $this->ram . " ram \n";
	}

	public function getDisplaySize()
	{
		echo $this->name .  " has " . $this->displaySize . " display \n";
	}
}

class iPhone5 extends iPhone{
	public $name = 'iPhone 5';
	public $displaySize = '5-inch';
	public $ram = '512mb';

}

class iPhone6 extends iPhone{
	public $name = 'iPhone 6';
	public $displaySize = '5.5-inch';
	public $ram = '1gb';
}

// iphone 5

$iphone5 = new iPhone5;

$iphone5->getRam();
$iphone5->getDisplaySize();

// iphone 6

$iphone6 = new iPhone6;

$iphone6->getRam();
$iphone6->getDisplaySize();

class iPhone7 extends iPhone{
	// public $name = 'iPhone 6';
	// public $displaySize = '5.5-inch';
	// public $ram = '1gb';
}

// instantiate iphone 7

$iphone7 = new iPhone7;
$iphone7->getRam();