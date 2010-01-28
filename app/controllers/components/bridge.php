<?php 

/*
 * VBulletin Brigde Component
 * 
 * Author: Enang Yusuf - enangyusuf@gmail.com
 * Original Source for kohana author Netrosis ( www.syphex.com )
 * 
 * Last Modified: 28 Januari 2010
 */ 

class BridgeComponent extends Object 
{
   var $controller = true;
 	var $cookie_prefix;
	var $default_user = array(
		'userid' 			=> 0,
		'username'			=> 'guest',
		'usergroupid' 		=> 3,
		'membergroupids'	=> '',
		'sessionhash'		=> '',
		'avatarurl'			=> '',
		'logouthash'		=> '',
		'salt'				=> '',
		'email'				=> ''
	);
	
	var $userinfo;
	var $config;
	var $vb;
	
   function startup(&$controller) {
		$this->controller =& $controller;   
		
		Configure::load('vbulletin');
		$this->config = Configure::read('vb');

		if(empty($this->config['license'])) die('no vBulletin licence, exiting');
		
		$this->cookie_prefix = $this->config['cookie_prefix'];
		$this->vb = $this->controller->Vbulletin;
   }

	function authenticate_session() {
		$userid = @$_COOKIE[$this->cookie_prefix . 'userid'];		
		$password = @$_COOKIE[$this->cookie_prefix . 'password'];
		$sessionhash = @$_COOKIE[$this->cookie_prefix . 'sessionhash'];
		
		$this->set_userinfo($this->default_user);
		
		if(!$sessionhash) return;

		$timeout = time() - $this->config['cookie_timeout'];
		$session = $this->vb->getSession($sessionhash,$this->fetch_id_hash(),$timeout);
		
		if(!$session) return;

		if($session['host'] != $this->fetch_ip()) return;		
		
		$userinfo = $this->vb->getUser($session['userid']);		
		
		if(!$userinfo) return; 
		
		$securitytoken_raw = sha1(@$userinfo['userid'] . sha1(@$userinfo['salt']) . sha1($this->config['license']));
		$userinfo['logouthash'] = time() . '-' . sha1(time() . $securitytoken_raw);									
		
		$this->set_userinfo($userinfo);		
		
		$this->userinfo['sessionhash'] = $session['sessionhash'];
		
		if($this->userinfo['avatarid'] > 0){
			$this->userinfo['avatarurl'] = $this->vb->getDefaultAvatar($userinfo['avatarid']);
		} elseif($this->vb->getAvatar($userinfo['userid'])) {
			$this->userinfo['avatarurl'] = $this->vb->getAvatar($userinfo['userid']);
		} else {
			$this->userinfo['avatarurl'] = $this->config['default_avatar'];
		}
		return false;
	}
	
	function set_userinfo($userinfo) {
		foreach($userinfo as $key => $value) {
			$this->userinfo[$key] = $value;
		}
	}

	function fetch_id_hash() {		
		return md5(@$_SERVER['HTTP_USER_AGENT'] . $this->fetch_substr_ip($this->fetch_alt_ip()));
	}
	
	function fetch_substr_ip($ip, $length = null) {
		if($length === NULL OR $length > 3) {
			$length = 1;
		}
		return implode('.', array_slice(explode('.', $ip), 0, 4 - $length));
	}
	
	function fetch_ip() {
		return $_SERVER['REMOTE_ADDR'];
	}

	function fetch_alt_ip() {
		$alt_ip = $_SERVER['REMOTE_ADDR'];

		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$alt_ip = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
			$ranges = array(
				'10.0.0.0/8' => array(ip2long('10.0.0.0'), ip2long('10.255.255.255')),
				'127.0.0.0/8' => array(ip2long('127.0.0.0'), ip2long('127.255.255.255')),
				'169.254.0.0/16' => array(ip2long('169.254.0.0'), ip2long('169.254.255.255')),
				'172.16.0.0/12' => array(ip2long('172.16.0.0'), ip2long('172.31.255.255')),
				'192.168.0.0/16' => array(ip2long('192.168.0.0'), ip2long('192.168.255.255')),
			);
			foreach ($matches[0] AS $ip) {
				$ip_long = ip2long($ip);
				if ($ip_long === false OR $ip_long == -1) {
					continue;
				}

				$private_ip = false;
				foreach ($ranges AS $range) {
					if ($ip_long >= $range[0] AND $ip_long <= $range[1])
					{
						$private_ip = true;
						break;
					}
				}

				if (!$private_ip) {
					$alt_ip = $ip;
					break;
				}
			}
		} else if (isset($_SERVER['HTTP_FROM'])) {
			$alt_ip = $_SERVER['HTTP_FROM'];
		}

		return $alt_ip;
	}

		
	function __get($var) {		
		if(!isset($this->userinfo["$var"])) {
			return;
		} else{
			return $this->userinfo["$var"];
		}
	}
	
	function isLogged() {
		if (!isset($this->userinfo["userid"])) return false;
		else {
			if ($this->userinfo["userid"] < 1) return false;
			else return true;
		}
	}
	
}   

?>
