<?= $this->extend('layout/main-layout') ?>

<?= $this->section('content') ?>

<div class="breadcrum">
    <p>
        <a href="#">Pemeriksaan Medis</a><span></span>
        <small>History Pasien</small>
    </p>
    <div class="clear"></div>
</div>
<div class="" style="height:40px">
    <div class="navigation-button">
        <a class="float-end" style="width:100px" href="<?php echo site_url('nurse/rawat_jalan/') ?>"><img src="<?php echo site_url('resource/doc/images/icon/back-icon.png') ?>" alt="" /> Back</a>
    </div>
</div>
<!-- notification template -->
<!-- end of notification template-->

<div class="card">
    <div class="card-header" style="padding-top:10px; padding-bottom:5px">
        <h4>Data Pasien</h4>
    </div>

    <div class="card-body" style="padding-top: 5px; padding-bottom: 0px;">
        <table class="table table-striped">
            <tr>
                <td width='15%'>No RM</td>
                <td width='35%'><?php echo $result['FS_MR'] ?></td>
                <td>NIK</td>
                <td><?= $result['FS_KD_IDENTITAS']; ?></td>
            </tr>
            <tr>
                <td width='15%'>Nama</td>
                <td width='35%'><?php echo (isset($result['FS_NM_PASIEN'])) ? $result['FS_NM_PASIEN'] : '' ?></td>
                <td>Alamat</td>
                <td><?php echo (isset($result['FS_ALM_PASIEN'])) ? $result['FS_ALM_PASIEN'] : '' ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><?php if ($result['FS_JNS_KELAMIN'] == '1') : ?>
                        Perempuan
                    <?php else : ?>
                        Laki-Laki
                    <?php endif; ?></td>
                <td>Tanggal Lahir | Umur</td>
                <td><?php echo (isset($result['FD_TGL_LAHIR'])) ? $result['FD_TGL_LAHIR'] : '' ?> | <?php echo $result['fn_umur'] ?> Tahun</td>

            </tr>
            <tr>
                <td width='15%'>Status Sosial / Pekerjaan / Pendidikan</td>
                <td width='35%'><?= $result['FS_NM_PEKERJAAN_DK']; ?> / <?= $result['FS_NM_PENDIDIKAN_DK']; ?></td>
                <td>Agama</td>
                <td><?php echo (isset($result['fs_nm_agama'])) ? $result['fs_nm_agama'] : '' ?></td>
            </tr>

        </table>
    </div>
</div>

<div class="navigation">
    <div class="pageRow">
        <div class="pageNav">
            <ul>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="" style="height:40px">
        <div class="navigation-button">
            <?php $resume = site_url('rm/rawat_jalan/resume/' . $result['FS_MR']); ?>
            <a href="javascript:void(0);" onclick="window.open('<?php echo $resume ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="float-end" style="width: 200;"><img src="<?php echo site_url() ?>resource/doc/images/icon/printer-icon.png" alt="" /> Profil Ringkas Medis Rawat Jalan</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="card">
        <div class="card-body" style="padding-top: 5px; padding-bottom: 0px;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width='10%'>Tanggal Kunjungan</th>

                        <th>Dokter</th>
                        <th>Layanan</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th width='20%'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $this->m_rawat_jalan = new \App\Models\M_rawat_jalan(); ?>
                    <?php foreach ($rs_pasien as $data) : ?>
                        <?php $cek_lab = $this->m_rawat_jalan->get_data_cek_lab([$data['FS_KD_REG']]); ?>
                        <?php $cek_rad = $this->m_rawat_jalan->get_data_cek_radiologi([$data['FS_KD_REG']]); ?>
                        <?php $cek_resep = $this->m_rawat_jalan->get_data_cek_resep([$data['FS_KD_REG']]); ?>
                        <?php $form_rm = $this->m_rawat_jalan->get_berkas_by_rg([$data['FS_KD_REG']]); ?>
                        <?php $cek_ases_perawat = $this->m_rawat_jalan->cek_ases_perawat_by_rg([$data['FS_KD_REG']]); ?>
                        <?php $cek_order_lab = $this->m_rawat_jalan->cek_data_order_lab_by_rg2([$data['FS_KD_REG']]); ?>
                        <?php $cek_order_rad = $this->m_rawat_jalan->cek_data_order_rad_by_rg2([$data['FS_KD_REG']]); ?>

                        <tr <?php if ($no++ % 2 == 1) echo `class="blink-row"` ?>>
                            <td><?php echo $data['FD_TGL_MASUK'] ?></td>

                            <td>
                                <?= $data['FS_NM_PEG']; ?><br>
                                <?= $data['DOK2']; ?>
                            </td>
                            <td>
                                <?= $data['FS_NM_LAYANAN']; ?><br>
                                <?= $data['LAYANAN2']; ?>
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
                            <td style="text-align: center;">
                                <b>
                                    <?php if ($data['FS_KD_JENIS_REG'] == '0') : ?>
                                        <div style="color: blue;">Rawat Jalan</div>
                                        <?php elseif ($data['FS_KD_JENIS_REG'] == '1') : ?>`
                                        <div style="color: green;">Rawat Inap</div>
                                    <?php elseif ($data['FS_KD_JENIS_REG'] == '3') : ?>
                                        <div style="color: red;">Rawat Darurat</div>
                                    <?php endif; ?>
                                </b>
                            </td>
                            <td>

                                <?php if (!empty(($form_rm['att_name'] ?? null))) : ?>
                                    <?php $operasi = site_url('rm/upload/download/' . $form_rm['att_name']) ?>
                                    <a href="<?php echo $operasi ?>" class="button-download" target="_blank">Operasi</a>
                                <?php endif; ?>
                                <?php if ($data['FS_KD_JENIS_REG'] == '0') : ?>
                                    <?php $rm = site_url('rm/rawat_jalan/cetak_rm/' . $data['FS_KD_REG'] . '/' . $data['FS_KD_TRS'] . '/' . (isset($data['FS_FORM'])) ?? '') ?>
                                    <a href="javascript:void(0);" onclick="window.open('<?php echo $rm ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">RM</a>
                                <?php elseif ($data['FS_KD_JENIS_REG'] == '1') : ?>
                                    <?php $rawat_inap_rm = site_url('rm/rawat_inap/cetak_rm/' . $data['FS_KD_REG'] . '/' . $data['FS_KD_TRS']) ?>
                                    <a href="javascript:void(0);" onclick="window.open('<?php echo $rawat_inap_rm ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">RM</a>
                                <?php elseif ($data['FS_KD_JENIS_REG'] == '3') : ?>
                                <?php endif; ?>


                                <?php if ($data['FS_CARA_PULANG'] == '2') : ?>
                                    <?php $skdp = site_url('medis/rawat_jalan/cetak_skdp/' . $data['FS_KD_REG'] . '/' . $data['FS_KD_TRS']) ?>
                                    <a href="javascript:void(0);" onclick="window.open('<?php echo $skdp ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">SKDP</a>
                                <?php else : ?>
                                <?php endif; ?>
                                <?php if ($data['FS_CARA_PULANG'] == '1') : ?>
                                    <?php $prb =  site_url('medis/rawat_jalan/cetak_prb/' . $data['FS_KD_REG'] . '/' . $data['FS_KD_TRS']) ?>
                                    <a href="javascript:void(0);" onclick="window.open('<?php echo $prb ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">PRB</a>
                                <?php else : ?>
                                <?php endif; ?>
                                <?php if ($data['FS_CARA_PULANG'] == '4') : ?>
                                    <?php $rujukan_rs = site_url('rm/rawat_jalan/cetak_rujukan/' . $data['FS_KD_REG'] . '/' . $data['FS_KD_TRS']) ?>
                                    <a href="javascript:void(0);" onclick="window.open('<?php echo $rujukan_rs ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Rujukan RS</a>
                                <?php else : ?>
                                <?php endif; ?>
                                <?php if ($cek_order_lab !== '') : ?>
                                    <?php $lab = site_url('rm/rawat_jalan/cetak_rujukan_lab/' . $data['FS_KD_REG'] . '/' . $data['FS_KD_TRS']) ?>
                                    <a href="javascript:void(0);" onclick="window.open('<?php echo $lab ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Lab</a>
                                <?php else : ?>
                                <?php endif; ?>
                                <?php if ($cek_order_rad !== '') : ?>
                                    <?php $radiologi = site_url('rm/rawat_jalan/cetak_rujukan_rad/' . $data['FS_KD_REG'] . '/' . $data['FS_KD_TRS']) ?>
                                    <a href="javascript:void(0);" onclick="window.open('<?php echo $radiologi ?>', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Radiologi</a>
                                <?php else : ?>
                                <?php endif; ?>
                                <?php if ($data['FS_TERAPI'] == '' or $data['FS_TERAPI'] == '<p>-</p>') : ?>
                                <?php else : ?>
                                    <?php $resep = site_url('medis/rawat_jalan/cetak_resep/' . $data['FS_KD_REG'] . '/' . $data['FS_KD_TRS']) ?>
                                    <a href="javascript:void(0);" onclick="window.open('<?php echo $resep ?> ', 'nama_window_pop_up', 'scrollbars=yes,resizeable=no')" class="button-edit">Resep</a>
                                <?php endif; ?>


                                <?php if ($data['FD_TGL_KELUAR'] == '3000-01-01') : ?>
                                <?php else : ?>
                                    <?php if ($cek_ases_perawat == '0') : ?>
                                        <?php $awal = site_url('nurse/rawat_jalan/add/' . $data['FS_KD_REG'] . '/' . $FS_KD_MEDIS . '/' . 'A') ?>
                                        <a href="<?php echo $awal ?>" class="button-edit">Awal</a>
                                        <?php $lanjut = site_url('nurse/rawat_jalan/add/' . $data['FS_KD_REG'] . '/' . $FS_KD_MEDIS . '/' . 'L') ?>
                                        <a href="<?php echo $lanjut ?>" class="button-edit">Lanjut</a>
                                    <?php else : ?>
                                        <?php $edit = site_url('nurse/rawat_jalan/edit/' . $data['FS_KD_REG']); ?>
                                        <a href="<?php echo $edit; ?>" class="button-edit">Edit</a>

                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <?= $this->endSection('content') ?>