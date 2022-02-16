<?php namespace App\Models;

class M_kep {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function insert($params) {
        $sql = "INSERT INTO TAC_RI_RENC_KEP(FS_KD_REG, FS_KD_DAFTAR_DIAGNOSA, FS_KD_NOC, FD_TGL_DICAPAI, FD_JAM_DICAPAI, FS_KD_INDIKATOR, FS_KD_NIC, mdb, 
                mdd, mdd_time)
                VALUES (?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    
    function insert_rincian_px($params) {
        $sql = "INSERT INTO TAC_RI_RENC_KEP2(FS_KD_RENC_KEP, FS_KD_NIC2)
                VALUES (?,?)";
        return $this->db->query($sql, $params);
    }
    
    function insert_diagnosa($params) {
        $sql = "INSERT INTO TAC_COM_DAFTAR_DIAG(FS_NM_DIAGNOSA)
                VALUES(?)";
        return $this->db->query($sql, $params);
    }

    function insert_noc($params) {
        $sql = "INSERT INTO TAC_COM_NOC(FS_KD_DAFTAR_DIAGNOSA, FS_NM_NOC)
                VALUEs (?,?)";
        return $this->db->query($sql, $params);
    }
    
    function insert_indikator($params) {
        $sql = "INSERT INTO TAC_COM_INDIKATOR(FS_KD_DAFTAR_DIAGNOSA, FS_KD_NOC, FS_NM_INDIKATOR)
                VALUEs (?,?,?)";
        return $this->db->query($sql, $params);
    }
    
    function insert_perencanaan($params) {
        $sql = "INSERT INTO TAC_COM_NIC(FS_KD_DAFTAR_DIAGNOSA, FS_KD_NOC, FS_KD_INDIKATOR, FS_NM_NIC)
                VALUEs (?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    
    function insert_rincian($params) {
        $sql = "INSERT INTO TAC_COM_NIC2(FS_KD_DAFTAR_DIAGNOSA, FS_KD_NOC, FS_KD_INDIKATOR, FS_KD_NIC, FS_NM_NIC2)
                VALUEs (?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    
    function insert_tindakan_kep($params) {
        $sql = "INSERT INTO TAC_RI_TIND_KEP(FS_KD_REG, FS_TINDKAN_KEP, FD_TGL_TINDKAN_KEP, FD_JAM_TINDKAN_KEP, mdb, mdd, mdd_time,FS_KD_TRS_KEP_TINDAKAN)
                VALUES (?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    
    function update_diagnosa($params) {
        $sql = "UPDATE TAC_COM_DAFTAR_DIAG SET FS_NM_DIAGNOSA = ? WHERE FS_KD_DAFTAR_DIAGNOSA = ?";
        return $this->db->query($sql, $params);
    }
    
    function update_noc($params) {
        $sql = "UPDATE TAC_COM_NOC SET FS_KD_DAFTAR_DIAGNOSA = ? ,FS_NM_NOC=? WHERE FS_KD_NOC = ?";
        return $this->db->query($sql, $params);
    }
    
    function update_indikator($params) {
        $sql = "UPDATE TAC_COM_INDIKATOR SET FS_KD_DAFTAR_DIAGNOSA = ? ,FS_KD_NOC=?,FS_NM_INDIKATOR=? WHERE FS_KD_INDIKATOR = ?";
        return $this->db->query($sql, $params);
    }
    
    function update_perencanaan($params) {
        $sql = "UPDATE TAC_COM_NIC SET FS_KD_DAFTAR_DIAGNOSA = ? ,FS_KD_NOC=?,FS_KD_INDIKATOR=?,FS_NM_NIC=? WHERE FS_KD_NIC = ?";
        return $this->db->query($sql, $params);
    }
    
    function update_rincian($params) {
        $sql = "UPDATE TAC_COM_NIC2 SET FS_KD_DAFTAR_DIAGNOSA = ? ,FS_KD_NOC=?,FS_KD_INDIKATOR=?,FS_KD_NIC=?,FS_NM_NIC2=? WHERE FS_KD_NIC2 = ?";
        return $this->db->query($sql, $params);
    }

    function delete_diagnosa($params) {
        $sql = "DELETE TAC_COM_DAFTAR_DIAG 
                WHERE FS_KD_DAFTAR_DIAGNOSA = ?";
        return $this->db->query($sql, $params);
    }
    
    function delete_noc($params) {
        $sql = "DELETE TAC_COM_NOC 
                WHERE FS_KD_NOC = ?";
        return $this->db->query($sql, $params);
    }
    
    function delete_indikator($params) {
        $sql = "DELETE TAC_COM_INDIKATOR 
                WHERE FS_KD_INDIKATOR = ?";
        return $this->db->query($sql, $params);
    }
    
    function delete_perencanaan($params) {
        $sql = "DELETE TAC_COM_NIC 
                WHERE FS_KD_NIC = ?";
        return $this->db->query($sql, $params);
    }
    
    function delete_rincian($params) {
        $sql = "DELETE TAC_COM_NIC2 
                WHERE FS_KD_NIC2 = ?";
        return $this->db->query($sql, $params);
    }
    
    function delete($params) {
        $sql = "DELETE TAC_RI_RENC_KEP2 
                WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }
   
    // get site data
    function get_layanan($params) {
        $sql = "SELECT a.FS_KD_LAYANAN,a.FS_NM_LAYANAN FROM
                HOSPITAL.dbo.TA_LAYANAN a
                WHERE a.FS_KD_INSTALASI = 'RJ' AND a.FB_AKTIF = '1'
                ORDER BY a.FS_NM_LAYANAN ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function cek_ass_jatuh($params) {
        $sql = "SELECT FS_KD_REG FROM TAC_RI_JATUH2 WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_pasien_bangsal($params) {
        $sql = " SELECT     aa.fs_kd_reg, RIGHT(bb.fs_mr,8) 'FS_MR',
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
        $sql = " SELECT     aa.fs_kd_reg, RIGHT(bb.fs_mr,8) 'FS_MR',
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
    
    function get_pasien_by_rg($params) {
        $sql = " SELECT hh.FD_TGL_LAHIR,hh.FS_ALM_PASIEN, aa.fs_kd_reg,aa.fd_tgl_masuk, aa.fs_jam_masuk, aa.fs_kd_petugas, aa.fd_tgl_void, aa.fs_jam_void, 
            www.fs_nm_agama, zzz.fs_nm_bed, hh.fs_kd_identitas, hh.FS_JNS_KELAMIN,
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
            aa.fs_kd_sesion_poli,aa.fs_anamnese,aa.fs_kd_trs_antrian, aa.fs_kd_trs_antrian2, aa.fs_kd_trs_antrian3, hh.fs_kd_identitas,
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
            ISNULL(ww.fs_asal_jenazah,'')fs_asal_jenazah, ISNULL(ww.fs_yayasan_jenazah,'')fs_yayasan_jenazah,nn.fs_nm_peg,
            hh.FS_HIGH_RISK,hh.FS_ALERGI,hh.FS_REAK_ALERGI,FS_NM_PEKERJAAN_DK,FS_NM_PENDIDIKAN_DK,(substring(HOSPITAL.dbo.if_get_umur_by_reg(aa.fs_kd_reg),1,3)+' Thn '+substring(HOSPITAL.dbo.if_get_umur_by_reg(aa.fs_kd_reg),5,2)+' bln ' 
            +right(HOSPITAL.dbo.if_get_umur_by_reg(aa.fs_kd_reg),2)+' hr')as fs_umur 
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
            LEFT JOIN HOSPITAL.dbo.TA_PEKERJAAN_DK m ON hh.FS_KD_PEKERJAAN_DK=m.FS_KD_PEKERJAAN_DK
            LEFT JOIN HOSPITAL.dbo.TA_PENDIDIKAN_DK n ON hh.FS_KD_PENDIDIKAN_DK=n.FS_KD_PENDIDIKAN_DK
            LEFT JOIN  HOSPITAL.dbo.ta_agama www ON hh.fs_kd_agama = www.fs_kd_agama
            LEFT JOIN  HOSPITAL.dbo.ta_trs_bed zz     ON aa.fs_kd_reg = zz.fs_kd_reg
            LEFT JOIN  HOSPITAL.dbo.ta_bed zzz ON zz.fs_kd_bed = zzz.fs_kd_bed
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

    function get_diagnosa($params) {
        $sql = "SELECT * FROM
                TAC_COM_DAFTAR_DIAG
                ORDER BY FS_NM_DIAGNOSA ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_daftar_diag($params) {
        $sql = "SELECT * FROM
                TAC_COM_DAFTAR_DIAG
                WHERE FS_KD_ASES = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_daftar_noc($params) {
        $sql = "SELECT * FROM
                TAC_COM_NOC
                WHERE FS_KD_DAFTAR_DIAGNOSA = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_daftar_indikator($params) {
        $sql = "SELECT * FROM
                TAC_COM_INDIKATOR
                WHERE FS_KD_NOC = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_daftar_nic($params) {
        $sql = "SELECT *
                FROM TAC_COM_NIC 
                WHERE FS_KD_INDIKATOR = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
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
    
   
    function get_daftar_nic2($params) {
        $sql = "SELECT *
                FROM TAC_COM_NIC2
                WHERE FS_KD_NIC = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    
    function get_diagnosa_by_id($params) {
        $sql = "SELECT *
                FROM TAC_COM_DAFTAR_DIAG
                WHERE FS_KD_DAFTAR_DIAGNOSA = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_noc($params) {
        $sql = "SELECT *
                FROM TAC_COM_NOC a
                INNER JOIN TAC_COM_DAFTAR_DIAG b ON a.FS_KD_DAFTAR_DIAGNOSA=b.FS_KD_DAFTAR_DIAGNOSA
                ORDER BY b.FS_NM_DIAGNOSA ASC ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_noc_by_id($params) {
        $sql = "SELECT *
                FROM TAC_COM_NOC a
                INNER JOIN TAC_COM_DAFTAR_DIAG b ON a.FS_KD_DAFTAR_DIAGNOSA=b.FS_KD_DAFTAR_DIAGNOSA
                WHERE a.FS_KD_NOC = ?
                ORDER BY b.FS_NM_DIAGNOSA ASC ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_indikator($params) {
        $sql = "SELECT *
                FROM TAC_COM_INDIKATOR a
                INNER JOIN TAC_COM_NOC b ON a.FS_KD_NOC=b.FS_KD_NOC
                INNER JOIN TAC_COM_DAFTAR_DIAG c ON a.FS_KD_DAFTAR_DIAGNOSA=c.FS_KD_DAFTAR_DIAGNOSA
                ORDER BY c.FS_NM_DIAGNOSA ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_indikator_by_id($params) {
        $sql = "SELECT *
                FROM TAC_COM_INDIKATOR a
                INNER JOIN TAC_COM_NOC b ON a.FS_KD_NOC=b.FS_KD_NOC
                INNER JOIN TAC_COM_DAFTAR_DIAG c ON c.FS_KD_DAFTAR_DIAGNOSA=a.FS_KD_DAFTAR_DIAGNOSA
                WHERE a.FS_KD_INDIKATOR=?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_perencanaan($params) {
        $sql = "SELECT *
                FROM TAC_COM_NIC a
                INNER JOIN TAC_COM_INDIKATOR b ON a.FS_KD_INDIKATOR=b.FS_KD_INDIKATOR
                INNER JOIN TAC_COM_NOC c ON a.FS_KD_NOC=c.FS_KD_NOC
                INNER JOIN TAC_COM_DAFTAR_DIAG d ON a.FS_KD_DAFTAR_DIAGNOSA=d.FS_KD_DAFTAR_DIAGNOSA
                ORDER BY d.FS_NM_DIAGNOSA ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_perencanaan_by_id($params) {
        $sql = "SELECT *
                FROM TAC_COM_NIC a
                INNER JOIN TAC_COM_INDIKATOR b ON a.FS_KD_INDIKATOR=b.FS_KD_INDIKATOR
                INNER JOIN TAC_COM_NOC c ON a.FS_KD_NOC=c.FS_KD_NOC
                INNER JOIN TAC_COM_DAFTAR_DIAG d ON a.FS_KD_DAFTAR_DIAGNOSA=d.FS_KD_DAFTAR_DIAGNOSA
                WHERE FS_KD_NIC = ?
                ORDER BY d.FS_NM_DIAGNOSA ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_rincian($params) {
        $sql = "SELECT *
                FROM TAC_COM_NIC2 a
                INNER JOIN TAC_COM_NIC b ON a.FS_KD_NIC=b.FS_KD_NIC
                INNER JOIN TAC_COM_INDIKATOR c ON a.FS_KD_INDIKATOR=c.FS_KD_INDIKATOR
                INNER JOIN TAC_COM_NOC d ON a.FS_KD_NOC=d.FS_KD_NOC
                INNER JOIN TAC_COM_DAFTAR_DIAG e ON a.FS_KD_DAFTAR_DIAGNOSA=e.FS_KD_DAFTAR_DIAGNOSA
                ORDER BY e.FS_NM_DIAGNOSA ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_rincian_by_id($params) {
        $sql = "SELECT *
                FROM TAC_COM_NIC2 a
                INNER JOIN TAC_COM_NIC b ON a.FS_KD_NIC=b.FS_KD_NIC
                INNER JOIN TAC_COM_INDIKATOR c ON a.FS_KD_INDIKATOR=c.FS_KD_INDIKATOR
                INNER JOIN TAC_COM_NOC d ON a.FS_KD_NOC=d.FS_KD_NOC
                INNER JOIN TAC_COM_DAFTAR_DIAG e ON a.FS_KD_DAFTAR_DIAGNOSA=e.FS_KD_DAFTAR_DIAGNOSA
                WHERE a.FS_KD_NIC2=?
                ORDER BY e.FS_NM_DIAGNOSA ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

  
    function get_rm_px_by_rg($params) {
        $sql = "SELECT FS_MR
                FROM HOSPITAL.dbo.TA_REGISTRASI
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_rencana_kep_by_rg($params) {
        $sql = "SELECT a.*,FS_NM_DIAGNOSA,FS_NM_NOC,FS_NM_INDIKATOR,FS_NM_NIC,FS_NM_PEG
                FROM TAC_RI_RENC_KEP a
                INNER JOIN TAC_COM_NIC d ON a.FS_KD_NIC=d.FS_KD_NIC
                INNER JOIN TAC_COM_INDIKATOR e ON a.FS_KD_INDIKATOR=e.FS_KD_INDIKATOR
                INNER JOIN TAC_COM_NOC f ON a.FS_KD_NOC=f.FS_KD_NOC
                INNER JOIN TAC_COM_DAFTAR_DIAG g ON a.FS_KD_DAFTAR_DIAGNOSA=g.FS_KD_DAFTAR_DIAGNOSA
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON a.mdb=h.FS_KD_PEG
                WHERE a.FS_KD_REG=?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_rincian_kep_by_id($params) {
        $sql = "SELECT *
                FROM TAC_RI_RENC_KEP2 a
                LEFT JOIN TAC_COM_NIC2 b ON a.FS_KD_NIC2=b.FS_KD_NIC2
                WHERE FS_KD_RENC_KEP = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_tindakan_kep_by_rg($params) {
        $sql = "SELECT a.*,b.FS_NM_PEG,c.FS_NM_KEP_TINDAKAN
                FROM TAC_RI_TIND_KEP a
		LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.mdb=b.FS_KD_PEG
                LEFT JOIN TAC_COM_KEP_TINDAKAN c ON a.FS_KD_TRS_KEP_TINDAKAN=c.FS_KD_TRS
                WHERE FS_KD_REG = ?
                ORDER BY a.FS_KD_TRS DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_data_kebidanan_by_rg($params) {
        $sql = "SELECT *
                FROM TAC_RI_ASES_KEBID
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_masalah_by_rg($params) {
        $sql = "SELECT FS_NM_MASALAH_KEP 
                FROM TAC_RI_MASALAH_KEP a 
                LEFT JOIN TAC_COM_PARAM_MASALAH_KEP b ON a.FS_KD_MASALAH_KEP=b.FS_KD_TRS
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

    function get_data_jatuh_by_rg($params) {
        $sql = "SELECT *
                FROM TAC_RI_JATUH
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_ases2_by_rg($params) {
        $sql = "SELECT *
                FROM TAC_RI_ASES_PER2
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_masalah_kep_by_rg($params) {
        $sql = "SELECT FS_NM_DIAGNOSA
                FROM TAC_RI_MASALAH_KEP a
                LEFT JOIN TAC_COM_DAFTAR_DIAG b ON a.FS_KD_MASALAH_KEP=b.FS_KD_DAFTAR_DIAGNOSA
                WHERE a.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_medis_by_rg($params) {
        $sql = "SELECT a.*,c.FS_NM_PEG,b.user_name
                FROM TAC_RI_MEDIS a
                LEFT JOIN TAC_COM_USER b ON a.mdb=b.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON b.user_name=c.FS_KD_PEG
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_medis_by_rg2($params) {
        $sql = "SELECT a.*,c.FS_NM_PEG,b.user_name,c.FS_NO_IJIN_PRAKTEK,d.FD_TGL_RUJUKAN
                FROM TAC_RI_MEDIS a
                LEFT JOIN TAC_COM_USER b ON a.mdb=b.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON b.user_name=c.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_SEP d ON a.FS_KD_REG = d.FS_KD_REG
                WHERE a.FS_KD_REG = ? AND a.FS_KD_TRS = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_medis_hd_by_rg2($params) {
        $sql = "SELECT a.*,c.FS_NM_PEG,b.user_name,c.FS_NO_IJIN_PRAKTEK,d.FD_TGL_RUJUKAN,e.*
                FROM TAC_RI_MEDIS a
                LEFT JOIN TAC_COM_USER b ON a.mdb=b.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON b.user_name=c.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_SEP d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_HD_INSTRUKSI_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
                WHERE a.FS_KD_REG = ? AND a.FS_KD_TRS = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_instruksi_medis_hd_by_rg($params) {
        $sql = "SELECT *
                FROM TAC_HD_INSTRUKSI_MEDIS
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_skdp_by_rg($params) {
        $sql = "SELECT a.*,b.FS_NM_SKDP_ALASAN,c.FS_NM_SKDP_RENCANA
                FROM TAC_RI_SKDP a
                LEFT JOIN TAC_COM_PARAMETER_SKDP_ALASAN b ON a.FS_SKDP_1=b.FS_KD_TRS
                LEFT JOIN TAC_COM_PARAMETER_SKDP_RENCANA c ON a.FS_SKDP_2=c.FS_KD_TRS
                WHERE a.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_prb_by_rg($params) {
        $sql = "SELECT FS_PROVIDER,FD_TGL_RUJUKAN
                FROM HOSPITAL.dbo.TA_TRS_SEP
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_terapi_by_rg($params) {
        $sql = "SELECT FS_NM_BARANG,FN_QTY_BARANG,FS_NM_SATUAN,FS_NM_CARAPAKAI_ETIKET,FS_ETIKET_QTY, 
                FS_ETIKET_HARI,FS_NM_CARAPAKAI_ETIKET,FS_NM_SATUANPAKAI_ETIKET,FS_ETIKET_CATATAN,FS_ETIKET 
                FROM HOSPITAL.dbo.TB_TRS_DOBILL_UMUM a
                LEFT JOIN HOSPITAL.dbo.TB_TRS_DOBILL_UMUM2 b ON a.FS_KD_TRS=b.FS_KD_TRS 
                LEFT JOIN HOSPITAL.dbo.TB_CARAPAKAI_ETIKET c ON b.FS_ETIKET_KD_PAKAI=c.FS_KD_CARAPAKAI_ETIKET 
                LEFT JOIN HOSPITAL.dbo.TB_SATUANPAKAI_ETIKET d ON b.FS_ETIKET_KD_SATUAN_PAKAI=d.FS_KD_SATUANPAKAI_ETIKET 
                WHERE a.FS_KD_REG = ? AND (a.FS_KD_LAYANAN = 'O004' OR a.FS_KD_LAYANAN = 'O005') AND FS_JAM_VOID <> '3000-01-01'
                ORDER BY FN_NO_URUT";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_data_lab_by_rg($params) {
        $sql = " select     aa.fs_kd_trs, aa.fd_tgl_trs, cc.FS_NM_TARIF, bb.fs_kd_jenis_pemeriksaan, dd.fs_nm_jenis_pemeriksaan, 
            dd.FS_SATUAN , bb.FS_HASIL, bb.FS_KETERANGAN, bb.fb_verifikasi_jenis 
            from       HOSPITAL.dbo.TA_TRS_TDK_UMUM aa 
            inner join HOSPITAL.dbo.TA_TRS_TDK_UMUM5 bb on aa.fs_kd_trs = bb.FS_KD_TRS 
                       and bb.FS_HASIL <> '' and bb.FS_HASIL <> 'HASIL MENYUSUL' 
            left join  HOSPITAL.dbo.TA_TARIF cc on bb.FS_KD_TARIF = cc.FS_KD_TARIF 
            left join  HOSPITAL.dbo.TA_JENIS_PEMERIKSAAN dd on bb.FS_KD_JENIS_PEMERIKSAAN = dd.fs_kd_jenis_pemeriksaan 
            where      aa.fd_tgl_void = '3000-01-01' 
                       AND aa.fs_kd_reg = ? order by aa.fs_kd_trs ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_data_rad_by_rg($params) {
        $sql = "  select     aa.fs_kd_trs, bb.fd_tgl_keterangan, bb.fs_jam_keterangan, cc.FS_NM_TARIF, bb.fs_keterangan 
                from       HOSPITAL.dbo.TA_TRS_TDK_UMUM aa 
                left join  HOSPITAL.dbo.TA_TRS_TDK_UMUM2 bb on aa.fs_kd_trs = bb.fs_kd_trs and fs_keterangan <> '' 
                left join  HOSPITAL.dbo.TA_TARIF cc on bb.fs_kd_tarif = cc.fs_kd_tarif 
                where      aa.fd_tgl_void = '3000-01-01' and bb.fb_void = 0 
                           AND aa.fs_kd_reg = ? order by bb.fs_kd_trs2 ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_no_kp() {
        $sql = "SELECT RIGHT(FN_VALUE+100000000,7)'KP'  FROM   HOSPITAL.dbo.tz_parameter_no  WHERE  fs_kd_parameter= 'NOKRTPRKSA'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_cek_rm($params) {
        $sql = "SELECT FS_KD_REG  FROM TAC_RI_MEDIS WHERE FS_KD_REG= ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_tac_com_parameter_alasan($params) {
        $sql = "SELECT *  FROM TAC_COM_PARAMETER_SKDP_ALASAN";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_planning($params) {
        $sql = "SELECT * FROM TAC_COM_PARAM_PLANNING";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_spiritual($params) {
        $sql = "SELECT * FROM TAC_COM_PARAM_SPIRITUAL";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_edukasi($params) {
        $sql = "SELECT * FROM TAC_COM_PARAM_EDUKASI";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_masalah_kep_by_rg($params) {
        $sql = "SELECT * FROM TAC_RI_MASALAH_KEP WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_rencana_kep_by_rg($params) {
        $sql = "SELECT * FROM TAC_RI_REN_KEP WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function list_keb_spiritual_by_rg($params) {
        $sql = "SELECT FS_KD_SPIRITUAL
               FROM TAC_RI_SPIRITUAL
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
    function list_edukasi_by_rg($params) {
        $sql = "SELECT FS_KD_EDUKASI
               FROM TAC_RI_EDUKASI
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
    function list_planning_by_rg($params) {
        $sql = "SELECT FS_KD_PLANNING
               FROM TAC_RI_PLANNING
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
    
    function list_kep_tindakan_by_rg($params) {
        $sql = "SELECT *
               FROM TAC_COM_KEP_TINDAKAN
               ORDER BY FS_NM_KEP_TINDAKAN";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

     function get_pasien_bangsal_kby($params) {
        $sql = " SELECT     aa.fs_kd_reg, RIGHT(bb.fs_mr,8) 'FS_MR',
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
            WHERE dd.fs_kd_layanan = 'B15' OR dd.fs_kd_layanan = 'B18'";
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
