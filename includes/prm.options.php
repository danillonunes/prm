<?php

add_action('admin_init', 'prm_options_admin_init');
add_action('admin_menu', 'prm_admin_menu');

function prm_options_admin_init() {
	register_setting('prm', 'prm_email');
	register_setting('prm', 'prm_subscription_amount');
	register_setting('prm', 'prm_subscription_item_name');
	register_setting('prm', 'prm_subscription_address_description');
	register_setting('prm', 'prm_subscription_payment_amount_description');
	register_setting('prm', 'prm_sandbox_mode');
	register_setting('prm', 'prm_paypal_email');
	register_setting('prm', 'prm_paypal_sandbox_email');
	register_setting('prm', 'prm_pagseguro_email');
	register_setting('prm', 'prm_pagseguro_token');
	register_setting('prm', 'prm_pagseguro_sandbox_email');
	register_setting('prm', 'prm_pagseguro_sandbox_token');
	register_setting('prm', 'prm_subscription_boleto_month_3_amount');
	register_setting('prm', 'prm_subscription_boleto_month_6_amount');
	register_setting('prm', 'prm_subscription_boleto_month_12_amount');
	register_setting('prm', 'prm_subscription_deposito_month_3_amount');
	register_setting('prm', 'prm_subscription_deposito_month_6_amount');
	register_setting('prm', 'prm_subscription_deposito_month_12_amount');
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

function prm_get_option($option) {
	switch ($option) {
		case 'prm_paypal_email':
		case 'prm_pagseguro_email':
		case 'prm_pagseguro_token':
			$sandbox = array(
				'prm_paypal_email' => 'prm_paypal_sandbox_email',
				'prm_pagseguro_email' => 'prm_pagseguro_sandbox_email',
				'prm_pagseguro_token' => 'prm_pagseguro_sandbox_token',
			);
			if (get_option('prm_sandbox_mode')) {
				$option = $sandbox[$option];
			}
			break;
	}

	$value = get_option($option);

	if ($value === '') {
		switch ($option) {
			case 'prm_email':
				$value = get_bloginfo('admin_email');
				break;
			case 'prm_subscription_item_name':
				$value = get_bloginfo('name');
				break;
		}
	}

	switch ($option) {
		case 'prm_subscription_address_description':
		case 'prm_subscription_paypal_message':
		case 'prm_subscription_pagseguro_message':
		case 'prm_subscription_deposito_message':
		case 'prm_subscription_boleto_message':
			$value = wpautop($value);
			break;
		case 'prm_subscription_amount':
			$value = preg_replace('/,/', '.', $value);
			break;
	}

	return $value;
}
