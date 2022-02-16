<?php
	echo $theme->initSweetalert('css'); 
	echo $theme->initBootstrapTable('css'); 

	echo $theme->initSweetalert('js'); 
	echo $theme->initBootstrapTable('js');

?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Poliklinik</h3>
    </div>

    <div class="box-body">
        <div id="toolbarGrid">
            <a href="<?php echo site_url('dokter/admin/master_poliklinik/form'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
        </div>
        <table id="tableDataPolikinik" width="100%"
            data-toolbar="#toolbarGrid"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('dokter/admin/master_poliklinik/load_data_poliklinik'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="poliId">Poli ID</th>
                    <th data-field="poliName">Nama Poliklinik</th>
                    <th data-field="poliStatus" data-align="center" data-formatter="statusPoliklinik">Status</th>                 
                    <th data-field="poliId" data-align="center" data-formatter="actionPoliklinik">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
var $tableDataPolikinik = $('#tableDataPolikinik');
$(document).ready(function(){
    $tableDataPolikinik.bootstrapTable();
});

var actionPoliklinik = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('dokter/admin/master_poliklinik/form/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeletePoliklinik('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusPoliklinik = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'unpublish'){
        return '<span class="text-red">Un Publish</span>';
    }
}

var doDeletePoliklinik = function(id)
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
        $.post("<?php echo site_url('dokter/admin/master_poliklinik/delete');?>",{id:id},function(response){
            if(response.status == 1){
                $tableDataPolikinik.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}
</script>