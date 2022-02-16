<link rel="stylesheet" type="text/css" href="<?php echo $this->asset_url; ?>vendor/bootstraptable/bootstrap-table.css">
<?php echo $theme->initSweetalert('css'); ?>

<script type="text/javascript" src="<?php echo $this->asset_url; ?>vendor/bootstraptable/bootstrap-table.js"></script>
<script type="text/javascript" src="<?php echo $this->asset_url; ?>vendor/bootstraptable/locale/bootstrap-table-id-ID.js"></script>
<?php echo $theme->initSweetalert('js'); ?>



<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Cari Data Halaman</h3>
    </div>

    <div class="box-body">
        
    </div>
</div>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Data Halaman</h3>
    </div>

    <div class="box-body">
        <div id="toolbarGrid">
            <a href="<?php echo site_url('content/admin/page/add'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Baru</a>
        </div>
        <table id="tableDataPage" width="100%"
            data-toolbar="#toolbarGrid"
            data-pagination="true"
            data-show-refresh="true"
            data-url="<?php echo site_url('content/admin/page/load_data_page'); ?>"
        >
            <thead>
                <tr>
                    <th data-field="pageTitle">Judul</th>
                    <th data-field="pageCreated">Dibuat</th>
                    <th data-field="pageAuthor">Author</th>
                    <th data-field="pageLabel" data-formatter="labelPost">Label</th>
                    <th data-field="pageStatus" data-align="center" data-formatter="statusPost">Status</th>                 
                    <th data-field="pageId" data-align="center" data-formatter="linkAksi">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
var $tableDataPage = $('#tableDataPage');
$(document).ready(function(){
    $tableDataPage.bootstrapTable();
});

var linkAksi = function(value,row,index){
    var htmlAksi = '';
    htmlAksi += '<a href="<?php echo site_url('content/admin/page/edit/'); ?>'+value+'" class="btn btn-xs btn-info btn-flat">EDIT</a> ';
    htmlAksi += '<a href="javascript:void(0)" onclick="doDeletePage('+value+')" class="btn btn-xs btn-danger btn-flat">DELETE</a>';
    htmlAksi += '';
    return htmlAksi;
}

var statusPost = function(value,row,index){
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

var labelPost = function(value,row,index){
    if(value == 'welcome_message'){
        return '<span class="text-primary">Halaman Selamat Datang</span>';
    }
    if(value == 'none'){
        return '<span class="text-default">None</span>';
    }
    
}

var doDeletePage = function(pageId)
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
        $.post("<?php echo site_url('content/admin/page/delete/');?>",{pageId:pageId},function(response){
            if(response.status == 1){
                $tableDataPage.bootstrapTable("refresh");
            }
            swal(response.title, response.msg, response.type);
        },"json");
      
    });
}
</script>