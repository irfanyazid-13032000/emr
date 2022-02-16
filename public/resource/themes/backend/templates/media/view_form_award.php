<?php 
echo $theme->initSweetalert(); 
?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Input Award</h3>
    </div>

    <div class="box-body">
    	<?php 
		$hidden_form = array("inputAwardId" => $editdata['awardId'],"inputTypeAward" => $editdata['awardType']);
		echo form_open_multipart("media/admin/award/save", array("method" => "post","id" => "formInputAward", "class" => "form-horizontal"), $hidden_form); 
		?>
		<div class="form-group">
			<?php echo form_label("Judul","inputJudulAward", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputJudulAward = array(
						"name" 			=> "inputJudulAward",
						"id" 			=> "inputJudulAward",
						"class" 		=> "form-control",
						"placeholder" 	=> "Judul",
						"value" 		=> set_value("inputJudulAward",$editdata['awardTitle'])
					);
					echo form_input( $inputJudulAward );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Gambar","inputImageAward", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php echo $theme->initImageFormFileManager('imageAward',$editdata['awardImage'],array('image_width' => 200)); ?>
			</div>
		</div>
		<div class="form-group">
			<?php echo form_label("Status","inputStatusAward", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-3">
				<?php
					$inputStatusAward = array(
						"id" 			=> "inputStatusAward",
						"class" 		=> "form-control",
						"placeholder" 	=> "Status",
					);

					echo form_dropdown("inputStatusAward",array('publish' => 'Aktif', 'unpublish' => 'Non Aktif'),set_value("inputStatusAward",$editdata['awardStatus']),$inputStatusAward);
				?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<?php 
					$buttonSubmitAward = array(
						"name" 			=> "buttonSubmitAward",
						"id" 			=> "buttonSubmitAward",
						"class" 		=> "btn btn-success",
						"content" 		=> "<i class=\"fa fa-save\"></i> Simpan"
					);
					echo form_button( $buttonSubmitAward ); 
				?>
			</div>
		</div>
		<?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
$(document).on("click", "#buttonSubmitAward", function(e){
	$.ajax({
		url: $("form#formInputAward").attr("action"),
		type: "post",
		dataType: "json",
		data: $('#formInputAward').serialize(),
		beforeSend: function(){

		},
		success: function(response){
			<?php if( !$editdata['awardId'] ): ?>
			if(response.status == 1){
				$('#inputAwardId').val('');
				$('#inputJudulAward').val('');
				$('#inputStatusAward').val('');
				fileManagerRemoveImage();
			}
			<?php endif; ?>
			swal(response.title, response.message, response.type);
		},
		error: function(){
			swal("Error!", "Terjadi kesalahan penyimpanan data", "error");
		}
	});
	
});
</script>