<?php

class Users extends Controller {

	function Users()
	{
		parent::Controller();
		$this->load->library('MySvn');
		$this->load->helper('htpasswd');
		
	}
	
	function index()
	{
		$data = array('title' => 'Users',
					  'view'  => 'users_index',
					  'users' => $this->mysvn->get_users() 
					  );
					  
		$this->load->view('template', $data);
	}
	
	function add()
	{
		$data = array('title' => 'Add User',
					  'view'  => 'users_add',
					  );
		
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('template', $data);
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
		echo $this->config->item('htpasswd_file');
	}
	
	function groups()
	{
		$this->mysvn->parse_authz_file();
	}
	
	function test()
	{
		$authz_file = file_get_contents($this->config->item('authz_file'));
		
		print_r($authz_file . "\n\n\n");
		
		//preg_match_all("/\[(?P<group>.*)\]\n/", $authz_file, $offset, PREG_SET_ORDER);
		
		/*preg_match_all("/\[.*\]\n/", $authz_file, $offset, PREG_PATTERN_ORDER);
		
		var_dump($offset . "\n\n\n");*/
		
		//$array = preg_grep(


		//$array = preg_split("/\[.*\]\n/", $authz_file,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
		
		$authz = preg_split("/\[/", $authz_file,-1,PREG_SPLIT_NO_EMPTY);
								
		$authz_array = array();
		
		foreach ($authz as $block) {
			
			$parts = split("\]\n", $block);
		
			//if ($parts[0] == 'groups') {
				
				$lines = split("\n", $parts[1]);
				
				foreach($lines as $line)
				{
					if ($line != '') {
						
						$ps = split("\s?=\s?", $line);
						
						$authz_array[ $parts[0] ][ trim($ps[0]) ] = split("\s?,\s?", $ps[1]);
					}
					
					
					//$perm[$ps[0]] = split("\s?,\s?", $ps[1]);
					
					
					
					//authz_array[$parts[0]][$ps[0]] = split("\s?,\s?", $ps[1]);
				}
				
				//$perm[$split[0]] = split$split[1]
			//}

			
			
			
		}
		
		
		//print_r($authz_array);
								
		
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */