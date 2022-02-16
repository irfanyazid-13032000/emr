<?php $icon = array("error" => "fa-ban","warning" => "fa-warning", "info" => "fa-info", "success" => "fa-check"); ?>
<div class="alert alert-<?php echo $type;?> alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa <?php echo $icon[$type]; ?>"></i><?php echo ucfirst($type); ?></h4>
	<?php echo $message; ?>
</div>