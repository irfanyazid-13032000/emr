<?php namespace App\Models;

class M_resume {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }
function insert_status($params) {
        $sql = "INSERT INTO TAC_RJ_STATUS( FS_KD_REG, FS_STATUS,FS_FORM, mdb, mdd)
                VALUES(?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    // insert surat keluar
    function insert($params) {
        $sql = "INSERT INTO TAB_PX_PULANG_RESUME (FS_KD_REG,FS_KELUHAN_UTAMA,FS_INDIKASI_DIRAWAT,FS_RIWAYAT_PENYAKIT,
                FS_PEMERIKSAAN_FISIK,FS_PEMERIKSAAN_PENUNJANG,FS_TERAPI,FS_HASIL_LAB,FS_ALERGI,FS_INSTRUKSI,FS_KD_LAYANAN,FD_TGL_KONTROL,
                FS_JAM_KONTROL,FS_DIAG_UTAMA,FS_KEADAAN_UMUM_BAIK,FS_KEADAAN_UMUM_MASIH_SAKIT,FS_KEADAAN_UMUM_SESAK,FS_KEADAAN_UMUM_PUCAT,
                FS_KEADAAN_UMUM_LEMAH,FS_KEADAAN_UMUM_LAIN,FS_SUHU,FS_NADI,FS_R,FS_TD,FS_CAT_HAL_PENTING,FS_CARA_PULANG,FS_STATUS,
                FS_MR,FS_PEM_FISIK1,FS_PEM_FISIK2,FS_PEM_FISIK3,FS_PEM_FISIK4,FS_PEM_FISIK5,FS_PEM_FISIK6,FS_PEM_FISIK7,FS_PEM_FISIK8,
                FS_INSTRUKSI1,FS_INSTRUKSI2,FS_INSTRUKSI3,FS_INSTRUKSI4,FS_INSTRUKSI5,FS_SUHU1,FS_NADI1,FS_R1,FS_TD1,FD_TGL_PULANG,FS_KD_LAYANAN2,FD_TGL_KONTROL2,
                FS_JAM_KONTROL2,FS_KET_INDIKASI,FS_KET_KONTROL,FS_KET_KONTROL2,FS_KET_CARA_PULANG,mdb,mdd,mdd_time)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
function insert_tac_rj_skdp($params) {
        $sql = "INSERT INTO TAC_RJ_SKDP(FS_KD_REG, FS_SKDP_1, FS_SKDP_2,FS_SKDP_KET,FS_SKDP_KONTROL,FS_NO_SKDP, mdb, mdd, mdd_time)
                VALUES (?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    function update($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME SET FS_KELUHAN_UTAMA =?,FS_INDIKASI_DIRAWAT =?,FS_RIWAYAT_PENYAKIT=?,
                FS_PEMERIKSAAN_FISIK =?,FS_PEMERIKSAAN_PENUNJANG =?,FS_TERAPI=?,FS_HASIL_LAB=?,FS_ALERGI=?,FS_INSTRUKSI=?,FS_KD_LAYANAN=?,FD_TGL_KONTROL=?,
                FS_JAM_KONTROL=?,FS_DIAG_UTAMA=?,FS_KEADAAN_UMUM_BAIK=?,FS_KEADAAN_UMUM_MASIH_SAKIT=?,FS_KEADAAN_UMUM_SESAK=?,FS_KEADAAN_UMUM_PUCAT=?,
                FS_KEADAAN_UMUM_LEMAH=?,FS_KEADAAN_UMUM_LAIN=?,FS_SUHU=?,FS_NADI=?,FS_R=?,FS_TD=?,FS_CAT_HAL_PENTING=?,FS_CARA_PULANG=?,FS_STATUS=?,
                FS_MR=?,FS_PEM_FISIK1=?,FS_PEM_FISIK2=?,FS_PEM_FISIK3=?,FS_PEM_FISIK4=?,FS_PEM_FISIK5=?,FS_PEM_FISIK6=?,FS_PEM_FISIK7=?,FS_PEM_FISIK8=?,
                FS_INSTRUKSI1=?,FS_INSTRUKSI2=?,FS_INSTRUKSI3=?,FS_INSTRUKSI4=?,FS_INSTRUKSI5=?,FS_SUHU1=?,FS_NADI1=?,FS_R1=?,FS_TD1=?,FD_TGL_PULANG=?,FS_KD_LAYANAN2=?,FD_TGL_KONTROL2=?,
                FS_JAM_KONTROL2=?,FS_KET_INDIKASI=?,FS_KET_KONTROL=?,FS_KET_KONTROL2=?,FS_KET_CARA_PULANG=?,mdb_update=?,mdd_update=?,mdd_time_update=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_terapi($params) {
        $sql = "UPDATE TAB_PX_PULANG_TERAPI SET FS_NM_OBAT =?,FS_JML_OBAT =?,FS_DOSIS_OBAT=?,
                FS_FREK_OBAT =?,FS_CARA_PEM_OBAT =? WHERE FS_KD_TERAPI = ?";
        return $this->db->query($sql, $params);
    }

    function update_diagnosis($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME_DIAG_SEK SET FS_NM_DIAG_SEK =? WHERE FS_KD_DIAG_SEK = ?";
        return $this->db->query($sql, $params);
    }
    function update_ket_kematian($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME SET FS_SEBAB_KEMATIAN =? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_tindakan($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME_TIND SET FS_NM_TIND =? WHERE FS_KD_TIND = ?";
        return $this->db->query($sql, $params);
    }

    function insert_terapi($params) {
        $sql = "INSERT INTO TAB_PX_PULANG_TERAPI(FS_NM_OBAT,FS_JML_OBAT,FS_DOSIS_OBAT,FS_FREK_OBAT,FS_CARA_PEM_OBAT,FS_KD_REG,mdb,mdd)
                VALUES(?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_diet($params) {
        $sql = "INSERT INTO TAB_PX_PULANG_RESUME_DIET(FS_KD_REG,FS_KD_DIET)
                VALUES(?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_indikasi_rawat($params) {
        $sql = "INSERT INTO TAB_PX_PULANG_RESUME_INDIKASI_RAWAT(FS_KD_REG,FS_KD_PARAM_INDIKASI_DIRAWAT)
                VALUES(?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_diag_sek($params) {
        $sql = "INSERT INTO TAB_PX_PULANG_RESUME_DIAG_SEK(FS_KD_REG,FS_NM_DIAG_SEK,ICD10,mdb,mdd)
                VALUES(?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_tind($params) {
        $sql = "INSERT INTO TAB_PX_PULANG_RESUME_TIND(FS_KD_REG,FS_NM_TIND,ICD9CM,mdb,mdd)
                VALUES(?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function get_terapi_by_rg($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_TERAPI WHERE FS_KD_REG = ? ORDER BY FS_KD_TERAPI ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_terapi_by_rg2($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_TERAPI WHERE FS_KD_TERAPI = ? ORDER BY FS_KD_TERAPI ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
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

    function get_diag_by_rg2($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_RESUME_DIAG_SEK WHERE FS_KD_DIAG_SEK = ? ORDER BY FS_KD_DIAG_SEK ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
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

    function get_tindakan_by_rg2($params) {
        $sql = "SELECT * FROM TAB_PX_PULANG_RESUME_TIND WHERE FS_KD_TIND = ? ORDER BY FS_KD_TIND ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // delete surat masuk
    function delete_terapi($params) {
        $sql = "DELETE FROM TAB_PX_PULANG_TERAPI WHERE FS_KD_TERAPI = ?";
        return $this->db->query($sql, $params);
    }

    // delete surat masuk
    function delete_diag_sek($params) {
        $sql = "DELETE FROM TAB_PX_PULANG_RESUME_DIAG_SEK WHERE FS_KD_DIAG_SEK = ?";
        return $this->db->query($sql, $params);
    }

    function delete_tind($params) {
        $sql = "DELETE FROM TAB_PX_PULANG_RESUME_TIND WHERE FS_KD_TIND = ?";
        return $this->db->query($sql, $params);
    }

    function delete_diet($params) {
        $sql = "DELETE FROM TAB_PX_PULANG_RESUME_DIET WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function delete_indikasi($params) {
        $sql = "DELETE FROM TAB_PX_PULANG_RESUME_INDIKASI_RAWAT WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
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
            fs_kd_layanan3,fs_kd_layanan_akhir,aa.fs_kd_trs_kwitansi_klaim, aa.FS_KD_TRS_KWITANSI_SISADP, 
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
            ISNULL(uu.fs_kd_medis_sekunder,'') fs_kd_medis_sekunder,aa.fs_anamnese, 
            ISNULL(ww.fs_asal_jenazah,'')fs_asal_jenazah, ISNULL(ww.fs_yayasan_jenazah,'')fs_yayasan_jenazah,nn.fs_nm_peg 
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
 LEFT JOIN tab_px_pulang_resume xx1 ON aa.fs_kd_reg=xx1.fs_kd_reg
 LEFT JOIN  HOSPITAL.dbo.td_peg nn           ON xx1.fs_verif_dokter= nn.fs_kd_peg 
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

    // get email address for send attachment
    function get_pasien_by_mr($params) {
        $sql = "SELECT       TOP(10)aa.FS_KD_REG, right(cc.FS_MR, 8)fs_mr, aa.fd_tgl_masuk, aa.fd_tgl_keluar, cc.FS_NM_PASIEN, 
            ISNULL(HOSPITAL.dbo.ifa_GetAllDiagByKodeReg(aa.fs_kd_reg), '')  fs_kd_diagnosa, 
            bb.FS_NM_LAYANAN 
            FROM HOSPITAL.dbo.TA_Registrasi aa 
            INNER JOIN HOSPITAL.dbo.TA_Layanan bb ON bb.FS_KD_LAYANAN = aa.FS_KD_LAYANAN 
            INNER JOIN HOSPITAL.dbo.TC_MR cc ON cc.FS_MR = aa.FS_MR 
            LEFT JOIN HOSPITAL.dbo.TC_MR1 ee ON aa.FS_KD_REG = ee.fs_kd_reg 
            LEFT JOIN HOSPITAL.dbo.TC_KET_ICD_EMPTY ff ON ee.FS_KD_KET_ICD_EMPTY = ff.FS_KD_KET_ICD_EMPTY 
            Where cc.fs_mr = ? and aa.fd_tgl_void = '3000-01-01' AND bb.FS_KD_INSTALASI = 'RI'
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

    function get_all_resume($params) {
        $sql = "SELECT FS_KD_REG FROM TAB_PX_PULANG_RESUME WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
        }
    }

    function cek_resume($params) {
        $sql = "SELECT FS_KD_REG FROM TAB_PX_PULANG_RESUME WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            return $result;
        } else {
            return 0;
        }
    }

    function get_resume_by_rg($params) {
        $sql = "SELECT a.*,b.FS_NM_LAYANAN,c.FS_NM_LAYANAN AS 'FS_NM_LAYANAN2' ,d.user_name'created',
                e.user_name 'edited'
                FROM TAB_PX_PULANG_RESUME a
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN b ON a.FS_KD_LAYANAN=b.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN c ON a.FS_KD_LAYANAN2=c.FS_KD_LAYANAN
                LEFT JOIN COM_USER d ON a.mdb=d.user_id
                LEFT JOIN COM_USER e ON a.mdb_update=e.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON a.FS_VERIF_DOKTER=f.FS_KD_PEG
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
        }
    }

    function get_diet_by_rg($params) {
        $sql = "SELECT a.FS_KD_PX_PULANG_DIET,FS_NM_DIET,a.FS_KD_DIET FROM TAB_PX_PULANG_RESUME_DIET a LEFT JOIN TAB_PX_PULANG_DIET b ON a.FS_KD_DIET=b.FS_KD_DIET WHERE a.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            return $result;
        } else {
            return array();
        }
    }

    function get_indikasi_dirawat_by_rg($params) {
        $sql = "SELECT a.*,b.* FROM TAB_PX_PULANG_RESUME_INDIKASI_RAWAT a LEFT JOIN COM_PARAM_RM_40_INDIKASI_DIRAWAT b ON a.FS_KD_PARAM_INDIKASI_DIRAWAT=b.FS_KD_PARAM_INDIKASI_DIRAWAT WHERE a.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            return $result;
        } else {
            return array();
        }
    }

    // total surat masuk
    function get_all_diet() {
        $sql = "SELECT * FROM TAB_PX_PULANG_DIET ORDER BY FS_NM_DIET ASC";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_indikasi_dirawat() {
        $sql = "SELECT * FROM COM_PARAM_RM_40_INDIKASI_DIRAWAT ORDER BY FS_KD_PARAM_INDIKASI_DIRAWAT ASC";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_layanan() {
        $sql = "SELECT * FROM HOSPITAL.dbo.TA_LAYANAN WHERE FS_KD_INSTALASI = 'RJ' ORDER BY FS_NM_LAYANAN ASC";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_obat($params) {
        $sql = "SELECT FS_NAMA_OBAT,FS_DOSIS_OBAT,FS_INTERVAL
                FROM TAB_RM_17 
                WHERE FS_KD_REG = ? AND FS_JENIS_OBAT = '1'
                GROUP BY FS_NAMA_OBAT,FS_DOSIS_OBAT,FS_INTERVAL";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // update surat keluar
    function update_status($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME SET FS_STATUS='1'
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_dokter($params) {
        $sql = "UPDATE TAB_PX_PULANG_RESUME SET FS_VERIF_DOKTER=?
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function get_pasien_bangsal($params) {
        $sql = " SELECT     aa.fs_kd_reg,RIGHT(bb.fs_mr,8) 'FS_MR',
            ISNULL(ee.fs_nm_bed, ' ') fs_nm_bed, 
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien,cc.fd_tgl_lahir
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
 LEFT JOIN  HOSPITAL.dbo.ta_bangsal gg ON ff.fs_kd_bangsal = gg.fs_kd_bangsal";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_pasien_bangsal_by_bangsal($params) {
        $sql = " SELECT     aa.fs_kd_reg,RIGHT(bb.fs_mr,8) 'FS_MR',
            ISNULL(ee.fs_nm_bed, ' ') fs_nm_bed, 
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien,cc.fd_tgl_lahir
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
            WHERE dd.fs_kd_layanan = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
function get_no_skdp($params) {
        $sql = "SELECT MAX(FS_NO_SKDP) 'NOSKDP' FROM TAC_RJ_SKDP WHERE MONTH(mdd) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
   function get_daftar_dokter($params) {
        $sql = "SELECT DISTINCT    aa.fs_kd_peg, fs_nm_alias, fs_nm_peg,dd.fs_kd_layanan
                FROM   HOSPITAL.dbo.td_peg aa  
                INNER JOIN HOSPITAL.dbo.TD_PEG_LAYANAN bb ON aa.FS_KD_PEG = bb.FS_KD_PEG
                INNER JOIN HOSPITAL.dbo.TD_PEG_SAT_TUGAS cc ON aa.FS_KD_PEG = cc.FS_KD_PEG
                INNER JOIN HOSPITAL.dbo.TA_LAYANAN dd ON bb.FS_KD_LAYANAN = dd.FS_KD_LAYANAN
                INNER JOIN HOSPITAL.dbo.TA_INSTALASI ee ON dd.FS_KD_INSTALASI = ee.FS_KD_INSTALASI
                WHERE  dd.fs_kd_layanan = ?  and
                aa.FB_AKTIF_DINAS = 'True' AND
                aa.FS_KD_PEG <> 'S000' AND
                cc.FS_KD_SAT_TUGAS = 'MD' AND
                ee.FS_KD_INSTALASI_DK = '2'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
   function get_daftar_jadwal($params) {
        $sql = "SELECT * FROM HOSPITAL.dbo.TA_JADWAL_DOKTER a 
                JOIN HOSPITAL.dbo.if_get_kalender(?,?) b ON a.FN_HARI=b.fn_hari
                WHERE a.FS_KD_DOKTER = ?   
                order by b.fd_tgl ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
   function cek_status_pulang($params) {
        $sql = "SELECT FS_CARA_PULANG FROM TAB_PX_PULANG_RESUME
                WHERE FS_KD_REG = ?   
                ORDER BY FS_KD_REG DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
}
