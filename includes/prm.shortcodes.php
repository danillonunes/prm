<?php

add_shortcode('prm_donation_form', 'prm_donation_form_shortcode');

function prm_donation_form_shortcode() {
	ob_start();
	include(PRM_PLUGIN_DIR . '/includes/prm.donation-form.php');
	return ob_get_clean();
}
