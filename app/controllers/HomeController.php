<?php 

require('Controller.php');

class HomeController extends Controller{
	public function index()
	{
		$this->view('home.php');
	}

	
}