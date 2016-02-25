<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'feedback' => array(
		'uri_callback' => '(?<query>)',
		'defaults' => array(
			'directory' => 'modules',
			'controller' => 'feedback',
			'action' => 'index',
		)
	),
);

