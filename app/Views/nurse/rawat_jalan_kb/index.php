 <?= $this->extend('layout/main-layout') ?>

 <?= $this->section('content') ?>


 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


 <div class="breadcrum">
     <p>
         <a href="#">Nursing Record</a><span></span>
         <small>Rawat Jalan</small>
     </p>
     <div class="clear"></div>
 </div>
 <div class="search-box">
     <div class="card">
         <div class="card-header bg-success" style="padding-top:10px; padding-bottom:5px">
             <h4 style="color: white;">Search</h4>
         </div>
         <br>
         <div class="card-body">
             <form action="<?= site_url('nurse/rawat_jalan_kb/proses_cari') ?>" method="post">
                 <table class="table-search" width="100%">
                     <tr>
                         <th width="10%" aligh="left">Dokter</th>
                         <td>
                             <select name="FS_KD_PEG" id="surat_dari" class="select2" style="width: 300px;">
                                 <option value=""></option>
                                 <?php foreach ($rs_dokter as $data) : ?>
                                     <option value="<?= $data['FS_KD_PEG'] ?>" <?php if ($search['FS_KD_PEG'] == $data['FS_KD_PEG']) echo "selected" ?>><?= $data['FS_NM_PEG'] ?></option>
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


 <!-- end of notification template-->
 <div class="dashboard-container">
     <table class="table-view" width="100%" border="2">
         <thead>
             <tr>
                 <th width='5%'>Nomor Antrian</th>
                 <th>No MR</th>
                 <th>Nama Pasien</th>
                 <th>Alamat</th>
                 <th>Status</th>
                 <th width='23%'>Aksi</th>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($rs_pasien as $data) : ?>
                 <!--{assign var=cek_lab value=$m_rawat_jalan->cek_data_order_lab_by_rg2(array($data.FS_KD_REG))}
        {assign var=cek_rad value=$m_rawat_jalan->cek_data_order_rad_by_rg2(array($data.FS_KD_REG))}-->
                 <tr <?php if ($data['FN_NO_URUT'] % 2 == 1) echo `class="blink-row"` ?>>
                     <td><?= $data['FN_NO_URUT'] ?></td>
                     <td><?= $data['FS_MR'] ?></td>
                     <td><?= $data['FS_NM_PASIEN'] ?></td>
                     <td><?= $data['FS_ALM_PASIEN'] ?></td>
                     <td>
                         <?php if ($data['FS_STATUS'] == '') : ?>
                             <img src="<?= site_url() ?>resource/doc/images/icon/icon.waiting.png" alt="" />
                             Periksa Perawat
                         <?php elseif ($data['FS_STATUS'] == '1') : ?>
                             <img src="{$BASEURL}resource/doc/images/icon/icon.waiting.dokter.png" alt="" />
                             Periksa Dokter
                         <?php elseif ($data['FS_STATUS'] == '2') : ?>
                             <?php if ($data['FS_TERAPI'] == '' or $data['FS_TERAPI'] == '<p>-</p>') : ?>
                                 <img src="<?= site_url() ?>resource/doc/images/icon/icon.approve.png" alt="" />
                                 Selesai
                             <?php else : ?>
                                 <img src="{$BASEURL}resource/doc/images/icon/icon.waiting.farmasi.png" alt="" />
                                 Farmasi
                             <?php endif; ?>
                         <?php endif; ?>
                     </td>
                     <td>

                         <?php if ($data['FS_STATUS'] >= '1') : ?>


                             <?php $entry = site_url("nurse/rawat_jalan_kb/history/'{$data['FS_MR']}/{$search['FS_KD_PEG']}"); ?>
                             <a href="<?= $entry ?>" class="button-edit">Entry</a>
                             <?php $kendali = site_url("rm/rawat_jalan/kendali/{$data['FS_KD_REG']}") ?>
                             <a href="javascript:void(0);" onclick="window.open('<?= site_url() ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Kendali</a>


                             <?php if ($data['FS_CARA_PULANG'] == '2') : ?>
                                 <?php $skdp = site_url("rm/rawat_jalan/cetak_skdp/{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}"); ?>
                                 <a href="javascript:void(0);" onclick="window.open('<?= $skdp ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">SKDP</a>
                             <?php else : ?>
                             <?php endif; ?>


                             <?php if ($data['FS_CARA_PULANG'] == '1') : ?>
                                 <?php $prb = site_url("medis/rawat_jalan/cetak_prb/{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}"); ?>
                                 <a href="javascript:void(0);" onclick="window.open('<?= $prb ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">PRB</a>
                             <?php else : ?>
                             <?php endif; ?>


                             <?php if ($data['FS_CARA_PULANG'] == '3') : ?>
                                 <?php $rawat_inap = site_url("rm/rawat_inap/cetak_rm/{$data['FS_KD_REG']}/11"); ?>
                                 <a href="javascript:void(0);" onclick="window.open('<?= $rawat_inap ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Rawat Inap</a>
                             <?php else : ?>
                             <?php endif; ?>


                             <?php if ($data['FS_CARA_PULANG'] == '4') : ?>
                                 <?php $rujukan_rs = site_url("rm/rawat_jalan/cetak_rujukan/|{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}"); ?>
                                 <a href="javascript:void(0);" onclick="window.open('<?= $rujukan_rs ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Rujukan RS</a>
                             <?php else : ?>
                             <?php endif; ?>


                             <?php if ($data['FS_CARA_PULANG'] == '5') : ?>
                                 <a href="#" class="button-edit">PRB/Prolanis</a>
                             <?php else : ?>
                             <?php endif; ?>


                             <?php if ($data['FS_CARA_PULANG'] == '6') : ?>
                                 <?php $rujukan_internal = site_url("rm/rawat_jalan/cetak_rujukan/{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}"); ?>
                                 <a href="javascript:void(0);" onclick="window.open('<?= $rujukan_internal ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Rujukan Internal</a>
                             <?php else : ?>
                             <?php endif; ?>


                             <?php if ($cek_lab !== '') : ?>
                                 <?php $lab = site_url("rm/rawat_jalan/cetak_rujukan_lab/{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}"); ?>
                                 <a href="javascript:void(0);" onclick="window.open('<?= $lab ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Lab</a>
                             <?php else : ?>
                             <?php endif; ?>


                             <?php if ($cek_rad !== '') : ?>
                                 <?php $radiologi = site_url("rm/rawat_jalan/cetak_rujukan_rad/{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}"); ?>
                                 <a href="javascript:void(0);" onclick="window.open('<?= $radiologi ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Radiologi</a>
                             <?php else : ?>
                             <?php endif; ?>


                             <?php if ($data['FS_TERAPI'] == '' or $data['FS_TERAPI'] == '<p>-</p>') : ?>
                             <?php else : ?>
                                 <?php $resep = site_url("medis/rawat_jalan/cetak_resep/{$data['FS_KD_REG']}/{$data['FS_KD_TRS']}") ?>
                                 <a href="javascript:void(0);" onclick="window.open('{$config->site_url('<?= $resep ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Resep</a>
                             <?php endif; ?>


                         <?php else : ?>
                             <?php $entry2 = site_url("nurse/rawat_jalan_kb/history/{$data['FS_MR']}/{$search['FS_KD_PEG']}"); ?>
                             <a href="<?= $entry2 ?>" class="button-edit">Entry</a>
                             <?php $kendali2 = site_url("rm/rawat_jalan/kendali/{$data['FS_KD_REG']}"); ?>
                             <a href="javascript:void(0);" onclick="window.open('<?= $kendali2 ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Kendali</a>

                         <?php endif; ?>

                     </td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>

 <script>
     $(document).ready(function() {
         $('#surat_dari').select2();
     });
 </script>

 <?= $this->endSection('content') ?>