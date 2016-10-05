<?php defined( 'ABSPATH' ) or die( 'No direct access allowed.' ); ?>
<?php _e('Você tem uma nova inscrição em seu site.', 'prm'); ?>
<br>
<?php _e('Seguem os dados do usuário:', 'prm'); ?>

<br>
<br>

<strong><?php _e('Nome', 'prm'); ?>:</strong>
<br>
<?php echo $name; ?>
<br>
<strong><?php _e('Email', 'prm'); ?>:</strong>
<br>
<?php echo $email; ?>
<?php if ($phone): ?>
	<br>
	<strong><?php _e('Telefone', 'prm'); ?>:</strong>
	<br>
	<?php echo $phone; ?>
<?php endif; ?>
<?php if ($thoroughfare || $premise || $sub_premise || $dependent_locality || $locality || $administrative_area || $postal_code): ?>
	<br>
	<strong><?php _e('Endereço', 'prm'); ?>:</strong>
	<?php if ($thoroughfare || $premise || $sub_premise): ?>
		<br>
		<?php echo $thoroughfare; ?>, <?php echo $premise; ?><?php if ($sub_premise): echo ', ' . $sub_premise; endif; ?>
	<?php endif; ?>
	<?php if ($dependent_locality || $locality || $administrative_area): ?>
		<br>
		<?php echo $dependent_locality; ?>, <?php echo $locality; ?>, <?php echo $administrative_area; ?>
	<?php endif; ?>
	<?php if ($postal_code): ?>
		<br>
		<?php echo $postal_code; ?>
	<?php endif; ?>
<?php endif; ?>

<br>
<br>

<strong><?php _e('Forma de pagamento', 'prm'); ?>:</strong> <?php echo $payment_method; ?>
<?php if (isset($payment_details)): ?>
	<br>
	<?php echo $payment_details; ?>
<?php endif; ?>

<?php if (isset($subscription_frequency)): ?>
	<br>
	<strong><?php _e('Frequência', 'prm'); ?>:</strong> <?php echo $subscription_frequency; ?>
<?php endif; ?>
<br>

<strong><?php _e('Valor', 'prm'); ?>:</strong> R$ <?php echo $subscription_amount; ?>
