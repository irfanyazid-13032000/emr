<?php
    echo $theme->initSweetalert('css'); 
    echo $theme->initBootstrapTable('css'); 

    echo $theme->initSweetalert('js'); 
    echo $theme->initBootstrapTable('js');

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Testimonial</h3>
    </div>

    <div class="box-body">
        <div id="toolbarGrid">
            <a href="<?php echo site_url('testimonial/admin/testimonial/form'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
        </div>
        <table id="tableDataTestimonial" width="100%"
            data-toolbar="#toolbarGrid"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('testimonial/admin/testimonial/load_data_testimonial'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="testimonialId" data-width="5%">ID</th>
                    <th data-field="testimonialName" data-width="20%">Nama</th>
                    <th data-field="testimonialText" data-width="50%">Isi Testimonial</th>
                    <th data-field="testimonialStatus" data-align="center" data-formatter="statusTestimonial" data-width="15%">Status</th>                 
                    <th data-field="testimonialId" data-align="center" data-formatter="actionTestimonial" data-width="10%">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var $tableDataTestimonial = $('#tableDataTestimonial');

$(document).ready(function(){
    $tableDataTestimonial.bootstrapTable();
});

var actionTestimonial = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('testimonial/admin/testimonial/form/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeleteTestimonial('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusTestimonial = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'unpublish'){
        return '<span class="text-red">Un Publish</span>';
    }
}

var doDeleteTestimonial = function(id)
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
        $.post("<?php echo site_url('testimonial/admin/testimonial/delete');?>",{id:id},function(response){
            if(response.status == 1){
                $tableDataTestimonial.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}
</script>