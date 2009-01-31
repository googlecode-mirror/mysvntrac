<?php

class Repositories extends Controller {

	function Repositories()
	{
		parent::Controller();
		$this->load->library('MySvn');
		$this->config->load('mysvn');
		$this->load->helper('htpasswd');
	}
	
	function index()
	{
		$data = array('title' => 'Repositories',
					  'view'  => 'repositories_index',
					  'repositories' => $this->mysvn->get_repositories());
					  
		$this->load->view('template', $data);
	}
	
	function add()
	{
		$data = array('title' => 'Add Repository',
					  'view'  => 'repositories_add',
					  );
		
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('template', $data);
		}
		else
		{
			$name = $this->input->post('name');
			$this->mysvn->add_repository($name);			
			redirect('repositories');
		}
	}
	
	function remove($name)
	{
		$this->mysvn->remove_repository($name);			
		redirect('repositories');
	}
	
	function edit()
	{

	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */