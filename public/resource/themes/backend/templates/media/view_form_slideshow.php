<?php 
echo $theme->initSweetalert(); 
?>
<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Tambah Slideshow</h3>
	</div>

	<div class="box-body">
		<?php 
			$hidden_form = array("inputImageId" => $imageId);
			echo form_open_multipart("media/admin/slideshow/save", array("method" => "post","id" => "formInputSlideshow", "class" => "form-horizontal"), $hidden_form); 
		?>

		<div class="form-group">
			<?php echo form_label("Title","inputNamaSlideshow", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputNamaSlideshow = array(
						"name" 			=> "inputNamaSlideshow",
						"id" 			=> "inputNamaSlideshow",
						"class" 		=> "form-control",
						"placeholder" 	=> "Title",
						"value" 		=> set_value("inputNamaSlideshow",$editdata['imageTitle'])
					);
					echo form_input( $inputNamaSlideshow );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Sub title","inputSubtitleSlideshow", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputSubtitleSlideshow = array(
						"name" 			=> "inputSubtitleSlideshow",
						"id" 			=> "inputSubtitleSlideshow",
						"class" 		=> "form-control",
						"placeholder" 	=> "Sub title",
						"value" 		=> set_value("inputSubtitleSlideshow",$editdata['imageSubtitle'])
					);
					echo form_input( $inputSubtitleSlideshow );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Caption","inputCaptionSlideshow", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputCaptionSlideshow = array(
						"name" 			=> "inputCaptionSlideshow",
						"id" 			=> "inputCaptionSlideshow",
						"class" 		=> "form-control",
						"placeholder" 	=> "Caption",
						"value" 		=> set_value("inputCaptionSlideshow",$editdata['imageCaption'])
					);
					echo form_input( $inputCaptionSlideshow );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Gambar","inputImageSlideshow", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php echo $theme->initImageFormFileManager('imageSlideshow',$editdata['imageSrc']); ?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Status","inputSlideshowStatus", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-3">
				<?php
					$inputSlideshowStatus = array(
						"id" 			=> "inputSlideshowStatus",
						"class" 		=> "form-control",
						"placeholder" 	=> "Status",
					);

					echo form_dropdown("inputSlideshowStatus",array('publish' => 'Aktif', 'unpublish' => 'Non Aktif'),set_value("inputSlideshowStatus",$editdata['imageStatus']),$inputSlideshowStatus);
				?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<?php 
					$buttonSubmitSlideshow = array(
						"name" 			=> "buttonSubmitSlideshow",
						"id" 			=> "buttonSubmitSlideshow",
						"class" 		=> "btn btn-success",
						"content" 		=> "<i class=\"fa fa-save\"></i> Simpan"
					);
					echo form_button( $buttonSubmitSlideshow ); 
				?>
			</div>
		</div>



		<?php echo form_close(); ?>
	</div>
</div>

<script type="text/javascript">
$(document).on("click", "#buttonSubmitSlideshow", function(e){
	$.ajax({
		url: $("form#formInputSlideshow").attr("action"),
		type: "post",
		dataType: "json",
		data: $('#formInputSlideshow').serialize(),
		beforeSend: function(){

		},
		success: function(response){
			swal(response.title, response.message, response.type);
		},
		error: function(){
			swal("Error!", "Terjadi kesalahan penyimpanan data", "error");
		}
	});
	
});

</script>