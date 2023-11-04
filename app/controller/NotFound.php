<?php 
class NotFound extends Controller
{
	public function index() { 
		$this->view("client/layout",[
			"page" => "404",
			"title" => "Not Found",
		]);
	}
}
?>