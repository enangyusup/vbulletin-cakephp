<?php

/*
 * VBulletin Config
 * 
 * Author: Enang Yusuf - enangyusuf@gmail.com
 * Original Source for kohana author Netrosis ( www.syphex.com )
 * 
 * Last Modified: 28 Januari 2010
 */ 

# vibulletin licence for use cookie salt
$config['vb']['license'] = 'VBSA75117D';

# url your vbulletin forum
$config['vb']['forum_url'] = 'http://localhost/forum/';

$config['vb']['db_prefix']	= 'vb_';
$config['vb']['groups'] = array(
					'admin'				=> 6,
					'moderator'			=> 7,
					'super_moderator' => 5,
					'user'				=> 2,
					'banned'				=> 8,
					'guest'				=> 1
					);
$config['vb']['cookie_timeout'] = 1800; //30 Mins
$config['vb']['cookie_prefix'] = 'bb';
$config['vb']['user_columns'] = array(
					'userid',
					'username',
					'email',
					'avatarid',
					'pmunread',
					'salt'
					);
$config['vb']['default_avatar'] = 'img/no_foto.png';