<?php defined('SYSPATH') or die('No direct access allowed.');

	$orm = $helper_orm->orm();
	$labels = $orm->labels();
	$required = $orm->required_fields();

/**** form_id ****/
	
	echo View_Admin::factory('form/control', array(
		'field' => 'form_id',
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'controls' => Form::select('form_id', array(0 => __(' - No linked form - ')) + $form_list, $orm->form_id, array(
			'id' => 'form_id_field',
			'class' => 'input-xxlarge',
		)),
	));

/**** text ****/
	
	echo View_Admin::factory('form/control', array(
		'field' => 'text',
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'controls' => Form::textarea('text', $orm->text, array(
			'id' => 'text_field',
			'class' => 'text_editor',
		)),
	));