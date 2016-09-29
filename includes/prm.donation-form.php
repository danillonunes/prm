<?php

function prm_donation_form() {
	$html = '';

	if (!isset($_POST['prm-donation-form-submit'])) {
		ob_start();
		include(PRM_PLUGIN_DIR . '/includes/prm.donation-form.html.php');
		$html = ob_get_clean();
	}
	else {
		include_once(PRM_PLUGIN_DIR . '/includes/prm.donation-form.submit.php');
		$values = prm_donation_form_values($_POST);
		$html = prm_donation_form_submit($values);
	}

	return $html;
}
