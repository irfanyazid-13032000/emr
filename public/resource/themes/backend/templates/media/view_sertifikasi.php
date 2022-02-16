<?php
	echo $theme->initSweetalert('css'); 
	echo $theme->initBootstrapTable('css'); 

	echo $theme->initSweetalert('js'); 
	echo $theme->initBootstrapTable('js');

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Sertifikasi</h3>
    </div>

    <div class="box-body">
    	 <div id="toolbarGrid">
            <a href="<?php echo site_url('media/admin/sertifikasi/form'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
        </div>
        <table id="tableDataSertifikasi" width="100%"
            data-toolbar="#toolbarGrid"
            data-toggle="table"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('media/admin/sertifikasi/load_data_sertifikasi/'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="awardImage" data-formatter="imageFormatter">Gambar</th>
                    <th data-field="awardTitle">Judul</th>
                    <th data-field="awardStatus" data-align="center" data-formatter="statusSertifikasi">Status</th>                 
                    <th data-field="awardId" data-align="center" data-formatter="actionSertifikasi">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<script type="text/javascript">
var $tableDataSertifikasi = $('#tableDataSertifikasi');
var baseUrl = '<?php echo base_url(); ?>';

var actionSertifikasi = function(value,row,index){
    var htmlAksi = '';
   htmlAksi += '<a href="<?php echo site_url('media/admin/sertifikasi/form/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeleteSertifikasi('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}


var statusSertifikasi = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'unpublish'){
        return '<span class="text-red">Un Publish</span>';
    }
}

var imageFormatter = function(value,row,index){
   if( value != '' )
   {
   		return '<img src="'+baseUrl+value+'" width="100" />';
   }
}

var doDeleteSertifikasi = function(id)
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
        $.post("<?php echo site_url('media/admin/sertifikasi/delete');?>",{id:id},function(response){
            if(response.status == 1){
                $tableDataSertifikasi.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}

</script>