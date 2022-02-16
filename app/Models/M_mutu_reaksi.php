<?php namespace App\Models;

class M_mutu_reaksi {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    // insert surat keluar
    function insert($params) {
        $sql = "INSERT INTO TAB_TRANS_DARAH (FS_KD_REG, FS_JENIS_REAKSI,FS_TINDAKAN_TRANS,FS_ANALISIS,mdb,mdd,
                FS_KEJADIAN_REAKSI,FD_TGL_KEJADIAN,FS_NM_OBAT) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function update($params) {
        $sql = "UPDATE TAB_TRANS_DARAH SET FS_KD_REG =?, FS_JENIS_REAKSI=?,FS_TINDAKAN_TRANS=?,FS_ANALISIS=?,mdb=?,mdd=?,FS_KEJADIAN_REAKSI =?, 
                FD_TGL_KEJADIAN = ?, FS_NM_OBAT = ? WHERE FS_KD_TRANS_DARAH = ?";
        return $this->db->query($sql, $params);
    }

    function delete($params) {
        $sql = "DELETE FROM TAB_TRANS_DARAH WHERE FS_KD_TRANS_DARAH = ?";
        return $this->db->query($sql, $params);
    }

    function get_pasien_bangsal($params) {
        $sql = " SELECT     aa.fs_kd_reg, bb.fs_mr, 
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien
            FROM       ( 
                        SELECT      fs_kd_trs 
                        FROM        HOSPITAL.dbo.TA_TRS_BED 
                        WHERE       fd_tgl_in <= ? 
                                AND fd_tgl_out + fs_jam_out >= ? 
                                AND fd_tgl_void = '3000-01-01' 
                        ) aa1 
            LEFT JOIN  HOSPITAL.dbo.ta_trs_bed aa ON aa1.fs_kd_trs = aa.fs_kd_trs 
            LEFT JOIN  HOSPITAL.dbo.ta_registrasi bb ON aa.fs_kd_reg = bb.fs_kd_reg 
            LEFT JOIN  HOSPITAL.dbo.tc_mr cc ON bb.fs_mr = cc.fs_mr 
            LEFT JOIN  HOSPITAL.dbo.ta_layanan dd ON aa.fs_kd_layanan = dd.fs_kd_layanan 
            LEFT JOIN  HOSPITAL.dbo.ta_bed ee ON aa.fs_kd_bed = ee.fs_kd_bed 
            LEFT JOIN  HOSPITAL.dbo.ta_kamar ff ON ee.fs_kd_kamar = ff.fs_kd_kamar 
            LEFT JOIN  HOSPITAL.dbo.ta_bangsal gg ON ff.fs_kd_bangsal = gg.fs_kd_bangsal 
            LEFT JOIN  HOSPITAL.dbo.ta_tipe_jaminan hh ON bb.fs_kd_tipe_jaminan = hh.fs_kd_tipe_jaminan 
            LEFT JOIN  HOSPITAL.dbo.ta_jaminan ii ON hh.fs_kd_jaminan = ii.fs_kd_jaminan 
            LEFT JOIN  HOSPITAL.dbo.td_peg jj ON bb.fs_kd_medis = jj.fs_kd_peg 
            LEFT JOIN  HOSPITAL.dbo.TD_PEG kk ON bb.FS_KD_MEDIS = kk.FS_KD_PEG 
            LEFT JOIN  HOSPITAL.dbo.ta_agama mm ON cc.FS_KD_AGAMA = mm.FS_KD_AGAMA 
            LEFT JOIN  HOSPITAL.dbo.ta_kelas qq ON hh.fs_kd_kelas = qq.fs_kd_kelas 
            LEFT JOIN  HOSPITAL.dbo.tl_fbagian tl ON dd.fs_kd_fbagian = tl.fs_kd_fbagian 
            LEFT JOIN  HOSPITAL.dbo.ta_grup_jaminan gj ON ii.fs_kd_grup_jaminan = gj.fs_kd_grup_jaminan 
            LEFT JOIN  HOSPITAL.dbo.ta_trs_sep aa2 ON bb.fs_kd_reg = aa2.fs_kd_reg 
            LEFT JOIN (
                    SELECT          xx1.fs_kd_reg, xx2.fs_no_polis, xx2.fs_atas_nama, xx2.fs_kd_tipe_jaminan, xx3.fs_kd_status,
                                    xx4.fs_kd_bu ,xx4.fs_nm_bu, xx5.fs_nm_status_peserta 
                    FROM            HOSPITAL.dbo.TA_REG_JAMINAN xx1 
                    LEFT JOIN       HOSPITAL.dbo.TA_REGISTRASI x on xx1.FS_KD_REG = x.FS_KD_REG        LEFT JOIN       HOSPITAL.dbo.TA_POLIS xx2 ON   xx1.FS_KD_POLIS = xx2.FS_KD_POLIS 
                    LEFT JOIN       HOSPITAL.dbo.TA_POLIS_COVER xx3 ON xx2.fs_kd_polis = xx3.fs_kd_polis and xx3.FS_MR = x.FS_MR
                    LEFT JOIN       HOSPITAL.dbo.TA_BU xx4 ON xx2.fs_kd_bu = xx4.fs_kd_bu 
                    LEFT JOIN       HOSPITAL.dbo.TA_STATUS_PESERTA xx5 ON xx3.fs_kd_status = xx5.fs_kd_status_peserta 
                        ) xxx ON bb.fs_kd_reg = xxx.fs_kd_reg AND bb.fs_kd_tipe_jaminan = xxx.fs_kd_tipe_jaminan 
            LEFT JOIN   HOSPITAL.dbo.ta_reg_inap rr ON bb.fs_kd_reg = rr.fs_kd_reg  LEFT JOIN   HOSPITAL.dbo.ta_jenis_inap ji ON bb.fs_kd_jenis_inap = ji.fs_kd_jenis_inap 
            LEFT JOIN   HOSPITAL.dbo.ta_trs_booking_bed tt ON rr.fs_kd_trs_booking_bed = tt.fs_kd_trs 
            LEFT JOIN   HOSPITAL.dbo.ta_tujuan_inap ti ON tt.fs_kd_tujuan_inap = ti.fs_kd_tujuan_inap 
            LEFT JOIN   HOSPITAL.dbo.TD_PEG kkz ON rr.fs_kd_medis_sekunder = kkz.FS_KD_PEG
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, sum(fn_total_bayar) fn_nilai_deposit 
                        FROM        HOSPITAL.dbo.TA_TRS_DEPOSIT 
                        WHERE       FD_TGL_VOID = '3000-01-01' 
                        GROUP BY    fs_kd_reg 
                        ) oo ON aa.fs_kd_reg = oo.fs_kd_reg 
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, fs_kd_layanan, COUNT(fs_kd_trs) fn_count_tdk 
                        FROM        HOSPITAL.dbo.ta_trs_tdk_umum 
                        WHERE       fd_tgl_trs = ?
                                AND fd_tgl_void = '3000-01-01' 
                        GROUP BY    fs_kd_reg, fs_kd_layanan 
                        ) kk1 ON aa.fs_kd_reg = kk1.fs_kd_reg AND aa.fs_kd_layanan = kk1.fs_kd_layanan 
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, DATEDIFF(day, fd_tgl_masuk, ? ) + 1 fn_hari_rawat, 
                            CASE 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 < 10  THEN 'A' 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 >= 10 AND  DATEDIFF(day, fd_tgl_masuk,?  ) + 1 <= 20 THEN 'B' 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 > 20 AND DATEDIFF(day, fd_tgl_masuk, ?  ) + 1 <= 30 THEN 'C' 
                                WHEN DATEDIFF(day, fd_tgl_masuk, ?  ) + 1 >= 31  THEN 'D'
                            END As fs_kd_range 
                        FROM        HOSPITAL.dbo.ta_registrasi 
                        WHERE       fd_tgl_void = '3000-01-01' 
                        ) ll1 ON aa.fs_kd_reg = ll1.fs_kd_reg 
            LEFT JOIN  ( 
                        SELECT      fs_kd_trs, DATEDIFF(day, fd_tgl_in, ? ) + 1 fn_hari_bed 
                        FROM        HOSPITAL.dbo.ta_trs_bed 
                        WHERE       fd_tgl_void = '3000-01-01' 
                        ) mm1 ON aa.fs_kd_trs = mm1.fs_kd_trs 
            LEFT JOIN ( 
                    SELECT        FS_KD_REG, MAX(fs_kd_trs) fs_kd_trs, MAX(FD_TGL_IN) fd_tgl_in 
                    FROM          HOSPITAL.dbo.TA_TRS_BED 
                    WHERE         FD_TGL_VOID = '3000-01-01' 
                    GROUP BY      FS_KD_REG 
                    ) nn1 ON aa.fs_kd_reg = nn1.fs_kd_reg 
            LEFT JOIN  (SELECT '1' fs_kd_dpp, 'Dokter Pilihan Pasien' fs_nm_dpp 
                        UNION 
                        SELECT '0' fs_kd_dpp, 'Dokter Pilihan RS' fs_nm_dpp) yy ON 
                        bb.fb_dpp = yy.fs_kd_dpp 
            LEFT JOIN  HOSPITAL.dbo.ta_kelas nn ON aa.fs_kd_kelas_tindakan = nn.fs_kd_kelas 
            LEFT JOIN  HOSPITAL.dbo.TA_JENIS_KELAMIN ss ON cc.FS_JNS_KELAMIN = ss.FS_KD_JENIS_KELAMIN 
            LEFT JOIN  HOSPITAL.dbo.TA_INSTALASI pp ON dd.FS_KD_INSTALASI = pp.FS_KD_INSTALASI";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_list_data_reak_trans_darah_lap($params) {
        $sql = "SELECT a.*,c.FS_NM_PASIEN,c.FS_MR,e.FS_NM_PEG FROM TAB_TRANS_DARAH a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN COM_USER d ON a.mdb = d.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON d.user_name = e.FS_KD_PEG
                WHERE MONTH(a.FD_TGL_KEJADIAN) BETWEEN ? AND ?
                AND YEAR(a.FD_TGL_KEJADIAN) BETWEEN ? AND ? AND  a.FS_KEJADIAN_REAKSI LIKE ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_reak_trans_darah_by_id($params) {
        $sql = "SELECT a.*,c.fs_nm_pasien,c.fs_mr,e.FS_NM_PEG,c.FD_TGL_LAHIR,c.FS_ALM_PASIEN,
                b.fd_tgl_masuk,b.fd_tgl_keluar, f.fs_nm_layanan 'layanan_akhir',b.FS_KD_REG
                FROM TAB_TRANS_DARAH a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN COM_USER d ON a.mdb = d.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON d.user_name = e.FS_KD_PEG
                LEFT JOIN  HOSPITAL.dbo.TA_LAYANAN f ON b.fs_kd_layanan_akhir = f.fs_kd_layanan 
                WHERE FS_KD_TRANS_DARAH = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_pasien_by_mr($params) {
        $sql = "SELECT       TOP(10)aa.FS_KD_REG, right(cc.FS_MR, 8)fs_mr, aa.fd_tgl_masuk, aa.fd_tgl_keluar, cc.FS_NM_PASIEN, 
            ISNULL(HOSPITAL.dbo.ifa_GetAllDiagByKodeReg(aa.fs_kd_reg), '')  fs_kd_diagnosa, 
            bb.FS_NM_LAYANAN 
            FROM HOSPITAL.dbo.TA_Registrasi aa 
            INNER JOIN HOSPITAL.dbo.TA_Layanan bb ON bb.FS_KD_LAYANAN = aa.FS_KD_LAYANAN 
            INNER JOIN HOSPITAL.dbo.TC_MR cc ON cc.FS_MR = aa.FS_MR 
            LEFT JOIN HOSPITAL.dbo.TC_MR1 ee ON aa.FS_KD_REG = ee.fs_kd_reg 
            LEFT JOIN HOSPITAL.dbo.TC_KET_ICD_EMPTY ff ON ee.FS_KD_KET_ICD_EMPTY = ff.FS_KD_KET_ICD_EMPTY 
            Where cc.fs_mr = ? and aa.fd_tgl_void = '3000-01-01'
            Order by aa.fs_kd_reg DESC,aa.fd_tgl_masuk";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_all_reaksi($params) {
        $sql = "SELECT FS_KD_REG,FS_KD_TRANS_DARAH FROM TAB_TRANS_DARAH WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
        }
    }

    function get_pasien_by_rg($params) {
        $sql = " SELECT hh.FD_TGL_LAHIR,hh.FS_ALM_PASIEN,     aa.fs_kd_reg,aa.fd_tgl_masuk, aa.fs_jam_masuk, aa.fs_kd_petugas, aa.fd_tgl_void, aa.fs_jam_void,  
            aa.fs_kd_petugas_void, aa.fs_mr, aa.fs_kd_layanan, aa.fs_kd_kelas,   
            aa.fs_kd_cara_masuk_dk, aa.fs_kd_rujukan, aa.fn_kunjunganke, aa.fs_kd_jenis_inap,  
            aa.fs_reg_ibu, aa.fs_kd_smf, aa.fs_kd_karcis, aa.fn_karcis,  
            aa.fn_karcis_sisa, aa.fs_kd_rek_sisa, aa.fs_kd_status_peserta, 
            aa.fs_nm_penjamin, aa.fs_alm_penjamin, aa.fs_alm2_penjamin, aa.fs_kota_penjamin,  
            aa.fs_hub_penjamin, aa.fs_id_penjamin, aa.fs_kd_medis, aa.fd_tgl_keluar, aa.fs_jam_keluar, 
            aa.fs_nomor_rujukan, aa.fd_tgl_rujukan, aa.fs_kd_icd, aa.fs_kd_tipe_jaminan, aa.fs_no_peserta, 
            aa.fs_kd_petugas_keluar, aa.fd_tgl_cancel_out, aa.fs_jam_cancel_out, aa.fs_kd_petugas_cancel_out, 
            aa.fs_kd_trs_tindakan, aa.fs_kd_petugas_kasir_masuk, aa.fs_kd_petugas_kasir_keluar, 
            aa.fs_kd_booking, aa.fb_prioritas, aa.fs_kd_trs_kwitansi_masuk, aa.fs_kd_trs_kwitansi_keluar, 
            aa.fs_uraian_dokter, aa.fd_tgl_free_charge, aa.fs_jam_free_charge, fn_diskon_tindakan, fn_diskon_karcis,  
            aa.fn_plafond_jaminan, aa.fs_sandi_kliring, aa.fs_kd_trs_administrasi,fs_kd_trs_materai,fs_kd_trs_struk, 
            aa.fs_kd_trs_pembulatan, aa.fs_kd_trs_deposit, aa.fn_kas_karcis, aa.fn_bank_karcis, aa.fn_kartu_kredit_karcis, 
            aa.fs_kd_rek_kas_karcis, aa.fs_kd_rek_bank_karcis, aa.fs_kd_rek_kartu_kredit_karcis, aa.fs_no_kartu_kredit_karcis, 
            fs_kd_layanan2, fs_kd_layanan3,fs_kd_layanan_akhir,aa.fs_kd_trs_kwitansi_klaim, aa.FS_KD_TRS_KWITANSI_SISADP, 
            aa.fn_total_hutang_jasa, aa.fn_total_hutang_obat, aa.fn_total_nilai_jasa, aa.fn_total_nilai_obat, 
            aa.fn_total_diskon_jasa, aa.fn_total_diskon_obat, aa.fn_total_biayaplus_jasa, aa.fn_total_biayaplus_obat, 
            aa.fn_total_tax_jasa, aa.fn_total_tax_obat, aa.fd_sent_verifikasi, 
            aa.fs_no_bank_karcis, aa.fs_kd_jenis_bank, fs_pekerjaan_penjamin, fs_no_telp_penjamin, 
            aa.fn_biaya_administrasi, aa.fn_biaya_meterai, aa.fn_biaya_pembulatan_jasa, aa.fn_biaya_pembulatan_obat, 
            aa.fs_kd_sesion_poli,aa.fs_anamnese,aa.fs_kd_trs_antrian, aa.fs_kd_trs_antrian2, aa.fs_kd_trs_antrian3, 
            aa.fs_kd_medis2, aa.fs_kd_medis3, fs_kd_bed_awal, fs_kd_trs_bed_awal, fs_kd_jenis_reg, fs_no_sjp, fs_kd_trs_sjp, xx.fs_nm_layanan 'layanan_akhir',
            ISNULL(datediff(year,hh.fd_tgl_lahir,aa.fd_tgl_masuk),0) fn_umur, 
            ISNULL(rr.fs_kd_polis, ' ') fs_kd_polis, ISNULL(ss.fs_no_polis, ' ') fs_no_polis, fb_dpp, 
            ISNULL(bb.fs_nm_user,' ') fs_nm_petugas, 
            ISNULL(cc.fs_nm_user,' ') fs_nm_petugas_void, 
            ISNULL(dd.fs_nm_user,' ') fs_nm_petugas_keluar, 
            ISNULL(ee.fs_nm_user,' ') fs_nm_petugas_cancel_out, 
            ISNULL(ff.fs_nm_user,' ') fs_nm_petugas_kasir_masuk, 
            ISNULL(gg.fs_nm_user,' ') fs_nm_petugas_kasir_keluar, 
            ISNULL(hh.fs_nm_pasien,' ') fs_nm_pasien, 
            ISNULL(ii.fs_nm_layanan,' ') fs_nm_layanan, 
            ISNULL(jj.fs_nm_kelas,' ') fs_nm_kelas, 
            ISNULL(kk.fs_nm_cara_masuk_dk,' ') fs_nm_cara_masuk_dk, 
            ISNULL(ll.fs_nm_smf,' ') fs_nm_smf, 
            ISNULL(mm.fs_nm_jenis_inap,' ') fs_nm_jenis_inap, 
            ISNULL(nn.fs_nm_peg,' ') fs_nm_medis, 
            ISNULL(nn2.fs_nm_peg,' ') fs_nm_medis2, 
            ISNULL(nn3.fs_nm_peg,' ') fs_nm_medis3, 
            ISNULL(oo.fs_nm_tipe_jaminan,' ') fs_nm_tipe_jaminan, 
            ISNULL(pp.fs_nm_rujukan,' ') fs_nm_rujukan, fs_kd_trs_kwitansi_lain, 
            ISNULL(qq.fs_nm_sesion_poli,' ') fs_nm_sesion_poli, 
            ISNULL(tt.fs_nm_medis_luar, '')fs_nm_medis_luar, 
            ISNULL(uu.fs_kd_caramasuk_inap,'') fs_kd_caramasuk_inap, 
            ISNULL(vv.fs_nm_caramasuk_inap,'') fs_nm_caramasuk_inap, 
            ISNULL(uu.fs_kd_trs_booking_bed,'') fs_kd_trs_booking_bed, 
            ISNULL(uu.fs_kd_medis_sekunder,'') fs_kd_medis_sekunder, 
            ISNULL(ww.fs_asal_jenazah,'')fs_asal_jenazah, ISNULL(ww.fs_yayasan_jenazah,'')fs_yayasan_jenazah 
 FROM       HOSPITAL.dbo.ta_registrasi aa 
 INNER JOIN HOSPITAL.dbo.tz_user bb          ON aa.fs_kd_petugas = bb.fs_kd_user  
 LEFT JOIN  HOSPITAL.dbo.tz_user cc          ON aa.fs_kd_petugas_void = cc.fs_kd_user  
 LEFT JOIN  HOSPITAL.dbo.tz_user dd          ON aa.fs_kd_petugas_keluar = dd.fs_kd_user  
 LEFT JOIN  HOSPITAL.dbo.tz_user ee          ON aa.fs_kd_petugas_cancel_out = ee.fs_kd_user  
 LEFT JOIN  HOSPITAL.dbo.tz_user ff          ON aa.fs_kd_petugas_kasir_masuk = ff.fs_kd_user  
 LEFT JOIN  HOSPITAL.dbo.tz_user gg          ON aa.fs_kd_petugas_kasir_keluar = gg.fs_kd_user  
 LEFT JOIN  HOSPITAL.dbo.tc_mr hh            ON aa.fs_mr = hh.fs_mr 
 LEFT JOIN  HOSPITAL.dbo.ta_layanan ii       ON aa.fs_kd_layanan = ii.fs_kd_layanan  
 LEFT JOIN  HOSPITAL.dbo.ta_layanan xx       ON aa.fs_kd_layanan_akhir = xx.fs_kd_layanan  
 LEFT JOIN  HOSPITAL.dbo.ta_kelas jj         ON aa.fs_kd_kelas = jj.fs_kd_kelas 
 LEFT JOIN  HOSPITAL.dbo.ta_cara_masuk_dk kk ON aa.fs_kd_cara_masuk_dk = kk.fs_kd_cara_masuk_dk 
 LEFT JOIN  HOSPITAL.dbo.ta_smf ll           ON aa.fs_kd_smf = ll.fs_kd_smf 
 LEFT JOIN  HOSPITAL.dbo.ta_jenis_inap mm    ON aa.fs_kd_jenis_inap = mm.fs_kd_jenis_inap 
 LEFT JOIN  HOSPITAL.dbo.td_peg nn           ON aa.fs_kd_medis= nn.fs_kd_peg 
 LEFT JOIN  HOSPITAL.dbo.td_peg nn2          ON aa.fs_kd_medis2= nn2.fs_kd_peg 
 LEFT JOIN  HOSPITAL.dbo.td_peg nn3          ON aa.fs_kd_medis3= nn3.fs_kd_peg 
 LEFT JOIN  HOSPITAL.dbo.ta_tipe_jaminan oo  ON aa.fs_kd_tipe_jaminan = oo.fs_kd_tipe_Jaminan 
 LEFT JOIN  HOSPITAL.dbo.ta_rujukan pp       ON aa.fs_kd_rujukan = pp.fs_kd_rujukan 
 LEFT JOIN  HOSPITAL.dbo.ta_sesion_poli qq   ON aa.fs_kd_sesion_poli = qq.fs_kd_sesion_poli 
 LEFT JOIN  HOSPITAL.dbo.ta_reg_jaminan rr   ON aa.fs_kd_reg = rr.fs_kd_reg 
 LEFT JOIN  HOSPITAL.dbo.ta_polis ss         ON rr.fs_kd_polis = ss.fs_kd_polis 
 LEFT JOIN  HOSPITAL.dbo.ta_reg_rujukan tt   ON aa.fs_kd_reg = tt.fs_kd_reg 
 LEFT JOIN  HOSPITAL.dbo.ta_reg_inap uu      ON aa.fs_kd_reg = uu.fs_kd_reg 
 LEFT JOIN  HOSPITAL.dbo.ta_caramasuk_inap vv ON uu.fs_kd_caramasuk_inap = vv.fs_kd_caramasuk_inap 
 LEFT JOIN  HOSPITAL.dbo.ta_reg_jalan ww     ON aa.fs_kd_reg = ww.fs_kd_reg 
 WHERE      aa.fs_kd_reg = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    function get_tot_jan1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '01' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_feb1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '02' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_mar1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '03' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_apr1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '04' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_mei1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '05' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jun1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '06' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jul1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '07' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_agt1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '08' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_sep1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '09' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_okt1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '10' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_nov1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '11' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_des1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '1' AND MONTH(FD_TGL_KEJADIAN) = '12' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jan2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '01' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_feb2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '02' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_mar2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '03' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_apr2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '04' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_mei2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '05' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jun2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '06' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jul2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '07' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_agt2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '08' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_sep2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '09' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_okt2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '10' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_nov2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '11' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_des2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '2' AND MONTH(FD_TGL_KEJADIAN) = '12' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jan3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '01' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_feb3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '02' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_mar3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '03' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_apr3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '04' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_mei3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '05' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jun3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '06' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jul3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '07' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_agt3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '08' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_sep3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '09' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_okt3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '10' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_nov3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '11' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_des3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '3' AND MONTH(FD_TGL_KEJADIAN) = '12' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jan4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '01' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_feb4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '02' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_mar4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '03' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_apr4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '04' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_mei4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '05' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jun4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '06' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_jul4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '07' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_agt4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '08' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_sep4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '09' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_okt4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '10' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_nov4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '11' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_tot_des4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE FS_KEJADIAN_REAKSI = '4' AND MONTH(FD_TGL_KEJADIAN) = '12' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '01' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '02' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '03' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '04' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total5($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '05' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total6($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '06' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total7($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '07' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total8($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '08' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total9($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '09' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total10($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '10' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total11($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '11' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    function get_total12($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_TRANS_DARAH
                WHERE MONTH(FD_TGL_KEJADIAN) = '12' AND YEAR(FD_TGL_KEJADIAN) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
}
