<?php

class csrf
{

	public function get_token_id()
	{
		if (!isset($_SESSION['CSRF_TOKEN']))
		{
			$_SESSION['CSRF_TOKEN'] = $this->random(10);
		}
		
		return $_SESSION['CSRF_TOKEN'];
	}

	public function get_token($token_id)
	{
		if (!isset($_SESSION[$token_id]))
		{
			$_SESSION[$token_id] = hash('sha256', $this->random(500));
		}
		
		return $_SESSION[$token_id];
	}
	
	public function check_valid($method)
	{
		$args = strtolower($method);
		
		if ($args == 'post' || $args == 'get')
		{
			$post = $_POST;
			$get = $_GET;
			
			if (isset(${$args}[$this->get_token_id()]) && ${$args}[$this->get_token_id()] == $this->get_token_id())
			{
				return true;
			}
		}
		
		return false;
	}
	
	public function form_names($names, $regenerate)
	{
		$values = array();
		foreach ($names as $n) 
		{
			if ($regenerate == true)
			{
				unset($_SESSION[$n]);
			}
			$s = isset($_SESSION[$n]) ? $_SESSION[$n] : $this->random(10); /* TODO: proteção anti-random igual */
			$_SESSION[$n] = $s;
			$values[$n] = $s;       
		}
		return $values;
	}
	
	public function random($len)
	{
		$ret = "";
		
		while (strlen($ret) < $len)
		{
			$rand = mt_rand(1, 999999999);
			$ret .= "$rand";
		}
		
		if (strlen($ret) > $len)
		{
			$ret = substr($ret, 0, $len);
		}
		
		return $ret;
	}

}

?>