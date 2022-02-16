<link rel="stylesheet" type="text/css" href="<?php echo $theme->asset_url; ?>vendor/fancybox/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="<?php echo $theme->asset_url; ?>vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<?php echo $theme->initSweetalert('css'); ?>
<script type="text/javascript" src="<?php echo $theme->asset_url; ?>vendor/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo $theme->asset_url; ?>vendor/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo $theme->asset_url; ?>vendor/moment/moment.js"></script>
<script type="text/javascript" src="<?php echo $theme->asset_url; ?>vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<?php echo $theme->initSweetalert('js'); ?>
<div class="row">
	<?php 
		$hidden_form = array(
			"inputTypePost" => "page",
			"inputAuthor" => $user_id
		);
		echo form_open_multipart("content/admin/page/save", array("method" => "post","id" => "formInputPage"), $hidden_form); 
	?>
		<div class="col-md-8">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Halaman</h3>
				</div>

				<div class="box-body">
					<div class="notification"></div>
					<div class="form-group">
						<?php
						$inputJudulPage = array(
							"name" 			=> "inputJudulPage",
							"id" 			=> "inputJudulPage",
							"class" 		=> "form-control",
							"placeholder" 	=> "Judul Halaman",
							"value" 		=> set_value("inputJudulPage")
						);

						echo form_label("Judul : ");
						echo form_input( $inputJudulPage );
						?>
					</div>
					<div class="form-group">
					  	<?php 
					  		$inputIsiPage = array(
								"name" 			=> "inputIsiPage",
								"id" 			=> "inputIsiPage",
								"class" 		=> "form-control",
								"value" 		=> set_value("inputIsiPage")
							);

							echo form_label("Isi Halaman : ");
					  		echo form_textarea( $inputIsiPage,"",true );
					  	?>
					</div>
					<div class="form-group">
						<?php
						$inputMetaTagPage = array(
							"name" 			=> "inputMetaTagPage",
							"id" 			=> "inputMetaTagPage",
							"class" 		=> "form-control",
							"placeholder" 	=> "Meta Tags",
							"value" 		=> set_value("inputMetaTagPage")
						);

						echo form_label("Meta Tags : ");
						echo form_input( $inputMetaTagPage );
						?>
					</div>
					<div class="form-group">
						<?php
						$inputMetaDeskripsiPage = array(
							"name" 			=> "inputMetaDeskripsiPage",
							"id" 			=> "inputMetaDeskripsiPage",
							"class" 		=> "form-control",
							"placeholder" 	=> "Meta Deskripsi",
							"value" 		=> set_value("inputMetaDeskripsiPage")
						);

						echo form_label("Meta Deskripsi : ");
						echo form_textarea( $inputMetaDeskripsiPage );
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">

			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Gambar</h3>
				</div>

				<div class="box-body">
					<div class="form-group">
						<div class="text-center">
							<div id="idImagePage"></div><br>
							<div id="actionImagePage">
								<a href="<?php echo site_url('filemanager/dialog.php?type=1&field_id=inputImagePage');?>" class="classAddImagePage">Tambah Gambar</a>
							</div>
						</div>
					  
					  <input type="hidden" name="inputImagePage" id="inputImagePage" value="">
					</div>
				</div>
			</div>

			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Publikasi</h3>
				</div>

				<div class="box-body">

					<div class="form-group">
						<?php echo form_label("Tanggal : "); ?>
						<div class="input-group date" id="datetimepicker">
							<?php
								$inputTanggalPage = array(
									"name" 			=> "inputTanggalPage",
									"id" 			=> "inputTanggalPage",
									"class" 		=> "form-control",
									"value" 		=> set_value("inputTanggalPage",date('d-m-Y H:i:s'))
								);
								echo form_input( $inputTanggalPage );
							?>
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						</div>
					</div>

					<div class="form-group">
						<?php
						$inputStatusPage = array(
							"id" 			=> "inputStatusPage",
							"class" 		=> "form-control",
							"placeholder" 	=> "Status Page",
						);
						echo form_label("Status : ");
						echo form_dropdown("inputStatusPage",$status_page,set_value("inputStatusPage"),$inputStatusPage);
						?>
					</div>
					<div class="form-group">
						<?php
						$inputLabelPage = array(
							"id" 			=> "inputLabelPage",
							"class" 		=> "form-control",
							"placeholder" 	=> "Label Page",
						);
						echo form_label("Status : ");
						echo form_dropdown("inputLabelPage",$label_page,set_value("inputLabelPage"),$inputLabelPage);
						?>
					</div>
				</div>

				<div class="box-footer">
					<div class="text-right">
						<?php 
							$buttonSubmitPage = array(
							"name" 			=> "buttonSubmitPage",
							"id" 			=> "buttonSubmitPage",
							"class" 		=> "btn btn-success",
							"content" 		=> "<i class=\"fa fa-save\"></i> Simpan"
						);
							echo form_button( $buttonSubmitPage ); 
						?>
					</div>
				</div>
			</div>

			

		</div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.classAddImagePage').fancybox({	
		'width'		: 900,
		'type'		: 'iframe',
		'autoScale' : false
	});

	$('#datetimepicker').datetimepicker({
		format:'DD-MM-YYYY HH:mm:ss',
		showClose:true
	});

});

$(document).on("click",".classAddImagePage",function(e){
	$('#actionImagePage').html('<a href="javascript:void(0);" onclick="removeImage()">Hapus Gambar</a>');
});

$(document).on("click","#buttonSubmitPage", function(e){
	$.ajax({
		url: $("form#formInputPage").attr("action"),
		type: "post",
		dataType: "json",
		data: $('#formInputPage').serialize(),
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
	selector: "#inputIsiPage",theme: "modern",height: 300,
	plugins: [
		 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
		 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
		 "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   relative_urls: false,
   remove_script_host: false,
   external_filemanager_path:"/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
   setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
 });

function responsive_filemanager_callback(field_id){
	var url=$('#'+field_id).val();
	var imageSrc = '<img src="'+url+'" width="300" />';
	$('#idImagePage').html(imageSrc);
}

function removeImage()
{
	$('#inputImagePage').val('');
	$('#idImagePage').empty();
	$('#actionImagePage').html('<a href="<?php echo site_url('filemanager/dialog.php?type=1&field_id=inputImagePage');?>" class="classAddImagePage">Tambah Gambar</a>');
}
</script>
