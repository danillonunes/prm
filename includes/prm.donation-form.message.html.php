<?php defined( 'ABSPATH' ) or die( 'No direct access allowed.' ); ?>
<p>
	<?php _e('Você tem uma nova inscrição em seu site.', 'prm'); ?>
	<br>
	<?php _e('Seguem os dados do usuário:', 'prm'); ?>
</p>

<p>
	<?php _e('Nome', 'prm'); ?>: <?php echo $name; ?>
	<br>
	<?php _e('Email', 'prm'); ?>: <?php echo $email; ?>
	<br>
	<?php _e('Telefone', 'prm'); ?>: <?php echo $phone; ?>
	<br>
	<?php _e('Endereço', 'prm'); ?>:
	<br>
	<?php echo $thoroughfare; ?>, <?php echo $premise; ?><?php if ($sub_premise): echo ', ' . $sub_premise; endif; ?>
	<br>
	<?php echo $dependent_locality; ?>, <?php echo $locality; ?>, <?php echo $administrative_area; ?>
	<br>
	<?php echo $postal_code; ?>
</p>

<p>
	<?php _e('Forma de pagamento:', 'prm'); ?>: <?php echo $paymnt_method; ?>
	<?php if ($paymnt_details): echo $paymnt_method; endif; ?>
</p>
