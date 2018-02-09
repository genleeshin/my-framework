<?php 

class Controller{
	public function view($file, $data)
	{
		extract($data);

		include(DIR_VIEW . 'head.php');
		include(DIR_VIEW . $file);
		include(DIR_VIEW . 'foot.php');
	}
}