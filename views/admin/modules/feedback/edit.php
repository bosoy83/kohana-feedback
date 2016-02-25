<?php defined('SYSPATH') or die('No direct access allowed.');

	echo View_Admin::factory('layout/page_select');

	$orm = $helper_orm->orm();
	$labels = $orm->labels();
	$required = $orm->required_fields();

	$query_array = array();
	if ( ! empty($BACK_URL)) {
		$query_array['back_url'] = $BACK_URL;
	}

	$action = Route::url('modules', array(
		'controller' => 'feedback',
		'query' => Helper_Page::make_query_string($query_array),
	));
		
	echo View_Admin::factory('layout/error')
		->bind('errors', $errors);
?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" class="form-horizontal" >
		<div class="tabbable">
			<ul class="nav nav-tabs kr-nav-tsbs">
<?php
				echo '<li class="active">', HTML::anchor('#tab-main', __('Main'), array(
					'data-toggle' => 'tab'
				)), '</li>'; 
				
				if ( ! empty($properties)) {
					echo '<li>', HTML::anchor('#tab-properties', __('Properties'), array(
						'data-toggle' => 'tab'
					)), '</li>';
				}
?>
				<!-- #tab-nav-insert# -->
			</ul>
			<div class="tab-content kr-tab-content">
				<div class="tab-pane kr-tab-pane active" id="tab-main">
<?php
					echo View_Admin::factory('modules/feedback/tab/main', array(
						'helper_orm' => $helper_orm,
						'form_list' => $form_list,
						'errors' => $errors,
					)); 
?>
				</div>
<?php
				if ( ! empty($properties)):
?>				
					<div class="tab-pane kr-tab-pane" id="tab-properties">
<?php
						echo View_Admin::factory('form/property/list', array(
							'properties' => $properties,
						)); 
?>
					</div>
<?php
				endif;
?>				
				<!-- #tab-pane-insert# -->
			</div>
		</div>
<?php
		echo View_Admin::factory('form/submit_save');
?>	
	</form>
