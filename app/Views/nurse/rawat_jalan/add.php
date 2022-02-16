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
    <?php $rawat_jalan = site_url('nurse/rawat_jalan/'); ?>
    <a href="<?= $rawat_jalan ?>">Rawat Jalan</a><span></span>
    <small>Add Data</small>
  </p>
  <div class="clear"></div>
</div>
<div class="" style="height: 40px;">
  <div class="navigation-button">
    <a class="float-end" style="width: 100px;" href="<?= $rawat_jalan; ?>"><img src="<?= site_url('resource/doc/images/icon/back-icon.png') ?>" alt="" /> Back</a>
  </div>
  <div class="clear"></div>
</div>
<!-- notification template -->
<!-- end of notification template-->
<form action="<?= site_url('nurse/rawat_jalan/add_process') ?>" method="post">
  <input type="hidden" name="FS_KD_REG" value="<?= $result['FS_KD_REG'] ?>" />
  <input type="hidden" name="FS_MR" value="<?= $result['FS_MR'] ?>" />
  <input type="hidden" name="FS_KD_MEDIS" value="<?= $FS_KD_MEDIS ?>" />
  <input type="hidden" name="FS_KD_LAYANAN" value="<?= $result['FS_KD_LAYANAN'] ?>" />
  <input type="hidden" name="FS_JNS_ASESMEN" value="<?= $FS_JNS_ASESMEN ?>" />


  <div class="card">
    <div class="card-header" style="padding-top:10px; padding-bottom:5px">
      <h4>Data Pasien</h4>
    </div>


    <div class="card-body">
      <table class="table table-striped" width="100%">
        <tr>
          <td width='20%'>Kode Reg / No MR</td>
          <td width='30%'><?= $result['FS_KD_REG']; ?> / <?= $result['FS_MR']; ?></td>
          <td width='20%'>NIK</td>
          <td width='30%'><?= $result['FS_KD_IDENTITAS']; ?></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td><?= ($result['FS_NM_PASIEN']) ?? ''; ?> </td>
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
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td>Jaminan</td>
          <td><?= ($result['FS_NM_JAMINAN']) ?? ''; ?></td>
          <td>Dokter</td>
          <td><?= ($result['FS_NM_PEG']) ?? ''; ?></td>
        </tr>
        <tr>
          <td>Kelengkapan Berkas</td>
          <td></td>
          <td></td>
          <td>
            <?php if ($result['FS_KD_TIPE_JAMINAN'] == '95001' or $result['FS_KD_TIPE_JAMINAN'] == '96001') : ?>
              <?php if ($result['FS_NO_SJP'] == ' ') : ?>
                <h3>
                  DATA BELUM DIVERIFIKASI
                </h3>
              <?php else : ?>
                <h3>
                  DATA SUDAH DIVERIVIKASI
                </h3>
              <?php endif; ?>
            <?php endif; ?>
          </td>

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
    <div class="" style="height:40px">
      <div class="navigation-button">
        <?php $profil = site_url('rm/rawat_jalan/resume/' . $result['FS_MR']) ?>
        <a href="javascript:void(0);" onclick="window.open('<?= $profil ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="float-end" style="width: 200px;"><img src="<? site_url('resource/doc/images/icon/printer-icon.png') ?>" alt="" /> Profil Ringkas Medis Rawat Jalan</a>
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
          <td width='20%'><input type="text" name="FS_SUHU" size="10" class="form-control" style="width: 190px;" /></td>
          <td>&nbsp;</td>
          <td width='10%'>Nadi</td>
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
          <td>Berat Badan</td>
          <td><input type="text" name="FS_BB" size="10" class="form-control" style="width: 190px;" /></td>
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
            <input type="text" name="FS_NYERIR" style="width: 190px;" class="form-control" value="<?= ($result['FS_NYERIR']) ?? '-' ?>" />
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
              <option value="">--Pilih Data--</option>
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
              <option value="">--Pilih Data--</option>
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
              <option value="">--Pilih Data--</option>
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
            <input type="text" name="FS_RIW_PENYAKIT_DAHULU" value="<?= ($result['FS_RIW_PENYAKIT_DAHULU']) ?? '-' ?>" style="width: 190px;" class="form-control">
          </td>
          <td width='20%'>Riwayat penyakit keluarga</td>
          <td width='30%'>
            <input type="text" name="FS_RIW_PENYAKIT_DAHULU2" value="<?= ($result['FS_RIW_PENYAKIT_DAHULU2']) ?? '-' ?>" style="width: 190px;" class="form-control">
          </td>
        </tr>
        <?php if ($result['FS_KD_LAYANAN'] == 'P003' || $result['FS_KD_LAYANAN2'] == 'P003' || $result['FS_KD_LAYANAN3'] == 'P003') : ?>
          <tr>
            <td width='20%'>Riwayat Imunisasi</td>
            <td width='30%'>
              <select name="FS_RIW_IMUNISASI" id="surat_dari" class="form-control" style="width: 190px;">
                <option value="0">--Pilih Data--</option>
                <option value="1">Lengkap</option>
                <option value="2">Kurang</option>
              </select>
              <input type="text" name="FS_RIW_IMUNISASI_KET" style="width: 190px;" class="form-control">
            </td>
            <td width='20%'>Riwayat Tumbuh Kembang</td>
            <td width='30%'>
              <select name="FS_RIW_TUMBUH" id="surat_dari" class="form-control" style="width: 190px;">
                <option value="0">--Pilih Data--</option>
                <option value="1">Normal</option>
                <option value="2">Ada Gangguan</option>
              </select>
              <input type="text" name="FS_RIW_TUMBUH_KET" style="width: 190px;" class="form-control">
            </td>
          </tr>
        <?php endif ?>
      </table>
      <table class="table-input" width="100%">
        <tr class="headrow">
          <th colspan="4">Riwayat Alergi</th>
        </tr>
        <tr>
          <td width='20%'>Riwayat Alergi</td>
          <td width='30%'>
            <input type="text" name="FS_ALERGI" style="width: 190px;" value="<?= ($result['FS_ALERGI']) ?? '-' ?>" class="form-control">
            <em style="color:red; font-size:10px;">* Wajib Diisi</em>
          </td>
          <td width='20%'>Reaksi Alergi</td>
          <td width='30%'>
            <input type="text" name="FS_REAK_ALERGI" style="width: 190px;" value="<?= ($result['FS_REAK_ALERGI']) ?? '-' ?>" class="form-control">
            <em style="color:red;font-size: 10px;">* Wajib Diisi</em>
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
            <input type="text" name="FS_STATUS_PSIK2" id="civstaton3" readonly style="width: 190px;" class="form-control" value="">
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
                <option value="0">Tidak</option>
                <option value="1">Ya</option>

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
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
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
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
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
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
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
                <option value="">--Pilih Data--</option>
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
      <?php endif; ?>
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
            <select name="FS_NILAI_KHUSUS" class="form-control" style="width: 190px;">
              <option value="1" onclick='document.getElementById("civstaton4").disabled = true'>Tidak Ada</option>
              <option VALUE="2" onclick='document.getElementById("civstaton4").disabled = false'>Ada</option>
            </select>
            <input type="text" name="FS_NILAI_KHUSUS2" id="civstaton4" readonly style="width: 190px;" class="form-control" value="">
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
              <option value="">--Pilih Data--</option>
              <option value="0">TIDAK</option>his
              <option value="1">YA</option>

            </select>
            <span id="scgr1"></span>
          </td>
          <td width='20%'>Kesimpulan</td>
          <td width='30%'><b><span id="rjtkesimpulangr"></span></b></td>
        </tr>
        <tr>
          <td width='20%'>Pasien usia diatas 60 tahun memiliki 1 (satu) penyakit dan mengalami gangguan akibat penurunan fungsi organ, psikologi, sosial, ekonomi dan lingkungan yang membutuhkan pelayanan kesehatan</td>
          <td width='30%'>
            <select name="FS_GERIATRI2" class="form-control" style="width: 190px;" id="gr2">
              <option value="">--Pilih Data--</option>
              <option value="0">TIDAK</option>
              <option value="1">YA</option>
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
              <option value="">--Pilih Data--</option>
              <option value="0">TIDAK</option>
              <option value="1">YA</option>
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
            <select name="tujuan" id="tujuan" style="width: 250px;">
              <?php foreach ($tujuan as $tuju) : ?>
                <option value="<?= $tuju['FS_KD_DAFTAR_DIAGNOSA'] ?>"><?= $tuju['FS_NM_DIAGNOSA']; ?></option>
              <?php endforeach; ?>
            </select>
          </td>
          <td width='20%'>Rencana Keperawatan</td>
          <td width='30%'>
            <select name="tembusan" id="tembusan" style="width:250px">
              <?php foreach ($tembusan as $tembus) : ?>
                <option value="<?= $tembus['FS_KD_TRS'] ?>"><?= $tembus['FS_NM_REN_KEP']; ?></option>
              <?php endforeach; ?>
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