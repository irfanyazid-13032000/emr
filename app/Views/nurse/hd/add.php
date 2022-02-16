<?= $this->extend('layout/main-layout') ?>

<?= $this->section('content') ?>
<script type="text/javascript" src="<?= site_url() ?>public/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?= site_url() ?>public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?= site_url() ?>public/js/select2.js"></script>
<script type="text/javascript" src="<?= site_url() ?>resource/js/jquery-ui-timepicker-addon.js"></script>


<style>
  #terakhir {
    border: 5px solid green;
  }

  #terakhir tr {
    border: 5px solid green;
  }

  #terakhir tr td {
    border: 5px solid green;
  }
</style>

<div class="breadcrum">
  <p>
    <a href="#">Nursing Record</a><span></span>
    <?php $rawat_jalan = site_url("nurse/hd") ?>
    <a href="<?= $rawat_jalan ?>">Rawat Jalan</a><span></span>
    <small>Add Data</small>
  </p>
  <div class="clear"></div>
</div>
<div class="" style="height:40px">
  <div class="navigation-button">
    <a href="<?= $rawat_jalan ?>" class="float-end" style="width: 100px;"><img src="<?= site_url() ?>resource/doc/images/icon/back-icon.png" alt="" /> Back</a>
  </div>
  <div class="clear"></div>
</div>
<!-- notification template -->
<!-- end of notification template-->
<form action="<?= site_url('nurse/hd/add_process') ?>" method="post">
  <input type="hidden" name="FS_KD_REG" value="<?= $result['FS_KD_REG'] ?>" />
  <input type="hidden" name="FS_MR" value="<?= $result['FS_MR'] ?>" />
  <input type="hidden" name="FS_KD_MEDIS" value="<?= $FS_KD_MEDIS ?>" />
  <input type="hidden" name="FS_KD_LAYANAN" value="<?= $result['FS_KD_LAYANAN'] ?>" />

  <div class="card">
    <div class="card-header" style="padding-top:10px; padding-bottom:5px">
      <h4>Data Pasien</h4>
    </div>


    <div class="card-body">
      <table class="table table-striped" width="100%">
        <tr>
          <td width='20%'>Kode Reg</td>
          <td width='30%'><?= $result['FS_KD_REG'] ?></td>
          <td width='20%'>No RM</td>
          <td width='30%'><?= $result['FS_MR'] ?></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td><?= ($result['FS_NM_PASIEN']) ?? ''; ?></td>
          <td>Alamat</td>
          <td><?= ($result['FS_ALM_PASIEN']) ?? ''; ?></td>
        </tr>
        <tr>
          <td>Umur</td>
          <td><?= ($result['fn_umur']) ?? ''; ?> Tahun</td>
          <td>Jenis Kelamin</td>
          <td>
            <?php if ($result['FS_JNS_KELAMIN'] == '1') : ?>
              Perempuan
            <?php else : ?>
              Laki-Laki
            <?php endif ?>
          </td>
        </tr>
        <tr>
          <td>Jaminan</td>
          <td><?= ($result['FS_NM_JAMINAN']) ?? ''; ?></td>
          <td>Dokter</td>
          <td><?= ($result['FS_NM_PEG']) ?? ''; ?></td>
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
        <?php $profil = site_url("rm/rawat_jalan/resume/{$result['FS_MR']}") ?>
        <a href="javascript:void(0);" onclick="window.open('<?= $profil ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="float-end" style="width: 200px;"><img src=" <?= site_url() ?>resource/doc/images/icon/printer-icon.png" alt="" /> Profil Ringkas Medis Rawat Jalan</a>
      </div>
    </div>
    <div class="clear"></div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="alert alert-danger">
        <p><strong>High Risk :</strong><?= (isset($result['FS_HIGH_RISK'])) ?? '-' ?></p>
        <p><strong>Alergi :</strong> <?= (isset($result['FS_ALERGI'])) ?? '-' ?> (<?= (isset($result['FS_REAK_ALERGI'])) ?? '-' ?>)</p>
        <div class="clear"></div>
      </div>
      <table class="table-input">
        <tr class="headrow">
          <th colspan="3">Anamnesa</th>
          <th colspan="3">Edukasi Pasien</th>
        </tr>
        <tr>
          <td colspan="3">
            <textarea cols="50" name="FS_ANAMNESA" class="form-control"></textarea>
          </td>
          <td colspan="3">
            <textarea cols="50" name="FS_EDUKASI" class="form-control"></textarea>
          </td>
        </tr>
        <tr class="headrow">
          <th colspan="4">Vital Sign</th>
        </tr>
        <tr>
          <td width='20%'>Suhu</td>
          <td width='20%'><input type="text" name="FS_SUHU" size="10" class="form-control" style="width: 190px;" /></td>
          <td>asas</td>
          <td width='20%'>Nadi</td>
          <td width='20%'><input type="text" name="FS_NADI" size="10" class="form-control" style="width: 190px;" /></td>
          <td>x/menit</td>
        </tr>
        <tr>
          <td>R</td>
          <td><input type="text" name="FS_R" size="10" class="form-control" style="width: 190px;" /></td>
          <td>x/menit</td>
          <td>TD</td>
          <td><input type="text" name="FS_TD" size="10" class="form-control" style="width: 190px;" /></td>
          <td>mmHg</td>
        </tr>
        <tr>
          <td>Tinggi Badan</td>
          <td><input type="text" name="FS_TB" size="10" class="form-control" style="width: 190px;" /></td>
          <td>cm</td>
          <td>Berat Badan Pre HD</td>
          <td><input type="text" name="FS_BB" size="10" class="form-control" style="width: 190px;" /></td>
          <td>Kg</td>
        </tr>
        <tr>
          <td>Berat Badan Kering</td>
          <td><input type="text" name="FS_BB_KERING" size="10" class="form-control" style="width: 190px;" /></td>
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
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            </select>
          </td>
          <td width='20%'></td>
          <td width='30%'></td>
        </tr>
        <tr>
          <td>Provokatif</td>
          <td>
            <select name="FS_NYERIP" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="0">Tidak Ada Nyeri</option>
              <option value="2">Biologik</option>
              <option value="3">Kimiawi</option>
              <option value="4">Mekanik / Rudapaksa</option>
            </select>
          </td>
          <td>Quality</td>
          <td>
            <select name="FS_NYERIQ" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="0">Tidak Ada</option>
              <option value="1">Seperti Di Tusuk-Tusuk</option>
              <option value="2">Seperti Terbakar</option>
              <option value="3">Seperti Tertimpa Beb</option>
              <option value="4">Ngilu</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Regio</td>
          <td>
            <input type="text" name="FS_NYERIR" size="10" class="form-control" style="width: 190px;" />
          </td>
          <td>Severity</td>
          <td>
            <select name="FS_NYERIS" id="surat_dari" class="form-control" style="width: 190px;">
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
            </select>
          </td>
        </tr>
        <tr>
          <td>Time</td>
          <td>
            <select name="FS_NYERIT" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="0">Tidak Ada</option>
              <option value="1">Kadang-kadang</option>
              <option value="2">Sering</option>
              <option value="3">Menetap</option>
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
          <td width='20%'>Pasien berjalan tidak seimbang / sempoyongan</td>
          <td width='30%'>
            <select name="FS_CARA_BERJALAN1" class="form-control" style="width: 190px;" id="op1">
              <option value="0">TIDAK</option>
              <option value="1">YA</option>

            </select>
            <span id="sc1"></span>
          </td>
          <td width='20%'>Kesimpulan</td>
          <td width='30%'><b><span id="rjtkesimpulan"></span></b></td>
        </tr>
        <tr>
          <td width='20%'>Pasien berjalan menggunakan alat bantu</td>
          <td width='30%'>
            <select name="FS_CARA_BERJALAN2" class="form-control" style="width: 190px;" id="op2">
              <option value="0">TIDAK</option>
              <option value="1">YA</option>
            </select>
            <span id="sc2"></span>
          </td>
          <td></td>
          <td>
          </td>
        </tr>
        <tr>
          <td>Pada saat akan duduk pasien memegang benda untuk menopang</td>
          <td>
            <select name="FS_CARA_DUDUK" class="form-control" style="width: 190px;" id="op3">
              <option value="0">TIDAK</option>
              <option value="1">YA</option>
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
            <input type="text" name="FS_RIW_PENYAKIT_DAHULU" value="<?= ($result['FS_RIW_PENYAKIT_DAHULU']) ?? '-'; ?>" size="32" class="form-control" style="width: 190px;">
          </td>
          <td width='20%'>Riwayat penyakit keluarga</td>
          <td width='30%'>
            <input type="text" name="FS_RIW_PENYAKIT_DAHULU2" value="<?= ($result['FS_RIW_PENYAKIT_DAHULU2']) ?? '-'; ?>" size="32" class="form-control" style="width: 190px;">
          </td>
        </tr>

      </table>
      <table class="table-input" width="100%">
        <tr class="headrow">
          <th colspan="4">Riwayat Alergi</th>
        </tr>
        <tr>
          <td width='20%'>Riwayat Alergi</td>
          <td width='30%'>
            <input type="text" name="FS_ALERGI" size="35" value="<?= ($result['FS_ALERGI']) ?? '-'; ?>" class="form-control" style="width: 190px;">
            <em style="color:red; font-size:10px;">* Wajib Diisi</em>
          </td>
          <td width='20%'>Reaksi Alergi</td>
          <td width='30%'>
            <input type="text" name="FS_REAK_ALERGI" size="35" value="<?= ($result['FS_REAK_ALERGI']) ?? '-'; ?>" class="form-control" style="width: 190px;">
            <em style="color:red; font-size: 10px;">* Wajib Diisi</em>
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
              <option value="1" onclick='document.getElementById("civstaton3").disabled = true'>Tenang</option>
              <option value="2" onclick='document.getElementById("civstaton3").disabled = true'>Cemas</option>
              <option value="3" onclick='document.getElementById("civstaton3").disabled = true'>Takut</option>
              <option value="4" onclick='document.getElementById("civstaton3").disabled = true'>Marah</option>
              <option value="5" onclick='document.getElementById("civstaton3").disabled = true'>Sedih</option>
              <option VALUE="6" onclick='document.getElementById("civstaton3").disabled = false'>Lainnya</option>
            </select>
            <input type="text" name="FS_STATUS_PSIK2" id="civstaton3" readonly size="32" style="width: 190px;" class="form-control">
          </td>
          <td width='20%'>Hubungan dengan anggota keluarga</td>
          <td width='30%'>
            <select name="FS_HUB_KELUARGA" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="1">Baik</option>
              <option value="2">Tidak Baik</option>

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
              <option value="1">Mandiri</option>
              <option value="2">Perlu Bantuan</option>

            </select>
          </td>
          <td width='20%'>Pengelihatan</td>
          <td width='30%'>
            <select name="FS_PENGELIHATAN" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="1">Normal</option>
              <option value="2">Kabur</option>
              <option value="3">Kaca Mata</option>
              <option value="4">Lensa Kontak</option>

            </select>
          </td>
        </tr>
        <tr>
          <td>Penciuman</td>
          <td>
            <select name="FS_PENCIUMAN" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="1">Normal</option>
              <option value="2">Tidak Normal</option>

            </select>
          </td>
          <td>Pendengaran</td>
          <td>
            <select name="FS_PENDENGARAN" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="1">Normal</option>
              <option value="2">Tidak Normal (Kanan)</option>
              <option value="3">Tidak Normal (Kiri)</option>
              <option value="4">Tidak Normal (Kanan & Kiri)</option>
              <option value="5">Alat Bantu Dengar (Kanan)</option>
              <option value="6">Alat Bantu Dengar (Kiri)</option>
              <option value="7">Alat Bantu Dengar (Kanan & Kiri)</option>

            </select>
          </td>
        </tr>
      </table>

      <table class="table-input" width="100%">
        <tr class="headrow">
          <th colspan="4">Skrining Nutrisi</th>
        </tr>
        <tr>
          <td width='20%'>Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</td>
          <td width='30%'>
            <select name="FS_NUTRISI1" class="form-control" style="width: 190px;" id="sn1">

              <option value="0">Tidak</option>
              <option value="1">Tidak Yakin</option>
              <option value="2">Ya (1-5 Kg)</option>
              <option value="3">Ya (6-10 Kg)</option>
              <option value="4">Ya (11-15 Kg)</option>
              <option value="5">Ya (>15 Kg)</option>

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

              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            </select>
            <span id="snh2"></span>
          </td>
          <td></td>
          <td>
          </td>
        </tr>
      </table>

      <table class="table-input" width="100%">
        <tr class="headrow">
          <th colspan="4">Spiritual dan Kultural pasien</th>
        </tr>
        <tr>
          <td width='20%'>Agama</td>
          <td width='30%'>
            <select name="FS_AGAMA" id="surat_dari" class="form-control" style="width: 190px;">
              <option value="1">Islam</option>
              <option value="2">Kristen</option>
              <option value="3">Katholik</option>
              <option value="4">Hindu</option>
              <option value="5">Buda</option>
              <option value="6">Konghucu</option>
            </select>
          </td>
          <td width='20%'>Nilai/Kepercayaan khusus</td>
          <td width='30%'>
            <select name="FS_NILAI_KHUSUS" class="form-control" style="width:190px">
              <option value="1" onclick='document.getElementById("civstaton4").disabled = true'>Tidak Ada</option>
              <option VALUE="2" onclick='document.getElementById("civstaton4").disabled = false'>Ada</option>
            </select>
            <input type="text" name="FS_NILAI_KHUSUS2" id="civstaton4" readonly size="32" style="width: 190px;" class="form-control">
          </td>
        </tr>
      </table>

      <table class="table-input" width="100%">
        <tr class="headrow">
          <th colspan="4">Keperawatan</th>
        </tr>
        <tr>
          <td width='20%'>Masalah Keperawatan</td>
          <td width='30%'>
            <select name="tujuan[]" id="tujuan" style="width:250px" multiple>
              <option></option>
            </select>
            <br>
            <em style="font-size: 12px;">*Bisa lebih dari satu, jika ada tambahan hub EDP</em>
          </td>
          <td width='20%'>Rencana Keperawatan</td>
          <td width='30%'>
            <select name="tembusan" id="tembusan" style="width:250px">
              <?php foreach ($tembusan as $tembus) : ?>
                <option value="<?= $tembus['FS_KD_TRS'] ?>"><?= $tembus['FS_NM_REN_KEP']; ?></option>
              <?php endforeach; ?>
            </select>
            <br>
            <em style="font-size: 12px;">*Bisa lebih dari satu, jika ada tambahan hub EDP</em>
          </td>
        </tr>

        <table class="table-input">


          <tr>
            <td>Resep HD</td>
            <td>
              <div class="form-check form-check-primary">
                <input name="instruksi_resepHD" type="radio" id="op1" value="1" class="form-check-input" />Inisiasi
              </div>
              <div class="form-check form-check-primary">
                <input name="instruksi_resepHD" type="radio" id="op2" value="2" class="form-check-input" />Akut
              </div>
            </td>
            <td>
              <div class="form-check form-check-primary">
                <input name="instruksi_resepHD" type="radio" id="op3" value="3" class="form-check-input" /> Rutin
              </div>
              <div class="form-check form-check-primary">
                <input name="instruksi_resepHD" type="radio" id="0p4" value="4" class="form-check-input" /> SLED
              </div>
            </td>

            <td></td>
            <td>UF Goal</td>
            <td><input type="text" name="instruksi_resepHD_UFgoal" size="6" class="form-control" style="width: 190px;"></td>
            <td>ml</td>
          </tr>


          <tr>
            <td>Time Dialisis</td>
            <td><input type="text" name="instruksi_resepHD_TD" size="5" value="5" class="form-control" style="width: 190px;"></td>
            <td>jam</td>
            <td></td>
            <td>Conductivity</td>
            <td><input type="text" name="instruksi_dialisat_conductivity_text" value="14" class="form-control" style="width: 190px;" class="form-check-input"></td>
          </tr>
          <tr>
            <td>QB</td>
            <td><input type="text" name="instruksi_resepHD_QB" size="6" class="form-control" style="width: 190px;" class="form-check-input"></td>
            <td>ml/mnt</td>
            <td></td>
            <td>Temperatur</td>
            <td><input type="text" name="instruksi_dialisat_temperatur_text" value="37" class="form-control" style="width: 190px;"></td>
          </tr>
          <tr>
            <td>QD</td>
            <td><input type="text" name="instruksi_resepHD_QD" size="6" value="500" class="form-control" style="width: 190px;"></td>
            <td>ml/mnt</td>
            <td></td>
            <td>Akses Vaskuler</td>
            <td>
              <input name="instruksi_av_fistula" type="checkbox" id="instruksi_av_fistula" value="1" class="form-check-input" />AV Fistula <br>
              <input name="instruksi_femoral" type="checkbox" id="instruksi_femoral" value="1" class="form-check-input" /> Femoral <br>
              <input name="instruksi_HD_catheter" type="checkbox" id="instruksi_HD_catheter" value="1" class="form-check-input" /> HD Catheter
            </td>
          </tr>
          <tr>
            <td>Dialisat </td>
            <td>
              <input name="instruksi_dialisat_asetat" type="checkbox" id="instruksi_dialisat_asetat" value="1" class="form-check-input" /> Asetat
              <input name="instruksi_dialisat_bicarbonat" type="checkbox" checked="" value="1" class="form-check-input" /> Bicarbonat <br>
            </td>
            <td>&nbsp</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;</td>
          </tr>

        </table>
        <table>

          <tr class="headrow">
            <th>Heparinisasi</th>
          </tr>
          <tr>
            <td>Dosis Awal </td>
            <td>
              <input type="text" name="instruksi_dosis_awal_text" size="6" class="form-control" style="width: 190px;">
            </td>
            <td>iu</td>
            <td>Dosis sirkulasi</td>
            <td>
              <input type="text" name="instruksi_dosis_sirkulasi_text" size="6" value="1500" class="form-control" style="width: 190px;">
            </td>
            <td>iu</td>
          </tr>
          <tr>
            <td>LMWH</td>
            <td>
              <input type="text" name="instruksi_LMWH_text" size="6" class="form-control" style="width: 190px;">
            </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td rowspan="2">Dosis Maintenance</td>
            <td>Continue</td>
            <td>
              <input type="text" name="instruksi_dosis_main_continue_text" size="6" value="1000" class="form-control" style="width: 120px;">
            <td>ui/jam</td>
            </td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Intermitten</td>
            <td><input type="text" name="instruksi_dosis_main_intermitten_text" size="6" class="form-control" style="width: 120px;"></td>
            <td>ui/jam</td>

          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td colspan="2">Tanpa Heparin, Penyebab</td>
            <td><input type="text" name="instruksi_tanpa_heparin_text" class="form-control" style="width: 120px;"></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td colspan="3"><input name="instruksi_program_bilas" type="checkbox" id="instruksi_program_bilas" value="1" class="form-check-input" /> Program bilas NaCl 0,9 % 100 cc/jam/ ½ jam</td>
          </tr>
        </table>

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
          <!-- <tr>
            <td colspan="15">
                <input type="submit" name="save" value="Simpan" class="edit-button" /> 
            </td>
        </tr>-->
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
                <div align="center">Tekanan<br>Darah</div>
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
            <?php foreach ($rs_monitoring_hd as $result) : ?>
              <tr>
                <td align="center"><?= $result['tindakan_anthd_jam'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_qb'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_nadi'] ?></td>


                <td align="center"><?= $result['tindakan_anthd_suhu'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_td'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_uf'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_uf_rate'] ?></td>

                <td align="center"><?= $result['tindakan_anthd_washout'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_tranfusi'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_makan'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_urin'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_muntah'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_perdarahan'] ?></td>
                <td align="center"><?= $result['tindakan_anthd_keterangan'] ?></td>
                <td align="center">
                  <?php $fs_kd_reg = ($result['FS_KD_REG']) ?? '' ?>
                  <?php $hapus = site_url("nurse/hd/delete_process_tindakan_monitoring/'{$result['FS_KD_HD_TINDAKAN_MONITORING']}/{$fs_kd_reg}") ?>
                  <a href="<?= $hapus ?>" class="button-edit" onClick="return confirm('Yakin ingin menghapus?')"> Hapus</a>
                </td>
              <?php endforeach; ?>
              </tr>
          </tbody>
        </table>
        <table class="table-input" width="100%">
          <tr class="submit-box">
            <td colspan="4">
              <div style="font-weight: bold;">
                *Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar
              </div>
              <br>
              <input type="submit" name="save" value="Kirim" class="form-control" style="width: auto;" />
            </td>
          </tr>
        </table>

</form>
</div>
</div>






<script type="text/javascript">
  $(document).ready(function() {
    // chain select
    // tujuan
    var user = $("#user").val();
    $('#tujuan').select2('data', null);
    //            $('#tujuan').select2('data', null);
    if (user == '') {
      $("#tujuan").attr("disabled", "disabled");
    } else {
      $("#tujuan").removeAttr("disabled");
      jQuery("#tujuan").html('');
      $.ajax({
        type: "POST",
        url: "<?= site_url() ?>nurse/hd/list_masalah_kep",
        data: "user=" + user,
        dataType: 'json',
        success: function(data) {
          var showData;
          jQuery.each(data, function(index, result) {
            if (result.value == 0) {} else {
              showData += "<option value='" + result.value + "'>" + result.label + "</option>";
            }
          })
          jQuery("#tujuan").html(showData);
          $('#tujuan').select2('val', []);
        }
      });
    }
    $("#user").change(function() {
      user = $(this).val();
      $('#tujuan').select2('data', null);
      if (user == '') {
        $("#tujuan").attr("disabled", "disabled");
      } else {
        $("#tujuan").removeAttr("disabled");
        jQuery("#tujuan").html('');
        $.ajax({
          type: "POST",
          url: "<?= site_url() ?>/nurse/hd/list_masalah_kep",
          data: "user=" + user,
          dataType: 'json',
          success: function(data) {
            var showData;
            jQuery.each(data, function(index, result) {
              if (result.value == 0) {} else {
                showData += "<option value='" + result.value + "'>" + result.label + "</option>";
              }
            })
            jQuery("#tujuan").html(showData);
          }
        });
      }
    });
    //tags
    $("#tujuan").select2({});
  });
</script>

<?= $this->endSection('content') ?>