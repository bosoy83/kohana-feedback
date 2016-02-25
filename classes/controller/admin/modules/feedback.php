<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Modules_Feedback extends Controller_Admin_Front {

	protected $menu_active_item = 'modules';
	protected $title = 'Feedback';
	protected $sub_title = 'Settings';
	protected $form_owner = 'feedback';

	public function before()
	{
		parent::before();
		
		$this->title = __($this->title);
		$this->sub_title = __($this->sub_title);
		
		if (empty($this->module_page_id)) {
			$this->request->current()
				->action('cap');
		}
	}
	
	public function action_index()
	{
		$request = $this->request->current();
		if (empty($this->back_url)) {
			$query_array = array();
			$this->back_url = Route::url('modules', array(
				'controller' => 'feedback',
				'query' => Helper_Page::make_query_string($query_array),
			));
		}
		
		if ($this->is_cancel) {
			$request
				->redirect($this->back_url);
		}

		$orm = ORM::factory('feedback')
			->find();
		
		if ( ! $orm->loaded()) {
			$orm
				->clear()
				->values(array(
					'site_id' => SITE_ID,
					'page_id' => $this->module_page_id,
					'creator_id' => $this->user->id,
				))
				->save();
		} elseif ( ! $this->acl->is_allowed($this->user, $orm, 'edit')) {
			throw new HTTP_Exception_404();
		}
		
		$orm_helper = ORM_Helper::factory('feedback');
		$orm_helper->orm($orm);
		
		$errors = array();
		$submit = $request->post('submit');
		if ($submit) {
			try {
				$values = $request->post();
				$orm_helper->save(array(
					'updated' => date('Y-m-d H:i:s'),
					'updater_id' => $this->user->id,
				) + $values);
			} catch (ORM_Validation_Exception $e) {
				$errors = $this->errors_extract($e);
			}
		}
		
		$properties = $orm_helper->property_list();

		$form_list = $this->_get_form_list();
		
		$this->template
			->set_filename('modules/feedback/edit')
			->set('errors', $errors)
			->set('helper_orm', $orm_helper)
			->set('form_list', $form_list)
			->set('properties', $properties);
	}
	
	private function _get_form_list()
	{
		$result = array();
		
		$list = ORM::factory('form')
			->where('owner', '=', $this->form_owner)
			->find_all();
		
		foreach ($list as $_orm) {
			$_date = __('from [feedback]').' '.$_orm->public_date;
			if ( ! empty($_orm->close_date) AND $_orm->close_date != '0000-00-00 00:00:00') {
				$_date .= ' '.__('to [feedback]').' '.$_orm->close_date;
			}
			
			$result[$_orm->id] = $_orm->title." [{$_date}]";
		}
		
		return $result;
	}
	
	public function action_cap()
	{
		$this->template
			->set_filename('modules/feedback/cap');
	}
}
