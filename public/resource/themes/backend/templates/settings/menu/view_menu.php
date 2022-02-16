<?php 
echo $theme->initSweetalert('css'); 
echo $theme->addCss( $theme->vendor_url . "select2/select2.min.css" );
echo $theme->addCss( $theme->asset_url . "css/menu-manager-style.css" );
echo $theme->initSweetalert('js'); 
echo $theme->addJs( $theme->vendor_url . "select2/select2.full.min.js" );
echo $theme->addJs( $theme->asset_url . "js/jquery-ui-1.8.16.custom.min.js" );
echo $theme->addJs( $theme->asset_url . "js/jquery-nestable.js" );
echo $theme->addJs( $theme->theme_url . "assets/plugins/nestedsortable/nestedSortable.js" );
?>

<style type="text/css">
	#menumanager {
		list-style: none;
	}
</style>

<div class="row">

	<div class="col-md-12">
		<div class="nav-tabs-custom">
		    <ul class="nav nav-tabs">
		        <li class="active"><a href="#tab_1" data-toggle="tab">Custom Link</a></li>
		        <li><a href="#tab_2" data-toggle="tab">Halaman</a></li>
		        <li><a href="#tab_3" data-toggle="tab">Kategori</a></li>
		    </ul>
		    <div class="tab-content">
		    
		        <div class="tab-pane active" id="tab_1">
		        	<form method="post" action="" class="form-horizontal" id="formCustomLink">
		        	<input type="hidden" name="inputTypeMenu" value="custom">
		        	<input type="hidden" name="inputEditCustomMenuId" id="inputEditCustomMenuId" value="">

						<div class="form-group">
							<label for="inputTitle" class="col-sm-2 control-label">Link Text</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="inputLinkText" name="inputLinkText" placeholder="Title">
							</div>
						</div>

						<div class="form-group">
							<label for="inputTitle" class="col-sm-2 control-label">Url</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="inputUrl" name="inputUrl" placeholder="Url">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-4">
								<button type="button" id="buttonSaveCustomLink" class="btn btn-success">
									<i class="fa fa-save"></i> Simpan
								</button>
								<button type="button" onclick="reloadPage()" class="btn btn-danger">
									<i class="fa fa-times"></i> Batal
								</button>
							</div>
						</div>

					</form>
		        </div>

		        <div class="tab-pane" id="tab_2">
		        	<form method="post" action="" class="form-horizontal" id="formPageMenu">
		        		<input type="hidden" name="inputPageSlug" id="inputPageSlug" value="">
		        		<input type="hidden" name="inputTypeMenu" value="page">
		        		<input type="hidden" name="inputEditPageMenuId" id="inputEditPageMenuId" value="">
						<div class="form-group">
							<label for="inputTitle" class="col-sm-2 control-label">Link Text</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="inputLinkTitle" name="inputLinkTitle" placeholder="Title">
							</div>
						</div>

						<div class="form-group">
							<label for="inputTitle" class="col-sm-2 control-label">Tipe Halaman</label>
							<div class="col-sm-4">
								<select name="inputTypePage" id="inputTypePage" class="form-control">
									<?php foreach($menutype as $type=>$title): ?>
										<option value="<?php echo $type; ?>"><?php echo $title; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="inputTitle" class="col-sm-2 control-label">Halaman</label>
							<div class="col-sm-4">
								<select name="inputPageId" id="inputPageId" class="form-control">
									<option value="">...</option>
									<?php foreach($contents as $page): ?>
										<option value="<?php echo $page->contentId; ?>" data-slug="<?php echo $page->contentSlug; ?>"><?php echo $page->contentTitle; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-4">
								<button type="button" id="buttonSaveMenuPage" class="btn btn-success">
									<i class="fa fa-save"></i> Simpan
								</button>
								<button type="button" onclick="reloadPage()" class="btn btn-danger">
									<i class="fa fa-times"></i> Batal
								</button>
							</div>
						</div>
					</form>
		        </div>

		        <div class="tab-pane" id="tab_3">
		        	<form method="post" action="" class="form-horizontal" id="formCategoryMenu">
		            	<input type="hidden" name="inputCategorySlug" id="inputCategorySlug" value="">
		            	<input type="hidden" name="inputTypeMenu" value="category">
		            	<input type="hidden" name="inputEditCategoryMenuId" id="inputEditCategoryMenuId" value="">
						<div class="form-group">
							<label for="inputTitle" class="col-sm-2 control-label">Link Text</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="inputLinkCategory" name="inputLinkCategory" placeholder="Title">
							</div>
						</div>

						<div class="form-group">
							<label for="inputTitle" class="col-sm-2 control-label">Kategori</label>
							<div class="col-sm-4">
								<select name="inputCategoryId" id="inputCategoryId" class="form-control">
									<option value="">...</option>
									<?php foreach($categories as $category): ?>
										<option value="<?php echo $category->categoryId; ?>" data-slug="<?php echo $category->categorySlug; ?>"><?php echo $category->categoryName; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-4">
								<button type="button" id="buttonSaveMenuCategory" class="btn btn-success">
									<i class="fa fa-save"></i> Simpan
								</button>
								<button type="button" onclick="reloadPage()" class="btn btn-danger">
									<i class="fa fa-times"></i> Batal
								</button>
							</div>
						</div>
					</form>
		        </div>

		    </div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="box box-solid">
		    <div class="box-header with-border">
		        <h3 class="box-title">Menu Manager</h3>
		    </div>

		    <div class="box-body">
		    	<form method="post" action="" id="formMenu">
		    	<?php echo $menu; ?>
		    	</form>
		    </div>
		</div>
	</div>

	

</div>


<script type="text/javascript">
$(document).ready(function(){
	$('.select2').select2();

	$('#menumanager').nestedSortable({
		listType: 'ul',
		handle: 'div',
		items: 'li',
		opacity: .6,
		toleranceElement: '> div',
		forcePlaceholderSize: true,
		tabSize: 15,
		placeholder: 'ns-helper',
		maxLevels: 5,
		update: function() {
			var sorted = $('#menumanager').nestedSortable('serialize');
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url('settings/admin/menu/save_sorted_menu'); ?>",
				data: sorted,
				error: function() {
					//$.colorbox({html:'<h2>Error</h2>Simpan kategori gagal'});
				},
				success: function(data) {
					//$.colorbox({html: data + ' kategori berhasil disimpan'});
					//update_kategori_select();
				}
			});

		}
	});
});

$(document).on("change","#inputPageId", function(e){
	var titlePage = $('#inputPageId option:selected').text();
	var slugPage = $('#inputPageId option:selected').data('slug');
	$('#inputPageSlug').val(slugPage);
	$('#inputLinkTitle').val(titlePage);
});

$(document).on("change","#inputCategoryId", function(e){
	var titleCategory = $('#inputCategoryId option:selected').text();
	var slugCategory = $('#inputCategoryId option:selected').data('slug');
	$('#inputCategorySlug').val(slugCategory);
	$('#inputLinkCategory').val(titleCategory);
});

$(document).on("change","#inputTypePage", function(e){
	var opt = '';
	$.post("<?php echo site_url('settings/admin/menu/load_content'); ?>",{type:$(this).val()},function(response){
		if(response.length > 0){
			for(i=0;i<response.length;i++){
				opt += '<option value="'+response[i].contentId+'" data-slug="'+response[i].contentSlug+'">'+response[i].contentTitle+'</option>';
			}
		}
		$('#inputPageId').empty().html(opt);
	},'json');
	
});

$(document).on("click","#buttonSaveCustomLink", function(e){
	if( $('#inputLinkText').val() == '' || $('#inputUrl').val() == '' ){
		swal("Warning!", "Silahkan lengkapi form", "warning");
	}else{
		saveLink("#formCustomLink");
	}
	
});

$(document).on("click","#buttonSaveMenuPage", function(e){
	if( $('#inputLinkTitle').val() == '' || $('#inputPageId').val() == '' ){
		swal("Warning!", "Silahkan lengkapi form", "warning");
	}else{
		saveLink("#formPageMenu");
	}
});

$(document).on("click","#buttonSaveMenuCategory", function(e){
	if( $('#inputLinkCategory').val() == '' || $('#inputCategoryId').val() == '' ){
		swal("Warning!", "Silahkan lengkapi form", "warning");
	}else{
		saveLink("#formCategoryMenu");
	}
});

$(document).on("click",".delete-menu", function(e){
	var menu_id = $(this).data('menuid');
	swal({
	  title: "Warning!",
	  text: "Menghapus menu ini akan menghapus sub-sub menu dibawahnya. Apakah anda yakin?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Hapus!",
	  closeOnConfirm: false
	},
	function(){
		$.post("<?php echo site_url('settings/admin/menu/delete_menu/');?>",{menu_id:menu_id},function(response){
			if(response.status == 1){
				reloadPage();
			}
			swal(response.title, response.message, response.type);
		},"json");
	  
	});
});

var saveLink = function(formId){
	$.ajax({
		url: "<?php echo site_url('settings/admin/menu/save_menu'); ?>",
		type: "post",
		dataType: "json",
		data: $(formId).serialize(),
		beforeSend: function(){

		},
		success: function(response){
			swal(response.title, response.msg, response.type);
			if(response.status == 1){
				$('form').find("input[type=text], textarea, select").val("");
				setTimeout(function(){
					document.location.href="<?php echo site_url('settings/admin/menu/');?>";
				}, 1000);
			}
		},
		error: function(){
			swal("Warning!", "Terjadi kesalahan system. Silahkan ulangi", "warning");
		}
	});
}

var editMenu = function(obj){
	var title = $(obj).data('title');
	var refid = $(obj).data('refid');
	var menuid = $(obj).data('menuid');
	var url = $(obj).data('url');
	var type = $(obj).data('type');
	var contenttype = $(obj).data('contenttype');

	switch(type){
		case'custom':
			$('#inputEditCustomMenuId').val(menuid);
			$('#inputLinkText').val(title);
			$('#inputUrl').val(url);
			$('a[href="#tab_1"]').tab('show');
		break;

		case 'category':	
			$('#inputEditCategoryMenuId').val(menuid);		
			$('#inputCategorySlug').val(url);
			$('#inputLinkCategory').val(title);
			$('#inputCategoryId').val(refid);
			$('a[href="#tab_3"]').tab('show');
		break;

		case 'page':
			$('a[href="#tab_2"]').tab('show');
			$('#inputEditPageMenuId').val(menuid);
			$('#inputTypePage').val(contenttype).change();
			$('#inputPageId').val(refid);
			$('#inputLinkTitle').val(title);
			$('#inputPageSlug').val(url);
			
		break;
	}
}


var reloadPage = function() {
    location.reload();
}

</script>
