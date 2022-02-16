<?php 
echo $theme->initSweetalert(); 
?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Testimonial</h3>
    </div>

    <div class="box-body">
        <?php 
            $hidden_form = array("inputTestimonialId" => $inputTestimonialId);
            echo form_open_multipart("testimonial/admin/testimonial/save", array("method" => "post","id" => "formInputTestimonial", "class" => "form-horizontal"), $hidden_form); 
        ?>

        <div class="form-group">
            <?php echo form_label("Nama","inputNamaTestimonial", array("class" => "col-sm-3 control-label") ); ?>
            <div class="col-sm-9">
                <?php
                    $inputNamaTestimonial = array(
                        "name"          => "inputNamaTestimonial",
                        "id"            => "inputNamaTestimonial",
                        "class"         => "form-control",
                        "placeholder"   => "Nama",
                        "value"         => set_value("inputNamaTestimonial",$editdata['inputNamaTestimonial'])
                    );
                    echo form_input( $inputNamaTestimonial );
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo form_label("Isi","inputTextTestimonial", array("class" => "col-sm-3 control-label") ); ?>
            <div class="col-sm-9">
                <?php
                    $inputTextTestimonial = array(
                        "name"          => "inputTextTestimonial",
                        "id"            => "inputTextTestimonial",
                        "class"         => "form-control",
                        "placeholder"   => "Isi",
                        "value"         => set_value("inputTextTestimonial",$editdata['inputTextTestimonial'])
                    );
                    echo form_textarea( $inputTextTestimonial );
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo form_label("Status","inputTestimonialStatus", array("class" => "col-sm-3 control-label") ); ?>
            <div class="col-sm-3">
                <?php
                    $inputTestimonialStatus = array(
                        "id"            => "inputTestimonialStatus",
                        "class"         => "form-control",
                        "placeholder"   => "Status",
                    );

                    echo form_dropdown("inputTestimonialStatus",array('publish' => 'Aktif', 'unpublish' => 'Non Aktif'),set_value("inputTestimonialStatus",$editdata['inputTestimonialStatus']),$inputTestimonialStatus);
                ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <?php 
                    $buttonSubmitTestimonial = array(
                        "name"          => "buttonSubmitTestimonial",
                        "id"            => "buttonSubmitTestimonial",
                        "class"         => "btn btn-success",
                        "content"       => "<i class=\"fa fa-save\"></i> Simpan"
                    );
                    echo form_button( $buttonSubmitTestimonial ); 
                ?>
            </div>
        </div>



        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
$(document).on("click", "#buttonSubmitTestimonial", function(e){
    $.ajax({
        url: $("form#formInputTestimonial").attr("action"),
        type: "post",
        dataType: "json",
        data: $('#formInputTestimonial').serialize(),
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