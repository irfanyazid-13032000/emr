<?php
	echo $theme->initSweetalert('css'); 
	echo $theme->initBootstrapTable('css'); 

	echo $theme->initSweetalert('js'); 
	echo $theme->initBootstrapTable('js');

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Form Periode Jadwal Dokter</h3>
    </div>

    <div class="box-body">
        <?php 
            $hidden_form = array("inputPeriodeJadwalId" => null);
            echo form_open_multipart("dokter/admin/master_dokter/save_periode_jadwal", array("method" => "post","id" => "formInputPeriodeJadwal", "class" => "form-horizontal"), $hidden_form); 
        ?>

            <div class="form-group">
                <?php echo form_label("Nama Periode","inputNamaPeriode", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputNamaPeriode = array(
                            "name"          => "inputNamaPeriode",
                            "id"            => "inputNamaPeriode",
                            "class"         => "form-control",
                            "placeholder"   => "Nama Periode",
                            "value"         => set_value("inputNamaPeriode")
                        );
                        echo form_input( $inputNamaPeriode );
                    ?>
                </div>
            </div>

            <div class="form-group">
            <?php echo form_label("Status","inputPeriodeStatus", array("class" => "col-sm-3 control-label") ); ?>
            <div class="col-sm-3">
                <?php
                    $inputPeriodeStatus = array(
                        "id"            => "inputPeriodeStatus",
                        "class"         => "form-control",
                        "placeholder"   => "Status",
                    );

                    echo form_dropdown("inputPeriodeStatus",array('publish' => 'Aktif', 'unpublish' => 'Non Aktif'),set_value("inputPeriodeStatus"),$inputPeriodeStatus);
                ?>
            </div>
        </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?php 
                        $buttonSubmitPeriodeJadwal = array(
                            "name"          => "buttonSubmitPeriodeJadwal",
                            "id"            => "buttonSubmitPeriodeJadwal",
                            "class"         => "btn btn-success",
                            "content"       => "<i class=\"fa fa-save\"></i> Simpan"
                        );
                        echo form_button( $buttonSubmitPeriodeJadwal ); 
                        $buttonResetPeriodeJadwal = array(
                            "name"          => "buttonResetPeriodeJadwal",
                            "id"            => "buttonResetPeriodeJadwal",
                            "class"         => "btn btn-danger",
                            "content"       => "<i class=\"fa fa-refresh\"></i> Reset",
                            "type"          => "reset"
                        );
                        echo form_button( $buttonResetPeriodeJadwal ); 
                    ?>
                </div>
            </div>

        <?php echo form_close(); ?>
    </div>
</div>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Periode Jadwal Dokter</h3>
    </div>

    <div class="box-body">
        <table id="tableDataPeriodeJadwalDokter" width="100%"
            data-toolbar="#toolbarGrid"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('dokter/admin/master_dokter/load_periode_jadwal_dokter'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="periodeId">Periode ID</th>
                    <th data-field="periodeNama">Nama Periode</th>
                    <th data-field="periodeStatus" data-align="center" data-formatter="statusPeriodeJadwalDokter">Status</th>                 
                    <th data-field="periodeId" data-align="center" data-formatter="actionPeriodeJadwalDokter">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
var $tableDataPeriodeJadwalDokter = $('#tableDataPeriodeJadwalDokter');

$(document).ready(function(){
	$tableDataPeriodeJadwalDokter.bootstrapTable();
});

$(document).on("click", "#buttonSubmitPeriodeJadwal", function(e){
    $.ajax({
        url: $("form#formInputPeriodeJadwal").attr("action"),
        type: "post",
        dataType: "json",
        data: $('#formInputPeriodeJadwal').serialize(),
        beforeSend: function(){

        },
        success: function(response){
            if(response.status == 1){
                $tableDataPeriodeJadwalDokter.bootstrapTable("refresh");
                $('#buttonResetPeriodeJadwal').click();
            }
            swal(response.title, response.message, response.type);
        },
        error: function(){
            swal("Error!", "Terjadi kesalahan penyimpanan data", "error");
        }
    });
    
});

var actionPeriodeJadwalDokter = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('dokter/admin/master_dokter/setting_jadwal_dokter/'); ?>'+value+'" class="btn btn-xs btn-success btn-flat">INPUT JADWAL DOKTER</a> ';
    htmlAksi += '<button type="button" class="btn btn-xs btn-info btn-flat" onclick="editPeriode('+row.periodeId+',\''+row.periodeNama+'\',\''+row.periodeStatus+'\')">EDIT</button> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeletePeriodeJadwalDokter('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusPeriodeJadwalDokter = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'unpublish'){
        return '<span class="text-red">Un Publish</span>';
    }
}

var doDeletePeriodeJadwalDokter = function(id)
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
        $.post("<?php echo site_url('dokter/admin/master_dokter/delete_periode_jadwal');?>",{id:id},function(response){
            if(response.status == 1){
                $tableDataPeriodeJadwalDokter.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}

var editPeriode = function(id,nama,status){
    $('input[name="inputPeriodeJadwalId"]').val(id);
    $('#inputNamaPeriode').val(nama);
    $('#inputPeriodeStatus').val(status);
}

</script>