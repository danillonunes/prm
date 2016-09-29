<?php

add_action('admin_init', 'prm_options_admin_init');
add_action('admin_menu', 'prm_admin_menu');

function prm_options_admin_init() {
	register_setting('prm', 'prm_email');
	register_setting('prm', 'prm_paypal_email');
	register_setting('prm', 'prm_subscription_paypal_item_name');
	register_setting('prm', 'prm_subscription_paypal_item_number');
	register_setting('prm', 'prm_subscription_paypal_amount');
	register_setting('prm', 'prm_subscription_paypal_currency');
	register_setting('prm', 'prm_subscription_return_url');
	register_setting('prm', 'prm_subscription_paypal_message');
	register_setting('prm', 'prm_subscription_pagseguro_message');
	register_setting('prm', 'prm_subscription_boleto_message');
	register_setting('prm', 'prm_subscription_deposito_message');
}

function prm_admin_menu() {
	add_options_page('PRM: The Patrão Relationship Management!', 'PRM', 'manage_options', 'prm', 'prm_options');
}

function prm_options() {
	include(PRM_PLUGIN_DIR . '/includes/prm.options.html.php');
}