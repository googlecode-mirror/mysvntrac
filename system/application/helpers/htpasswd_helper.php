<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('htpasswd_add'))
{
	function htpasswd_add($filename, $username, $password) 
	{
		$data = $username.":".htpasswd($password)."\n";
		if (is_writable($filename)) {
			if (!$handle = fopen($filename, 'a')) {
				//echo "Cannot open file ($filename)";
				exit;
			}	
			if (fwrite($handle, $data) === FALSE) {
				//echo "Cannot write to file ($filename)";
				exit;
			}
			//echo "Success, wrote ($data) to file ($filename)";
		fclose($handle);
		} else {
			//echo "The file $filename is not writable";
		}
	}
}

if ( ! function_exists('htpasswd_show'))
{
	function htpasswd_show($filename)
	{
		$file = file($filename);
		$array = array();
		$count = count($file);
		for ($i = 0; $i < $count; $i++)
		{
			list($username, $password) = explode(':', $file[$i]);
			$array[] = array("username" => $username, "password" => $password);
		}
		return $array;
	}
}

if ( ! function_exists('htpasswd_delete'))
{
	function htpasswd_delete($filename, $username) 
	{
		$file = file($filename);
		$pattern = "/". $username."/";
		
		foreach ($file as $key => $value) {
			if(preg_match($pattern, $value)) { $line = $key;  }
		}
		
		unset($file[$line]);
		
		if (!$fp = fopen($filename, 'w+'))
		{
			print "Cannot open file ($file)";
			exit;
		}
			
		if($fp)
		{
			foreach($file as $line) { fwrite($fp,$line); }
			fclose($fp);
		}
	}
}
 
if ( ! function_exists('htpasswd'))
{
	function htpasswd($password)
	{
		$password = crypt(trim($password),base64_encode(CRYPT_STD_DES));
		return $password;
	}
}

/* End of file Htpasswd.php */
/* Location: ./system/application/helpers/Htpasswd.php */