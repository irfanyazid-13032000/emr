<?php namespace App\Models;

class M_insiden {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    // get last inserted id
    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function get_all_pegawai() {
        $sql = "SELECT FS_KD_PEG,FS_NM_PEG FROM HOSPITAL.dbo.TD_PEG
                where ISNUMERIC(FS_KD_PEG) = 1
                GROUP BY FS_KD_PEG,FS_NM_PEG
                ORDER BY FS_NM_PEG ";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_pasien_by_mr($params) {
        $sql = "SELECT       TOP(20)aa.FS_KD_REG, right(cc.FS_MR, 8)fs_mr, aa.fd_tgl_masuk, aa.fd_tgl_keluar, cc.FS_NM_PASIEN, 
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

    function get_all_investigasi($params) {
        $sql = "SELECT FS_KD_REG,FS_KD_LAP_INVESTIGASI FROM TAB_LAP_INVESTIGASI WHERE FS_KD_REG = ?";
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

    function get_all_unit() {
        $sql = "SELECT FS_KD_LAYANAN,FS_NM_LAYANAN
                FROM HOSPITAL.dbo.TA_LAYANAN
                ORDER BY FS_NM_LAYANAN ";
        $query = $this->db->query($sql);
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
                INNER JOIN TAB_LAP_INVESTIGASI b ON a.FS_KD_LAYANAN=b.FS_KD_LAYANAN
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
    function get_smf() {
        $sql = "SELECT *
                FROM HOSPITAL.dbo.TA_SMF
                ORDER BY FS_NM_SMF";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_all_sasaran() {
        $sql = "SELECT *
                FROM TAB_LAP_INVESTIGASI4
                ORDER BY FS_KD_SASARAN ";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_rekomendasi_by_id($params) {
        $sql = "SELECT * FROM TAB_LAP_INVESTIGASI2
                WHERE FS_KD_LAP_INVESTIGASI = ? 
                ORDER BY FS_KD_LAP_INVESTIGASI2 DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_tindakan_by_id($params) {
        $sql = "SELECT * FROM TAB_LAP_INVESTIGASI3
                WHERE FS_KD_LAP_INVESTIGASI = ? 
                ORDER BY FS_KD_LAP_INVESTIGASI3 DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_lap_investigasi_by_id($params) {
        $sql = "SELECT a.*,b.FS_NM_PEG,c.FS_NM_LAYANAN,d.FS_NM_SASARAN,
                f.fs_nm_pasien,f.fs_mr,f.FD_TGL_LAHIR,f.FS_ALM_PASIEN,
                e.fd_tgl_masuk,e.fd_tgl_keluar, g.fs_nm_layanan 'layanan_akhir',
                h.FS_REKOMENDASI,i.FS_TINDAKAN,j.FS_NM_SMF,k.FS_NM_LAYANAN 'UNIT_PENYEBAB'
                FROM TAB_LAP_INVESTIGASI a
                LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.FS_KD_PEG=b.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN c ON a.FS_KD_LAYANAN=c.FS_KD_LAYANAN
                LEFT JOIN TAB_LAP_INVESTIGASI4 d ON a.FS_KD_SASARAN=d.FS_KD_SASARAN
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI e ON a.FS_KD_REG=e.FS_KD_REG
		LEFT JOIN HOSPITAL.dbo.TC_MR f ON e.FS_MR=f.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN g ON e.fs_kd_layanan_akhir = g.fs_kd_layanan
                LEFT JOIN TAB_LAP_INVESTIGASI2 h ON a.FS_KD_LAP_INVESTIGASI=h.FS_KD_LAP_INVESTIGASI
                LEFT JOIN TAB_LAP_INVESTIGASI3 i ON a.FS_KD_LAP_INVESTIGASI=i.FS_KD_LAP_INVESTIGASI
                LEFT JOIN HOSPITAL.dbo.TA_SMF j ON a.FS_KD_SMF=j.FS_KD_SMF
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN k ON a.FS_KD_LAYANAN_PENYEBAB=k.FS_KD_LAYANAN
                WHERE a.FS_KD_LAP_INVESTIGASI = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_list_investigasi_lap($params) {
        $sql = "SELECT a.*,b.FS_NM_PEG,d.FS_NM_PEG 'FS_NM_PEG2',f.FS_NM_PASIEN,f.FS_MR,
                g.FS_NM_SASARAN
                FROM TAB_LAP_INVESTIGASI a
                LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.FS_KD_PEG=b.FS_KD_PEG
                LEFT JOIN COM_USER c ON a.mdb = c.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON c.user_name = d.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI e ON a.FS_KD_REG=e.FS_KD_REG
		LEFT JOIN HOSPITAL.dbo.TC_MR f ON e.FS_MR=f.FS_MR
                LEFT JOIN TAB_LAP_INVESTIGASI4 g ON a.FS_KD_SASARAN=g.FS_KD_SASARAN
                WHERE FD_TGL_KEJADIAN BETWEEN ? AND ?
                ORDER BY FD_TGL_KEJADIAN DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_list_investigasi_task($params) {
        $sql = "SELECT a.*,b.FS_NM_PEG,d.FS_NM_PEG 'FS_NM_PEG2',
                f.FS_NM_PASIEN,e.FS_MR
                FROM TAB_LAP_INVESTIGASI a
                LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.FS_KD_PEG=b.FS_KD_PEG
                LEFT JOIN COM_USER c ON a.mdb = c.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON c.user_name = d.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI e ON a.FS_KD_REG=e.FS_KD_REG
		LEFT JOIN HOSPITAL.dbo.TC_MR f ON e.FS_MR=f.FS_MR
                WHERE FS_STATUS='2'
                ORDER BY FD_TGL_KEJADIAN DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasi($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_STATUS = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }

    function get_total_lapinvestigasi1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_KD_SASARAN = '1' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? 
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?  AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasi2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_KD_SASARAN = '2' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? 
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasi3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_KD_SASARAN = '3' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? 
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasi4($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_KD_SASARAN = '4' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? 
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasi5($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_KD_SASARAN = '5' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? 
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasi6($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_KD_SASARAN = '6' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? 
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND FS_STATUS='3'";
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
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_SASARAN = '1' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                 AND FS_STATUS='3'";
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
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_SASARAN = '2' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                 AND FS_STATUS='3'";
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
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_SASARAN = '3' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                 AND FS_STATUS='3'";
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
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_SASARAN = '4' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                 AND FS_STATUS='3'";
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
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_SASARAN = '5' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                 AND FS_STATUS='3'";
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
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_SASARAN = '6' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                 AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasiikp1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_IKP = '1' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasiikp2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_IKP = '2' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_total_lapinvestigasiikp3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_KD_LAYANAN = ? AND FS_IKP = '3' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_totalikp1($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_IKP = '1' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                 AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_totalikp2($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_IKP = '2' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_totalikp3($params) {
        $sql = "SELECT COUNT(*)'total' 
                FROM TAB_LAP_INVESTIGASI
                WHERE FS_IKP = '3' AND MONTH(FD_TGL_KEJADIAN) BETWEEN ? AND ? AND YEAR(FD_TGL_KEJADIAN) BETWEEN ? AND ?
                 AND FS_STATUS='3'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    // insert surat masuk
    function insert($params) {
        $sql = "INSERT INTO TAB_LAP_INVESTIGASI (FS_KASUS, FS_KRONOLOGIS, FS_PENYEBAB_LANGSUNG, FS_PENYEBAB_LATAR_BELAKANG, 
                FS_KD_PEG, FD_TGL_MULAI,FD_TGL_SELESAI,FS_KD_KELENGKAPAN,FS_KD_KELANJUTAN,FD_TGL_KEJADIAN, mdb, mdd,FS_KD_LAYANAN,FS_KD_SASARAN,FS_IKP,
                FS_STATUS,FS_KD_REG,FS_MENGAPA3,FS_MENGAPA4,FS_MENGAPA5,FS_KD_GRADE_RISIKO,FS_PEMBERI_LAPORAN,FS_KD_SMF,
                FS_KD_LAYANAN_PENYEBAB,FS_KD_DAMPAK_PASIEN,FS_TINDAKAN_OLEH,FS_INSIDEN_SERUPA,FS_ANALISA_RCA) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert2($params) {
        $sql = "INSERT INTO TAB_LAP_INVESTIGASI2 (FS_REKOMENDASI, FS_PJ, FS_KD_LAP_INVESTIGASI, mdb, mdd) 
                VALUES (?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert3($params) {
        $sql = "INSERT INTO TAB_LAP_INVESTIGASI3 (FS_TINDAKAN, FS_PJ2, FS_KD_LAP_INVESTIGASI, mdb, mdd) 
                VALUES (?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function update($params) {
        $sql = "UPDATE TAB_LAP_INVESTIGASI SET FS_KASUS =?, FS_KRONOLOGIS=?, FS_PENYEBAB_LANGSUNG=?, FS_PENYEBAB_LATAR_BELAKANG=?, 
                FS_KD_PEG =?, FD_TGL_MULAI=?,FD_TGL_SELESAI=?,FS_KD_KELENGKAPAN=?,FS_KD_KELANJUTAN=?,FD_TGL_KEJADIAN=?, mdb=?, mdd=?, 
                FS_KD_LAYANAN=?,FS_KD_SASARAN=?,FS_IKP=?,FS_STATUS=?,FS_MENGAPA3=?,FS_MENGAPA4=?,FS_MENGAPA5=?,
                FS_KD_GRADE_RISIKO=?,FS_PEMBERI_LAPORAN=?,FS_KD_SMF=?,FS_KD_LAYANAN_PENYEBAB=?,FS_KD_DAMPAK_PASIEN=?,
                FS_TINDAKAN_OLEH=?,FS_INSIDEN_SERUPA=?,FS_ANALISA_RCA=?
                WHERE FS_KD_LAP_INVESTIGASI = ?";
        return $this->db->query($sql, $params);
    }

    function update2($params) {
        $sql = "UPDATE TAB_LAP_INVESTIGASI SET FS_KD_KELENGKAPAN=?,FS_KD_KELANJUTAN=?,FS_STATUS=? WHERE FS_KD_LAP_INVESTIGASI = ?";
        return $this->db->query($sql, $params);
    }

    function update_status($params) {
        $sql = "UPDATE TAB_LAP_INVESTIGASI SET FS_STATUS = ? WHERE FS_KD_LAP_INVESTIGASI = ?";
        return $this->db->query($sql, $params);
    }

    function update_rekom($params) {
        $sql = "UPDATE TAB_LAP_INVESTIGASI2 SET FS_REKOMENDASI=?,FS_PJ=?,mdb=?,mdd=? WHERE FS_KD_LAP_INVESTIGASI = ?";
        return $this->db->query($sql, $params);
    }

    function update_tind($params) {
        $sql = "UPDATE TAB_LAP_INVESTIGASI3 SET FS_TINDAKAN=?,FS_PJ2=?,mdb=?,mdd=? WHERE FS_KD_LAP_INVESTIGASI = ?";
        return $this->db->query($sql, $params);
    }

    function delete($params) {
        $sql = "DELETE FROM TAB_LAP_INVESTIGASI WHERE FS_KD_LAP_INVESTIGASI = ?";
        return $this->db->query($sql, $params);
    }

}
