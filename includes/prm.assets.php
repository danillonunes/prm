<?php

add_action('wp_enqueue_scripts', 'prm_wp_scripts');

if (is_admin()) {
	add_action('admin_enqueue_scripts', 'prm_admin_scripts');
}

function prm_wp_scripts() {
	wp_enqueue_style('prm.donation-form', PRM_PLUGIN_DIR_URL . 'assets/css/prm.donation-form.css');
	wp_enqueue_script('prm.jQuery-Mask-Plugin', PRM_PLUGIN_DIR_URL . 'assets/lib/jQuery-Mask-Plugin-1.14.0/dist/jquery.mask.min.js', array(
		'jquery',
	));
	wp_enqueue_script('prm.donation-form', PRM_PLUGIN_DIR_URL . 'assets/js/prm.donation-form.js', array(
		'jquery',
		'prm.jQuery-Mask-Plugin',
	));
}

function prm_admin_scripts($hook) {
	switch ($hook) {
		case 'settings_page_prm':
			wp_enqueue_script('prm.jQuery-Mask-Plugin', PRM_PLUGIN_DIR_URL . 'assets/lib/jQuery-Mask-Plugin-1.14.0/dist/jquery.mask.min.js', array(
				'jquery',
			));
			wp_enqueue_script('mmdimo-options', PRM_PLUGIN_DIR_URL . 'assets/js/prm.options.js');
			break;
	}
}
