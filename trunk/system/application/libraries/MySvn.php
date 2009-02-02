<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MySvn {

	var $CI;

	function MySvn()
	{		
		$this->CI =& get_instance();
		$this->CI->config->load('mysvn');
		log_message('debug', "MySvn Class Initialized");
	}
	
	function get_users()
	{
		$this->CI->config->load('mysvn');
		$htpasswd_file = file($this->CI->config->item('htpasswd_file'));
		$array = array();
		$count = count($htpasswd_file);
		for ($i = 0; $i < $count; $i++)
		{
			list($username, $password) = explode(':', $htpasswd_file[$i]);
			
			$authz = $this->parse_authz_file();			
			$groups = array();
			foreach($authz['groups'] as $group => $members) {
				if (in_array($username, $members)) $groups[] = $group;					
			}  
			
			$users[] = array("username" => $username, "password" => $password, "groups" => $groups);
		}
		log_message('debug', "Retrieved Users From Htpasswd File");
		return $users;
	}
	
	function add_user($username, $password)
	{
		$data = $username.":".$this->_htpasswd($password)."\n";
		$htpasswd_file = $this->CI->config->item('htpasswd_file');
		if (is_writable($htpasswd_file)) {
			if (!$handle = fopen($htpasswd_file, 'a')) {
				log_message('debug', "Cannot Open Htpasswd File: ".$htpasswd_file);
				exit;
			}	
			if (fwrite($handle, $data) === FALSE) {
				log_message('debug', "Cannot Write To Htpasswd File: ".$htpasswd_file);
				exit;
			}
			log_message('debug', "Written To Htpasswd File: ".$htpasswd_file);
		fclose($handle);
		} else {
			log_message('debug', "Non Writable Htpasswd File: ".$htpasswd_file);
		}
	}
	
	function _htpasswd($password)
	{
		$password = crypt(trim($password),base64_encode(CRYPT_STD_DES));
		return $password;
	}

	function remove_user($username) 
	{
		$htpasswd_file = file($this->CI->config->item('htpasswd_file'));
		$pattern = "/". $username."/";
		
		foreach ($htpasswd_file as $key => $value) {
			if(preg_match($pattern, $value)) { $line = $key;  }
		}
		unset($htpasswd_file[$line]);
		if (!$fp = fopen($this->CI->config->item('htpasswd_file'), 'w+'))
		{
			log_message('debug', "Cannot Open Htpasswd File: ".$htpasswd_file);
			exit;
		}
		if($fp)
		{
			foreach($file as $line) { fwrite($fp,$line); }
			fclose($fp);
		}
	}
	
	function get_groups()
	{
		$authz = $this->parse_authz_file();
		return $authz['groups'];
/*		if (isset($authz['groups'])) {
			return array_keys($authz['groups']);
		} else {
			return array();
		}
*/	}
	
	function parse_authz_file()
	{
		
		$authz_file = file_get_contents($this->CI->config->item('authz_file'));
		$authz = preg_split("/\[/", $authz_file,-1,PREG_SPLIT_NO_EMPTY);			
		$authz_array = array();
		
		foreach ($authz as $block) {
			
			$parts = split("\]\n", $block);
			$lines = split("\n", $parts[1]);
			
			foreach($lines as $line)
			{
				if ($line != '') {
					
					$ps = explode("=", $line);
					
					$nm = explode(",", $ps[1]);
					array_walk($nm, array($this, '_trim_val'));
					
					$authz_array[ $parts[0] ][ trim($ps[0]) ] = $nm;
				}
			}	
		}
		return $authz_array;
	}
	
	function _trim_val(&$val)
	{
		$val = trim($val);
	}
	
	function get_repositories()
	{
		$this->CI->load->helper('directory');
		$repositories = directory_map($this->CI->config->item('svn_dir'), true);
		log_message('debug', "Retrieved Repositories");
		return $repositories == null ? array() : $repositories;
	}
	
	function add_repository($name)
	{
		$svn_dir = $this->CI->config->item('svn_dir');
		chdir($svn_dir);
		$line = exec("svnadmin create $name", $return);
		log_message('debug', "Create Svn Repository: ".$return);
		$trac_dir = $this->CI->config->item('trac_dir');
		if ($this->CI->config->item('is_trac_pre_0_9')) {
			$line2 = exec("trac-admin $trac_dir/$name initenv '$name' $svn_dir/$name", $return);
		} else {
			$line2 = exec("trac-admin $trac_dir/$name initenv '$name' sqlite:db/trac.db svn $svn_dir/$name", $return);
		}
		log_message('debug', "Create Trac Environment: ".$return);
	}
	
	function remove_repository($name)
	{
		exec('rm -r '.$this->CI->config->item('svn_dir')."/".$name, $return);
		log_message('debug', "Removed Svn Repository: ".$return);
		exec('rm -r '.$this->CI->config->item('trac_dir')."/".$name, $return);
		log_message('debug', "Removed Trac Environment: ".$return);
	}

}
	
/* End of file MySvn.php */
/* Location: ./system/libraries/MySvn.php */