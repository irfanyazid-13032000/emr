<?php namespace App\Models;

class M_kelengkapan_mr {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    // insert surat keluar
    function insert($params) {
        $sql = "INSERT INTO TAB_KELENGKAPAN_MR (FS_KD_REG,mdb,mdd,FS_KD_MEDIS_IGD,FS_KD_MEDIS_OP,FS_KD_MEDIS_AN,FS_KD_PEG_MR,FS_STATUS_MR) 
                VALUES (?, ?, ?, ?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_hasil($params) {
        $sql = "INSERT INTO TAB_KELENGKAPAN_MR_DETAIL(FS_KD_KELENGKAPAN_MR, FS_KD_PARAMETER_MR, FS_HASIL) 
                VALUES (?, ?, ?)";
        return $this->db->query($sql, $params);
    }
    
    function insert_hasil_cp($params) {
        $sql = "INSERT INTO TAB_KELENGKAPAN_MR_CP(FS_KD_KELENGKAPAN_MR, FS_KD_COM_PAR_CP, FS_HASIL, FS_KET_HASIL_CP) 
                VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function insert_diag_op($params) {
        $sql = "INSERT INTO TAB_DIAG_OP (FS_KD_REG, FS_DIAG_PRE,FS_DIAG_POST,mdb,mdd,FD_TGL_KEJADIAN) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function insert_diagnosis($params) {
        $sql = "INSERT INTO TAB_PX_PULANG_RESUME (FS_KD_REG, FS_DIAG_UTAMA, mdb, mdd) 
                VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function get_pegawai() {
        $sql = "SELECT FS_KD_PEG,FS_NM_PEG FROM HOSPITAL.dbo.TD_PEG
                where ISNUMERIC(FS_KD_PEG) = 1
                GROUP BY FS_KD_PEG,FS_NM_PEG
                ORDER BY FS_NM_PEG";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_medis() {
        $sql = "SELECT FS_KD_PEG,FS_NM_PEG FROM HOSPITAL.dbo.TD_PEG
                where FS_KD_PEG LIKE 'S%' AND FB_AKTIF_DINAS = '1'
                GROUP BY FS_KD_PEG,FS_NM_PEG
                ORDER BY FS_NM_PEG";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_peg() {
        $sql = "SELECT FS_KD_PEG,FS_NM_PEG FROM HOSPITAL.dbo.TD_PEG
                where FS_KD_PEG NOT LIKE 'S%' AND FB_AKTIF_DINAS = '1'
                GROUP BY FS_KD_PEG,FS_NM_PEG
                ORDER BY FS_NM_PEG";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_param_mr() {
        $sql = "SELECT * FROM COM_PARAMETER_MR WHERE FB_AKTIF = '1' ORDER BY FS_NO_URUT";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_param_mr_by_rm() {
        $sql = "SELECT * FROM COM_PARAMETER_MR
                WHERE FS_PARAMETER_NILAI = '1' AND FB_AKTIF = '1'
                ORDER BY FS_NO_URUT";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_param_cp() {
        $sql = "SELECT * FROM COM_PARAMETER_CP ORDER BY FS_KD_COM_PAR_CP";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_param_mr_by_id($params) {
        $sql = "SELECT b.FS_HASIL FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                WHERE a.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_param_mr2_by_id($params) {
        $sql = "SELECT * FROM TAB_DIAG_OP
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_diag_sek_by_id($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_RESUME_DIAG_SEK
                WHERE FS_KD_DIAG_SEK = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_tindakan_by_id($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_RESUME_TIND
                WHERE FS_KD_TIND = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_pasien_by_tgl_pulang($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_MR,b.FS_NM_PASIEN,a.FD_TGL_MASUK,a.FD_TGL_KELUAR,c.FS_NM_LAYANAN,d.FS_NM_PEG 
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                LEFT JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN c ON a.FS_KD_LAYANAN=c.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_MEDIS=d.FS_KD_PEG
                WHERE a.FS_MR LIKE ? AND a.FD_TGL_KELUAR = ? AND FD_TGL_VOID = '3000-01-01' AND c.FS_KD_INSTALASI = 'RI'
                ORDER BY c.FS_KD_LAYANAN DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_all_unit_lap() {
        $sql = "SELECT DISTINCT a.FS_KD_LAYANAN,FS_NM_LAYANAN
                FROM HOSPITAL.dbo.TA_LAYANAN a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_LAYANAN=b.FS_KD_LAYANAN
                INNER JOIN TAB_KELENGKAPAN_MR c ON b.FS_KD_REG=c.FS_KD_REG
                WHERE FS_KD_INSTALASI='RI'
                ORDER BY FS_NM_LAYANAN";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function update_hasil($params) {
        $sql = "UPDATE TAB_KELENGKAPAN_MR_DETAIL SET FS_HASIL=? WHERE FS_KD_PARAMETER_MR=? AND FS_KD_KELENGKAPAN_MR=?";
        return $this->db->query($sql, $params);
    }

    function update($params) {
        $sql = "UPDATE TAB_KELENGKAPAN_MR SET mdb=?,mdd=?,FS_KD_MEDIS_IGD=?,FS_KD_MEDIS_OP=?,FS_KD_MEDIS_AN=?,FS_KD_PEG_MR=?,FS_STATUS_MR=? WHERE FS_KD_KELENGKAPAN_MR=?";
        return $this->db->query($sql, $params);
    }

    function update_diag_op($params) {
        $sql = "UPDATE TAB_DIAG_OP SET FS_DIAG_PRE =?,FS_DIAG_POST=?,FD_TGL_KEJADIAN=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_diagnosis($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME SET FS_DIAG_UTAMA =? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }
    function update_diag_utama($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME SET FS_ICD_DIAG_UTAMA =? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }
    function update_diag_sek($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME_DIAG_SEK SET FS_NM_DIAG_SEK =?,ICD10=?,mdb=?,mdd=? WHERE FS_KD_DIAG_SEK = ?";
        return $this->db->query($sql, $params);
    }
    function update_tindakan($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME_TIND SET FS_NM_TIND =?,ICD9CM=?,mdb=?,mdd=? WHERE FS_KD_TIND = ?";
        return $this->db->query($sql, $params);
    }

    function get_pasien_by_rg($params) {
        $sql = " SELECT xx.*,aa.fs_kd_reg,aa.fd_tgl_masuk, aa.fs_jam_masuk, aa.fs_kd_petugas, aa.fd_tgl_void, aa.fs_jam_void,  
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
            aa.fs_kd_medis2, aa.fs_kd_medis3, fs_kd_bed_awal, fs_kd_trs_bed_awal, fs_kd_jenis_reg, fs_no_sjp, fs_kd_trs_sjp, 
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
 LEFT JOIN  TAB_KELENGKAPAN_MR xx ON aa.FS_KD_REG=xx.FS_KD_REG
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

    // get email address for send attachment
    function get_pasien_by_mr($params) {
        $sql = "SELECT       aa.FS_KD_REG, right(cc.FS_MR, 8)fs_mr, aa.fd_tgl_masuk, aa.fd_tgl_keluar, cc.FS_NM_PASIEN, 
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

    // total surat masuk
    function get_total_kelengkapan_mr_lap($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                WHERE c.FS_MR LIKE ? AND b.FS_KD_LAYANAN LIKE ? AND MONTH(FD_TGL_KELUAR) LIKE ? AND YEAR(FD_TGL_KELUAR) LIKE ?
                ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }

    // list surat masuk
    function get_list_kelengkapan_mr_lap($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,b.FD_TGL_KELUAR 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                WHERE c.FS_MR LIKE ? AND b.FS_KD_LAYANAN LIKE ? AND MONTH(b.FD_TGL_KELUAR) = ? AND YEAR(b.FD_TGL_KELUAR) = ?
                ORDER BY b.FD_TGL_KELUAR DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_all_kelengkapan_mr($params) {
        $sql = "SELECT FS_KD_REG,FS_KD_KELENGKAPAN_MR
                FROM TAB_KELENGKAPAN_MR a
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_all_kelengkapan_mr2($params) {
        $sql = "SELECT a.FS_KD_REG,a.FS_KD_KELENGKAPAN_MR,b.FD_TGL_KELUAR,RIGHT(c.FS_MR,7)'FS_MR',c.FS_NM_PASIEN,
                d.FS_NM_LAYANAN,e.FS_DIAG_UTAMA,f.FS_NM_PEG 'DPJP',g.FS_NM_PEG 'DOKTER_IGD',H.FS_NM_PEG 'DOKTER_OP',
                I.FS_NM_PEG 'DOKTER_AN'
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN_AKHIR=d.FS_KD_LAYANAN
                LEFT JOIN TAB_PX_PULANG_RESUME e ON a.FS_KD_REG=e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON b.FS_KD_MEDIS = f.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG g ON a.FS_KD_MEDIS_IGD = g.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON a.FS_KD_MEDIS_OP = h.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG i ON a.FS_KD_MEDIS_AN = i.FS_KD_PEG
                WHERE b.FD_TGL_KELUAR BETWEEN ? AND ?
                ORDER BY b.FD_TGL_KELUAR DESC,b.FS_KD_LAYANAN_AKHIR DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_lap_detail($params) {
        $sql = "SELECT a.FS_KD_REG,a.FS_KD_KELENGKAPAN_MR,b.FD_TGL_KELUAR,RIGHT(c.FS_MR,7)'FS_MR',c.FS_NM_PASIEN,
                d.FS_NM_LAYANAN,f.FS_NM_PEG
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL j ON a.FS_KD_KELENGKAPAN_MR = j.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN_AKHIR=d.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON b.FS_KD_MEDIS = f.FS_KD_PEG
                WHERE j.FS_KD_PARAMETER_MR LIKE ? AND b.FS_KD_MEDIS LIKE ? AND b.FD_TGL_KELUAR BETWEEN ? AND ? AND j.FS_HASIL = '2'
                ORDER BY b.FD_TGL_KELUAR DESC,b.FS_KD_LAYANAN_AKHIR DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_lap_detail_igd($params) {
        $sql = "SELECT c.FD_TGL_KELUAR,RIGHT(d.FS_MR,7)'FS_MR',d.FS_NM_PASIEN,
                g.FS_NM_PEG
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR = b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR d ON c.FS_MR=d.FS_MR
                LEFT JOIN HOSPITAL.dbo.TD_PEG g ON a.FS_KD_MEDIS_IGD = g.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND b.FS_HASIL = '2' AND b.FS_KD_PARAMETER_MR LIKE ? AND a.FS_KD_MEDIS_IGD LIKE ? 
                GROUP BY c.FD_TGL_KELUAR,d.FS_NM_PASIEN,
                g.FS_NM_PEG,d.FS_MR
                ORDER BY c.FD_TGL_KELUAR DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_lap_detail_an($params) {
        $sql = "SELECT c.FD_TGL_KELUAR,RIGHT(d.FS_MR,7)'FS_MR',d.FS_NM_PASIEN,
                g.FS_NM_PEG
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR = b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR d ON c.FS_MR=d.FS_MR
                LEFT JOIN HOSPITAL.dbo.TD_PEG g ON a.FS_KD_MEDIS_AN = g.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND b.FS_HASIL = '2' AND b.FS_KD_PARAMETER_MR LIKE ? AND a.FS_KD_MEDIS_AN LIKE ? 
                GROUP BY c.FD_TGL_KELUAR,d.FS_NM_PASIEN,
                g.FS_NM_PEG,d.FS_MR
                ORDER BY c.FD_TGL_KELUAR DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_lap_detail_op($params) {
        $sql = "SELECT c.FD_TGL_KELUAR,RIGHT(d.FS_MR,7)'FS_MR',d.FS_NM_PASIEN,
                g.FS_NM_PEG
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR = b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR d ON c.FS_MR=d.FS_MR
                LEFT JOIN HOSPITAL.dbo.TD_PEG g ON a.FS_KD_MEDIS_OP = g.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND b.FS_HASIL = '2' AND b.FS_KD_PARAMETER_MR LIKE ? AND a.FS_KD_MEDIS_OP LIKE ? 
                GROUP BY c.FD_TGL_KELUAR,d.FS_NM_PASIEN,
                g.FS_NM_PEG,d.FS_MR
                ORDER BY c.FD_TGL_KELUAR DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_all_kelengkapan_mr3($params) {
        $sql = "SELECT a.FS_KD_REG,a.FS_KD_KELENGKAPAN_MR,b.FD_TGL_KELUAR,RIGHT(c.FS_MR,7)'FS_MR',c.FS_NM_PASIEN,
                d.FS_NM_LAYANAN,e.FS_DIAG_UTAMA,f.FS_NM_PEG 'DPJP',g.ICD10,g.FS_NM_DIAG_SEK,h.ICD9CM,h.FS_NM_TIND
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN_AKHIR=d.FS_KD_LAYANAN
                LEFT JOIN TAB_PX_PULANG_RESUME e ON a.FS_KD_REG=e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON b.FS_KD_MEDIS = f.FS_KD_PEG
                LEFT JOIN TAB_PX_PULANG_RESUME_DIAG_SEK g ON a.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAB_PX_PULANG_RESUME_TIND h ON a.FS_KD_REG=h.FS_KD_REG
                WHERE b.FD_TGL_KELUAR BETWEEN ? AND ?
                ORDER BY b.FD_TGL_KELUAR DESC,b.FS_KD_LAYANAN_AKHIR DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '1' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '2' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '3' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '4' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr5($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '5' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr6($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '6' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr7($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '7' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr8($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '8' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr9($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '9' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr10($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '10' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr11($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '11' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr12($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '12' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr13($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '13' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr14($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ? AND b.FS_KD_PARAMETER_MR = '14' AND c.FD_TGL_KELUAR BETWEEN ? AND ? 
                AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_total_kelengkapanmr15($params) {
        $sql = "SELECT COUNT(a.FS_KD_REG)'total' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_LAYANAN_AKHIR = ?  AND c.FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_1($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '1' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_2($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '2' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_3($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '3' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_4($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '4' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_5($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '5' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_6($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '6' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_7($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '7' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_8($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '8' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_9($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '9' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_10($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '10' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_11($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '11' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_12($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '12' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_13($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '13' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_kelengkapanmr_det_14($params) {
        $sql = "SELECT FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE c.FS_KD_REG = ? AND b.FS_KD_PARAMETER_MR = '14' AND FD_TGL_KELUAR BETWEEN ? AND ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total1($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '1' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total2($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '2' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total3($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '3' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total4($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '4' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total5($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '5' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total6($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '6' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total7($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '7' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total8($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '8' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total9($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '9' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total10($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '10' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total11($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '11' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total12($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '12' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total13($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '13' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total14($params) {
        $sql = "SELECT COUNT(*)'total' 
               FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                WHERE b.FS_KD_PARAMETER_MR = '14' AND c.FD_TGL_KELUAR BETWEEN ? AND ?
                 AND FS_HASIL='2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_list_kelengkapan_mr_excel_det($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,e.FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL e ON a. FS_KD_KELENGKAPAN_MR = e.FS_KD_KELENGKAPAN_MR
                WHERE e.FS_KD_KELENGKAPAN_MR = ? AND FS_KD_PARAMETER_MR = 1";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_list_kelengkapan_mr_excel_det2($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,e.FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL e ON a. FS_KD_KELENGKAPAN_MR = e.FS_KD_KELENGKAPAN_MR
                WHERE e.FS_KD_KELENGKAPAN_MR = ? AND FS_KD_PARAMETER_MR = 2";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_list_kelengkapan_mr_excel_det3($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,e.FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL e ON a. FS_KD_KELENGKAPAN_MR = e.FS_KD_KELENGKAPAN_MR
                WHERE e.FS_KD_KELENGKAPAN_MR = ? AND FS_KD_PARAMETER_MR = 3";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_list_kelengkapan_mr_excel_det4($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,e.FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL e ON a. FS_KD_KELENGKAPAN_MR = e.FS_KD_KELENGKAPAN_MR
                WHERE e.FS_KD_KELENGKAPAN_MR = ? AND FS_KD_PARAMETER_MR = 4";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_list_kelengkapan_mr_excel_det5($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,e.FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL e ON a. FS_KD_KELENGKAPAN_MR = e.FS_KD_KELENGKAPAN_MR
                WHERE e.FS_KD_KELENGKAPAN_MR = ? AND FS_KD_PARAMETER_MR = 5";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_list_kelengkapan_mr_excel_det6($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,e.FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL e ON a. FS_KD_KELENGKAPAN_MR = e.FS_KD_KELENGKAPAN_MR
                WHERE e.FS_KD_KELENGKAPAN_MR = ? AND FS_KD_PARAMETER_MR = 6";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get all tujuan
    function get_list_kelengkapan_mr_excel_det7($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,e.FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL e ON a. FS_KD_KELENGKAPAN_MR = e.FS_KD_KELENGKAPAN_MR
                WHERE e.FS_KD_KELENGKAPAN_MR = ? AND FS_KD_PARAMETER_MR = 7";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_list_kelengkapan_mr_excel_det8($params) {
        $sql = "SELECT a.FS_KD_REG,a.mdd,b.FD_TGL_MASUK,c.FS_NM_PASIEN,d.FS_NM_LAYANAN,a.FS_KD_KELENGKAPAN_MR,c.FS_MR,e.FS_HASIL 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON b.FS_KD_LAYANAN=d.FS_KD_LAYANAN
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL e ON a. FS_KD_KELENGKAPAN_MR = e.FS_KD_KELENGKAPAN_MR
                WHERE e.FS_KD_KELENGKAPAN_MR = ? AND FS_KD_PARAMETER_MR = 7";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
            ;
        } else {
            return array();
        }
    }

    function get_unit_kerja() {
        $sql = "SELECT * FROM HOSPITAL.dbo.TA_LAYANAN ORDER BY FS_NM_LAYANAN ASC";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_resume_by_rg($params) {
        $sql = "SELECT a.*,b.FS_NM_LAYANAN FROM TAB_PX_PULANG_RESUME a
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN b ON a.FS_KD_LAYANAN=b.FS_KD_LAYANAN
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
        }
    }

    function get_resume_by_rg2($params) {
        $sql = "SELECT a.*,b.FS_NM_LAYANAN FROM TAB_PX_PULANG_RESUME a
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN b ON a.FS_KD_LAYANAN=b.FS_KD_LAYANAN
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            return $result;
        } else {
            return 0;
        }
    }

    function get_diag_by_rg($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_RESUME_DIAG_SEK WHERE FS_KD_REG = ? ORDER BY FS_KD_DIAG_SEK ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_tind_by_rg($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_RESUME_TIND WHERE FS_KD_REG = ? ORDER BY FS_KD_TIND ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_diag_utama_by_rg($params) {
        $sql = "SELECT b.FS_KET_ICD FROM HOSPITAL.dbo.TC_MR2 a
                LEFT JOIN HOSPITAL.dbo.TC_ICD b ON a.FS_KD_DIAGNOSA=b.FS_KD_ICD
                WHERE FS_KD_REG = ? AND FN_URUT ='1'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
        }
    }

    function get_stats_dok_igd($params) {
        $sql = "SELECT d.FS_KD_PEG,d.FS_NM_PEG,COUNT(a.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_MEDIS_IGD = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND FS_HASIL = '2' AND b.FS_KD_PARAMETER_MR = '1' AND a.FS_KD_MEDIS_IGD != 'S000'
                GROUP BY d.FS_KD_PEG,d.FS_NM_PEG
                ORDER BY TOTAL DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_total_igd($params) {
        $sql = "SELECT COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_MEDIS_IGD = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND a.FS_KD_MEDIS_IGD = ? AND b.FS_KD_PARAMETER_MR = '1'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    
    function get_stats_dok_op($params) {
        $sql = "SELECT d.FS_KD_PEG,d.FS_NM_PEG,COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_MEDIS_OP = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND FS_HASIL = '2' AND b.FS_KD_PARAMETER_MR = '14'
                GROUP BY d.FS_NM_PEG,d.FS_KD_PEG
                ORDER BY TOTAL DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
     function get_total_co($params) {
        $sql = "SELECT COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_MEDIS_OP = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND a.FS_KD_MEDIS_OP = ? AND b.FS_KD_PARAMETER_MR = '14'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_stats_dok_an($params) {
        $sql = "SELECT d.FS_KD_PEG,d.FS_NM_PEG,COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_MEDIS_AN = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND FS_HASIL = '2' AND b.FS_KD_PARAMETER_MR = '7'
                GROUP BY d.FS_NM_PEG,d.FS_KD_PEG
                ORDER BY TOTAL DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_total_an($params) {
        $sql = "SELECT COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_MEDIS_AN = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND a.FS_KD_MEDIS_AN = ? AND b.FS_KD_PARAMETER_MR = '7'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_stats_dok_res($params) {
        $sql = "SELECT d.FS_KD_PEG,d.FS_NM_PEG,COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON c.FS_KD_MEDIS = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND b.FS_KD_PARAMETER_MR = '8'
                AND FS_HASIL = '2'
                GROUP BY d.FS_NM_PEG,d.FS_KD_PEG
                ORDER BY TOTAL DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_stats_bang_hhc($params) {
        $sql = "SELECT d.FS_NM_LAYANAN,d.FS_KD_LAYANAN,COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON c.FS_KD_LAYANAN = d.FS_KD_LAYANAN
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND b.FS_KD_PARAMETER_MR = '12'
                AND FS_HASIL = '2'
                GROUP BY d.FS_NM_LAYANAN,d.FS_KD_LAYANAN
                ORDER BY TOTAL DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    
    function get_total_rm($params) {
        $sql = "SELECT COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON c.FS_KD_MEDIS = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND c.FS_KD_MEDIS = ? AND b.FS_KD_PARAMETER_MR = '8'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_stats_peg_pu($params) {
        $sql = "SELECT d.FS_KD_PEG,d.FS_NM_PEG,COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' 
                FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_PEG_MR = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND b.FS_KD_PARAMETER_MR = '9'
                AND FS_HASIL = '2' AND a.FS_KD_PEG_MR <> 'NULL'
                GROUP BY d.FS_NM_PEG,d.FS_KD_PEG
                ORDER BY TOTAL DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_all_icd($params) {
        $sql = "SELECT * 
                FROM HOSPITAL.dbo.TC_ICD WHERE FS_KD_ICD = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    function get_all_icd9cm($params) {
        $sql = "SELECT * 
                FROM HOSPITAL.dbo.TC_ICD9CM WHERE FS_KD_ICD9CM = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    function get_all_icd_row($params) {
        $sql = "SELECT * 
                FROM HOSPITAL.dbo.TC_ICD WHERE FS_KD_ICD = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    function get_all_icd9cm_row($params) {
        $sql = "SELECT * 
                FROM HOSPITAL.dbo.TC_ICD9CM WHERE FS_KD_ICD9CM = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    function cek_morbid($params) {
        $sql = "SELECT * 
                FROM HOSPITAL.dbo.TC_MR2 WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_total_pu($params) {
        $sql = "SELECT COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_PEG_MR = d.FS_KD_PEG
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND a.FS_KD_PEG_MR = ? AND b.FS_KD_PARAMETER_MR = '9'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_total_hhc($params) {
        $sql = "SELECT COUNT(b.FS_KD_KELENGKAPAN_MR)'TOTAL' FROM TAB_KELENGKAPAN_MR a
                LEFT JOIN TAB_KELENGKAPAN_MR_DETAIL b ON a.FS_KD_KELENGKAPAN_MR=b.FS_KD_KELENGKAPAN_MR
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI c ON a.FS_KD_REG=c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON c.FS_KD_LAYANAN = d.FS_KD_LAYANAN
                WHERE c.FD_TGL_KELUAR BETWEEN ? AND ? AND c.FS_KD_LAYANAN = ? AND b.FS_KD_PARAMETER_MR = '12'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_icd_px($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_RESUME_DIAG_SEK
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

}
