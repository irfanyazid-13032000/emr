<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah Password</h3>
    </div>

    <div class="box-body">
    	<?php echo $notification; ?>
    	<?php 
			$hidden_form = array("inputUserId" => $user_id);
			echo form_open_multipart("settings/admin/general_settings/change_password", array("method" => "post","id" => "formChangePassword", "class" => "form-horizontal"), $hidden_form); 
		?>
			<div class="form-group">
				<?php echo form_label("Password Lama ","inputOldPassword", array("class" => "col-sm-3 control-label") ); ?>
				<div class="col-sm-4">
					<?php
						$inputOldPassword = array(
							"name" 			=> "inputOldPassword",
							"id" 			=> "inputOldPassword",
							"class" 		=> "form-control",
							"placeholder" 	=> "Password Lama",
							"value" 		=> set_value("inputOldPassword",'')
						);
						echo form_password( $inputOldPassword );
					?>
				</div>
			</div>

			<div class="form-group">
				<?php echo form_label("Password Baru ","inputNewPassword", array("class" => "col-sm-3 control-label") ); ?>
				<div class="col-sm-4">
					<?php
						$inputNewPassword = array(
							"name" 			=> "inputNewPassword",
							"id" 			=> "inputNewPassword",
							"class" 		=> "form-control",
							"placeholder" 	=> "Password Baru",
							"value" 		=> set_value("inputNewPassword",'')
						);
						echo form_password( $inputNewPassword );
					?>
				</div>
			</div>

			<div class="form-group">
				<?php echo form_label("Konfirmasi Password ","inputRetypePassword", array("class" => "col-sm-3 control-label") ); ?>
				<div class="col-sm-4">
					<?php
						$inputRetypePassword = array(
							"name" 			=> "inputRetypePassword",
							"id" 			=> "inputRetypePassword",
							"class" 		=> "form-control",
							"placeholder" 	=> "Password Baru",
							"value" 		=> set_value("inputRetypePassword",'')
						);
						echo form_password( $inputRetypePassword );
					?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-4">
					<?php 
						$buttonSubmitChangePassword = array(
							"id" 			=> "buttonSubmitChangePassword",
							"class" 		=> "btn btn-success",
						);
						echo form_submit("buttonSubmitChangePassword", "Ubah Password", $buttonSubmitChangePassword ); 
					?>
				</div>
			</div>

			</div>
		<?php echo form_close(); ?>
    </div>
</div>