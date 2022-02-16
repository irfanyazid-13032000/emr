<link rel="stylesheet" type="text/css" href="<?php echo $this->asset_url; ?>vendor/bootstraptable/bootstrap-table.css">
<?php echo $theme->initSweetalert('css'); ?>

<script type="text/javascript" src="<?php echo $this->asset_url; ?>vendor/bootstraptable/bootstrap-table.js"></script>
<script type="text/javascript" src="<?php echo $this->asset_url; ?>vendor/bootstraptable/locale/bootstrap-table-id-ID.js"></script>
<?php echo $theme->initSweetalert('js'); ?>

<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Cari Data Artikel</h3>
	</div>

	<div class="box-body">
		
	</div>
</div>

<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Data Artikel</h3>
	</div>

	<div class="box-body">
		<div id="toolbarGrid">
			<a href="<?php echo site_url('content/admin/blog/add'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
		</div>
		<table id="tableDataBlog" width="100%"
			data-toolbar="#toolbarGrid"
			data-pagination="true"
			data-show-refresh="true"
			data-url="<?php echo site_url('content/admin/blog/load_data_blog'); ?>"
		>
			<thead>
				<tr>
					<th data-field="blogTitle">Judul</th>
					<th data-field="blogCategory">Kategori</th>
					<th data-field="blogCreated">Tanggal</th>
					<th data-field="blogAuthor">Author</th>
					<th data-field="blogStatus" data-align="center" data-formatter="statusPost">Status</th>					
					<th data-field="blogId" data-align="center" data-formatter="linkAksi">Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">
var $tableDataBlog = $('#tableDataBlog');
$(document).ready(function(){
	$tableDataBlog.bootstrapTable();
});

var linkAksi = function(value,row,index){
	var htmlAksi = '';
	htmlAksi += '<a href="<?php echo site_url('content/admin/blog/edit/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
	htmlAksi += '<a href="javascript:void(0)" onclick="doDeleteBlog('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
	htmlAksi += '';
	return htmlAksi;
}

var statusPost = function(value,row,index){
	if(value == 'publish'){
		return '<span class="text-green">Publish</span>';
	}
	if(value == 'pending'){
		return '<span class="text-red">Pending</span>';
	}
	if(value == 'draft'){
		return '<span class="text-muted">Draft</span>';
	}
}

var doDeleteBlog = function(blogId)
{
	swal({
	  title: "Warning!",
	  text: "Apakah anda yakin akan menghapus data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Hapus!",
	  closeOnConfirm: false
	},
	function(){
		$.post("<?php echo site_url('content/admin/blog/delete/');?>",{blogId:blogId},function(response){
			if(response.status == 1){
				$tableDataBlog.bootstrapTable("refresh");
			}
			swal(response.title, response.msg, response.type);
		},"json");
	  
	});
}
</script>