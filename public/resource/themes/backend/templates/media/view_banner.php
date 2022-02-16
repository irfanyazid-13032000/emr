<?php
	echo $theme->initSweetalert('css'); 
	echo $theme->initBootstrapTable('css'); 

	echo $theme->initSweetalert('js'); 
	echo $theme->initBootstrapTable('js');

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Banner</h3>
    </div>

    <div class="box-body">
        <div id="toolbarGrid">
            <a href="<?php echo site_url('media/admin/banner/form'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
        </div>
        <table id="tableDataBanner" width="100%"
            data-toolbar="#toolbarGrid"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('media/admin/banner/load_data_banner'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="bannerImage" data-formatter="imageFormatter">Gambar</th>
                    <th data-field="bannerTitle">Judul</th>
                    <th data-field="bannerUrl">Url</th>
                    <th data-field="bannerPosition">Posisi</th>
                    <th data-field="bannerStatus" data-align="center" data-formatter="statusBanner">Status</th>                 
                    <th data-field="bannerId" data-align="center" data-formatter="actionBanner">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var $tableDataBanner = $('#tableDataBanner');

$(document).ready(function(){
	$tableDataBanner.bootstrapTable();
});

var actionBanner = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('media/admin/banner/form/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeleteBanner('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusBanner = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'unpublish'){
        return '<span class="text-red">Un Publish</span>';
    }
}

var imageFormatter = function(value,row,index){
    return '<img src="'+base_url+value+'" width="200" />';
}

var doDeleteBanner = function(id)
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
        $.post("<?php echo site_url('media/admin/banner/delete');?>",{id:id},function(response){
            if(response.status == 1){
                $tableDataBanner.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}
</script>