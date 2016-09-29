<?php

add_shortcode('prm_subscription_form', 'prm_donation_form_shortcode');
add_shortcode('prm_subscription_message', 'prm_subscription_message_shortcode');

function prm_donation_form_shortcode() {
	return prm_donation_form();
}

function prm_subscription_message_shortcode() {
	return prm_subscription_message();
}
