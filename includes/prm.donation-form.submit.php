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

function prm_donation_form_submit($values) {
	$html = '';

	$message_sent = prm_donation_form_submit_email($values);

	$html = prm_donation_form_submit_result($values);

	return $html;
}

function prm_donation_form_submit_email($values) {
	$to = get_bloginfo('admin_email');
	$subject = sprintf(__('Nova inscrição em %s'), get_bloginfo('name'));
	$message = prm_donation_form_submit_email_message($values);

	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	$headers[] = 'Reply-To: ' . $values['prm-donation-form-name'] . ' <' . $values['prm-donation-form-email'] . '>';

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
	$payment_messages = array(
		'deposito' => __('Depósito message', 'prm'),
		'boleto' => __('Boleto message', 'prm'),
	);

	switch ($values['payment-method']) {
		case 'deposito':
		case 'boleto':
			$html = $payment_messages[$values['payment-method']];
			break;
	}

	return $html;
}
