<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() 
	{
		parent::__construct();   
		$this->load->model('User_model');
		session_start();
    }	

    public function login()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		$user = $this->User_model->get_user($username, md5($password));

		if (!empty($user)) {
			$_SESSION['userID'] = $user[0]->ID;
		}
		redirect('/', 'refresh');
	}

	public function logout()
	{
		unset($_SESSION['userID']);
		redirect('/', 'refresh');
	}

	public function profile() {
		$id = $_SESSION['userID'];
		$users = $this->User_model->get_user_by_id($id);

		if(isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg'])) {
			$this->data['error_msg'] = $_SESSION['error_msg'];
			unset($_SESSION['error_msg']);
		}

		$this->data['user'] = $users[0];
		$this->load->view('profile',$this->data);
	}

	public function update_profile()
	{
		$id = $_SESSION['userID'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$users = $this->User_model->get_user_by_id($id);
		$user = $users[0];

		if(md5($password) != $user->Password) {
			$_SESSION['error_msg'] = 'Anda salah memasukkan password.';
			redirect('/user/profile', 'refresh');
		}

		if(isset($_POST['password_new'])) {
			$password_new = $_POST['password_new'];
		}
		else {
			$password_new = $password;
		}

		$user = $this->User_model->update_profile($id, $username, md5($password_new));
		redirect('/user/profile', 'refresh');
	}
}
