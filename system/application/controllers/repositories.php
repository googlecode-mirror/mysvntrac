<?php

class Repositories extends Controller {

	function Repositories()
	{
		parent::Controller();
		$this->config->load('mysvn');
		$this->load->helper('htpasswd');
		
	}
	
	function index()
	{
		$this->load->helper('directory');
		$map = directory_map($this->config->item('svn_dir'), true);

		$data = array('title' => 'Repositories',
					  'view'  => 'repositories_index',
					  'repositories' => $map );
					  
		$this->load->view('template', $data);
	}
	
	function add()
	{
		$this->load->helper(array('form'));
		
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('repositories_add');
		}
		else
		{
			$name = $this->input->post('name');
			$svn_dir = $this->config->item('svn_dir');

			chdir($svn_dir);
			$line = system("svnadmin create $name", $return);
			
			$trac_dir = $this->config->item('trac_dir');
			$line2 = system("trac-admin $trac_dir/$name initenv '$name' sqlite:db/trac.db svn $svn_dir/$name", $return2);
			
			echo $return . "<br/>";
			echo $return2;
			//redirect('repositories');
		}
	}
	
	function remove()
	{
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */