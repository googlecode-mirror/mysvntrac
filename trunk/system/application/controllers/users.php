<?php

class Users extends Controller {

	function Users()
	{
		parent::Controller();
		$this->config->load('mysvn');
		$this->load->helper('htpasswd');
		
	}
	
	function index()
	{
		$data = array('title' => 'Users',
					  'view'  => 'users_index',
					  'users' => htpasswd_show($this->config->item('htpasswd_file')) );
					  
		$this->load->view('template', $data);
	}
	
	function add()
	{
		$this->load->helper(array('form'));
		
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('users_add');
		}
		else
		{	
			htpasswd_add($this->config->item('htpasswd_file'), 
						 $this->input->post('username'), 
						 $this->input->post('password') );
			
			redirect('users');
		}
	}
	
	function remove()
	{
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */