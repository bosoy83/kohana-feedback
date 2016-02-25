<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
	'a2' => array(
		'resources' => array(
			'feedback_controller' => 'module_controller',
			'feedback' => 'module',
		),
		'rules' => array(
			'allow' => array(
				'controller_access' => array(
					'role' => 'base',
					'resource' => 'feedback_controller',
					'privilege' => 'access',
					'assertion' => array('Acl_Assert_Module_Access', array(
						'module' => 'feedback',
					)),
				),
				'feedback_edit_1' => array(
					'role' => 'base',
					'resource' => 'feedback',
					'privilege' => 'edit',
					'assertion' => array('Acl_Assert_Edit', array(
						'site_id' => SITE_ID,
					)),
				),
			),
			'deny' => array()
		)
	),
);