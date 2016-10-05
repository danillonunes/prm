<?php

register_activation_hook(__FILE__, 'prm_activate');
add_action('plugins_loaded', 'prm_update_db_check');

function prm_activate() {
	global $wpdb;

	$table_name = prm_patrons_table_name();

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name text NOT NULL,
		email text NOT NULL,
		phone text NOT NULL,
		address_postal_code text NOT NULL,
		address_thoroughfare text NOT NULL,
		address_premise text NOT NULL,
		address_sub_premise text NOT NULL,
		address_dependent_locality text NOT NULL,
		address_locality text NOT NULL,
		address_administrative_area text NOT NULL,
		payment_method tinytext NOT NULL,
		subscription_amount tinytext NOT NULL,
		subscription_frequency tinytext NOT NULL,
		payment_status tinytext NOT NULL,
		payment_method_transaction_id tinytext NOT NULL,
		payment_method_subscription_id tinytext NOT NULL,
		PRIMARY KEY (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

	add_option('prm_db_version', PRM_VERSION);
}

function prm_patrons_table_name() {
	global $wpdb;

	return $wpdb->prefix . 'prm_subscriptions';
}

function prm_update_db_check() {
	if (prm_get_option('prm_db_version') != PRM_VERSION) {
		prm_activate();
	}
}
