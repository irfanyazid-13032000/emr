<?php echo $theme->initSweetalert(); ?>

<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Tambah Kategori</h3>
	</div>

	<div class="box-body">
		<?php 
			$hidden_form = array("inputAuthor" => $user_id,"inputCategoryId" => $category_id);
			echo form_open_multipart("content/admin/category/save", array("method" => "post","id" => "formInputCategory", "class" => "form-horizontal"), $hidden_form); 
		?>

		<div class="form-group">
			<?php echo form_label("Nama Kategori","inputNamaKategori", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputNamaKategori = array(
						"name" 			=> "inputNamaKategori",
						"id" 			=> "inputNamaKategori",
						"class" 		=> "form-control",
						"placeholder" 	=> "Nama Kategori",
						"value" 		=> set_value("inputNamaKategori",$category->categoryName)
					);
					echo form_input( $inputNamaKategori );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Meta Tags ","inputKategoriMetaTags", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputKategoriMetaTags = array(
						"name" 			=> "inputKategoriMetaTags",
						"id" 			=> "inputKategoriMetaTags",
						"class" 		=> "form-control",
						"placeholder" 	=> "Meta Tags",
						"value" 		=> set_value("inputKategoriMetaTags",$category->categoryMetaTags)
					);
					echo form_input( $inputKategoriMetaTags );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Meta Deskripsi","inputKategoriMetaDeskripsi", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-9">
				<?php
					$inputKategoriMetaDeskripsi = array(
						"name" 			=> "inputKategoriMetaDeskripsi",
						"id" 			=> "inputKategoriMetaDeskripsi",
						"class" 		=> "form-control",
						"placeholder" 	=> "Meta Deskripsi",
						"rows"			=> 2,
						"value" 		=> set_value("inputKategoriMetaDeskripsi",$category->categoryMetaDescription)
					);

					echo form_textarea( $inputKategoriMetaDeskripsi );
				?>
			</div>
		</div>

		<div class="form-group">
			<?php echo form_label("Status","inputKategoriStatus", array("class" => "col-sm-3 control-label") ); ?>
			<div class="col-sm-3">
				<?php
					$inputKategoriStatus = array(
						"id" 			=> "inputKategoriStatus",
						"class" 		=> "form-control",
						"placeholder" 	=> "Status",
					);

					echo form_dropdown("inputKategoriStatus",$status_category,set_value("inputKategoriStatus",$category->categoryStatus),$inputKategoriStatus);
				?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<?php 
					$buttonSubmitCategory = array(
						"name" 			=> "buttonSubmitCategory",
						"id" 			=> "buttonSubmitCategory",
						"class" 		=> "btn btn-success",
						"content" 		=> "<i class=\"fa fa-save\"></i> Simpan"
					);
					echo form_button( $buttonSubmitCategory ); 
				?>
			</div>
		</div>



		<?php echo form_close(); ?>
	</div>
</div>

<script type="text/javascript">
$(document).on("click", "#buttonSubmitCategory", function(e){
	$.ajax({
		url: $("form#formInputCategory").attr("action"),
		type: "post",
		dataType: "json",
		data: $('#formInputCategory').serialize(),
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