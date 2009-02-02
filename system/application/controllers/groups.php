<?php

class Groups extends Controller {

	function Groups()
	{
		parent::Controller();
		$this->load->library('MySvn');
		
	}
	
	function index()
	{
		$data = array('title' => 'Groups',
					  'view'  => 'groups_index',
					  'groups' => $this->mysvn->get_groups() 
					  );
					  
		$this->load->view('template', $data);
	}
	
	function add()
	{
		$data = array('title' => 'Add Group',
					  'view'  => 'groups_add',
					  );
		
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_dash');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('template', $data);
		}
		else
		{	
			redirect('groups');
		}
	}
	
	function remove()
	{
	}
	
	function show($group)
	{
		
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */