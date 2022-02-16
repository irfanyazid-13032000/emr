<?php
	echo $theme->initSweetalert('css'); 
	echo $theme->initBootstrapTable('css'); 

	echo $theme->initSweetalert('js'); 
	echo $theme->initBootstrapTable('js');

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Form Input Jadwal Dokter</h3>
    </div>

    <div class="box-body">
        <?php 
            $hidden_form = array("inputJadwalDokterId" => $jadwal_id);
            echo form_open_multipart("dokter/admin/master_dokter/save_jadwal", array("method" => "post","id" => "formInputJadwalDokter", "class" => "form-horizontal"), $hidden_form); 
        ?>

            <div class="form-group">
                <?php echo form_label("Periode","inputPeriodeId", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputPeriodeId = array(
                            "name"          => "inputPeriodeId",
                            "id"            => "inputPeriodeId",
                            "class"         => "form-control",
                            "placeholder"   => "Periode",
                        );
                        echo form_dropdown("inputPeriodeId",$periode,set_value("inputPeriodeId", $dataedit['inputPeriodeId']),$inputPeriodeId);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label("Nama Dokter","inputDokterId", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputDokterId = array(
                            "name"          => "inputDokterId",
                            "id"            => "inputDokterId",
                            "class"         => "form-control",
                            "placeholder"   => "Nama Dokter",
                        );
                        echo form_dropdown("inputDokterId",$dokter,set_value("inputDokterId", $dataedit['inputDokterId']),$inputDokterId);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label("Hari Senin","inputHariSenin", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputHariSenin = array(
                            "name"          => "inputHariSenin",
                            "id"            => "inputHariSenin",
                            "class"         => "form-control",
                            "placeholder"   => "Jadwal Hari Senin",
                            "value"         => set_value("inputHariSenin", $dataedit['inputHariSenin'])
                        );
                        echo form_input( $inputHariSenin );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label("Hari Selasa","inputHariSelasa", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputHariSelasa = array(
                            "name"          => "inputHariSelasa",
                            "id"            => "inputHariSelasa",
                            "class"         => "form-control",
                            "placeholder"   => "Jadwal Hari Selasa",
                            "value"         => set_value("inputHariSelasa", $dataedit['inputHariSelasa'])
                        );
                        echo form_input( $inputHariSelasa );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label("Hari Rabu","inputHariRabu", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputHariRabu = array(
                            "name"          => "inputHariRabu",
                            "id"            => "inputHariRabu",
                            "class"         => "form-control",
                            "placeholder"   => "Jadwal Hari Rabu",
                            "value"         => set_value("inputHariRabu", $dataedit['inputHariRabu'])
                        );
                        echo form_input( $inputHariRabu );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label("Hari Kamis","inputHariKamis", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputHariKamis = array(
                            "name"          => "inputHariKamis",
                            "id"            => "inputHariKamis",
                            "class"         => "form-control",
                            "placeholder"   => "Jadwal Hari Kamis",
                            "value"         => set_value("inputHariKamis", $dataedit['inputHariKamis'])
                        );
                        echo form_input( $inputHariKamis );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label("Hari Jumat","inputHariJumat", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputHariJumat = array(
                            "name"          => "inputHariJumat",
                            "id"            => "inputHariJumat",
                            "class"         => "form-control",
                            "placeholder"   => "Jadwal Hari Jumat",
                            "value"         => set_value("inputHariJumat", $dataedit['inputHariJumat'])
                        );
                        echo form_input( $inputHariJumat );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label("Hari Sabtu","inputHariSabtu", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputHariSabtu = array(
                            "name"          => "inputHariSabtu",
                            "id"            => "inputHariSabtu",
                            "class"         => "form-control",
                            "placeholder"   => "Jadwal Hari Sabtu",
                            "value"         => set_value("inputHariSabtu", $dataedit['inputHariSabtu'])
                        );
                        echo form_input( $inputHariSabtu );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label("Hari Minggu","inputHariMinggu", array("class" => "col-sm-3 control-label") ); ?>
                <div class="col-sm-9">
                    <?php
                        $inputHariMinggu = array(
                            "name"          => "inputHariMinggu",
                            "id"            => "inputHariMinggu",
                            "class"         => "form-control",
                            "placeholder"   => "Jadwal Hari Minggu",
                            "value"         => set_value("inputHariMinggu", $dataedit['inputHariMinggu'])
                        );
                        echo form_input( $inputHariMinggu );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?php 
                        $buttonSubmitJadwalDokter = array(
                            "name"          => "buttonSubmitJadwalDokter",
                            "id"            => "buttonSubmitJadwalDokter",
                            "class"         => "btn btn-success",
                            "content"       => "<i class=\"fa fa-save\"></i> Simpan"
                        );
                        echo form_button( $buttonSubmitJadwalDokter ); 
                        $buttonResetJadwalDokter = array(
                            "name"          => "buttonResetJadwalDokter",
                            "id"            => "buttonResetJadwalDokter",
                            "class"         => "btn btn-danger",
                            "content"       => "<i class=\"fa fa-refresh\"></i> Reset",
                            "type"          => "reset"
                        );
                        echo form_button( $buttonResetJadwalDokter ); 
                    ?>
                </div>
            </div>

        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
$(document).on("click", "#buttonSubmitJadwalDokter", function(e){
    $.ajax({
        url: $("form#formInputJadwalDokter").attr("action"),
        type: "post",
        dataType: "json",
        data: $('#formInputJadwalDokter').serialize(),
        beforeSend: function(){

        },
        success: function(response){
            if(response.status == 1){
                if( $('input[name="inputJadwalDokterId"]').val() != '' ){
                    $('#buttonResetJadwalDokter').click();
                }
            }
            swal(response.title, response.message, response.type);
        },
        error: function(){
            swal("Error!", "Terjadi kesalahan penyimpanan data", "error");
        }
    });
    
});
</script>