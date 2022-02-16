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
			"inputTypePost" => "post",
			"inputAuthor" => $user_id,
			"inputContentId" => $blog_id
		);
		echo form_open_multipart("content/admin/blog/save", array("method" => "post","id" => "formInputArtikel"), $hidden_form); 
	?>
		<div class="col-md-8">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Artikel</h3>
				</div>

				<div class="box-body">
					<div class="notification"></div>
					<div class="form-group">
						<?php
						$inputJudulArtikel = array(
							"name" 			=> "inputJudulArtikel",
							"id" 			=> "inputJudulArtikel",
							"class" 		=> "form-control",
							"placeholder" 	=> "Judul Artikel",
							"value" 		=> set_value("inputJudulArtikel",$blog->blogTitle)
						);

						echo form_label("Judul : ");
						echo form_input( $inputJudulArtikel );
						?>
					</div>
					<div class="form-group">
						<?php
						$inputIdCategoryArtikel = array(
							"id" 			=> "inputIdCategoryArtikel",
							"class" 		=> "form-control",
							"placeholder" 	=> "Kategori Artikel",
						);
						echo form_label("Kategori : ");
						echo form_dropdown("inputIdCategoryArtikel",$categories,set_value("inputIdCategoryArtikel",$blog->blogCategoryId),$inputIdCategoryArtikel);
						?>
					 </div>
					<div class="form-group">
					  	<?php 
					  		$inputIsiArtikel = array(
								"name" 			=> "inputIsiArtikel",
								"id" 			=> "inputIsiArtikel",
								"class" 		=> "form-control",
								"value" 		=> set_value("inputIsiArtikel")
							);

							echo form_label("Isi Artikel : ");
					  		echo form_textarea( $inputIsiArtikel,"",true );
					  	?>
					</div>
					<div class="form-group">
						<?php
						$inputMetaTagArtikel = array(
							"name" 			=> "inputMetaTagArtikel",
							"id" 			=> "inputMetaTagArtikel",
							"class" 		=> "form-control",
							"placeholder" 	=> "Meta Tags",
							"value" 		=> set_value("inputMetaTagArtikel",$blog->blogMetaTags)
						);

						echo form_label("Meta Tags : ");
						echo form_input( $inputMetaTagArtikel );
						?>
					</div>
					<div class="form-group">
						<?php
						$inputMetaDeskripsiArtikel = array(
							"name" 			=> "inputMetaDeskripsiArtikel",
							"id" 			=> "inputMetaDeskripsiArtikel",
							"class" 		=> "form-control",
							"placeholder" 	=> "Meta Deskripsi",
							"value" 		=> set_value("inputMetaDeskripsiArtikel",$blog->blogMetaDescription)
						);

						echo form_label("Meta Deskripsi : ");
						echo form_textarea( $inputMetaDeskripsiArtikel );
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
							<div id="idImageArtikel">
								<?php if($blog->blogImage): ?>
									<img src="<?php echo _URL . $blog->blogImage; ?>" width="300">
								<?php endif; ?>
							</div><br>
							<div id="actionImageArtikel">
								<?php if($blog->blogImage): ?>
									<a href="javascript:void(0);" onclick="removeImage()">Hapus Gambar</a>
								<?php else: ?>
									<a href="<?php echo site_url('filemanager/dialog.php?type=1&field_id=inputImageArtikel');?>" class="classAddImageArtikel">Tambah Gambar</a>
								<?php endif; ?>
							</div>
						</div>
					  
					  <input type="hidden" name="inputImageArtikel" id="inputImageArtikel" value="<?php echo $blog->blogImage; ?>">
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
								$inputTanggalArtikel = array(
									"name" 			=> "inputTanggalArtikel",
									"id" 			=> "inputTanggalArtikel",
									"class" 		=> "form-control",
									"value" 		=> set_value("inputTanggalArtikel",$blog->blogCreated)
								);
								echo form_input( $inputTanggalArtikel );
							?>
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						</div>
					</div>

					<div class="form-group">
						<?php
						$inputStatusArtikel = array(
							"id" 			=> "inputStatusArtikel",
							"class" 		=> "form-control",
							"placeholder" 	=> "Kategori Artikel",
						);
						echo form_label("Status : ");
						echo form_dropdown("inputStatusArtikel",$status_artikel,set_value("inputStatusArtikel",$blog->blogStatus),$inputStatusArtikel);
						?>
					</div>
				</div>

				<div class="box-footer">
					<div class="text-right">
						<?php 
							$buttonSubmitArtikel = array(
							"name" 			=> "buttonSubmitArtikel",
							"id" 			=> "buttonSubmitArtikel",
							"class" 		=> "btn btn-success",
							"content" 		=> "<i class=\"fa fa-save\"></i> Simpan"
						);
							echo form_button( $buttonSubmitArtikel ); 
						?>
					</div>
				</div>
			</div>

			

		</div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.classAddImageArtikel').fancybox({	
		'width'		: 900,
		'type'		: 'iframe',
		'autoScale' : false
	});

	$('#datetimepicker').datetimepicker({
		format:'DD-MM-YYYY HH:mm:ss',
		showClose:true
	});
	$('#inputIsiArtikel').val('<?php echo preg_replace( "/\r|\n/", "",$blog->blogText); ?>');
});

$(document).on("click",".classAddImageArtikel",function(e){
	$('#actionImageArtikel').html('<a href="javascript:void(0);" onclick="removeImage()">Hapus Gambar</a>');
});

$(document).on("click","#buttonSubmitArtikel", function(e){
	$.ajax({
		url: $("form#formInputArtikel").attr("action"),
		type: "post",
		dataType: "json",
		data: $('#formInputArtikel').serialize(),
		beforeSend: function(){

		},
		success: function(response){
			//$('.notification').html(response.message);
			swal(response.title, response.message, response.type);
		},
		error: function(){
			swal("Error!", "Terjadi kesalahan penyimpanan data", "error");
		}
	});
});

tinymce.init({
	selector: "#inputIsiArtikel",theme: "modern",height: 300,
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



function responsive_filemanager_callback(field_id){
	var url=$('#'+field_id).val();
	var imageSrc = '<img src="'+url+'" width="300" />';
	$('#idImageArtikel').html(imageSrc);
}

function removeImage()
{
	$('#inputImageArtikel').val('');
	$('#idImageArtikel').empty();
	$('#actionImageArtikel').html('<a href="<?php echo site_url('filemanager/dialog.php?type=1&field_id=inputImageArtikel');?>" class="classAddImageArtikel">Tambah Gambar</a>');
}
</script>
