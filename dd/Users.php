<?php
defined('BASEPATH') OR exit('No direct access allowed');
class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('users_model');
	}
	public function signup()
	{
		$data['title']= "Sign Up";
		$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('passconf', 'Confirm Password', 'required|matches[password]');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run() == false)
		{
			$this->load->view('header',$data);
			$this->load->view('users/signup',$data);
			//$this->load->view('footer',$data);
		}
		else
		{

			$userdata = array(
				'first_name' => $this->input->post('first_name', TRUE),
				'last_name' => $this->input->post('last_name', TRUE),
				'email' => $this->input->post('email', TRUE),
				'password' => md5($this->input->post('password', TRUE)),
				'created_at' => date('Y-m-d H:i:s', time()),
			);

			$this->users_model->save($userdata);
			$this->session->set_flashdata('message','Registration Successful.');
			redirect('users/login');
		}
	}

	public function login()
	{
		$data['title'] = "Login";
		$this->load->view('header',$data);
		$this->load->view('users/login',$data);
		//$this->load->view('footer',$data);
	}
}