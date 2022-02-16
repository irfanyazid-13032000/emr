<?php namespace App\Models;

class M_far_rekon {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }
    
    function insert($params) {
        $sql = "INSERT INTO TAC_FAR_REKON(FS_KD_REG, FS_KD_OBAT, FS_DOSIS, FS_KD_SATUAN, FS_FREKUENSI, FS_CARA_PEMBERIAN, FS_TINDAK_LANJUT, 
                FS_PERUBAHAN, FS_STATUS, mdb, mdd, FS_KD_OBAT2,FS_KD_LAYANAN_ASAL,FS_KD_LAYANAN_AKHIR)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    
    function delete_process($params) {
        $sql = "UPDATE TAC_FAR_REKON SET mdd_void = ?, mdb_void=? WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }
     function get_pasien_by_rg($params) {
        $sql = " SELECT hh.FD_TGL_LAHIR,hh.FS_ALM_PASIEN, aa.fs_kd_reg,aa.fd_tgl_masuk, aa.fs_jam_masuk, aa.fs_kd_petugas, aa.fd_tgl_void, aa.fs_jam_void,  m.FS_NM_PEKERJAAN_DK, n.FS_NM_PENDIDIKAN_DK, 
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
    
    function get_resep_by_rg($params) {
        $sql = "SELECT FS_KD_BARANG,FS_NM_BARANG,FN_QTY_BARANG,FS_KD_SATUAN 
                FROM HOSPITAL.dbo.TB_TRS_DOBILL_UMUM a
                LEFT JOIN HOSPITAL.dbo.TB_TRS_DOBILL_UMUM2 b ON a.FS_KD_TRS=b.FS_KD_TRS
                WHERE a.FS_KD_REG = ? AND FD_TGL_VOID = '3000-01-01' AND FS_KD_TRS_GEN = ''";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_resep($params) {
        $sql = "SELECT FS_KD_BARANG,FS_NM_BARANG 
                FROM HOSPITAL.dbo.TB_BARANG 
                WHERE FB_AKTIF = '1' AND FS_KD_GRUP_REK = '001'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_unit($params) {
        $sql = "SELECT FS_KD_LAYANAN,FS_NM_LAYANAN
                FROM HOSPITAL.dbo.TA_LAYANAN
                WHERE FB_AKTIF = '1' ORDER BY FS_NM_LAYANAN ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_sat_barang($params) {
        $sql = "SELECT FS_KD_SAT_JUAL,FS_NM_BARANG
                FROM HOSPITAL.dbo.TB_BARANG 
                WHERE FS_KD_BARANG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
        
    function get_list_rekon_by_rg($params) {
        $sql = "SELECT a.*,b.FS_NM_BARANG,c.FS_NM_PEG,d.FS_NM_LAYANAN 'LAYANAN_AWAL'
                ,e.FS_NM_LAYANAN 'LAYANAN_AKHIR'
                FROM TAC_FAR_REKON a
                LEFT JOIN HOSPITAL.dbo.TB_BARANG b ON a.FS_KD_OBAT=b.FS_KD_BARANG
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON a.mdb=c.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON a.FS_KD_LAYANAN_ASAL=d.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN e ON a.FS_KD_LAYANAN_AKHIR=e.FS_KD_LAYANAN
                WHERE FS_KD_REG = ? AND mdd_void = '3000-01-01'";
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