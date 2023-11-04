<?php 

class Home extends Controller
{
	function index () {
		
		$this->view("client/layout", [
			"page"=>"home",
			"title" => "Home Page"
		]);
	}
}

?>