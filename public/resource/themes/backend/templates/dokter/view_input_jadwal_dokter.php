<?php
    echo $theme->initSweetalert('css'); 
    echo $theme->initBootstrapTable('css'); 

    echo $theme->initSweetalert('js'); 
    echo $theme->initBootstrapTable('js');

?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Jadwal Dokter</h3>
    </div>

    <div class="box-body">

        <div id="toolbarGrid">
            <a href="<?php echo site_url('dokter/admin/master_dokter/form_input_jadwal'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>            
        </div>
    	<table id="tableJadwalDokter" width="100%" class="table" data-toggle="table" 
            data-toolbar="#toolbarGrid"
            data-show-refresh="true"
            data-url="<?php echo site_url('dokter/admin/master_dokter/load_jadwal_dokter/'.$periode_id); ?>"
        >
    		<thead>
    			<tr>
    				<th data-field="rp_name">PELAYANAN</th>
    				<th data-field="md_name">DOKTER</th>
    				<th data-field="mjd_senin">SENIN</th>
    				<th data-field="mjd_selasa">SELASA</th>
    				<th data-field="mjd_rabu">RABU</th>
    				<th data-field="mjd_kamis">KAMIS</th>
    				<th data-field="mjd_jumat">JUMAT</th>
    				<th data-field="mjd_sabtu">SABTU</th>
    				<th data-field="mjd_minggu">MINGGU</th>
                    <th data-field="mjd_id" data-formatter="actionJadwalDokter">AKSI</th>
    			</tr>
    		</thead>

    	</table>
  
    </div>
</div>

<script type="text/javascript">
var $tableJadwalDokter = $('#tableJadwalDokter');
var actionJadwalDokter = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('dokter/admin/master_dokter/form_input_jadwal/'); ?>'+value+'" class="btn btn-xs btn-primary btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeleteJadwalDokter('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusJadwalDokter = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'unpublish'){
        return '<span class="text-red">Un Publish</span>';
    }
}

var doDeleteJadwalDokter = function(id)
{
    swal({
      title: "Warning!",
      text: "Menghapus data periode sekaligus akan menghapus jadwal dokter. Apakah anda yakin?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Hapus!",
      closeOnConfirm: false
    },
    function(){
        $.post("<?php echo site_url('dokter/admin/master_dokter/delete_jadwal');?>",{id:id},function(response){
            if(response.status == 1){
                $tableJadwalDokter.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}

</script>