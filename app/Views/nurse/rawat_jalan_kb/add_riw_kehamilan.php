<?= $this->extend('layout/main-layout') ?>

<?= $this->section('content') ?>


<script type="text/javascript" src="<?= site_url() ?>resource/js/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?= site_url() ?>resource/js/jquery/jquery-ui-1.9.2.custom.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?= site_url() ?>resource/js/jquery/jquery-ui-timepicker-addon.js"></script>

<div class="breadcrum">
    <p>
        <a href="#">Nursing Record</a><span></span>
        <a href="<?= site_url('nurse/rawat_jalan_kb/') ?>">Rawat Jalan</a><span></span>
        <small>Add Data</small>
    </p>
    <div class="clear"></div>
</div>
<div class="" style="height: 40px;">
    <div class="navigation-button">
        <a href="<?= site_url('nurse/rawat_jalan_kb/') ?>" class="float-end" style="width: 100px;"><img src="<?= site_url() ?>resource/doc/images/icon/back-icon.png" alt="" /> Back</a>
    </div>
    <div class="clear"></div>
</div>
<!-- notification template -->
<!-- end of notification template-->
<form action="<?= site_url('nurse/rawat_jalan_kb/add_riw_kehamilan_process') ?>" method="post">
    <input type="hidden" name="FS_KD_REG" value="<?= $result['FS_KD_REG'] ?? '' ?>" />
    <input type="hidden" name="FS_KD_MEDIS" value="<?= $result['FS_KD_MEDIS'] ?? '' ?>" />
    <input type="hidden" name="FS_KD_LAYANAN" value="<?= $result['FS_KD_LAYANAN'] ?? '' ?>" />
    <table class="table-info" width="100%">
        <tr class="headrow">
            <th colspan="4">Data Pasien</th>
        </tr>
        <tr>
            <td width='20%'>Kode Reg</td>
            <td width='30%'><?= $result['FS_KD_REG'] ?></td>
            <td width='20%'>No RM</td>
            <td width='30%'><?= $result['FS_MR'] ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?= $result['FS_NM_PASIEN'] ?? '' ?></td>
            <td>Alamat</td>
            <td><?= $result['FS_ALM_PASIEN'] ?? '' ?></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td><?= $result['fn_umur'] ?? '' ?> Tahun</td>
            <td>Jenis Kelamin</td>
            <td>
                <?php if ($result['FS_JNS_KELAMIN'] == '1') : ?>
                    Perempuan
                <?php else : ?>
                    Laki-Laki
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Jaminan</td>
            <td><?= $result['FS_NM_JAMINAN'] ?? '' ?></td>
            <td>Dokter</td>
            <td><?= $result['FS_NM_PEG'] ?? '' ?></td>
        </tr>
    </table>
    <table class="table-input" width="100%">
        <tr class="headrow">
            <th colspan="4">Riwayat Kehamilan,Persalinan dan Nifas Yang Lalu</th>
        </tr>
        <tr>
            <td width='20%'>Tahun Partus</td>
            <td width='30%'>
                <input type="text" name="FS_RIW_KEHAMILAN_THN_PARTUS" size="35" />
            </td>
            <td width='20%'>Tempat Partus</td>
            <td width='30%'>
                <input type="text" name="FS_RIW_KEHAMILAN_TMPT_PARTUS" size="35" />
            </td>
        </tr>
        <tr>
            <td>Umur Hamil</td>
            <td><input type="text" name="FS_RIW_KEHAMILAN_UMUR_HAMIL" size="35" /></td>
            <td>Jenis Persalinan</td>
            <td><input type="text" name="FS_RIW_KEHAMILAN_JNS_PERSALINAN" size="35" /></td>
        </tr>
        <tr>
            <td>Penolong Persalinan</td>
            <td><input type="text" name="FS_RIW_KEHAMILAN_PENOLONG_PERSALINAN" size="35" /></td>
            <td>Penyulit</td>
            <td><input type="text" name="FS_RIW_KEHAMILAN_PENYULIT" size="35" /></td>
        </tr>
        <tr>
            <td>Jenis Kelamin / Berat Lahir</td>
            <td><input type="text" name="FS_RIW_KEHAMILAN_JK" size="35" /></td>
            <td>Keadaan Anak Sekarang</td>
            <td><input type="text" name="FS_RIW_KEHAMILAN_KEADAAN_ANAK" size="35" /></td>
        </tr>
        <tr class="submit-box">
            <td colspan="4">
                <input type="submit" name="save" value="Simpan" class="edit-button" />
            </td>
        </tr>
    </table>
</form>
<table class="table-info" width="100%">
    <tr class="headrow">
        <th colspan="10">Data</th>
    </tr>
    <tr>
        <td align='center'>Tahun Partus</td>
        <td align='center'>Tempat Partus</td>
        <td align='center'>Umur Hamil</td>
        <td align='center'>Jenis Persalinan</td>
        <td align='center'>Penolong Persalinan</td>
        <td align='center'>Penyulit</td>
        <td align='center'>Jenis Kelamin / Berat Lahir</td>
        <td align='center'>Keadaan Anak Sekarang</td>
        <td align='center'>Aksi</td>
    </tr>
    <?php foreach ($rs_riw_kehamilan as $data) : ?>
        <tr>
            <td><?= $data['FS_RIW_KEHAMILAN_THN_PARTUS'] ?></td>
            <td> <?= $data['FS_RIW_KEHAMILAN_TMPT_PARTUS'] ?></td>
            <td> <?= $data['FS_RIW_KEHAMILAN_UMUR_HAMIL'] ?></td>
            <td> <?= $data['FS_RIW_KEHAMILAN_JNS_PERSALINAN'] ?></td>
            <td> <?= $data['FS_RIW_KEHAMILAN_PENOLONG_PERSALINAN'] ?></td>
            <td> <?= $data['FS_RIW_KEHAMILAN_PENYULIT'] ?></td>
            <td> <?= $data['FS_RIW_KEHAMILAN_JK'] ?></td>
            <td> <?= $data['FS_RIW_KEHAMILAN_KEADAAN_ANAK'] ?></td>
            <?php $edit = site_url("nurse/rawat_jalan_kb/edit_riw_kehamilan/{$data['FS_KD_TRS']}/{$data['FS_KD_REG']}") ?>
            <td align='center'><a href="<?= $edit ?>">Edit</a>
                <?php $hapus = site_url("nurse/rawat_jalan_kb/delete_riw_kehamilan_process/{$data['FS_KD_TRS']}/{$data['FS_KD_REG']}") ?>
                <a href="<?= $hapus ?>">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection('content') ?>