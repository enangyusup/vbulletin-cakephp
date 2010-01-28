<?php

class HomeController extends AppController {
   var $uses = array('Vbulletin');
   var $components = array('Bridge');
	var $helpers = array('Html', 'Form', 'Javascript');

	function index() {
		$this->pageTitle = 'Ngetest cakephp jeung vbulletin';
		$this->Bridge->authenticate_session();
		$furl = Configure::read('vb.forum_url');
		$this->set('furl',$furl);
		if($this->Bridge->isLogged()) {
			$this->set('username',$this->Bridge->__get('username'));
			$this->set('avatarimg',$this->Bridge->__get('avatarurl'));
			$this->set('profileurl', $furl . 'member.php?u=' . $this->Bridge->__get('userid'));	
			
			$pms = $this->Bridge->__get('pmunread');
			$pmline = ($pms != 1) ? "$pms new PMs" : "$pms new PM";
			$this->set('pmunread',$pmline);
			$this->set('logouthash', $this->Bridge->__get('logouthash'));
			$this->set('islogged', true);
		} else {
			$this->set('sessionhash', $this->Bridge->__get('sessionhash'));	
			$this->set('islogged', false);
		}
	}	
	
}