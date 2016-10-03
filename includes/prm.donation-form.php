<?php

add_action('plugins_loaded', 'prm_subscription_submit');
add_action('plugins_loaded', 'prm_subscription_notification');

function prm_subscription_submit() {
	if (isset($_POST['prm-donation-form-submit'])) {
		include_once(PRM_PLUGIN_DIR . '/includes/prm.donation-form.submit.php');

		if ($error = prm_donation_form_validate($_POST)) {
			prm_donation_form_error($error);
		}
		else {
			$values = prm_donation_form_values($_POST);
			$id = prm_donation_form_submit_save($values);

			$payment = prm_donation_form_submit_payment($id, $values);

			if ($payment['status'] == 'completed') {
				prm_donation_form_submit_email($id);
				prm_donation_form_payment_complete($id);
			}

			if (isset($payment['redirect'])) {
				wp_redirect($payment['redirect']);
				exit;
			}
		}
	}
}

function prm_subscription_notification() {
	if (isset($_GET['prm_subscription_return']) && isset($_GET['prm_subscription_id'])) {
		switch ($_GET['prm_subscription_return']) {
			case 'paypal':
				$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
				if (get_option('prm_sandbox_mode')) {
					$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
				}

				$raw_post_array = explode('&', file_get_contents('php://input'));
				$post = array();
				$req = 'cmd=_notify-validate';
				foreach ($raw_post_array as $keyval) {
					$keyval = explode('=', $keyval);
					if (count($keyval) == 2) {
						$post[$keyval[0]] = urldecode($keyval[1]);
					}
					$req .= "&{$keyval[0]}={$keyval[1]}";
				}

				if ($post['payment_status'] == 'Completed') {
					$args = array(
						'method' => 'POST',
						'headers' => array(
							'Connection' => 'Close',
						),
						'body' => $req,
					);

					$verification = wp_remote_request($paypal_url, $args);

					if ($verification['body'] == 'VERIFIED') {
						include_once(PRM_PLUGIN_DIR . '/includes/prm.donation-form.submit.php');
						prm_donation_form_submit_email($_GET['prm_subscription_id']);
						prm_donation_form_payment_complete($_GET['prm_subscription_id'], array(
							'payment_method_subscription_id' => $post['subscr_id'],
							'payment_method_transaction_id' => $post['txn_id']
						));
					}
				}
				break;
			case 'pagseguro':
				include_once(PRM_PLUGIN_DIR . '/includes/prm.donation-form.submit.php');
				prm_donation_form_submit_email($_GET['prm_subscription_id']);
				break;
		}
	}
}

function prm_donation_form() {
	$html = '';

	if (!isset($_POST['prm-donation-form-submit']) || prm_donation_form_error()) {
		ob_start();
		include(PRM_PLUGIN_DIR . '/includes/prm.donation-form.html.php');
		$html = ob_get_clean();
	}

	return $html;
}

function prm_donation_form_error($error = FALSE) {
	static $static_error;

	if ($error) {
		$static_error = $error;
	}

	return $static_error;
}

function prm_subscription_load($id) {
	if (is_numeric($id)) {
		global $wpdb;
		$table = prm_patrons_table_name();
		return $wpdb->get_row('SELECT * FROM ' . $table . ' WHERE id = ' . $id);
	}
}

function prm_subscription_message() {
	$html = '';

	if (isset($_REQUEST['prm-donation-payment-method'])) {
		switch ($_REQUEST['prm-donation-payment-method']) {
			case 'paypal':
			case 'pagseguro':
			case 'deposito':
			case 'boleto':
				$html = prm_get_option('prm_subscription_' . $_REQUEST['prm-donation-payment-method'] . '_message');
				break;
		}
	}

	return $html;
}
