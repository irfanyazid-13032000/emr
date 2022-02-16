<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Tambah Dokter</h3>
	</div>
	
	<div class="box-body">
		<?php 
			$hidden_form = array("inputDokterId" => $dokterId);
			echo form_open_multipart("dokter/admin/master_dokter/save", array("method" => "post","id" => "formInputDokter", "class" => "form-horizontal"), $hidden_form); 
		?>

		<div class="form-group">
			<?php echo form_label("Nama Dokter","inputNamaDokter", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputNamaDokter = array(
						"name" 			=> "inputNamaDokter",
						"id" 			=> "inputNamaDokter",
						"class" 		=> "form-control",
						"placeholder" 	=> "Nama Dokter",
						"value" 		=> set_value("inputNamaDokter",$editdata['dokterName'])
					);
					echo form_input( $inputNamaDokter );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Spesialis","inputPoliId", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputPoliId = array(
						"name" 			=> "inputPoliId",
						"id" 			=> "inputPoliId",
						"class" 		=> "form-control",
						"placeholder" 	=> "Spesialis",
					);
					echo form_dropdown("inputPoliId",$datapoli,set_value("inputPoliId",$editdata['dokterPoliId']),$inputPoliId);
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Deskripsi ","inputDeskripsiDokter", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputDeskripsiDokter = array(
						"name" 			=> "inputDeskripsiDokter",
						"id" 			=> "inputDeskripsiDokter",
						"class" 		=> "form-control",
						"value" 		=> set_value("inputDeskripsiDokter")
					);
					echo form_textarea( $inputDeskripsiDokter );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Photo","inputImageDokter", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php echo $theme->initImageFormFileManager('imageDokter',$editdata['dokterImage']); ?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Status","inputDokterStatus", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-3">
				<?php
					$inputDokterStatus = array(
						"id" 			=> "inputDokterStatus",
						"class" 		=> "form-control",
						"placeholder" 	=> "Status",
					);

					echo form_dropdown("inputDokterStatus",array('publish' => 'Aktif', 'unpublish' => 'Non Aktif'),set_value("inputDokterStatus",$editdata['dokterStatus']),$inputDokterStatus);
				?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<?php 
					$buttonSubmitDokter = array(
						"name" 			=> "buttonSubmitDokter",
						"id" 			=> "buttonSubmitDokter",
						"class" 		=> "btn btn-success",
						"content" 		=> "<i class=\"fa fa-save\"></i> Simpan"
					);
					echo form_button( $buttonSubmitDokter ); 
				?>
			</div>
		</div>



		<?php echo form_close(); ?>
	</div>
</div>
<?php 
echo $theme->initSweetalert(); 
//echo $theme->initTinymce('#inputDeskripsiDokter');
?>
<script type="text/javascript" src="<?php echo $theme->asset_url; ?>vendor/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
$(document).on("click", "#buttonSubmitDokter", function(e){
	$.ajax({
		url: $("form#formInputDokter").attr("action"),
		type: "post",
		dataType: "json",
		data: $('#formInputDokter').serialize(),
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

tinymce.init({
	selector: "#inputDeskripsiDokter",theme: "modern",height: 300,
	plugins: [
		 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
		 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
		 "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   eencoding: 'html',
   relative_urls: false,
   remove_script_host: false,
   external_filemanager_path:"/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
   setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
        //editor.setContent($('#inputIsiArtikel').html());
    }
 });

<?php if($dokterId): ?>
	$('#inputDeskripsiDokter').val('<?php echo $editdata['dokterText']; ?>');
<?php endif; ?>


</script>