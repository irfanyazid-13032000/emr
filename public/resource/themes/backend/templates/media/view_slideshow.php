<?php
	echo $theme->initSweetalert('css'); 
	echo $theme->initBootstrapTable('css'); 

	echo $theme->initSweetalert('js'); 
	echo $theme->initBootstrapTable('js');

?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Slideshow</h3>
    </div>

    <div class="box-body">
        <div id="toolbarGrid">
            <a href="<?php echo site_url('media/admin/slideshow/form'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
        </div>
        <table id="tableDataSlideshow" width="100%"
            data-toolbar="#toolbarGrid"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('media/admin/slideshow/load_data_slideshow'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="imageSrc" data-formatter="imageSrc" data-width="300">Gambar</th>
                    <th data-field="imageTitle">Title</th>
                    <th data-field="imageSubtitle">Sub Title</th>
                    <th data-field="imageCaption">Caption</th>
                    <th data-field="imageStatus" data-align="center" data-formatter="statusSlideshow">Status</th>                 
                    <th data-field="imageId" data-align="center" data-formatter="actionSlideshow">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
var $tableDataSlideshow = $('#tableDataSlideshow');
var baseUrl = '<?php echo base_url(); ?>';

$(document).ready(function(){
    $tableDataSlideshow.bootstrapTable();
});

var actionSlideshow = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('media/admin/slideshow/form/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeleteSlideshow('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusSlideshow = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'unpublish'){
        return '<span class="text-red">Un Publish</span>';
    }
}

var imageSrc = function(value,row,index){
   if( value != '' )
   {
   		return '<img src="'+baseUrl+value+'" width="250" />';
   }
}

var doDeleteSlideshow = function(id)
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
        $.post("<?php echo site_url('media/admin/slideshow/delete');?>",{id:id},function(response){
            if(response.status == 1){
                $tableDataSlideshow.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}


</script>