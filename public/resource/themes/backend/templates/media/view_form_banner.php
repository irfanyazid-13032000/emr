<?php 
echo $theme->initSweetalert(); 
?>
<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Tambah Banner</h3>
	</div>

	<div class="box-body">
		<?php 
			$hidden_form = array("inputBannerId" => $bannerId);
			echo form_open_multipart("media/admin/banner/save", array("method" => "post","id" => "formInputBanner", "class" => "form-horizontal"), $hidden_form); 
		?>

		<div class="form-group">
			<?php echo form_label("Title","inputNamaBanner", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputNamaBanner = array(
						"name" 			=> "inputNamaBanner",
						"id" 			=> "inputNamaBanner",
						"class" 		=> "form-control",
						"placeholder" 	=> "Title",
						"value" 		=> set_value("inputNamaBanner",$editdata['inputNamaBanner'])
					);
					echo form_input( $inputNamaBanner );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Url","inputUrlBanner", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputUrlBanner = array(
						"name" 			=> "inputUrlBanner",
						"id" 			=> "inputUrlBanner",
						"class" 		=> "form-control",
						"placeholder" 	=> "Url",
						"value" 		=> set_value("inputUrlBanner",$editdata['inputUrlBanner'])
					);
					echo form_input( $inputUrlBanner );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Gambar","inputImageBanner", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php echo $theme->initImageFormFileManager('imageBanner',$editdata['inputImageBanner']); ?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Posisi","inputBannerPosition", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-3">
				<?php
					$inputBannerPosition = array(
						"id" 			=> "inputBannerPosition",
						"class" 		=> "form-control",
						"placeholder" 	=> "Posisi",
					);

					echo form_dropdown("inputBannerPosition",array('left' => 'Kiri', 'right' => 'Kanan'),set_value("inputBannerPosition",$editdata['inputBannerPosition']),$inputBannerPosition);
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Status","inputBannerStatus", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-3">
				<?php
					$inputBannerStatus = array(
						"id" 			=> "inputBannerStatus",
						"class" 		=> "form-control",
						"placeholder" 	=> "Status",
					);

					echo form_dropdown("inputBannerStatus",array('publish' => 'Aktif', 'unpublish' => 'Non Aktif'),set_value("inputBannerStatus",$editdata['inputBannerStatus']),$inputBannerStatus);
				?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<?php 
					$buttonSubmitBanner = array(
						"name" 			=> "buttonSubmitBanner",
						"id" 			=> "buttonSubmitBanner",
						"class" 		=> "btn btn-success",
						"content" 		=> "<i class=\"fa fa-save\"></i> Simpan"
					);
					echo form_button( $buttonSubmitBanner ); 
				?>
			</div>
		</div>



		<?php echo form_close(); ?>
	</div>
</div>

<script type="text/javascript">
$(document).on("click", "#buttonSubmitBanner", function(e){
	$.ajax({
		url: $("form#formInputBanner").attr("action"),
		type: "post",
		dataType: "json",
		data: $('#formInputBanner').serialize(),
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