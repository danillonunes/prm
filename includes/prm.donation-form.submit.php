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

	$name = explode(' ', $values['name']);

	$values['first-name'] = array_shift($name);
	$values['last-name'] = implode(' ', $name);

	$values['address-line-1'] = implode(', ', array(
		$values['address']['thoroughfare'],
		$values['address']['premise'],
		$values['address']['sub-premise']
	));
	$values['address-line-2'] = $values['address']['dependent-locality'];

	$values['phone-int'] = preg_replace('/[^\d]/', '', $values['phone']);
	$values['phone-ddd'] = substr($values['phone-int'], 0, 2);
	$values['phone-number'] = substr($values['phone-int'], 2);

	$values['postal-int'] = preg_replace('/[^\d]/', '', $values['address']['postal-code']);

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
	if (prm_get_option('prm_sandbox_mode')) {
		$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	}

	$params['cmd'] = '_ext-enter';
	$params['redirect_cmd'] = '_xclick-subscriptions';
	$params['business'] = prm_get_option('prm_paypal_email');
	$params['lc'] = 'BR';
	$params['item_name'] = prm_get_option('prm_subscription_item_name');
	$params['item_number'] = '';
	$params['src'] = '1';
	$params['a3'] = prm_get_option('prm_subscription_amount');
	$params['p3'] = '1';
	$params['t3'] = 'M';
	$params['no_shipping'] = '1';
	$params['currency_code'] = 'BRL';
	$params['bn'] = 'PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHosted';
	$params['charset'] = 'UTF-8';
	$params['notify_url'] = '';


	$params['first_name'] = $values['first-name'];
	$params['last_name'] = $values['last-name'];
	$params['address1'] = $values['address-line-1'];
	$params['address2'] = $values['address-line-2'];
	$params['city'] = $values['address']['locality'];
	$params['state'] = $values['address']['administrative-area'];
	$params['zip'] = $values['postal-int'];
	$params['ls'] = 'BR';
	$params['email'] = $values['email'];
	$params['night_phone_a'] = $values['phone-ddd'];
	$params['night_phone_b'] = $values['phone-number'];

	$return_url = prm_get_option('prm_subscription_return_url');
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
	$pagseguro_pre_url = 'https://ws.pagseguro.uol.com.br/v2/pre-approvals/request';
	if (prm_get_option('prm_sandbox_mode')) {
		$pagseguro_pre_url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/pre-approvals/request';
	}

	$pre_params['email'] = prm_get_option('prm_pagseguro_email');
	$pre_params['token'] = prm_get_option('prm_pagseguro_token');

	$pre_params['senderName'] = $values['name'];
	$pre_params['senderAreaCode'] = $values['phone-ddd'];
	$pre_params['senderPhone'] = $values['phone-number'];
	$pre_params['senderEmail'] = $values['email'];
	$pre_params['senderAddressStreet'] = $values['address']['thoroughfare'];
	$pre_params['senderAddressNumber'] = $values['address']['premise'];
	$pre_params['senderAddressComplement'] = $values['address']['sub-premise'];
	$pre_params['senderAddressDistrict'] = $values['address']['dependent-locality'];
	$pre_params['senderAddressPostalCode'] = $values['postal-int'];
	$pre_params['senderAddressCity'] = $values['address']['locality'];
	$pre_params['senderAddressState'] = $values['address']['administrative-area'];
	$pre_params['senderAddressCountry'] = 'BRA';

	$pre_params['preApprovalCharge'] = 'auto';
	$pre_params['preApprovalName'] = prm_get_option('prm_subscription_item_name');
	$pre_params['preApprovalAmountPerPayment'] = prm_get_option('prm_subscription_amount');
	$pre_params['preApprovalPeriod'] = 'monthly';
	$pre_params['preApprovalFinalDate'] = date('Y-m-d\TH:i:s.uP', strtotime("+2 years"));
	$pre_params['preApprovalMaxTotalAmount'] = sprintf('%01.2f', prm_get_option('prm_subscription_amount') * 24);

	$pre_params['receiverEmail'] = prm_get_option('prm_pagseguro_email');

	$return_url = prm_get_option('prm_subscription_return_url');
	$return_url = strpos('?', $return_url) === FALSE ? $return_url . '?' : $return_url . '&';
	$return_url = $return_url . 'prm-donation-payment-method=pagseguro';

	$pre_params['redirectURL'] = $return_url;

	$args = array(
		'method' => 'POST',
		'headers' => array(
			'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
		),
		'body' => utf8_encode(http_build_query($pre_params)),
	);

	$pre_approval = wp_remote_request($pagseguro_pre_url, $args);
	$pre_approval_obj = new SimpleXMLElement($pre_approval['body']);

	if (isset($pre_approval_obj->code)) {
		$url = 'https://pagseguro.uol.com.br/v2/pre-approvals/request.html?code=' . $pre_approval_obj->code;
		if (prm_get_option('prm_sandbox_mode')) {
			$url = 'https://sandbox.pagseguro.uol.com.br/v2/pre-approvals/request.html?code=' . $pre_approval_obj->code;
		}

		return array(
			'status' => 'processing',
			'redirect' => $url
		);
	}
}

function prm_donation_form_submit_payment_redirect($values) {
	$url = prm_get_option('prm_subscription_return_url');
	$url = strpos('?', $url) === FALSE ? $url . '?' : $url . '&';
	$url = $url . 'prm-donation-payment-method=' . $values['payment-method'];

	return array(
		'status' => 'completed',
		'redirect' => $url
	);
}

function prm_donation_form_submit_email($values) {
	$to = prm_get_option('prm_email');
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
		case 'paypal':
		case 'pagseguro':
		case 'deposito':
		case 'boleto':
			$html = wpautop(prm_get_option('prm_subscription_' . $values['payment-method'] . '_message'));
			break;
	}

	return $html;
}
