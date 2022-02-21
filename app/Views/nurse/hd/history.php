<?= $this->extend('layout/main-layout') ?>

<?= $this->section('content') ?>

<div class="breadcrum">
  <p>
    <a href="#">Pemeriksaan Medis</a><span></span>
    <small>History Pasien</small>
  </p>
  <div class="clear"></div>
</div>
<div class="" style="height: 40px;">
  <div class="navigation-button">
    <a class="float-end" style="width:100px" href="<?php echo site_url('nurse/hd/') ?>"><img src="<?php echo site_url('resource/doc/images/icon/back-icon.png') ?>" alt="" /> Back</a>
  </div>
  <div class="clear"></div>
</div>
<!-- notification template -->

<!-- end of notification template-->

<table class="table-info" width="100%">
  <tr class="headrow">
    <th colspan="4">Data Pasien</th>
  </tr>

  <td width='15%'>No RM</td>
  <td width='35%'><?= $result['FS_MR'] ?></td>
  <td>NIK</td>
  <td><?= $result['FS_KD_IDENTITAS'] ?></td>
  </tr>
  <tr>
    <td width='15%'>Nama</td>
    <td width='35%'><?= (isset($result['FS_NM_PASIEN'])) ? $result['FS_NM_PASIEN'] : '' ?></td>
    <td>Alamat</td>
    <td><?= (isset($result['FS_ALM_PASIEN'])) ? $result['FS_ALM_PASIEN'] : '' ?></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td><?php if ($result['FS_JNS_KELAMIN'] == '1') : ?>
        Perempuan
      <?php else : ?>
        Laki-Laki
      <?php endif; ?></td>
    <td>Tanggal Lahir | Umur</td>
    <td><?= (isset($result['FD_TGL_LAHIR'])) ? $result['FD_TGL_LAHIR'] : '' ?> | <?= $result['fn_umur'] ?> Tahun</td>
  </tr>
  <tr>
    <td width='15%'>Status Sosial / Pekerjaan / Pendidikan</td>
    <td width='35%'><?= $result['FS_NM_PEKERJAAN_DK'] ?> / <?= $result['FS_NM_PENDIDIKAN_DK'] ?></td>
    <td>Agama</td>
    <td><?= (isset($result['fs_nm_agama'])) ? $result['fs_nm_agama'] : '' ?></td>
  </tr>



</table>




<div class="navigation">
  <div class="pageRow">
    <div class="pageNav">
      <ul>
        <li class="info"></li>
      </ul>
    </div>
    <div class="clear"></div>
  </div>
  <div style="height: 40px;">
    <div class="navigation-button">
      <?php $profil = site_url("rm/rawat_jalan/resume/'{$result['FS_MR']}") ?>
      <a href="javascript:void(0);" onclick="window.open('<?= $profil ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="float-end" style="width: 200;"><img src="<?= site_url() ?>resource/doc/images/icon/printer-icon.png" alt="" /> Profil Ringkas Medis Rawat Jalan</a>
    </div>
    <div class="clear"></div>
  </div>
</div>


<table class="table table-view" width="100%" border="0">
  <thead>
    <tr>
      <th width='10%'>Tanggal Kunjungan</th>

      <th>Dokter</th>
      <th>Layanan</th>
      <th>Catatan</th>
      <th>Status</th>
      <th width='30%'>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rs_pasien as $data) : ?>
      <?php $m_rawat_jalan = new \App\Models\M_rawat_jalan(); ?>
      <?php $cek_lab = $m_rawat_jalan->get_data_cek_lab([$data['FS_KD_REG']]); ?>
      <!--{assign var=cek_lab value=$m_rawat_jalan->get_data_cek_lab(array($data.FS_KD_REG))}
      <?php $cek_rad = $m_rawat_jalan->get_data_cek_radiologi([$data['FS_KD_REG']]); ?>
        {assign var=cek_rad value=$m_rawat_jalan->get_data_cek_radiologi(array($data.FS_KD_REG))}
        <?php $cek_resep = $m_rawat_jalan->get_data_cek_resep([$data['FS_KD_REG']]); ?>
        
        {assign var=cek_resep value=$m_rawat_jalan->get_data_cek_resep(array($data.FS_KD_REG))}
        <?php $form_rm = $m_rawat_jalan->get_berkas_by_rg([$data['FS_KD_REG']]); ?>

        {assign var=form_rm value=$m_rawat_jalan->get_berkas_by_rg(array($data.FS_KD_REG))}
        <?php $cek_ases_perawat = $m_rawat_jalan->cek_ases_perawat_by_rg([$data['FS_KD_REG']]); ?>
        
        {assign var=cek_ases_perawat value=$m_rawat_jalan->cek_ases_perawat_by_rg(array($data.FS_KD_REG))}
        -->
      <tr <?php if ($no++ % 2 == 1) echo `class="blink-row"` ?>>
        <td><?= $data['FD_TGL_MASUK'] ?></td>

        <td>
          <?= $data['FS_NM_PEG'] ?><br>
          <?= $data['DOK2'] ?>
        </td>
        <td>
          <?= $data['FS_NM_LAYANAN'] ?><br>
          <?= $data['LAYANAN2'] ?>
        </td>
        <td>
          <?php if ($cek_lab >= '1') : ?>
            - Hasil Laboratorium <br>
          <?php endif; ?>
          <?php if ($cek_rad >= '1') : ?>
            - Hasil Radiologi <br>
          <?php endif; ?>
          <?php if ($cek_resep >= '1') : ?>
            - Resep
          <?php endif; ?>
        </td>
        <td>
          <center>
            <b>
              <?php if ($data['FS_KD_JENIS_REG'] == '0') : ?>
                <div style="color: blue;">Rawat Jalan</div>
              <?php elseif ($data['FS_KD_JENIS_REG'] == '1') : ?>
                <div style="color: green;">Rawat Inap</div>
              <?php elseif ($data['FS_KD_JENIS_REG'] == '3') : ?>
                <div style="color: red;">Rawat Darurat</div>
              <?php endif; ?>
            </b>
          </center>
        </td>
        <td>
          <?php if (!empty($form_rm['att_name']) ?? '') : ?>
            <?php $operasi = site_url("rm/upload/download/{$form_rm['att_name']}") ?>
            <a href="<?= $operasi ?>" class="button-download" target="_blank">Operasi</a>
          <?php endif; ?>
          <?php if ($data['FS_KD_JENIS_REG'] == '0') : ?>
            <?php $rawat_jalan_cetak_rm = site_url("rm/rawat_jalan/cetak_rm/{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}/2") ?>
            <a href="javascript:void(0);" onclick="window.open('<?= $rawat_jalan_cetak_rm ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">RM</a>
          <?php elseif ($data['FS_KD_JENIS_REG'] == '1') : ?>
            <?php $rawat_inap_cetak_rm = site_url("rm/rawat_inap/cetak_rm/{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}") ?>
            <a href="javascript:void(0);" onclick="window.open('<?= $rawat_inap_cetak_rm ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">RM</a>
          <?php elseif ($data['FS_KD_JENIS_REG'] == '3') : ?>
          <?php endif; ?>

          <?php if ($data['FD_TGL_KELUAR'] == '3000-01-01') : ?>
          <?php else : ?>
            <?php if ($cek_ases_perawat == '0') : ?>
              <?php $awal = site_url("nurse/hd/add/{$data['FS_KD_REG']}/{$FS_KD_MEDIS}/A") ?>
              <a href="<?= $awal ?>" class="button-edit">Awal</a>
              <?php $lanjut = site_url("nurse/hd/add/$FS_KD_MEDIS/$FS_KD_MEDIS/L") ?>
              <a href="<?= $lanjut ?>" class="button-edit">Lanjut</a>
            <?php else : ?>
              <?php $fs_kd_reg = ($data['FS_KD_REG']) ? $data['FS_KD_REG'] : ''; ?>
              <?php $edit = site_url("nurse/hd/edit/{$fs_kd_reg}") ?>
              <a href="<?= $edit ?>" class="button-edit">Edit</a>

            <?php endif; ?>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>



<?= $this->endSection('content') ?>