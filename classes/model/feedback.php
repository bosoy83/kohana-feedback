<?php defined('SYSPATH') or die('No direct script access.');

class Model_Feedback extends ORM_Base {

	protected $_table_name = 'feedback';
	protected $_sorting = array('site_id' => 'ASC', 'page_id' => 'ASC');

	protected $_belongs_to = array(
		'form' => array(
			'model' => 'form',
			'foreign_key' => 'form_id',
		),
	);
	
	public function labels()
	{
		return array(
			'page_id' => 'Page',
			'form_id' => 'Form',
			'text' => 'Text',
		);
	}

	public function rules()
	{
		return array(
			'id' => array(
				array('digit'),
			),
			'site_id' => array(
				array('not_empty'),
				array('digit'),
			),
			'page_id' => array(
				array('not_empty'),
				array('digit'),
			),
			'form_id' => array(
				array('digit'),
			),
		);
	}

	public function filters()
	{
		return array(
			TRUE => array(
				array('trim'),
			),
		);
	}
}
