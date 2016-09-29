<?php

function prm_donation_form_values($post) {
	$values = array(
		'name' => $post['prm-donation-form-name'],
		'email' => $post['prm-donation-form-email'],
		'phone' => $post['prm-donation-form-phone'],
		'address' => array(
			'thoroughfare' => $post['prm-donation-form-address-thoroughfare'],
			'premise' => $post['prm-donation-form-address-premise'],
			'sub-premise' => $post['prm-donation-form-address-sub-premise'],
			'dependent-locality' => $post['prm-donation-form-address-dependent-locality'],
			'locality' => $post['prm-donation-form-address-locality'],
			'administrative-area' => $post['prm-donation-form-address-administrative-area'],
			'postal-code' => $post['prm-donation-form-address-postal-code'],
		),
		'payment-method' => $post['prm-donation-form-payment-method'],
	);

	return $values;
}

function prm_donation_form_submit_payment($values) {
	switch ($values['payment-method']) {
		case 'paypal':
			return prm_donation_form_submit_payment_paypal($values);
		case 'pagseguro':
			return prm_donation_form_submit_payment_pagseguro($values);
		case 'boleto':
		case 'deposito':
			return prm_donation_form_submit_payment_redirect($values);
	}
}

function prm_donation_form_submit_payment_paypal($values) {
	$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';

	$params['cmd'] = '_xclick-subscriptions';
	$params['business'] = get_option('prm_paypal_email');
	$params['lc'] = 'BR';
	$params['item_name'] = get_option('prm_subscription_paypal_item_name');
	$params['item_number'] = get_option('prm_subscription_paypal_item_number');
	$params['src'] = '1';
	$params['a3'] = get_option('prm_subscription_paypal_amount');
	$params['p3'] = '1';
	$params['t3'] = 'M';
	$params['currency_code'] = get_option('prm_subscription_paypal_currency');
	$params['bn'] = 'PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHosted';
	$params['charset'] = 'UTF-8';

	$return_url = get_option('prm_subscription_return_url');
	$return_url = strpos('?', $return_url) === FALSE ? $return_url . '?' : $return_url . '&';
	$return_url = $return_url . 'prm-donation-payment-method=paypal';

	$params['return'] = urlencode(stripslashes($return_url));

	$url = $paypal_url . '?' . utf8_encode(http_build_query($params));

	return array(
		'status' => 'processing',
		'redirect' => $url
	);
}

function prm_donation_form_submit_payment_pagseguro($values) {
}

function prm_donation_form_submit_payment_redirect($values) {
	$url = get_option('prm_subscription_return_url');
	$url = strpos('?', $url) === FALSE ? $url . '?' : $url . '&';
	$url = $url . 'prm-donation-payment-method=' . $values['payment-method'];

	return array(
		'status' => 'completed',
		'redirect' => $url
	);
}

function prm_donation_form_submit_email($values) {
	$to = get_option('prm_email');
	$to = $to ? $to : get_bloginfo('admin_email');
	$subject = sprintf(__('%s fez uma nova inscrição em %s'), $values['name'], get_bloginfo('name'));
	$message = prm_donation_form_submit_email_message($values);

	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	$headers[] = 'Reply-To: ' . $values['name'] . ' <' . $values['email'] . '>';

	return wp_mail($to, $subject, $message, $headers);
}

function prm_donation_form_submit_email_message($values) {
	$name = $values['name'];
	$email = $values['email'];
	$phone = $values['phone'];

	$thoroughfare = $values['address']['thoroughfare'];
	$premise = $values['address']['premise'];
	$sub_premise = $values['address']['sub-premise'];

	$dependent_locality = $values['address']['dependent-locality'];
	$locality = $values['address']['locality'];
	$administrative_area = $values['address']['administrative-area'];
	$postal_code = $values['address']['postal-code'];

	$payment_methods = array(
		'paypal' => __('PayPal', 'prm'),
		'pagseguro' => __('PagSeguro', 'prm'),
		'deposito' => __('Depósito', 'prm'),
		'boleto' => __('Boleto', 'prm'),
	);

	$payment_method = isset($payment_methods[$values['payment-method']]) ? $payment_methods[$values['payment-method']] : '';

	ob_start();
	include(PRM_PLUGIN_DIR . '/includes/prm.donation-form.message.html.php');
	return ob_get_clean();
}

function prm_donation_form_submit_result($values) {
	$html = '';

	switch ($values['payment-method']) {
		case 'deposito':
		case 'boleto':
			$html = get_option('prm_subscription_' . $values['payment-method'] . '_message');
			break;
	}

	return $html;
}
