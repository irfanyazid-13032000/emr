<?= $this->extend('layout/main-layout') ?>

<?= $this->section('content') ?>
<script type="text/javascript" src="<?= site_url() ?>resource/js/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?= site_url() ?>resource/js/jquery/jquery-ui-1.9.2.custom.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?= site_url() ?>resource/js/jquery/jquery-ui-timepicker-addon.js"></script>

<style>
  #otakatik {
    border: 5px #6527cb solid;
  }

  #otakatik tr {
    border: 5px #6527cb solid;
  }

  #otakatik tr td {
    border: 5px #6527cb solid;
  }
</style>


<div class="breadcrum">
  <p>
    <a href="#">Nursing Record</a><span></span>
    <a href="<?= site_url('nurse/hd/') ?>">Rawat Jalan</a><span></span>
    <small>Add Data</small>
  </p>
  <div class="clear"></div>
</div>
<div class="" style="height: 40px;">
  <div class="navigation-button">
    <ul>
      <li><a href="<?= site_url('nurse/hd/') ?>" class="float-end" style="width: 100px;"><img src="<?= site_url() ?>resource/doc/images/icon/back-icon.png" alt="" /> Back</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<!-- notification template -->
<!-- end of notification template-->
<form action="<?= site_url('nurse/hd/edit_process') ?>" method="post">
  <input type="hidden" name="FS_KD_REG" value="<?= $result['FS_KD_REG'] ?>" />
  <input type="hidden" name="FS_MR" value="<?= $result['FS_MR'] ?>" />
  <div class="card">
    <div class="card-header" style="padding-top:10px; padding-bottom:5px">
      <h4>Data Pasien</h4>
    </div>

    <div class="card-body">
      <table class="table table-striped" width="100%">
        <tr>
          <td width='15%'>Kode Reg</td>
          <td width='35%'><?= $result['FS_KD_REG'] ?></td>
          <td width='15%'>No RM</td>
          <td width='35%'><?= $result['FS_MR'] ?></td>
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
          <td><?= ($result['FS_NM_PEG']) ?? '' ?></td>
        </tr>
      </table>
    </div>
  </div>
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
        <?php $resume_rawat_jalan = site_url("rm/rawat_jalan/resume/'{$result['FS_MR']}") ?>
        <a href="javascript:void(0);" onclick="window.open('<?= $resume_rawat_jalan ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="float-end" style="width: auto;"><img src="<?= site_url() ?>resource/doc/images/icon/printer-icon.png" alt="" /> Resume Rawat Jalan</a>
      </div>
    </div>
    <div class="clear"></div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="alert alert-danger">
        <p><strong>High Risk :</strong><?= ($result['FS_HIGH_RISK']) ?? '' ?></p>
        <p><strong>Alergi :</strong> <?= ($result['FS_ALERGI']) ?? '' ?> (<?= ($result['FS_REAK_ALERGI']) ?? '' ?>)</p>
        <div class="clear"></div>
      </div>
      <em>* Klik Simpan terlebih dahulu sebelum melanjutkan mengisi data yang lain</em>
      <table class="table-input" width="100%">

        <tr class="headrow">
          <th colspan="15">MONITOR</th>
        </tr>
        <tr>
          <td rowspan="2">
            <div align="center">Jam</div>
          </td>
          <td rowspan="2">
            <div align="center">QB<br>(ml/mnt)</div>
          </td>
          <td rowspan="2">
            <div align="center">Nadi</div>
          </td>


          <td rowspan="2">
            <div align="center">SUHU <br>(<span>&#176;</span>C)</div>
          </td>
          <td rowspan="2">
            <div align="center">Tekanan<br>Darah</div>
          </td>
          <td rowspan="2">
            <div align="center">UF<br>Removed</div>
          </td>
          <td rowspan="2">
            <div align="center">UF<br>Rate</div>
          </td>

          <td colspan="3">
            <div align="center">INTAKE</div>
          </td>
          <td colspan="3">
            <div align="center">OUTPUT</div>
          </td>
          <td rowspan="2">
            <div align="center">KET</div>
          </td>
        </tr>
        <tr>
          <td>Washout</td>
          <td>Transfusi</td>
          <td>Makan <br>-minum</td>
          <td>Urin</td>
          <td>Muntah</td>
          <td>Per<br>darahan</td>
        </tr>

        <tr>
          <td><input name="tindakan_anthd_jam" type="text" id="tindakan_anthd_jam" size="7" class="form-control"></td>
          <td><input name="tindakan_anthd_qb" type="text" id="tindakan_anthd_qb" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_nadi" type="text" size="3" class="form-control"></td>


          <td><input name="tindakan_anthd_suhu" type="text" id="tindakan_anthd_suhu" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_td" type="text" id="tindakan_anthd_td" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_uf" type="text" id="tindakan_anthd_uf" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_uf_rate" type="text" id="tindakan_anthd_uf_rate" size="3" class="form-control"></td>

          <td><input name="tindakan_anthd_washout" type="text" id="tindakan_anthd_washout" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_tranfusi" type="text" id="tindakan_anthd_tranfusi" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_makan" type="text" id="tindakan_anthd_makan" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_urin" type="text" id="tindakan_anthd_urin" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_muntah" type="text" id="tindakan_anthd_muntah" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_perdarahan" type="text" id="tindakan_anthd_perdarahan" size="3" class="form-control"></td>
          <td><input name="tindakan_anthd_keterangan" type="text" id="tindakan_anthd_keterangan" size="6" class="form-control"></td>
        </tr>
        <tr>
          <td colspan="15">
            <br>
            <input type="submit" name="save" value="Simpan" class="form-control" style="width: auto;" />
          </td>
        </tr>
      </table>
      <table class="table-view" width="100%">
        <tbody>
          <tr class="headrow">
            <th rowspan="2">
              <div align="center">Jam</div>
            </th>
            <th rowspan="2">
              <div align="center">QB<br>(ml/mnt)</div>
            </th>
            <th rowspan="2">
              <div align="center">Nadi</div>
            </th>


            <th rowspan="2">
              <div align="center">SUHU <br>(<span>&#176;</span>C)</div>
            </th>
            <th rowspan="2">
              <div align="center">TD</div>
            </th>
            <th rowspan="2">
              <div align="center">UF<br>Removed</div>
            </th>
            <th rowspan="2">
              <div align="center">UF<br>Rate</div>
            </th>

            <th colspan="3">
              <div align="center">INTAKE</div>
            </th>
            <th colspan="3">
              <div align="center">OUTPUT</div>
            </th>
            <th rowspan="2">
              <div align="center">KET</div>
            </th>
            <th></th>
          </tr>
          <tr class="headrow">
            <th>Washout</th>
            <th>Transfusi</th>
            <th>Makan <br>-minum</th>
            <th>Urin</th>
            <th>Muntah</th>
            <th>Per<br>darahan</th>
            <th></th>
          </tr>
          <?php foreach ($rs_monitoring_hd as $monitoring) : ?>
            <tr>
              <td align="center"><?= $monitoring['tindakan_anthd_jam'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_qb'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_nadi'] ?></td>

              <td align="center"><?= $monitoring['tindakan_anthd_suhu'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_td'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_uf'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_uf_rate'] ?></td>

              <td align="center"><?= $monitoring['tindakan_anthd_washout'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_tranfusi'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_makan'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_urin'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_muntah'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_perdarahan'] ?></td>
              <td align="center"><?= $monitoring['tindakan_anthd_keterangan'] ?></td>
              <td align="center">
                <?php $fs_kd_reg =  ($monitoring['FS_KD_REG']) ?? '' ?>
                <?php $hapus = site_url("nurse/hd/delete_process_tindakan_monitoring_edit/{$monitoring['FS_KD_HD_TINDAKAN_MONITORING']}/{$fs_kd_reg}") ?>
                <a href="<?= $hapus ?>" class="button-edit" onClick="return confirm('Yakin ingin menghapus?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <table class="table-input">
        <tr class="headrow">
          <th colspan="2">Anamnesa</th>
          <th colspan="2">Catatan Edukasi</th>
        </tr>
        <tr>
          <td colspan="3">
            <textarea cols="50" name="FS_ANAMNESA" class="form-control"><?= $ases2['FS_ANAMNESA'] ?></textarea>
          </td>
          <td colspan="3">
            <textarea cols="50" name="FS_EDUKASI" class="form-control"><?= $ases2['FS_EDUKASI'] ?></textarea>
          </td>
        </tr>
        <tr class="headrow">
          <th colspan="4">Vital Sign</th>
        </tr>
        <tr>
          <td width='10%'>Suhu</td>
          <td width='20%'><input type="text" name="FS_SUHU" size="10" value="<?= $vs['FS_SUHU'] ?>" class="form-control" style="width: 190px;" /></td>
          <td>&nbsp;</td>
          <td width='10%'>Nadi</td>
          <td width='20%'><input type="text" name="FS_NADI" size="10" value="<?= $vs['FS_NADI'] ?>" class="form-control" style="width: 190px;" /></td>
          <td> x/menit</td>
        </tr>
        <tr>
          <td>R</td>
          <td><input type="text" name="FS_R" size="10" value="<?= $vs['FS_R'] ?>" class="form-control" style="width: 190px;" /></td>
          <td>x/menit</td>
          <td>TD</td>
          <td><input type="text" name="FS_TD" size="10" value="<?= $vs['FS_TD'] ?>" class="form-control" style="width: 190px;" /></td>
          <td>mmHg</td>
        </tr>
        <tr>
          <td>Tinggi Badan</td>
          <td><input type="text" name="FS_TB" size="10" value="<?= $vs['FS_TB'] ?>" class="form-control" style="width: 190px;" /></td>
          <td>cm</td>
          <td>Berat Badan Pre HD</td>
          <td><input type="text" name="FS_BB" size="10" value="<?= $vs['FS_BB'] ?>" class="form-control" style="width: 190px;" /></td>
          <td>Kg</td>
        </tr>
        <tr>
          <td>Berat Badan Kering</td>
          <td><input type="text" name="FS_BB_KERING" size="10" value="<?= $vs['FS_BB_KERING'] ?>" class="form-control" style="width: 190px;" /></td>
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
              <option value="0" <?php if ($nyeri['FS_NYERI'] == '0') echo 'selected' ?>>Tidak</option>
              <option value="1" <?php if ($nyeri['FS_NYERI'] == '1') echo 'selected' ?>>Ya</option>
            </select>
          </td>
          <td width='20%'></td>
          <td width='30%'></td>
        </tr>
        <tr>
          <td>Provokatif</td>
          <td>
            <select name="FS_NYERIP" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="0" <?php if ($nyeri['FS_NYERIP'] == '0') echo 'selected' ?>>Tidak Ada Nyeri</option>
              <option value="1" <?php if ($nyeri['FS_NYERIP'] == '1') echo 'selected' ?>>Biologik</option>
              <option value="2" <?php if ($nyeri['FS_NYERIP'] == '2') echo 'selected' ?>>Kimiawi</option>
              <option value="3" <?php if ($nyeri['FS_NYERIP'] == '3') echo 'selected' ?>>Mekanik / Rudapaksa</option>
            </select>
          </td>
          <td>Quality</td>
          <td>
            <select name="FS_NYERIQ" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="0" <?php if ($nyeri['FS_NYERIQ'] == '0') echo 'selected' ?>>Tidak Ada</option>
              <option value="1" <?php if ($nyeri['FS_NYERIQ'] == '1') echo 'selected' ?>>Seperti Di Tusuk-Tusuk</option>
              <option value="2" <?php if ($nyeri['FS_NYERIQ'] == '2') echo 'selected' ?>>Seperti Terbakar</option>
              <option value="3" <?php if ($nyeri['FS_NYERIQ'] == '3') echo 'selected' ?>>Seperti Tertimpa Beb</option>
              <option value="4" <?php if ($nyeri['FS_NYERIQ'] == '4') echo 'selected' ?>>Ngilu</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Regio</td>
          <td>
            <input type="text" name="FS_NYERIR" size="30" value="<?= $nyeri['FS_NYERIR'] ?>" class="form-control" style="width: 190px;" />
          </td>
          <td>Severity</td>
          <td>
            <select name="FS_NYERIS" id="surat_dari" class="form-control" style="width: 190px;">
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
            </select>
          </td>
        </tr>
        <tr>
          <td>Time</td>
          <td>
            <select name="FS_NYERIT" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="0" <?php if ($nyeri['FS_NYERIT'] == '0') echo 'selected' ?>>Tidak Ada</option>
              <option value="1" <?php if ($nyeri['FS_NYERIT'] == '1') echo 'selected' ?>>Kadang-kadang</option>
              <option value="2" <?php if ($nyeri['FS_NYERIT'] == '2') echo 'selected' ?>>Sering</option>
              <option value="3" <?php if ($nyeri['FS_NYERIT'] == '3') echo 'selected' ?>>Menetap</option>
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
              <option value="1" <?php if ($jatuh['FS_CARA_BERJALAN1'] == '1') echo 'selected' ?>>YA</option>
              <option value="0" <?php if ($jatuh['FS_CARA_BERJALAN1'] == '0') echo 'selected' ?>>TIDAK</option>
            </select>
            <span id="sc1"></span>
          </td>
          <td width='15%'>Kesimpulan</td>
          <td width='35%'>
            <b><span id="totalsc">0</span></b>
            <span id="rjtkesimpulan">

            </span>
          </td>
        </tr>
        <tr>
          <td width='15%'>Cara berjalan pasien dengan mengunakan alat bantu</td>
          <td width='35%'>
            <select name="FS_CARA_BERJALAN2" id="surat_dari" class="form-control" style="width: 190px;" id="op2">
              <option value="">--Pilih Data--</option>
              <option value="1" <?php if ($jatuh['FS_CARA_BERJALAN2'] == '1') echo 'selected' ?>>YA</option>
              <option value="0" <?php if ($jatuh['FS_CARA_BERJALAN2'] == '0') echo 'selected' ?>>TIDAK</option>
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
              <option value="1" <?php if ($jatuh['FS_CARA_DUDUK'] == '1') echo 'selected' ?>>YA</option>
              <option value="0" <?php if ($jatuh['FS_CARA_DUDUK'] == '0') echo 'selected' ?>>TIDAK</option>
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
          <td width='20%'>Riwayat Penyakit dahulu</td>
          <td width='30%'>
            <input type="text" name="FS_RIW_PENYAKIT_DAHULU" value="<?= ($result['FS_RIW_PENYAKIT_DAHULU']) ?? '-' ?>" size="32" class="form-control" style="width: 190px;">
          </td>
          <td width='20%'>Riwayat penyakit keluarga</td>
          <td width='30%'>
            <input type="text" name="FS_RIW_PENYAKIT_DAHULU2" value="<?= ($result['FS_RIW_PENYAKIT_DAHULU2']) ?? '-' ?>" size="32" class="form-control" style="width: 190px;">
          </td>
        </tr>
        <?php if ($result['FS_KD_LAYANAN'] == 'P003' || $result['FS_KD_LAYANAN2'] == 'P003' || $result['FS_KD_LAYANAN3'] == 'P003') : ?>
          <tr>
            <td>Riwayat Imunisasi</td>
            <td>
              <select name="FS_RIW_IMUNISASI" id="surat_dari" class="form-control" style="width: 190px;">
                <option value="0" <?php if ($ases2['FS_RIW_IMUNISASI'] == '0') echo 'selected' ?>>--Pilih Data--</option>
                <option value="1" <?php if ($ases2['FS_RIW_IMUNISASI'] == '1') echo 'selected' ?>>Lengkap</option>
                <option value="2" <?php if ($ases2['FS_RIW_IMUNISASI'] == '2') echo 'selected' ?>>Kurang</option>
              </select>
              <br><br>
              <input type="text" name="FS_RIW_IMUNISASI_KET" size="32" value="<?= $ases2['FS_RIW_IMUNISASI_KET'] ?>">
            </td>
            <td>Riwayat Tumbuh Kembang</td>
            <td>
              <select name="FS_RIW_TUMBUH" id="surat_dari" class="select2" style="width: 190px;">
                <option value="0" <?php if ($ases2['FS_RIW_TUMBUH'] == '0') echo 'selected' ?>>--Pilih Data--</option>
                <option value="1" <?php if ($ases2['FS_RIW_TUMBUH'] == '1') echo 'selected' ?>>Normal</option>
                <option value="2" <?php if ($ases2['FS_RIW_TUMBUH'] == '2') echo 'selected' ?>>Ada Gangguan</option>
              </select>
              <br><br>
              <input type="text" name="FS_RIW_TUMBUH_KET" size="32" value="<?= $ases2['FS_RIW_TUMBUH_KET'] ?>">
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
            <input type="text" name="FS_ALERGI" size="35" value="<?= ($result['FS_ALERGI']) ?? '-' ?>" class="form-control" style="width: 190px;">
            <em style="color:red">* Wajib Diisi</em>
          </td>
          <td width='20%'>Reaksi Alergi</td>
          <td width='30%'>
            <input type="text" name="FS_REAK_ALERGI" size="35" value="<?= ($result['FS_REAK_ALERGI']) ?? '-' ?>" class="form-control" style="width: 190px;">
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
            <select name="FS_STATUS_PSIK" class="form-control" style="width: 190px;">
              <option value="" <?php if ($ases2['FS_STATUS_PSIK'] == '') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>--Pilih Data--</option>
              <option value="1" <?php if ($ases2['FS_STATUS_PSIK'] == '1') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Tenang</option>
              <option value="2" <?php if ($ases2['FS_STATUS_PSIK'] == '2') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Cemas</option>
              <option value="3" <?php if ($ases2['FS_STATUS_PSIK'] == '3') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Takut</option>
              <option value="4" <?php if ($ases2['FS_STATUS_PSIK'] == '4') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Marah</option>
              <option value="5" <?php if ($ases2['FS_STATUS_PSIK'] == '5') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = true'>Sedih</option>
              <option value="6" <?php if ($ases2['FS_STATUS_PSIK'] != '' && $ases2['FS_STATUS_PSIK'] != '1' && $ases2['FS_STATUS_PSIK'] != '2' && $ases2['FS_STATUS_PSIK'] != '3' && $ases2['FS_STATUS_PSIK'] != '4' && $ases2['FS_STATUS_PSIK'] != '5') echo 'selected' ?> onclick='document.getElementById("civstaton3").disabled = false'>Lainnya</option>
            </select>

            <input type="text" name="FS_STATUS_PSIK2" id="civstaton3" <?php if ($ases2['FS_STATUS_PSIK2'] == '0') echo 'disabled' ?> size="27" value="<?= $ases2['FS_STATUS_PSIK2'] ?>" class="form-control" style="width: 190px;">
          </td>
          <td width='20%'>Hubungan dengan anggota keluarga</td>
          <td width='30%'>
            <select name="FS_HUB_KELUARGA" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="" <?php if ($ases2['FS_HUB_KELUARGA'] == '') echo 'selected' ?>>--Pilih Data--</option>
              <option value=" 1" <?php if ($ases2['FS_HUB_KELUARGA'] == '1') echo 'selected' ?>>Baik</option>
              <option value="2" <?php if ($ases2['FS_HUB_KELUARGA'] == '2') echo 'selected' ?>>Tidak Baik</option>

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
              <option value="" <?php if ($ases2['FS_ST_FUNGSIONAL'] == '') echo 'selected' ?>>--Pilih Data--</option>
              <option value="1" <?php if ($ases2['FS_ST_FUNGSIONAL'] == '1') echo 'selected' ?>>Mandiri</option>
              <option value="2" <?php if ($ases2['FS_ST_FUNGSIONAL'] == '2') echo 'selected' ?>>Perlu Bantuan</option>
            </select>
          </td>
          <td width='20%'>Pengelihatan</td>
          <td width='30%'>
            <select name="FS_PENGELIHATAN" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="1" <?php if ($ases2['FS_PENGELIHATAN'] == '1') echo 'selected' ?>>Normal</option>
              <option value="2" <?php if ($ases2['FS_PENGELIHATAN'] == '2') echo 'selected' ?>>Kabur</option>
              <option value="3" <?php if ($ases2['FS_PENGELIHATAN'] == '3') echo 'selected' ?>>Kaca Mata</option>
              <option value="4" <?php if ($ases2['FS_PENGELIHATAN'] == '4') echo 'selected' ?>>Lensa Kontak</option>

            </select>
          </td>
        </tr>
        <tr>
          <td>Penciuman</td>
          <td>
            <select name="FS_PENCIUMAN" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="1" <?php if ($ases2['FS_PENCIUMAN'] == '1') echo 'selected' ?>>Normal</option>
              <option value="2" <?php if ($ases2['FS_PENCIUMAN'] == '2') echo 'selected' ?>>Tidak Normal</option>

            </select>
          </td>
          <td>Pendengaran</td>
          <td>
            <select name="FS_PENDENGARAN" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="1" <?php if ($ases2['FS_PENDENGARAN'] == '1') echo 'selected' ?>>Normal</option>
              <option value="2" <?php if ($ases2['FS_PENDENGARAN'] == '2') echo 'selected' ?>>Tidak Normal (Kanan)</option>
              <option value="3" <?php if ($ases2['FS_PENDENGARAN'] == '3') echo 'selected' ?>>Tidak Normal (Kiri)</option>
              <option value="4" <?php if ($ases2['FS_PENDENGARAN'] == '4') echo 'selected' ?>>Tidak Normal (Kanan & Kiri)</option>
              <option value="5" <?php if ($ases2['FS_PENDENGARAN'] == '5') echo 'selected' ?>>Alat Bantu Dengar (Kanan)</option>
              <option value="6" <?php if ($ases2['FS_PENDENGARAN'] == '6') echo 'selected' ?>}>Alat Bantu Dengar (Kiri)</option>
              <option value="7" <?php if ($ases2['FS_PENDENGARAN'] == '7') echo 'selected' ?>>Alat Bantu Dengar (Kanan & Kiri)</option>
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
              <select name="FS_NUTRISI_ANAK1" class="select2" style="width: 190px;" id="sna1">
                <option value="">--Pilih Data--</option>
                <option value="0" <?php if ($nutrisi['FS_NUTRISI_ANAK1'] == '0') echo 'selected' ?>>Tidak</option>
                <option value="1" <?php if ($nutrisi['FS_NUTRISI_ANAK1'] == '1') echo 'selected' ?>>Ya</option>

              </select>
              <span id="snha1"></span>
            </td>
            <td width='20%'>Kesimpulan</td>
            <td width='30%'><b><span id="kesimpulansna"></span></b></td>
          </tr>
          <tr>
            <td>Apakah terdapat penurunan BB selama satu bulan terakhir?</td>
            <td>
              <select name="FS_NUTRISI_ANAK2" class="form-control" style="width: 190px;" id="sna2">
                <option value="">--Pilih Data--</option>
                <option value="0" <?php if ($nutrisi['FS_NUTRISI_ANAK2'] == '0') echo 'selected' ?>>Tidak</option>
                <option value="1" <?php if ($nutrisi['FS_NUTRISI_ANAK2'] == '1') echo 'selected' ?>>Ya</option>
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
                <option value="0" <?php if ($nutrisi['FS_NUTRISI_ANAK3'] == '0') echo 'selected' ?>>Tidak</option>
                <option value="1" <?php if ($nutrisi['FS_NUTRISI_ANAK3'] == '1') echo 'selected' ?>>Ya</option>
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
              <select name="FS_NUTRISI_ANAK4" class="select2" style="width: 190px;" id="sna4">
                <option value="">--Pilih Data--</option>
                <option value="0" <?php if ($nutrisi['FS_NUTRISI_ANAK4'] == '0') echo 'selected' ?>>Tidak</option>
                <option value="1" <?php if ($nutrisi['FS_NUTRISI_ANAK4'] == '1') echo 'selected' ?>>Ya</option>
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
                <option value="0" <?php if ($nutrisi['FS_NUTRISI1'] == '0') echo 'selected' ?>>Tidak</option>
                <option value="1" <?php if ($nutrisi['FS_NUTRISI1'] == '1') echo 'selected' ?>>Tidak Yakin</option>
                <option value="2" <?php if ($nutrisi['FS_NUTRISI1'] == '2') echo 'selected' ?>>Ya (1-5 Kg)</option>
                <option value="3" <?php if ($nutrisi['FS_NUTRISI1'] == '3') echo 'selected' ?>>Ya (6-10 Kg)</option>
                <option value="4" <?php if ($nutrisi['FS_NUTRISI1'] == '4') echo 'selected' ?>>Ya (11-15 Kg)</option>
                <option value="5" <?php if ($nutrisi['FS_NUTRISI1'] == '5') echo 'selected' ?>>Ya (>15 Kg)</option>

              </select>
              <span id="snh1"></span>
            </td>
            <td width='20%'>Kesimpulan</td>
            <td width='30%'><b><span id="kesimpulansn"></span></b></td>
          </tr>
          <tr>
            <td>Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</td>
            <td>
              <select name="FS_NUTRISI2" class="form-control" style="width: 190px;" id="sn2">
                <option value="">--Pilih Data--</option>
                <option value="0" <?php if ($nutrisi['FS_NUTRISI2'] == '0') echo 'selected' ?>>Tidak</option>
                <option value="1" <?php if ($nutrisi['FS_NUTRISI2'] == '1') echo 'selected' ?>>Ya</option>
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
              <option value="" <?php if ($ases2['FS_AGAMA'] == '') echo 'selected' ?>>--Pilih Data--</option>
              <option value="1" <?php if ($ases2['FS_AGAMA'] == '1') echo 'selected' ?>>Islam</option>
              <option value="2" <?php if ($ases2['FS_AGAMA'] == '2') echo 'selected' ?>>Kristen</option>
              <option value="3" <?php if ($ases2['FS_AGAMA'] == '3') echo 'selected' ?>>Katholik</option>
              <option value="4" <?php if ($ases2['FS_AGAMA'] == '4') echo 'selected' ?>>Hindu</option>
              <option value="5" <?php if ($ases2['FS_AGAMA'] == '5') echo 'selected' ?>>Buda</option>
              <option value="6" <?php if ($ases2['FS_AGAMA'] == '6') echo 'selected' ?>>Konghucu</option>
            </select>
          </td>
          <td width='20%'>Nilai/Kepercayaan khusus</td>
          <td width='30%'>
            <select name="FS_NILAI_KHUSUS" class="form-control" style="width: 190px;">
              <option value="" <?php if ($ases2['FS_NILAI_KHUSUS'] == '') echo 'selected' ?> onclick='document.getElementById("civstaton4").disabled = true'>--Pilih Data--</option>
              <option value="1" <?php if ($ases2['FS_NILAI_KHUSUS'] == '1') echo 'selected' ?> onclick='document.getElementById("civstaton4").disabled = true'>Tidak Ada</option>
              <option value="2" <?php if ($ases2['FS_NILAI_KHUSUS'] != '' && $ases2['FS_NILAI_KHUSUS'] != '1') echo 'selected' ?>onclick='document.getElementById("civstaton4").disabled = false'>Ada</option>
            </select>
            <input type="text" name="FS_NILAI_KHUSUS2" id="civstaton4" <?php if ($ases2['FS_NILAI_KHUSUS'] == '0') echo 'disabled' ?> size="27" value="<?= $ases2['FS_NILAI_KHUSUS2'] ?>" class="form-control" style="width: 190px;">
          </td>
        </tr>
        <table class="table-input" width="100%">
          <tr class="headrow">
            <th colspan="4">Keperawatan</th>
          </tr>
          <tr>
            <td width='20%'>Masalah Keperawatan</td>
            <td width='30%'>
              <select name="tujuan[]" multiple id="tujuan" style="width:250px">
                <option></option>
              </select>
              <br>
              <em>*Bisa lebih dari satu, jika ada tambahan hub EDP</em>
            </td>
            <td width='20%'>Rencana Keperawatan</td>
            <td width='30%'>
              <select name="tembusan[]" multiple id="tembusan" style="width:250px">
                <option></option>
              </select>
              <br>
              <em>*Bisa lebih dari satu, jika ada tambahan hub EDP</em>
            </td>
          </tr>
        </table>
        <table class="table-input" id="otakatik">
          <tr class="headrow">
            <th colspan="4">INSTRUKSI MEDIC</th>
          </tr>

          <tr>
            <td>Resep HD</td>
            <td>
              <input name="instruksi_resepHD" type="radio" value="1" <?php if ($medis['instruksi_resepHD'] == '1') echo 'checked' ?> /> Inisiasi &nbsp;
              <input name="instruksi_resepHD" type="radio" value="2" <?php if ($medis['instruksi_resepHD'] == '2') echo 'checked' ?> /> Akut &nbsp;
              <input name="instruksi_resepHD" type="radio" value="3" <?php if ($medis['instruksi_resepHD'] == '3') echo 'checked' ?> /> Rutin &nbsp;
              <input name="instruksi_resepHD" type="radio" value="4" <?php if ($medis['instruksi_resepHD'] == '4') echo 'checked' ?> /> SLED
            </td>
            <td>UF Goal</td>
            <td><input type="text" name="instruksi_resepHD_UFgoal" size="6" value="<?= $medis['instruksi_resepHD_UFgoal'] ?>" class="form-control" style="width: 190px;"></td>
            <td>ml</td>
          </tr>
          <tr>
            <td>TD</td>
            <td><input type="text" name="instruksi_resepHD_TD" size="6" value="<?= $medis['instruksi_resepHD_TD'] ?>" class="form-control"> Jam</td>
            <td>Conductivity</td>
            <td><input type="text" name="instruksi_dialisat_conductivity_text" value="<?= $medis['instruksi_dialisat_conductivity_text'] ?>" class="form-control" style="width: 190px;">
            <td>asdad</td>
            </td>
          </tr>
          <tr>
            <td>QB</td>
            <td><input type="text" name="instruksi_resepHD_QB" size="6" value="<?= $medis['instruksi_resepHD_QB'] ?>" class="form-control"> ml/mnt</td>
            <td>Temperatur</td>
            <td><input type="text" name="instruksi_dialisat_temperatur_text" value="<?= $medis['instruksi_dialisat_temperatur_text'] ?>" class="form-control" style="width: 190px;"></td>
            <td>asdasd</td>
          </tr>
          <tr>
            <td>QD</td>
            <td><input type="text" name="instruksi_resepHD_QD" size="6" value="<?= $medis['instruksi_resepHD_QD'] ?>" class="form-control" style="width: 190px;"> ml/mnt</td>
            <td>Akses Vaskuler</td>
            <td colspan="2">
              <input name="instruksi_av_fistula" type="checkbox" <?php if ($medis['instruksi_av_fistula'] == '1') echo 'checked' ?> value="1" /> AV Fistula &nbsp;
              <input name="instruksi_femoral" type="checkbox" value="1" <?php if ($medis['instruksi_femoral'] == '1') echo 'checked' ?> /> Femoral &nbsp;
              <input name="instruksi_HD_catheter" type="checkbox" <?php if ($medis['instruksi_HD_catheter'] == '1') echo 'checked' ?> value="1" /> HD Catheter &nbsp; <br>
            </td>
          </tr>
          <tr>
            <td>Dialisat </td>
            <td>
              <input name="instruksi_dialisat_asetat" type="checkbox" <?php if ($medis['instruksi_dialisat_asetat'] == '1') echo 'checked' ?> value="1" /> Asetat &nbsp;
              <input name="instruksi_dialisat_bicarbonat" type="checkbox" <?php if ($medis['instruksi_dialisat_bicarbonat'] == '1') echo 'checked' ?> value="1" /> Bicarbonat <br>

            </td>
            <td></td>
            <td>
            </td>
          </tr>

        </table>
        <table>

          <tr class="headrow">
            <th colspan="4">Heparinisasi</th>
          </tr>
          <tr>
            <td>Dosis Awal </td>
            <td><input type="text" name="instruksi_dosis_awal_text" size="6" value="<?= $medis['instruksi_dosis_awal_text'] ?>"> iu</td>
            <td>Dosis sirkulasi</td>
            <td>
              <input type="text" name="instruksi_dosis_sirkulasi_text" size="6" value="<?= $medis['instruksi_dosis_sirkulasi_text'] ?>"> iu
            </td>
          </tr>
          <tr>
            <td>LMWH</td>
            <td><input type="text" name="instruksi_LMWH_text" size="6" value="<?= $medis['instruksi_LMWH_text'] ?>">
            </td>
            <td>Dosis Maintenance</td>
            <td>
              Continue &nbsp;
              <input type="text" name="instruksi_dosis_main_continue_text" size="6" value="<?= $medis['instruksi_dosis_main_continue_text'] ?>">ui/jam <br><br>
              Intermitten &nbsp;
              <input type="text" name="instruksi_dosis_main_intermitten_text" size="6" value="<?= $medis['instruksi_dosis_main_intermitten_text'] ?>"> ui/jam
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Tanpa Heparin, Penyebab</td>
            <td><input type="text" name="instruksi_tanpa_heparin_text" value="<?= $medis['instruksi_tanpa_heparin_text'] ?>"></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2"><input name="instruksi_program_bilas" type="checkbox" <?php if ($medis['instruksi_program_bilas'] == '1') echo 'checked' ?> value="1" /> Program bilas NaCl 0,9 % 100 cc/jam/ ½ jam</td>
          </tr>
          <tr class="submit-box">
            <td colspan="4">
              <div style="font-weight: bold;">
                *Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar
              </div>
              <br>
              <input type="submit" name="save" value="Kirim" class="edit-button" />
            </td>
          </tr>
        </table>
</form>
</div>
</div>


<script>
  $(document).ready(function() {
    $('#tembusan').select2();
  });

  $(document).ready(function() {
    $('#tujuan').select2({
      width: 'resolve'
    });
  });
</script>

<?= $this->endSection('content') ?>