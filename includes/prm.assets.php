<?php

add_action('wp_enqueue_scripts', 'prm_wp_scripts');

function prm_wp_scripts() {
	wp_enqueue_style('prm.donation-form', plugin_dir_url(PRM_PLUGIN_FILE) . 'assets/css/prm.donation-form.css');
	wp_enqueue_script('prm.jQuery-Mask-Plugin', plugin_dir_url(PRM_PLUGIN_FILE) . 'assets/lib/jQuery-Mask-Plugin-1.14.0/dist/jquery.mask.min.js', array(
		'jquery',
	));
	wp_enqueue_script('prm.donation-form', plugin_dir_url(PRM_PLUGIN_FILE) . 'assets/js/prm.donation-form.js', array(
		'jquery',
		'prm.jQuery-Mask-Plugin',
	));
}
