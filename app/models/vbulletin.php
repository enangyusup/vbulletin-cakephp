<?php 

/*
 * VBulletin Model
 * 
 * Author: Enang Yusuf - enangyusuf@gmail.com
 * Original Source for kohana author Netrosis ( www.syphex.com )
 * 
 * Last Modified: 28 Januari 2010
 */ 

class Vbulletin extends AppModel 
{
	var $name = 'Vbulletin';
	var $useTable = false;
	var $useDbConfig = "forum";

	var $dbprefix;
	var $user_columns;
	var $config;
	
	function __construct() {
		parent::__construct(); 

		Configure::load('vbulletin');
		
		$this->config = Configure::read('vb');
		$this->dbprefix = $this->config['db_prefix'];
		$this->user_columns = $this->config['user_columns'];	
	}
		
	function getSession($sessionhash,$idhash,$timeout) {
		$sql = " SELECT * FROM {$this->dbprefix}session
					WHERE 
						sessionhash 	= '" . $sessionhash . "' AND
						idhash			= '" . $idhash . "' AND
						lastactivity 	> '" . $timeout . "' LIMIT 1";
		$result = $this->query($sql);
		if ($result) {
			foreach($result as $rows) $data = $rows;
			foreach($data as $row) $session = $row;
			return $session;
		} else return false;
	}

	function getUser($userid) {
		$sql = " SELECT " . implode(', ', $this->user_columns) . "
					FROM {$this->dbprefix}user
					WHERE userid = {$userid} LIMIT 1";
					
		$result = $this->query($sql);
		if ($result) {
			foreach($result as $rows) $data = $rows;
			foreach($data as $row) $userinfo = $row;
			return $userinfo;
		} else return false;
	}

	function getAvatar($userid = 0) {
		$sql = " SELECT dateline, width, height 
					FROM {$this->dbprefix}customavatar 
					WHERE userid= " . $userid;
		$result = $this->query($sql);
		if ($result) {
			foreach($result as $row) {
				$avatarurl = $this->config['forum_url'].'image.php?u='.$userid."&amp;dateline=".$row[$this->dbprefix.'customavatar']['dateline']; 
			}
			return $avatarurl;
		} else return false;
	}
	
	function getDefaultAvatar($id) {
		$sql = " SELECT * FROM {$this->dbprefix}avatar 
					WHERE avatarid = " . $id;
		$result = $this->query($sql);
		if ($result) {
			foreach($result as $row) {
				$avatar = $this->config['forum_url'] . $row[$this->dbprefix.'avatar']['avatarpath'];
			}
			return $avatar;
		} else return false;
	}
	
}   

?>
