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
    <a href="<?= site_url('nurse/rawat_jalan/') ?>">Rawat Jalan</a><span></span>
    <small>Add Data</small>
  </p>
  <div class="clear"></div>
</div>
<div class="" style="height: 40px;">
  <div class="navigation-button">
    <a href="<?= site_url('nurse/rawat_jalan/') ?>" class="float-end" style="width: 100px;"> <img src="<?= site_url() ?>resource/doc/images/icon/back-icon.png" alt="" /> Back</a>
  </div>
  <div class="clear"></div>
</div>
<form action="<?= site_url('nurse/rawat_jalan/edit_process') ?>" method="post">
  <input type="hidden" name="FS_KD_REG" value="<?= $result['FS_KD_REG'] ?>" />
  <input type="hidden" name="FS_MR" value="<?= $result['FS_MR'] ?>" />







  <table class="table table-info" width="100%">
    <tr class="headrow">
      <th colspan="4">Data Pasien</th>
    </tr>
    <tr>
      <td width='20%'>Kode Reg / No MR</td>
      <td width='30%'><?= $result['FS_KD_REG'] ?> / <?= $result['FS_MR'] ?></td>
      <td width='20%'>NIK</td>
      <td width='30%'><?= $result['FS_KD_IDENTITAS'] ?></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><?= ($result['FS_NM_PASIEN']) ?? '' ?></td>
      <td>Alamat</td>
      <td><?= ($result['FS_ALM_PASIEN']) ?? '' ?></td>
    </tr>
    <tr>
      <td>Umur</td>
      <td><?= ($result['fn_umur']) ?? '' ?> Tahun</td>
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
      <td><?= ($result['FS_NM_JAMINAN']) ?? '' ?></td>
      <td>Dokter</td>
      <td><?= $result['FS_NM_PEG'] ?? '' ?></td>
    </tr>
    <tr>
      <td>Kelengkapan Berkas</td>
      <td>
        <?php if ($result['FS_KD_TIPE_JAMINAN'] == '95001' or $result['FS_KD_TIPE_JAMINAN'] == '96001') : ?>
          <?php if ($result['FS_NO_SJP'] == '') : ?>
            <span style='color: red;font-weight: bold;font-size: 15px;'>
              <blink>DATA BELUM DIVERIFIKASI</blink>
            </span>
          <?php else : ?>
            <span style='color: green;font-weight: bold;font-size: 15px;'>
              <blink>DATA SUDAH DIVERIVIKASI</blink>
            </span>
          <?php endif; ?>
        <?php endif; ?>
      </td>
      <td>Status Sosial / Pekerjaan / Pendidikan</td>
      <td>
        <?= $result['FS_NM_PEKERJAAN_DK'] ?> / <?= $result['FS_NM_PENDIDIKAN_DK'] ?>
      </td>
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
    <div class="" style="height: 40px;">
      <div class="navigation-button">
        <?php $profil = site_url('rm/rawat_jalan/resume/' . $result['FS_MR']) ?>
        <a href="javascript:void(0);" onclick="window.open('<?= $profil ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="float-end" style="width: 200px;"><img src=" <?= site_url() ?>resource/doc/images/icon/printer-icon.png" alt="" /> Profil Ringkas Medis Rawat Jalan</a>
      </div>
    </div>
    <div class="clear"></div>
  </div>




  <div class="alert alert-danger">
    <p><strong>High Risk :</strong> <?= ($result['FS_HIGH_RISK']) ?? '-' ?> </p>
    <p><strong>Alergi :</strong> <?= $result['FS_ALERGI'] ?? '-' ?> (<?= $result['FS_REAK_ALERGI'] ?? '-' ?>)</p>
    <div class="clear"></div>
  </div>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="2">Anamnesa / Allow Anamnesa</th>
      <th colspan="2">Pemeriksaan Fisik</th>
      <th colspan="2">Edukasi</th>
    </tr>
    <tr>
      <td colspan="2">
        <textarea cols="50" name="FS_ANAMNESA" class="form-control"><?= ($result['FS_ANAMNESA']) ?? '-' ?></textarea>
        <em style="color:red">* Wajib Diisi</em>
      </td>
      <td colspan="2">
        <textarea cols="50" name="FS_PEMERIKSAAN_FISIK" class="form-control"><?= ($result['FS_PEMERIKSAAN_FISIK']) ?? '-' ?></textarea>
        <em>&nbsp;</em>
      </td>
      <td colspan="2">
        <textarea cols="50" name="FS_EDUKASI" class="form-control"><?= ($result['FS_EDUKASI']) ?? '-' ?></textarea>
        <em>&nbsp;</em>
      </td>
    </tr>
  </table>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="6">Vital Sign</th>
    </tr>
    <tr>
      <td width='10%'>Suhu</td>
      <td width='10%'><input type="text" class="form-control" name="FS_SUHU" size="10" style="width: 190px;" value="<?= $vs['FS_SUHU'] ?? '' ?>" /></td>
      <td>&nbsp;</td>
      <td width='10%'>Nadi</td>
      <td width='20%'><input type="text" class="form-control" name="FS_NADI" size="10" style="width: 190px;" value="<?= $vs['FS_NADI'] ?? "" ?>" /></td>
      <td>x/menit</td>
    </tr>
    <tr>
      <td>R</td>
      <td><input type="text" class="form-control" name="FS_R" size="10" style="width: 190px;" value="<?= $vs['FS_R'] ?? "" ?>" /></td>
      <td>x/menit</td>
      <td>TD</td>
      <td><input type="text" class="form-control" name="FS_TD" size="10" style="width: 190px;" value="<?= $vs['FS_TD'] ?? "" ?>" /></td>
      <td>mmHg</td>
    </tr>
    <tr>
      <td>Tinggi Badan</td>
      <td><input type="text" class="form-control" name="FS_TB" size="10" style="width: 190px;" value="<?= $vs['FS_TB'] ?? "" ?>" /></td>
      <td>cm</td>
      <td>Berat Badan</td>
      <td><input type="text" class="form-control" name="FS_BB" size="10" style="width: 190px;" value="<?= $vs['FS_BB'] ?? "" ?>" /></td>
      <td>Kg</td>
    </tr>
  </table>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="4">Asesmen Nyeri</th>
    </tr>
    <tr>
      <td width='20%'>Ada Nyeri ?</td>
      <td width='30%'>
        <select name="FS_NYERI" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($nyeri['FS_NYERI'])) : ?>
            <option value="0" <?php if ($nyeri['FS_NYERI'] == '0') echo 'selected' ?>> Tidak</option>
            <option value="1" <?php if ($nyeri['FS_NYERI'] == '1') echo 'selected' ?>>>Ya</option>
          <?php else : ?>
            <option value="0"> Tidak</option>
            <option value="1">Ya</option>
          <?php endif; ?>
        </select>
      </td>
      <td width='20%'></td>
      <td width='30%'></td>
    </tr>
    <tr>
      <td>Provokatif</td>
      <td>
        <select name="FS_NYERIP" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($nyeri['FS_NYERIP'])) : ?>
            <option value="0" <?php if ($nyeri['FS_NYERIP'] == '0') echo 'selected' ?>>Tidak Ada Nyeri</option>
            <option value="1" <?php if ($nyeri['FS_NYERIP'] == '1') echo 'selected' ?>>Biologik</option>
            <option value="2" <?php if ($nyeri['FS_NYERIP'] == '2') echo 'selected' ?>>Kimiawi</option>
            <option value="3" <?php if ($nyeri['FS_NYERIP'] == '3') echo 'selected' ?>>Mekanik / Rudapaksa</option>
          <?php else : ?>
            <option value="0">Tidak Ada Nyeri</option>
            <option value="1">Biologik</option>
            <option value="2">Kimiawi</option>
            <option value="3">Mekanik / Rudapaksa</option>
          <?php endif; ?>
        </select>
      </td>
      <td>Quality</td>
      <td>
        <select name="FS_NYERIQ" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($nyeri['FS_NYERIQ'])) : ?>
            <option value="0" <?php if ($nyeri['FS_NYERIQ'] == '0') echo 'selected' ?>>Tidak Ada</option>
            <option value="1" <?php if ($nyeri['FS_NYERIQ'] == '1') echo 'selected' ?>>Seperti Di Tusuk-Tusuk</option>
            <option value="2" <?php if ($nyeri['FS_NYERIQ'] == '2') echo 'selected' ?>>Seperti Terbakar</option>
            <option value="3" <?php if ($nyeri['FS_NYERIQ'] == '3') echo 'selected' ?>>Seperti Tertimpa Beb</option>
            <option value="4" <?php if ($nyeri['FS_NYERIQ'] == '4') echo 'selected' ?>>Ngilu</option>
          <?php else : ?>
            <option value="0">Tidak Ada</option>
            <option value="1">Seperti Di Tusuk-Tusuk</option>
            <option value="2">Seperti Terbakar</option>
            <option value="3">Seperti Tertimpa Beb</option>
            <option value="4">Ngilu</option>
          <?php endif; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Regio</td>
      <td>
        <input type="text" class="form-control" name="FS_NYERIR" style="width: 190px;" value="<?= $nyeri['FS_NYERIR'] ?? "" ?>" />
      </td>
      <td>Severity</td>
      <td>
        <select name="FS_NYERIS" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($nyeri['FS_NYERIS'])) : ?>
            <option value="0" <?php if ($nyeri['FS_NYERIS'] == '0') echo 'selected' ?>>0</option>
            <option value="1" <?php if ($nyeri['FS_NYERIS'] == '1') echo 'selected' ?>>1</option>
            <option value="2" <?php if ($nyeri['FS_NYERIS'] == '2') echo 'selected' ?>>2</option>
            <option value="3" <?php if ($nyeri['FS_NYERIS'] == '3') echo 'selected' ?>>3</option>
            <option value="4" <?php if ($nyeri['FS_NYERIS'] == '4') echo 'selected' ?>>4</option>
            <option value="5" <?php if ($nyeri['FS_NYERIS'] == '5') echo 'selected' ?>>5</option>
            <option value="6" <?php if ($nyeri['FS_NYERIS'] == '6') echo 'selected' ?>>6</option>
            <option value="7" <?php if ($nyeri['FS_NYERIS'] == '7') echo 'selected' ?>>7</option>
            <option value="8" <?php if ($nyeri['FS_NYERIS'] == '8') echo 'selected' ?>>8</option>
            <option value="9" <?php if ($nyeri['FS_NYERIS'] == '9') echo 'selected' ?>>9</option>
            <option value="10" <?php if ($nyeri['FS_NYERIS'] == '10') echo 'selected' ?>>10</option>
          <?php else : ?>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          <?php endif; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Time</td>
      <td>
        <select name="FS_NYERIT" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($nyeri['FS_NYERIT'])) : ?>
            <option value="0" <?php if ($nyeri['FS_NYERIT'] == '0') echo 'selected' ?>>Tidak Ada</option>
            <option value="1" <?php if ($nyeri['FS_NYERIT'] == '1') echo 'selected' ?>>Kadang-kadang</option>
            <option value="2" <?php if ($nyeri['FS_NYERIT'] == '2') echo 'selected' ?>>Sering</option>
            <option value="3" <?php if ($nyeri['FS_NYERIT'] == '3') echo 'selected' ?>>Menetap</option>
          <?php else : ?>
            <option value="0">Tidak Ada</option>
            <option value="1">Kadang-kadang</option>
            <option value="2">Sering</option>
            <option value="3">Menetap</option>
          <?php endif; ?>
        </select>
      </td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="4">Asesmen Jatuh</th>
    </tr>
    <tr>
      <td width='15%'>Cara berjalan pasien Tidak seimbang / sempoyongan / limbung</td>
      <td width='35%'>
        <select name="FS_CARA_BERJALAN1" id="surat_dari" class="form-control" style="width: 190px;" id="op1">
          <option value="">--Pilih Data--</option>
          <?php if (isset($jatuh['FS_CARA_BERJALAN1'])) : ?>
            <option value="1" <?php if ($jatuh['FS_CARA_BERJALAN1'] == '1') echo 'selected' ?>>YA</option>
            <option value="0" <?php if ($jatuh['FS_CARA_BERJALAN1'] == '0') echo 'selected' ?>>TIDAK</option>
          <?php else : ?>
            <option value="1">YA</option>
            <option value="0">TIDAK</option>
          <?php endif; ?>
        </select>
        <span id="sc1"></span>
      </td>
      <td width='15%'>Kesimpulan</td>
      <td width='35%'>
        <b>
          <span id="totalsc"></span>
          <?php $jatuh2 = intval($jatuh['FS_CARA_BERJALAN1'] ?? '') + intval($jatuh['FS_CARA_BERJALAN2'] ?? "") + intval($jatuh['FS_CARA_DUDUK'] ?? "") ?>
          <?= $jatuh2 ?>
        </b>
        <span id="rjtkesimpulan"></span>
        (<?php
          if ($jatuh2 >= "3") {
            echo "RISIKO TINGGI";
          } elseif ($jatuh2 > "1" && $jatuh2 <= '2') {
            echo "RISIKO RENDAH";
          } elseif ($jatuh2 <= '1') {
            echo "TIDAK ADA RISIKO";
          }
          ?>)
      </td>

    </tr>
    <tr>
      <td width='15%'>Cara berjalan pasien dengan mengunakan alat bantu</td>
      <td width='35%'>
        <select name="FS_CARA_BERJALAN2" id="surat_dari" class="form-control" style="width: 190px;" id="op2">
          <option value="">--Pilih Data--</option>
          <?php if (isset($jatuh['FS_CARA_BERJALAN2'])) : ?>
            <option value="1" <?php if ($jatuh['FS_CARA_BERJALAN2'] == '1') echo 'selected' ?>>YA</option>
            <option value="0" <?php if ($jatuh['FS_CARA_BERJALAN2'] == '0') echo 'selected' ?>>TIDAK</option>
          <?php else : ?>
            <option value="1">YA</option>
            <option value="0">TIDAK</option>
          <?php endif; ?>
        </select>
        <span id="sc2"></span>
      </td>
      <td></td>
      <td>
      </td>
    </tr>
    <tr>
      <td>Menopang saat akan duduk: tampak memegang pinggiran kursi atau meja / benda lain sebagai penopang saat akan duduk.</td>
      <td>
        <select name="FS_CARA_DUDUK" id="surat_dari" class="form-control" style="width: 190px;" id="op3">
          <option value="">--Pilih Data--</option>
          <?php if (isset($jatuh['FS_CARA_DUDUK'])) : ?>
            <option value="1" <?php if ($jatuh['FS_CARA_DUDUK'] == '1') echo 'selected' ?>>YA</option>
            <option value="0" <?php if ($jatuh['FS_CARA_DUDUK'] == '0') echo 'selected' ?>>TIDAK</option>
          <?php else : ?>
            <option value="1">YA</option>
            <option value="0">TIDAK</option>
          <?php endif; ?>
        </select>
        <span id="sc3"></span>
      </td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="4">Riwayat Kesehatan</th>
    </tr>
    <tr>
      <td width='20%'>Riweayat Penyakit dahulu</td>
      <td width='30%'>
        <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU" value="<?= $result['FS_RIW_PENYAKIT_DAHULU'] ?? '-' ?>" size="32">
      </td>
      <td width='20%'>Riwayat penyakit keluarga</td>
      <td width='30%'>
        <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU2" value="<?= $rs_pasien['FS_RIW_PENYAKIT_DAHULU2'] ?? '-' ?>" size="32">
      </td>
    </tr>
    <?php if ($result['FS_KD_LAYANAN'] == 'P003' || $result['FS_KD_LAYANAN2'] == 'P003' || $result['FS_KD_LAYANAN3'] == 'P003') : ?>
      <tr>
        <td>Riwayat Imunisasi</td>
        <td>
          <select name="FS_RIW_IMUNISASI" id="surat_dari" class="form-control" style="width: 190px;">
            <?php if (isset($ases2['FS_RIW_IMUNISASI'])) : ?>
              <option value="0" <?php if ($ases2['FS_RIW_IMUNISASI'] == '0') echo 'selected' ?>>--Pilih Data--</option>
              <option value="1" <?php if ($ases2['FS_RIW_IMUNISASI'] == '1') echo 'selected' ?>>Lengkap</option>
              <option value="2" <?php if ($ases2['FS_RIW_IMUNISASI'] == '2') echo 'selected' ?>>Kurang</option>
            <?php else : ?>
              <option value="0">--Pilih Data--</option>
              <option value="1">Lengkap</option>
              <option value="2">Kurang</option>
            <?php endif; ?>
          </select>
          <br><br>
          <input type="text" class="form-control" name="FS_RIW_IMUNISASI_KET" size="32" value="<?= $ases2['FS_RIW_IMUNISASI_KET'] ?>">
        </td>
        <td>Riwayat Tumbuh Kembang</td>
        <td>
          <select name="FS_RIW_TUMBUH" id="surat_dari" class="form-control" style="width: 190px;">
            <?php if (isset($ases2['FS_RIW_TUMBUH'])) : ?>
              <option value="0" <?php if ($ases2['FS_RIW_TUMBUH'] == '0') echo 'selected' ?>>--Pilih Data--</option>
              <option value="1" <?php if ($ases2['FS_RIW_TUMBUH'] == '1') echo 'selected' ?>>Normal</option>
              <option value="2" <?php if ($ases2['FS_RIW_TUMBUH'] == '2') echo 'selected' ?>>Ada Gangguan</option>
            <?php else : ?>
              <option value="0">--Pilih Data--</option>
              <option value="1">Normal</option>
              <option value="2">Ada Gangguan</option>
            <?php endif; ?>
          </select>
          <br><br>
          <input type="text" class="form-control" name="FS_RIW_TUMBUH_KET" size="32" value="<?= $ases2['FS_RIW_TUMBUH_KET'] ?>">
        </td>
      </tr>
    <?php endif; ?>
  </table>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="4">Riwayat Alergi</th>
    </tr>
    <tr>
      <td width='20%'>Riwayat Alergi</td>
      <td width='30%'>
        <input type="text" name="FS_ALERGI" size="35" value="<?= $result['FS_ALERGI'] ?>" class="form-control">
        <em style="color:red">* Wajib Diisi</em>
      </td>
      <td width='20%'>Reaksi Alergi</td>
      <td width='30%'>
        <input type="text" name="FS_REAK_ALERGI" size="35" value="<?= $result['FS_REAK_ALERGI'] ?>" class="form-control">
        <em style="color:red">* Wajib Diisi</em>
      </td>
    </tr>
  </table>

  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="2">Status Psikologis</th>
      <th colspan="2">Status Sosial</th>
    </tr>
    <tr>
      <td width='20%'>Status Psikologis</td>
      <td width='30%'>
        <select name="FS_STATUS_PSIK" class="form-control">
          <?php if (isset($ases2['FS_STATUS_PSIK'])) : ?>
            <option value="" <?php if ($ases2['FS_STATUS_PSIK'] == '') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>--Pilih Data--</option>
            <option value="1" <?php if ($ases2['FS_STATUS_PSIK'] == '1') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Tenang</option>
            <option value="2" <?php if ($ases2['FS_STATUS_PSIK'] == '2') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Cemas</option>
            <option value="3" <?php if ($ases2['FS_STATUS_PSIK'] == '3') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Takut</option>
            <option value="4" <?php if ($ases2['FS_STATUS_PSIK'] == '4') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Marah</option>
            <option value="5" <?php if ($ases2['FS_STATUS_PSIK'] == '5') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Sedih</option>
            <option value="6" <?php if ($ases2['FS_STATUS_PSIK'] !== '' && $ases2['FS_STATUS_PSIK'] !== '1' && $ases2['FS_STATUS_PSIK'] !== '2' && $ases2['FS_STATUS_PSIK'] !== '3' && $ases2['FS_STATUS_PSIK'] !== '4' && $ases2['FS_STATUS_PSIK'] !== '5') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = false'>Lainnya</option>
          <?php else : ?>
            <option value="" onclick='document.getElementById("civstaton3").disabled = true'>--Pilih Data--</option>
            <option value="1" onclick='document.getElementById("civstaton3").disabled = true'>Tenang</option>
            <option value="2" onclick='document.getElementById("civstaton3").disabled = true'>Cemas</option>
            <option value="3" onclick='document.getElementById("civstaton3").disabled = true'>Takut</option>
            <option value="4" onclick='document.getElementById("civstaton3").disabled = true'>Marah</option>
            <option value="5" onclick='document.getElementById("civstaton3").disabled = true'>Sedih</option>
            <option value="6" onclick='document.getElementById("civstaton3").disabled = false'>Lainnya</option>
          <?php endif; ?>
        </select>
        <?php if (isset($ases2['FS_STATUS_PSIK2'])) : ?>
          <input type="text" class="form-control" name="FS_STATUS_PSIK2" id="civstaton3" <?php if ($ases2['FS_STATUS_PSIK2'] == '0') echo 'disabled' ?> size="27" value="<?= $ases2['FS_STATUS_PSIK2'] ?? "" ?>">
        <?php else : ?>
          <input type="text" class="form-control" name="FS_STATUS_PSIK2" id="civstaton3" disabled size="27" value="<?= $ases2['FS_STATUS_PSIK2'] ?? "" ?>">
        <?php endif; ?>
      </td>
      <td width='20%'>Hubungan dengan anggota keluarga</td>
      <td width='30%'>
        <select name="FS_HUB_KELUARGA" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($ases2['FS_HUB_KELUARGA'])) : ?>
            <option value="" <?php if ($ases2['FS_HUB_KELUARGA'] == '') echo 'selected' ?>>--Pilih Data--</option>
            <option value="1" <?php if ($ases2['FS_HUB_KELUARGA'] == '1') echo 'selected' ?>>Baik</option>
            <option value="2" <?php if ($ases2['FS_HUB_KELUARGA'] == '') echo 'selected' ?>>Tidak Baik</option>
          <?php else : ?>
            <option value="">--Pilih Data--</option>
            <option value="1">Baik</option>
            <option value="2">Tidak Baik</option>
          <?php endif; ?>
        </select>
      </td>
    </tr>
  </table>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="4">Status Fungsional</th>
    </tr>
    <tr>
      <td width='20%'>Status Fungsional</td>
      <td width='30%'>
        <select name="FS_ST_FUNGSIONAL" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($ases2['FS_ST_FUNGSIONAL'])) : ?>
            <option value="" <?php if ($ases2['FS_ST_FUNGSIONAL'] == '') echo 'selected' ?>>--Pilih Data--</option>
            <option value="1" <?php if ($ases2['FS_ST_FUNGSIONAL'] == '1') echo 'selected' ?>>Mandiri</option>
            <option value="2" <?php if ($ases2['FS_ST_FUNGSIONAL'] == '2') echo 'selected' ?>>Perlu Bantuan</option>
          <?php else : ?>
            <option value="">--Pilih Data--</option>
            <option value="1">Mandiri</option>
            <option value="2">Perlu Bantuan</option>
          <?php endif; ?>
        </select>
      </td>
      <td width='20%'>Pengelihatan</td>
      <td width='30%'>
        <select name="FS_PENGELIHATAN" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($ases2['FS_PENGELIHATAN'])) : ?>
            <option value="1" <?php if ($ases2['FS_PENGELIHATAN'] == '1') echo 'selected' ?>>Normal</option>
            <option value="2" <?php if ($ases2['FS_PENGELIHATAN'] == '2') echo 'selected' ?>>Kabur</option>
            <option value="3" <?php if ($ases2['FS_PENGELIHATAN'] == '3') echo 'selected' ?>>Kaca Mata</option>
            <option value="4" <?php if ($ases2['FS_PENGELIHATAN'] == '4') echo 'selected' ?>>Lensa Kontak</option>
          <?php else : ?>
            <option value="1">Normal</option>
            <option value="2">Kabur</option>
            <option value="3">Kaca Mata</option>
            <option value="4">Lensa Kontak</option>
          <?php endif; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Penciuman</td>
      <td>
        <select name="FS_PENCIUMAN" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($ases2['FS_PENCIUMAN'])) : ?>
            <option value="1" <?php if ($ases2['FS_PENCIUMAN'] == '1') echo 'selected' ?>>Normal</option>
            <option value="2" <?php if ($ases2['FS_PENCIUMAN'] == '2') echo 'selected' ?>>Tidak Normal</option>
          <?php else : ?>
            <option value="1">Normal</option>
            <option value="2">Tidak Normal</option>
          <?php endif; ?>
        </select>
      </td>
      <td>Pendengaran</td>
      <td>
        <select name="FS_PENDENGARAN" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($ases2['FS_PENDENGARAN'])) : ?>
            <option value="1" <?php if ($ases2['FS_PENDENGARAN'] == '1') echo 'selected' ?>>Normal</option>
            <option value="2" <?php if ($ases2['FS_PENDENGARAN'] == '2') echo 'selected' ?>>Tidak Normal (Kanan)</option>
            <option value="3" <?php if ($ases2['FS_PENDENGARAN'] == '3') echo 'selected' ?>>Tidak Normal (Kiri)</option>
            <option value="4" <?php if ($ases2['FS_PENDENGARAN'] == '4') echo 'selected' ?>>Tidak Normal (Kanan & Kiri)</option>
            <option value="5" <?php if ($ases2['FS_PENDENGARAN'] == '5') echo 'selected' ?>>Alat Bantu Dengar (Kanan)</option>
            <option value="6" <?php if ($ases2['FS_PENDENGARAN'] == '6') echo 'selected' ?>>Alat Bantu Dengar (Kiri)</option>
            <option value="7" <?php if ($ases2['FS_PENDENGARAN'] == '7') echo 'selected' ?>>Alat Bantu Dengar (Kanan & Kiri)</option>
          <?php else : ?>
            <option value="1">Normal</option>
            <option value="2">Tidak Normal (Kanan)</option>
            <option value="3">Tidak Normal (Kiri)</option>
            <option value="4">Tidak Normal (Kanan & Kiri)</option>
            <option value="5">Alat Bantu Dengar (Kanan)</option>
            <option value="6">Alat Bantu Dengar (Kiri)</option>
            <option value="7">Alat Bantu Dengar (Kanan & Kiri)</option>
          <?php endif; ?>
        </select>
      </td>
    </tr>
    </tr>
  </table>
  <?php if ($result['FS_KD_LAYANAN'] == 'P003' || $result['FS_KD_LAYANAN2'] == 'P003' || $result['FS_KD_LAYANAN3'] == 'P003') : ?>
    <table class="table-input" width="100%">
      <tr class="headrow">
        <th colspan="4">Skrining Nutrisi Anak <b>Adaptasi Strong Kids (Anak usia 1-18 Tahun)</b></th>
      </tr>
      <tr>
        <td width='20%'>Apakah pasien tampak kurus?</td>
        <td width='30%'>
          <select name="FS_NUTRISI_ANAK1" class="form-control" style="width: 190px;" id="sna1">
            <option value="">--Pilih Data--</option>
            <?php if (isset($ases2['FS_NUTRISI_ANAK1'])) : ?>
              <option value="0" <?php if ($ases2['FS_NUTRISI_ANAK1'] == '0') echo 'selected' ?>>Tidak</option>
              <option value="1" <?php if ($ases2['FS_NUTRISI_ANAK1'] == '1') echo 'selected' ?>>Ya</option>
            <?php else : ?>
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            <?php endif; ?>
          </select>
          <span id="snha1"></span>
        </td>
        <td width='20%'>Kesimpulan</td>
        <td width='30%'>
          <b><span id="kesimpulansna"></span>
            <?php $nutrisi_anak = intval($nutrisi['FS_NUTRISI_ANAK1'] ?? "") + intval($nutrisi['FS_NUTRISI_ANAK2'] ?? "") + intval($nutrisi['FS_NUTRISI_ANAK3'] ?? "") + intval($nutrisi['FS_NUTRISI_ANAK4'] ?? ""); ?>
            <?php if ($nutrisi_anak >= '1') : ?>
              RISIKO MALNUTRISI
            <?php else : ?>
              TIDAK BERESIKO
            <?php endif; ?>
          </b>
        </td>
      </tr>
      <tr>
        <td>Apakah terdapat penurunan BB selama satu bulan terakhir?</td>
        <td>
          <select name="FS_NUTRISI_ANAK2" class="form-control" style="width: 190px;" id="sna2">
            <option value="">--Pilih Data--</option>
            <?php if (isset($ases2['FS_NUTRISI_ANAK2'])) : ?>
              <option value="0" <?php if ($nutrisi['FS_NUTRISI_ANAK2'] == '0') echo 'selected' ?>>Tidak</option>
              <option value="1" <?php if ($nutrisi['FS_NUTRISI_ANAK2'] == '1') echo 'selected' ?>>Ya</option>
            <?php else : ?>
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            <?php endif; ?>
          </select>
          <span id="snha2"></span>
        </td>
        <td></td>
        <td>
        </td>
      </tr>
      <tr>
        <td>Apakah ada diare > 5x/hari atau muntah > 3x/hari atau asupan turun dalam 1 minggu?</td>
        <td>
          <select name="FS_NUTRISI_ANAK3" class="form-control" style="width: 190px;" id="sna3">
            <option value="">--Pilih Data--</option>
            <?php if (isset($ases2['FS_NUTRISI_ANAK3'])) : ?>
              <option value="0" <?php if ($nutrisi['FS_NUTRISI_ANAK3'] == '0') echo 'selected' ?>>Tidak</option>
              <option value="1" <?php if ($nutrisi['FS_NUTRISI_ANAK3'] == '1') echo 'selected' ?>>Ya</option>
            <?php else : ?>
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            <?php endif; ?>
          </select>
          <span id="snha3"></span>
        </td>
        <td></td>
        <td>
        </td>
      </tr>
      <tr>
        <td>Apakah terdapat penyakit atau keadaan yang mengakibatkan pasien beresiko malnutrisi?</td>
        <td>
          <select name="FS_NUTRISI_ANAK4" class="form-control" style="width: 190px;" id="sna4">
            <option value="">--Pilih Data--</option>
            <?php if (isset($ases2['FS_NUTRISI_ANAK4'])) : ?>
              <option value="0" <?php if ($nutrisi['FS_NUTRISI_ANAK4'] == '0') echo 'selected' ?>>Tidak</option>
              <option value="1" <?php if ($nutrisi['FS_NUTRISI_ANAK4'] == '1') echo 'selected' ?>>Ya</option>
            <?php else : ?>
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            <?php endif; ?>
          </select>
          <span id="snha4"></span>
        </td>
        <td></td>
        <td>
        </td>
      </tr>
    </table>
  <?php else : ?>
    <table class="table-input" width="100%">
      <tr class="headrow">
        <th colspan="4">Skrining Nutrisi</th>
      </tr>
      <tr>
        <td width='20%'>Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</td>
        <td width='30%'>
          <select name="FS_NUTRISI1" class="form-control" style="width: 190px;" id="sn1">
            <option value="">--Pilih Data--</option>
            <?php if (isset($ases2['FS_NUTRISI1'])) : ?>
              <option value="0" <?php if ($nutrisi['FS_NUTRISI1'] == '0') echo 'selected' ?>>Tidak</option>
              <option value="1" <?php if ($nutrisi['FS_NUTRISI1'] == '1') echo 'selected' ?>>Tidak Yakin</option>
              <option value="2" <?php if ($nutrisi['FS_NUTRISI1'] == '2') echo 'selected' ?>>Ya (1-5 Kg)</option>
              <option value="3" <?php if ($nutrisi['FS_NUTRISI1'] == '3') echo 'selected' ?>>Ya (6-10 Kg)</option>
              <option value="4" <?php if ($nutrisi['FS_NUTRISI1'] == '4') echo 'selected' ?>>Ya (11-15 Kg)</option>
              <option value="5" <?php if ($nutrisi['FS_NUTRISI1'] == '5') echo 'selected' ?>>Ya (>15 Kg)</option>
            <?php else : ?>
              <option value="0">Tidak</option>
              <option value="1">Tidak Yakin</option>
              <option value="2">Ya (1-5 Kg)</option>
              <option value="3">Ya (6-10 Kg)</option>
              <option value="4">Ya (11-15 Kg)</option>
              <option value="5">Ya (>15 Kg)</option>
            <?php endif; ?>
          </select>
          <span id="snh1"></span>
        </td>
        <td width='20%'>Kesimpulan</td>
        <td width='30%'>
          <b><span id="kesimpulansn"></span>
            <?php $nutrisi_dewasa = intval($nutrisi['FS_NUTRISI1'] ?? "") + intval($nutrisi['FS_NUTRISI2'] ?? "") ?>
            <?php if ($nutrisi_dewasa >= '2') : ?>
              RISIKO MALNUTRISI
            <?php else : ?>
              TIDAK BERESIKO
            <?php endif; ?>
          </b>
        </td>
      </tr>
      <tr>
        <td>Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</td>
        <td>
          <select name="FS_NUTRISI2" class="form-control" style="width: 190px;" id="sn2">
            <option value="">--Pilih Data--</option>
            <?php if (isset($ases2['FS_NUTRISI2'])) : ?>
              <option value="0" <?php if ($nutrisi['FS_NUTRISI2'] == '0') echo 'selected' ?>>Tidak</option>
              <option value="1" <?php if ($nutrisi['FS_NUTRISI2'] == '1') echo 'selected' ?>>Ya</option>
            <?php else : ?>
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            <?php endif; ?>
          </select>
          <span id="snh2"></span>
        </td>
        <td></td>
        <td>
        </td>
      </tr>
    </table>
  <?php endif; ?>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="4">Spiritual dan Kultural pasien</th>
    </tr>
    <tr>
      <td width='20%'>Agama</td>
      <td width='30%'>
        <select name="FS_AGAMA" id="surat_dari" class="form-control" style="width: 190px;">
          <?php if (isset($ases2['FS_AGAMA'])) : ?>
            <option value="" <?php if ($ases2['FS_AGAMA'] == '') echo 'selected' ?>>--Pilih Data--</option>
            <option value="1" <?php if ($ases2['FS_AGAMA'] == '1') echo 'selected' ?>>Islam</option>
            <option value="2" <?php if ($ases2['FS_AGAMA'] == '2') echo 'selected' ?>>Kristen</option>
            <option value="3" <?php if ($ases2['FS_AGAMA'] == '3') echo 'selected' ?>>Katholik</option>
            <option value="4" <?php if ($ases2['FS_AGAMA'] == '4') echo 'selected' ?>>Hindu</option>
            <option value="5" <?php if ($ases2['FS_AGAMA'] == '5') echo 'selected' ?>>Buda</option>
            <option value="6" <?php if ($ases2['FS_AGAMA'] == '6') echo 'selected' ?>>Konghucu</option>
          <?php else : ?>
            <option value="">--Pilih Data--</option>
            <option value="1">Islam</option>
            <option value="2">Kristen</option>
            <option value="3">Katholik</option>
            <option value="4">Hindu</option>
            <option value="5">Buda</option>
            <option value="6">Konghucu</option>
          <?php endif; ?>
        </select>
      </td>
      <td width='20%'>Nilai/Kepercayaan khusus</td>
      <td width='30%'>
        <select name="FS_NILAI_KHUSUS" class="form-control">
          <?php if (isset($ases2['FS_NILAI_KHUSUS'])) : ?>
            <option value="" <?php if ($ases2['FS_NILAI_KHUSUS'] == '') echo 'selected' ?> onclick='document.getElementById("civstaton4").disabled = true'>--Pilih Data--</option>
            <option value="1" <?php if ($ases2['FS_NILAI_KHUSUS'] == '1') echo 'selected' ?> onclick='document.getElementById("civstaton4").disabled = true'>Tidak Ada</option>
            <option value="2" <?php if ($ases2['FS_NILAI_KHUSUS'] !== '' && $ases2['FS_NILAI_KHUSUS'] !== '1') echo 'selected' ?>onclick='document.getElementById("civstaton4").disabled = false'>Ada</option>
          <?php else : ?>
            <option value="" onclick='document.getElementById("civstaton4").disabled = true'>--Pilih Data--</option>
            <option value="1" onclick='document.getElementById("civstaton4").disabled = true'>Tidak Ada</option>
            <option value="2" onclick='document.getElementById("civstaton4").disabled = false'>Ada</option>
          <?php endif; ?>
        </select>
        <?php if (isset($ases2['FS_NILAI_KHUSUS2'])) : ?>
          <input type="text" class="form-control" name="FS_NILAI_KHUSUS2" id="civstaton4" <?php if ($ases2['FS_NILAI_KHUSUS2'] == '0') echo 'disabled' ?> size="27" value="<?= $ases2['FS_NILAI_KHUSUS2'] ?>">
        <?php else : ?>
          <input type="text" class="form-control" name="FS_NILAI_KHUSUS2" id="civstaton4" disabled size="27" value="<?= $ases2['FS_NILAI_KHUSUS2'] ?? "" ?>">
        <?php endif; ?>
      </td>
    </tr>
  </table>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="4">Skrining Geriatri</th>
    </tr>
    <tr>
      <td width='20%'>Pasien usia diatas 60 tahun dengan memiliki lebih dari 1 (satu) penyakit fisik dan/atau psikis</td>
      <td width='30%'>
        <select name="FS_GERIATRI1" class="form-control" style="width: 190px;" id="gr1">
          <?php if (isset($ases2['FS_GERIATRI1'])) : ?>
            <option value="" <?php if ($geriatri['FS_GERIATRI1'] == '') echo 'selected' ?>>--Pilih Data--</option>
            <option value="0" <?php if ($geriatri['FS_GERIATRI1'] == '0') echo 'selected' ?>>TIDAK</option>
            <option value="1" <?php if ($geriatri['FS_GERIATRI1'] == '1') echo 'selected' ?>>YA</option>
          <?php else : ?>
            <option value="">--Pilih Data--</option>
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          <?php endif; ?>
        </select>
        <span id="scgr1"></span>
      </td>
      <td width='20%'>Kesimpulan</td>
      <td width='30%'>
        <b><span id="rjtkesimpulangr"></span>
          <?php $geriatri2 = intval($geriatri['FS_GERIATRI1'] ?? "") + intval($geriatri['FS_GERIATRI2'] ?? "") + intval($geriatri['FS_GERIATRI3'] ?? "") ?>
          <?php if ($geriatri2 >= '1') : ?>
            BERI PELAYANAN KUSUS TANPA ANTRI
          <?php else : ?>
            -
          <?php endif; ?>

        </b>
      </td>
    </tr>
    <tr>
      <td width='20%'>Pasien usia diatas 60 tahun memiliki 1 (satu) penyakit dan mengalami gangguan akibat penurunan fungsi organ, psikologi, sosial, ekonomi dan lingkungan yang membutuhkan pelayanan kesehatan</td>
      <td width='30%'>
        <select name="FS_GERIATRI2" class="form-control" style="width: 190px;" id="gr2">
          <?php if (isset($geriatri['FS_GERIATRI2'])) : ?>
            <option value="" <?php if ($geriatri['FS_GERIATRI2'] == '') echo 'selected' ?>>--Pilih Data--</option>
            <option value="0" <?php if ($geriatri['FS_GERIATRI2'] == '0') echo 'selected' ?>>TIDAK</option>
            <option value="1" <?php if ($geriatri['FS_GERIATRI2'] == '1') echo 'selected' ?>>YA</option>
          <?php else : ?>
            <option value="">--Pilih Data--</option>
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          <?php endif; ?>
        </select>
        <span id="scgr2"></span>
      </td>
      <td></td>
      <td>
      </td>
    </tr>
    <tr>
      <td>Pasien usia diatas 70 tahun yang memiliki 1 (satu) penyakit fisik dan/atau psikis</td>
      <td>
        <select name="FS_GERIATRI3" class="form-control" style="width: 190px;" id="gr3">
          <?php if (isset($geriatri['FS_GERIATRI3'])) : ?>
            <option value="" <?php if ($geriatri['FS_GERIATRI3'] == '') echo 'selected' ?>>--Pilih Data--</option>
            <option value="0" <?php if ($geriatri['FS_GERIATRI3'] == '0') echo 'selected' ?>>TIDAK</option>
            <option value="1" <?php if ($geriatri['FS_GERIATRI3'] == '1') echo 'selected' ?>>YA</option>
          <?php else : ?>
            <option value="">--Pilih Data--</option>
            <option value="0">TIDAK</option>
            <option value="1">YA</option>
          <?php endif; ?>
        </select>
        <span id="scgr3"></span>
      </td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <table class="table-input" width="100%">
    <tr class="headrow">
      <th colspan="4">Keperawatan</th>
    </tr>
    <tr>
      <td width='20%'>Masalah Keperawatan</td>
      <td width='30%'>
        <select name="tujuan[]" multiple id="tujuan" style="width:250px">
        </select>
      </td>
      <td width='20%'>Rencana Keperawatan</td>
      <td width='30%'>
        <select name="tembusan[]" multiple id="tembusan" style="width:250px">

        </select>
      </td>
    </tr>
    <tr class="submit-box">
      <td colspan="4">
        <div style="font-weight: bold;">
          *Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar
        </div>
        <br>
        <input type="submit" name="save" value="Simpan" class="form-control" style="width: auto;" />
      </td>
    </tr>
  </table>
</form>



<script>
  $(document).ready(function() {
    $('#tujuan').select2({
      ajax: {
        url: "<?= site_url() ?>/nurse/hd/list_masalah_kep",
        dataType: 'json',

      }
    });


    $('#tembusan').select2({
      ajax: {
        url: "<?= site_url() ?>/nurse/hd/list_rencana_kep",
        dataType: 'json'
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
      }
    });
  });
</script>>

<?= $this->endSection('content') ?>