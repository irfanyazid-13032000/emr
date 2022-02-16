<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Tambah Poliklinik</h3>
	</div>

	<div class="box-body">
		<?php 
			$hidden_form = array("inputPoliId" => $poliId);
			echo form_open_multipart("dokter/admin/master_poliklinik/save", array("method" => "post","id" => "formInputPoliklinik", "class" => "form-horizontal"), $hidden_form); 
		?>

		<div class="form-group">
			<?php echo form_label("Nama Poliklinik","inputNamaPoliklinik", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputNamaPoliklinik = array(
						"name" 			=> "inputNamaPoliklinik",
						"id" 			=> "inputNamaPoliklinik",
						"class" 		=> "form-control",
						"placeholder" 	=> "Nama Poliklinik",
						"value" 		=> set_value("inputNamaPoliklinik",$editdata['poliName'])
					);
					echo form_input( $inputNamaPoliklinik );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Deskripsi ","inputDeskripsiPoliklinik", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputDeskripsiPoliklinik = array(
						"name" 			=> "inputDeskripsiPoliklinik",
						"id" 			=> "inputDeskripsiPoliklinik",
						"class" 		=> "form-control",
						"value" 		=> set_value("inputDeskripsiPoliklinik")
					);
					echo form_textarea( $inputDeskripsiPoliklinik );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Icon","inputIconPoliklinik", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php echo $theme->initImageFormFileManager('iconPoliklinik',$editdata['poliIcon'], array('image_width'=>100)); ?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Gambar","inputImagePoliklinik", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php echo $theme->initImageFormFileManager('imagePoliklinik',$editdata['poliImage']); ?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Status","inputPoliklinikStatus", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-3">
				<?php
					$inputPoliklinikStatus = array(
						"id" 			=> "inputPoliklinikStatus",
						"class" 		=> "form-control",
						"placeholder" 	=> "Status",
					);

					echo form_dropdown("inputPoliklinikStatus",array('publish' => 'Aktif', 'unpublish' => 'Non Aktif'),set_value("inputPoliklinikStatus",$editdata['poliStatus']),$inputPoliklinikStatus);
				?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<?php 
					$buttonSubmitPoliklinik = array(
						"name" 			=> "buttonSubmitPoliklinik",
						"id" 			=> "buttonSubmitPoliklinik",
						"class" 		=> "btn btn-success",
						"content" 		=> "<i class=\"fa fa-save\"></i> Simpan"
					);
					echo form_button( $buttonSubmitPoliklinik ); 
				?>
			</div>
		</div>



		<?php echo form_close(); ?>
	</div>
</div>
<?php 
echo $theme->initSweetalert(); 
//echo $theme->initTinymce('#inputDeskripsiPoliklinik');
?>
<script type="text/javascript" src="<?php echo $theme->asset_url; ?>vendor/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
$(document).on("click", "#buttonSubmitPoliklinik", function(e){
	$.ajax({
		url: $("form#formInputPoliklinik").attr("action"),
		type: "post",
		dataType: "json",
		data: $('#formInputPoliklinik').serialize(),
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
	selector: "#inputDeskripsiPoliklinik",theme: "modern",height: 300,
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

<?php if($poliId): ?>
	$('#inputDeskripsiPoliklinik').val('<?php echo $editdata['poliText']; ?>');
<?php endif; ?>


</script>