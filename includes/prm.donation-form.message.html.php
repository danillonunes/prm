<?php defined( 'ABSPATH' ) or die( 'No direct access allowed.' ); ?>
<p>
	<?php _e('Você tem uma nova inscrição em seu site.', 'prm'); ?>
	<br>
	<?php _e('Seguem os dados do usuário:', 'prm'); ?>
</p>

<p>
	<strong><?php _e('Nome', 'prm'); ?>:</strong>
	<br>
	<?php echo $name; ?>
	<br>
	<strong><?php _e('Email', 'prm'); ?>:</strong>
	<br>
	<?php echo $email; ?>
	<br>
	<strong><?php _e('Telefone', 'prm'); ?>:</strong>
	<br>
	<?php echo $phone; ?>
	<br>
	<strong><?php _e('Endereço', 'prm'); ?>:</strong>
	<br>
	<?php echo $thoroughfare; ?>, <?php echo $premise; ?><?php if ($sub_premise): echo ', ' . $sub_premise; endif; ?>
	<br>
	<?php echo $dependent_locality; ?>, <?php echo $locality; ?>, <?php echo $administrative_area; ?>
	<br>
	<?php echo $postal_code; ?>
</p>

<p>
	<?php _e('Forma de pagamento', 'prm'); ?>: <?php echo $payment_method; ?>
</p>
