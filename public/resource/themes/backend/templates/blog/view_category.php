<link rel="stylesheet" type="text/css" href="<?php echo $this->asset_url; ?>vendor/bootstraptable/bootstrap-table.css">
<?php echo $theme->initSweetalert('css'); ?>

<script type="text/javascript" src="<?php echo $this->asset_url; ?>vendor/bootstraptable/bootstrap-table.js"></script>
<script type="text/javascript" src="<?php echo $this->asset_url; ?>vendor/bootstraptable/locale/bootstrap-table-id-ID.js"></script>
<?php echo $theme->initSweetalert('js'); ?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Kategori</h3>
    </div>

    <div class="box-body">
        <div id="toolbarGrid">
            <a href="<?php echo site_url('content/admin/category/add'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
        </div>
        <table id="tableDataCategory" width="100%"
            data-toolbar="#toolbarGrid"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('content/admin/category/load_data_category'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="categoryId">Kategori ID</th>
                    <th data-field="categoryName">Kategori</th>
                    <th data-field="categoryStatus" data-align="center" data-formatter="statusCategory">Status</th>                 
                    <th data-field="categoryId" data-align="center" data-formatter="actionCategory">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
var $tableDataCategory = $('#tableDataCategory');
$(document).ready(function(){
    $tableDataCategory.bootstrapTable();
});

var actionCategory = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('content/admin/category/edit/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeleteCategory('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusCategory = function(value,row,index){
    if(value == 'publish'){
        return '<span class="text-green">Publish</span>';
    }
    if(value == 'pending'){
        return '<span class="text-red">Pending</span>';
    }
    if(value == 'draft'){
        return '<span class="text-muted">Draft</span>';
    }
}

var doDeleteCategory = function(categoryId)
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
        $.post("<?php echo site_url('content/admin/category/delete/');?>",{categoryId:categoryId},function(response){
            if(response.status == 1){
                $tableDataCategory.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}
</script>