<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	// Log in Admin
	public function index()
	{
		$data['title'] = 'Admin Login';
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('danger', validation_errors());
			$this->load->view('admin/login', $data);
		} else {
			// get email and Encrypt Password
			$email = $this->input->post('email');
			$encrypt_password = md5($this->input->post('password'));
			$user_id = $this->Administrator_Model->adminLogin($email, $encrypt_password);

			if ($user_id) { // && $user_id->role_id == 1
				//Create Session
				$user_data = array(
					'user_id' => $user_id->id,
					'email' => $user_id->email,
					'login' => true
				);
				$this->session->set_userdata($user_data);

				//Set Message
				$this->session->set_flashdata('success', 'Welcome to administrator Dashboard.');
				redirect('admin/index');
			} else {
				$this->session->set_flashdata('danger', 'Login Credentials is invalid!');
				$this->load->view('admin/login', $data);
				//redirect('login');
			}
		}
	}

	public function logout()
	{
		// unset user data
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('user_id');

		//Set Message
		$this->session->set_flashdata('danger', 'You are logged out.');
		//$this->load->view('home/login');
		redirect(base_url("/"));
	}

	public function forget_password($page = 'forget-password')
	{
		if (!file_exists(APPPATH . 'views/' . $page . '.php')) {
			show_404();
		}
		$data['title'] = ucfirst($page);
		$this->load->view($page, $data);
	}
}