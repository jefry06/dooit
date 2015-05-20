<?php if($this->session->userdata('message')){ ?>
	<?php if($this->session->userdata('message_type') == 'error'): ?>
	<div id="alert" class="alert alert-danger" align="center">
    	<button type="button" data-dismiss="alert" class="close" id="alert">&times;</button><?php echo $this->session->userdata('message') ?> 
    </div>
	<?php elseif ($this->session->userdata('message_type') == 'info'): ?>
    <div id="alert" class="alert alert-info" align="center">
      	<button type="button" data-dismiss="alert" class="close" id="alert">&times;</button><?php echo $this->session->userdata('message') ?>
    </div>
	<?php elseif ($this->session->userdata('message_type') == 'warning'): ?>
    <div id="alert" class="alert alert-warning" align="center">
      	<button type="button" data-dismiss="alert" class="close" id="alert">&times;</button><?php echo $this->session->userdata('message') ?>
    </div>
	<?php elseif ($this->session->userdata('message_type') == 'success'): ?>
    <div id="alert" class="alert alert-success" align="center">
      	<button type="button" data-dismiss="alert" class="close" id="alert">&times;</button><?php echo $this->session->userdata('message') ?>
    </div>
	<?php endif; ?>

	<?php $this->session->unset_userdata('message') ?>
	<?php $this->session->unset_userdata('message_type') ?>
<?php } ?>

<?php $error = validation_errors() ?>
<?php if( ! empty($error)){ ?>
	<div id="alert" class="alert alert-danger">
    	<button type="button" data-dismiss="alert" class="close" align="center">&times;</button><?php echo $error; ?> 
    </div>
<?php } ?>