<?php
	echo $theme->initSweetalert('css'); 
	echo $theme->initBootstrapTable('css'); 

	echo $theme->initSweetalert('js'); 
	echo $theme->initBootstrapTable('js');

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Dokter</h3>
    </div>

    <div class="box-body">
        <div id="toolbarGrid">
            <a href="<?php echo site_url('dokter/admin/master_dokter/form'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
        </div>
        <table id="tableDataDokter" width="100%"
            data-toolbar="#toolbarGrid"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('dokter/admin/master_dokter/load_data_dokter'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="dokterId">Dokter ID</th>
                    <th data-field="dokterName">Nama Dokter</th>
                    <th data-field="dokterSpesialisNama">Spesialis</th>
                    <th data-field="dokterStatus" data-align="center" data-formatter="statusDokter">Status</th>                 
                    <th data-field="dokterId" data-align="center" data-formatter="actionDokter">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
var $tableDataDokter = $('#tableDataDokter');

$(document).ready(function(){
	$tableDataDokter.bootstrapTable();
});

var actionDokter = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('dokter/admin/master_dokter/form/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeleteDokter('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusDokter = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'unpublish'){
        return '<span class="text-red">Un Publish</span>';
    }
}

var doDeleteDokter = function(id)
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
        $.post("<?php echo site_url('dokter/admin/master_dokter/delete');?>",{id:id},function(response){
            if(response.status == 1){
                $tableDataDokter.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}
</script>