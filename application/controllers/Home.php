<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() 
	{
		parent::__construct();   
        session_start();
		if($this->config->item('maintenance') == TRUE) {
        	$content = $this->load->view('under_maintenance', '', TRUE);
			echo $content;
        	die();
    	}
	}

	public function index()
	{
		if( !isset($_SESSION['userID']) ) {
			$this->load->view('login');
		}
		else {
			$this->load->view('index');	
		}
	}
}