<?= $this->extend('layout/main-layout') ?>

<?= $this->section('content') ?>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<section>

  <div class="search-box">
    <div class="card">
      <div class="card-header bg-success" style="padding-top:10px; padding-bottom:5px">
        <h4 style="color: white;">Search</h4>
      </div>
      <br>
      <div class="card-body">
        <form action="<?= site_url('nurse/rawat_jalan/proses_cari') ?>" method="post">
          <table class="table-search" width="100%">
            <tr>
              <th width="10%" aligh="left">Dokter</th>
              <td>
                <select name="FS_KD_PEG" id="surat_dari" class="select2" style="width: 300px;">
                  <option value=""></option>
                  <?php foreach ($rs_dokter as $data) : ?>
                    <option value="<?= $data['FS_KD_PEG'] ?>" <?= ($search['FS_KD_PEG'] == $data['FS_KD_PEG']) ? 'selected="selected"' : '' ?>><?= $data['FS_NM_PEG'] ?></option>
                  <?php endforeach; ?>
                </select>
              <th width="10%" aligh="left"></th>
              <td width="75%">
                <input name="save" type="submit" value="Tampilkan" style="background-color: #435EBE; color:white;border-radius:5px;border:none" />
                <input name="save" type="submit" value="Reset" style="background-color: #435EBE; color:white;border-radius:5px;border:none" />
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>



  <div class="card">
    <div class="card-body">

      <table class="table table-striped">
        <thead>

          <tr>
            <th>Nomor Antrian</th>
            <th>No Reg / No MR / Nama Jaminan</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <?php foreach ($rs_pasien as $pasien) : ?>
          <tr>
            <td><?= $pasien['FN_NO_URUT'] ?></td>
            <td><?= $pasien['FS_KD_REG'] ?> / <?= $pasien['FS_MR'] ?></td>
            <td><?= $pasien['FS_NM_PASIEN'] ?></td>
            <td><?= $pasien['FS_ALM_PASIEN'] ?></td>

            <td>


              <?php if ($pasien['FS_STATUS'] == '') : ?>
                <img src="<?= site_url() ?>resource/doc/images/icon/icon.waiting.png" alt="" />
                Periksa Perawat
              <?php elseif ($pasien['FS_STATUS'] == '1') : ?>
                <img src="<?= site_url() ?>resource/doc/images/icon/icon.waiting.dokter.png" alt="" />
                Periksa Dokter
              <?php elseif ($pasien['FS_STATUS'] == '2') : ?>
                <?php if ($pasien['FS_TERAPI'] == '' or $pasien['FS_TERAPI'] == '<p>-</p>') : ?>
                  <img src="<?= site_url() ?>resource/doc/images/icon/icon.approve.png" alt="" />
                  Selesai
                <?php else : ?>
                  <img src="<?= site_url(); ?>resource/doc/images/icon/icon.waiting.farmasi.png" alt="" />
                  Farmasi
                  <?php endif; ?>`
                <?php endif; ?>

            </td>
            <td>
              <?php if ($pasien['FS_STATUS'] >= '1') : ?>
                <?php $history = site_url("nurse/rawat_jalan/history/" . $pasien['FS_MR'] . "/" . $search['FS_KD_PEG']); ?>
                <a href="<?= $history; ?>" class="button-edit">Entry</a>
                <?php $kendali = site_url("rm/rawat_jalan/kendali/" . $pasien['FS_KD_REG']) ?>
                <a href="javascript:void(0);" onclick="window.open('<?= $kendali; ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Kendali</a>




                <?php if ($pasien["FS_CARA_PULANG"] == '1') : ?>
                  <?php $cetak_rb = site_url("medis/rawat_jalan/cetak_rb/" . $pasien['FS_KD_REG'] . "/" . $pasien['FS_KD_TRS']); ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $cetak_rb ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">RB</a>
                <?php else : ?>
                <?php endif; ?>




                <?php if ($pasien['FS_CARA_PULANG'] == '2') : ?>
                  <?php $cetak_skdp = site_url("rm/rawat_jalan/cetak_skdp/{$pasien['FS_KD_REG']}/{$pasien['FS_KD_TRS']}"); ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $cetak_skdp ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">SKDP</a>
                <?php else : ?>
                <?php endif; ?>


                <?php if ($pasien["FS_CARA_PULANG"] == '3') : ?>
                  <?php $cetak_rm = site_url("rm/rawat_inap/cetak_rm/{$pasien['FS_KD_REG']}/{$pasien['FS_KD_TRS']}/11") ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $cetak_rm ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Rawat Inap</a>
                <?php else : ?>
                <?php endif; ?>



                <?php if ($pasien["FS_CARA_PULANG"] == '4') : ?>
                  <?php $cetak_rujukan = site_url("rm/rawat_jalan/cetak_rujukan/{$pasien['FS_KD_REG']}/{$pasien['FS_KD_TRS']}"); ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $cetak_rujukan ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Rujukan RS</a>
                <?php else : ?>
                <?php endif; ?>



                <?php if ($pasien["FS_CARA_PULANG"] == '5') : ?>
                  <?php $cetak_prb = site_url("rm/rawat_jalan/cetak_prb/{$pasien['FS_KD_REG']}/{$pasien['FS_KD_TRS']}"); ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $cetak_prb ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">PRB/Prolanis</a>
                <?php else : ?>
                <?php endif; ?>



                <?php if ($pasien["FS_CARA_PULANG"] == '6') : ?>
                  <?php $rujukan_internal = site_url("rm/rawat_jalan/cetak_rujukan/{$pasien['FS_KD_REG']}/{$pasien['FS_KD_TRS']}"); ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $rujukan_internal ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Rujukan Internal</a>
                <?php else : ?>
                <?php endif; ?>


                <?php if (isset($cek_lab) ?? '') : ?>
                  <?php $lab = site_url("rm/rawat_jalan/cetak_rujukan_lab/{$pasien['FS_KD_REG']}/{$pasien['FS_KD_TRS']}"); ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $lab ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Lab</a>
                <?php else : ?>
                <?php endif; ?>


                <?php if (isset($cek_rad) ?? '') : ?>
                  <?php $radiologi = site_url("rm/rawat_jalan/cetak_rujukan_rad/{$pasien['FS_KD_REG']}/{$pasien['FS_KD_TRS']}"); ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $radiologi ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Radiologi</a>
                <?php else : ?>
                <?php endif; ?>


                <?php if ($pasien["FS_TERAPI"] == '' or $pasien["FS_TERAPI"] == '<p>-</p>') : ?>
                <?php else : ?>
                  <?php $resep = site_url("medis/rawat_jalan/cetak_resep/{$pasien['FS_KD_REG']}/{$pasien['FS_KD_TRS']}"); ?>
                  <a href="javascript:void(0);" onclick="window.open('<?= $resep ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Resep</a>
                <?php endif; ?>

              <?php else : ?>
                <?php $entry = site_url("nurse/rawat_jalan/history/{$pasien['FS_MR']}/{$search['FS_KD_PEG']}"); ?>
                <a href="<?= $entry ?>" class="button-edit">Entry</a>
                <a href="javascript:void(0);" onclick="window.open('<?= $entry ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Kendali</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>

      </table>

    </div>
  </div>
</section>


<?= $this->endSection('content') ?>



<?= $this->section('content') ?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#surat_dari').select2();
  });
</script>
<?= $this->endSection('content') ?>