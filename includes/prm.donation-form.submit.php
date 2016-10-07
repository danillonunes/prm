<?php

function prm_donation_form_validate($post) {
	$error = array();

	if (!wp_verify_nonce($post['prm-donation-form-nonce'], 'prm-donation-form')) {
		$error[] = array(
			'error' => 'invalid',
			'field' => 'prm-donation-form-nonce'
		);
	}

	foreach ($post as $key => $value) {
		switch ($key) {
			case 'prm-donation-form-name':
			case 'prm-donation-form-email':
			case 'prm-donation-form-payment-method':
				if ($value == '') {
					$error[] = array(
						'error' => 'empty',
						'field' => $key
					);
				}
				break;
		}

		switch ($key) {
			case 'prm-donation-form-email':
				if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
					$error[] = array(
						'error' => 'invalid',
						'field' => $key
					);
				}
				break;
			case 'prm-donation-subscription-amount':
				if (preg_replace('/[^\d]/', '', $value) < 100) {
					$error[] = array(
						'error' => 'invalid',
						'field' => $key
					);
				}
		}
	}

	if (!empty($error)) {
		return $error;
	}
}

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
		'subscription-amount' => $post['prm-donation-form-subscription-amount'] ? preg_replace('/,/', '.', preg_replace('/\./', '', $post['prm-donation-form-subscription-amount'])) : prm_get_option('prm_subscription_amount'),
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

	switch ($values['payment-method']) {
		case 'boleto':
		case 'deposito':
			$values['subscription-frequency'] = $post['prm-donation-form-subscription-' . $values['payment-method'] . '-frequency'];
			$values['subscription-amount'] = prm_get_option('prm_subscription_' . $values['payment-method'] . '_' . preg_replace('/-/', '_', $values['subscription-frequency']) . '_amount');
			break;
		default:
			$values['subscription-frequency'] = 'month-1';
	}

	return $values;
}

function prm_donation_form_submit_save($values) {
	global $wpdb;

	$data = array(
		'time' => current_time('mysql'),
		'name' => $values['name'],
		'email' => $values['email'],
		'phone' => $values['phone'],
		'address_thoroughfare' => $values['address']['thoroughfare'],
		'address_premise' => $values['address']['premise'],
		'address_sub_premise' => $values['address']['sub-premise'],
		'address_dependent_locality' => $values['address']['dependent-locality'],
		'address_locality' => $values['address']['locality'],
		'address_administrative_area' => $values['address']['administrative-area'],
		'address_postal_code' => $values['address']['postal-code'],
		'payment_method' => $values['payment-method'],
		'payment_status' => 'pending',
		'subscription_amount' => $values['subscription-amount'],
		'subscription_frequency' => $values['subscription-frequency'],
		'payment_method_transaction_id' => 'pending',
		'payment_method_subscription_id' => 'pending',
	);

	$insert = $wpdb->insert(
		prm_patrons_table_name(),
		$data
	);

	if ($insert) {
		return $wpdb->insert_id;
	}
}

function prm_donation_form_submit_payment($id, $values) {
	switch ($values['payment-method']) {
		case 'paypal':
			return prm_donation_form_submit_payment_paypal($id, $values);
		case 'pagseguro':
			return prm_donation_form_submit_payment_pagseguro($id, $values);
		case 'boleto':
		case 'deposito':
			return prm_donation_form_submit_payment_redirect($id, $values);
	}
}

function prm_donation_form_submit_payment_paypal($id, $values) {
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
	$params['a3'] = $values['subscription-amount'];
	$params['p3'] = '1';
	$params['t3'] = 'M';
	$params['rm'] = '2';
	$params['no_shipping'] = '1';
	$params['currency_code'] = 'BRL';
	$params['bn'] = 'PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHosted';
	$params['charset'] = 'UTF-8';

	$site_url = site_url();
	$site_url = (strpos('?', $site_url) === FALSE ? $site_url . '?' : $site_url . '&') . 'prm_subscription_return=paypal&prm_subscription_id=' . $id;
	$params['notify_url'] = $site_url;

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

	$params['return'] = $return_url;

	$url = $paypal_url . '?' . utf8_encode(http_build_query($params));

	return array(
		'status' => 'pending',
		'redirect' => $url
	);
}

function prm_donation_form_submit_payment_pagseguro($id, $values) {
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
	$pre_params['preApprovalAmountPerPayment'] = $values['subscription-amount'];
	$pre_params['preApprovalPeriod'] = 'monthly';
	$pre_params['preApprovalFinalDate'] = date('Y-m-d\TH:i:s.uP', strtotime("+2 years"));
	$pre_params['preApprovalMaxTotalAmount'] = sprintf('%01.2f', $values['subscription-amount'] * 24);

	$pre_params['receiverEmail'] = prm_get_option('prm_pagseguro_email');

	$return_url = prm_get_option('prm_subscription_return_url');
	$return_url = strpos('?', $return_url) === FALSE ? $return_url . '?' : $return_url . '&';
	$return_url = $return_url . 'prm-donation-payment-method=pagseguro&prm_subscription_return=pagseguro&prm_subscription_id=' . $id;

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
			'status' => 'pending',
			'redirect' => $url
		);
	}
}

function prm_donation_form_submit_payment_redirect($id, $values) {
	$url = prm_get_option('prm_subscription_return_url');
	$url = strpos('?', $url) === FALSE ? $url . '?' : $url . '&';
	$url = $url . 'prm-donation-payment-method=' . $values['payment-method'];

	return array(
		'status' => 'completed',
		'redirect' => $url
	);
}

function prm_donation_form_submit_email($id) {
	$subscription = prm_subscription_load($id);

	$to = prm_get_option('prm_email');
	$subject = sprintf(__('%s fez uma nova inscrição em %s'), $subscription->name, get_bloginfo('name'));
	$message = prm_donation_form_submit_email_message($subscription);

	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	$headers[] = 'Reply-To: ' . $subscription->name . ' <' . $subscription->mail . '>';

	return wp_mail($to, $subject, $message, $headers);
}

function prm_donation_form_submit_email_message($subscription) {
	$name = $subscription->name;
	$email = $subscription->email;
	$phone = $subscription->phone;

	$thoroughfare = $subscription->address_thoroughfare;
	$premise = $subscription->address_premise;
	$sub_premise = $subscription->address_sub_premise;

	$dependent_locality = $subscription->address_dependent_locality;
	$locality = $subscription->address_locality;
	$administrative_area = $subscription->address_administrative_area;
	$postal_code = $subscription->address_postal_code;

	$subscription_amount = preg_replace('/\./', ',', $subscription->subscription_amount);

	switch ($subscription->subscription_frequency) {
		case 'month-3':
			$subscription_frequency = __('Trimestral', 'prm');
			break;
		case 'month-6':
			$subscription_frequency = __('Semestral', 'prm');
			break;
		case 'month-12':
			$subscription_frequency = __('Anual', 'prm');
			break;
	}

	$payment_methods = array(
		'paypal' => __('PayPal', 'prm'),
		'pagseguro' => __('PagSeguro', 'prm'),
		'deposito' => __('Depósito', 'prm'),
		'boleto' => __('Boleto', 'prm'),
	);

	switch ($subscription->payment_method) {
		case 'pagseguro':
			$payment_details = __('Note que o pagamento via PagSeguro pode não ter sido aprovado imediatamente e a assinatura pode ser cancelada antes de sua aprovação.');
			$payment_details .= '<br>';
			$payment_details .= __('Verifique o status do pagamento diretamente na interface do PagSeguro.');
			break;
	}

	$payment_method = isset($payment_methods[$subscription->payment_method]) ? $payment_methods[$subscription->payment_method] : '';

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

function prm_donation_form_payment_complete($id, $details = array()) {
	global $wpdb;

	$data = array_merge(array('payment_status' => 'completed'), $details);

	return $wpdb->update(
		prm_patrons_table_name(),
		$data,
		array('id' => $id)
	);
}
