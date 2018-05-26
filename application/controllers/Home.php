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

	public function back_up()
	{
		if( !isset($_SESSION['userID']) ) {
			$this->load->view('login');
		}
		else {
			$this->load->dbutil();

			$prefs = array(     
					'format'      => 'zip',             
					'filename'    => 'laju_utama.sql'
				);

			$backup =& $this->dbutil->backup($prefs); 

			$db_name = 'Backed Up on '. date("Y-m-d H.i.s") .'.zip';
			$save = '/'.$db_name;

			$this->load->helper('file');
			write_file($save, $backup); 

			$this->load->helper('download');
			force_download($db_name, $backup);	
		}
		redirect('/', 'refresh');		
	}
}