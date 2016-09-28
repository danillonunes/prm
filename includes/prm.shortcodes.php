<?php

add_shortcode('prm_donation_form', 'prm_donation_form_shortcode');

function prm_donation_form_shortcode() {
	include_once(PRM_PLUGIN_DIR . '/includes/prm.donation-form.php');
	return prm_donation_form();
}
