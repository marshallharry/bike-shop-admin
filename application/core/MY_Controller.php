<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function __construct() 
	{
		parent::__construct();   
		session_start();
		if($this->config->item('maintenance') == TRUE) {
        	$content = $this->load->view('under_maintenance', '', TRUE);
			echo $content;
        	die();
    	}
        if( !isset($_SESSION['userID']) ) {
		    redirect('/', 'refresh');
		}
    }
}
