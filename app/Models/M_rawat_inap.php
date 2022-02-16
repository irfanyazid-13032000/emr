<?php namespace App\Models;



class M_rawat_inap {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

     function insert($params) {
        $sql = "INSERT
                INTO TAC_RI_MEDIS(FS_KD_KP, FS_KD_REG, FS_DIAGNOSA, FS_ANAMNESA, FS_TINDAKAN, FS_TERAPI, FS_CATATAN_FISIK, FS_KD_MEDIS, 
                FS_CARA_PULANG, FS_DAFTAR_MASALAH, FS_PLANNING_LAB, FS_PLANNING_RAD, FS_HASIL_PEMERIKSAAN_PENUNJANG,FS_STATUS,FS_MR, mdb, mdd, FS_JAM_TRS)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
     function update($params) {
        $sql = "UPDATE TAC_RI_MEDIS SET FS_DIAGNOSA=?, FS_ANAMNESA=?, FS_TINDAKAN=?, FS_TERAPI=?, FS_CATATAN_FISIK=?, FS_KD_MEDIS=?, 
                FS_CARA_PULANG=?, FS_DAFTAR_MASALAH=?, FS_PLANNING_LAB=?,FS_PLANNING_RAD=?, FS_HASIL_PEMERIKSAAN_PENUNJANG=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }
    
    function get_resume_by_rg($params) {
        $sql = "SELECT a.*,b.FS_NM_LAYANAN,c.FS_NM_LAYANAN AS 'FS_NM_LAYANAN2' ,d.FS_NM_PEG
                FROM TAB_PX_PULANG_RESUME a
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN b ON a.FS_KD_LAYANAN=b.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN c ON a.FS_KD_LAYANAN2=c.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_VERIF_DOKTER=d.FS_KD_PEG
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
        }
    }
    
     function get_pasien_bangsal($params) {
        $sql = " SELECT     aa.fs_kd_reg, bb.fs_mr, 
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
            WHERE bb.FS_KD_MEDIS = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
     function get_pasien_bangsal_admin($params) {
        $sql = " SELECT     aa.fs_kd_reg, bb.fs_mr, 
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
    
    function cek_rawat_inap($params) {
        $sql = "SELECT FS_KD_REG FROM TAC_RI_MEDIS WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
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
    
    function get_data_medis_by_rg2($params) {
        $sql = "SELECT a.*,c.FS_NM_PEG,b.user_name,c.FS_NO_IJIN_PRAKTEK,d.FD_TGL_RUJUKAN
                FROM TAC_RJ_MEDIS a
                LEFT JOIN TAC_COM_USER b ON a.mdb=b.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON b.user_name=c.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_SEP d ON a.FS_KD_REG = d.FS_KD_REG
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
    
    function list_masalah_kep_by_rg($params) {
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
            ISNULL(ww.fs_asal_jenazah,'')fs_asal_jenazah, ISNULL(ww.fs_yayasan_jenazah,'')fs_yayasan_jenazah,nn.fs_nm_peg,
            FS_NM_PEKERJAAN_DK,FS_NM_PENDIDIKAN_DK,(substring(HOSPITAL.dbo.if_get_umur_by_reg(aa.fs_kd_reg),1,3)+' Thn '+substring(HOSPITAL.dbo.if_get_umur_by_reg(aa.fs_kd_reg),5,2)+' bln ' 
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
    
    function get_px_by_dokter_by_rg2($params) {
        $sql = "SELECT a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,a.FS_JNS_KELAMIN,a.FS_KD_IDENTITAS,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,f.FS_NM_LAYANAN,b.FS_KD_LAYANAN,
                b.FS_KD_LAYANAN2,b.FS_KD_LAYANAN3,b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB,h.FS_NM_PEG 'DOK2',
                i.FS_KD_TRS,a.FS_TEMP_LAHIR,b.FS_NO_SJP,j.FS_NM_LAYANAN 'LAYANAN_AKHIR',k.*,FS_HIGH_RISK,FS_ALERGI,
                FS_RIW_PENYAKIT_DAHULU,FS_RIW_PENYAKIT_DAHULU2,b.FS_JAM_MASUK
                FROM HOSPITAL.dbo.TC_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN c ON b.FS_KD_TIPE_JAMINAN=c.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN d ON c.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON b.FS_KD_MEDIS=e.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON b.FS_KD_MEDIS2=h.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN f ON b.FS_KD_LAYANAN=f.FS_KD_LAYANAN
                LEFT JOIN TAC_RJ_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS i ON b.FS_KD_REG=i.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN j ON b.FS_KD_LAYANAN_AKHIR=j.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TA_TRS_SEP k ON b.FS_KD_REG=k.FS_KD_REG
                WHERE b.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
	
	function get_px_by_dokter_by_rg3($params) {
        $sql = "SELECT b.FS_NO_PESERTA,a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN,l.FS_NO_LAB,l.FD_TGL_TRS,a.FS_ALM2_PASIEN,FS_ALM3_PASIEN, l.FS_JAM_TRS,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,ee.fs_nm_jenis_pemeriksaan,aa.updtgl,l.fd_tgl_hasil_lab, jj.fs_hasil,jj.fs_kd_jenis_pemeriksaan,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,FS_NM_LAYANAN,b.FS_KD_LAYANAN,i.FS_ANAMNESA,i.FS_DIAGNOSA,
                b.FS_KD_LAYANAN2,b.FS_KD_LAYANAN3,b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB,h.FS_NM_PEG 'DOK2',
                l.FS_KD_TRS,a.FS_TEMP_LAHIR,b.FS_NO_SJP,a.FS_HIGH_RISK,i.mdd,a.FS_ALERGI,f.FS_KD_LAYANAN_BPJS,a.FS_NM_SUAMI,a.FS_TGL_LAHIR_SUAMI,m.FS_NM_PEKERJAAN_DK,
                b.FS_NO_SJP,b.FS_KD_TIPE_JAMINAN,k.FS_KD_TRS AS 'FS_KD_TRS_KP',a.FS_REAK_ALERGI, bbb.FS_NM_USER
                FROM HOSPITAL.dbo.TC_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN c ON b.FS_KD_TIPE_JAMINAN=c.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN d ON c.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON b.FS_KD_MEDIS=e.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON b.FS_KD_MEDIS2=h.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN f ON b.FS_KD_LAYANAN=f.FS_KD_LAYANAN
				LEFT JOIN HOSPITAL.dbo.TA_PEKERJAAN_DK m ON a.FS_KD_PEKERJAAN_DK=m.FS_KD_PEKERJAAN_DK
                LEFT JOIN TAC_RJ_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS i ON b.FS_KD_REG=i.FS_KD_REG
                LEFT JOIN TAC_RJ_ALERGI j ON b.FS_KD_REG=j.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA k ON b.FS_KD_REG=k.FS_KD_REG
				LEFT JOIN HOSPITAL.dbo.TA_TRS_TDK_UMUM l ON b.FS_KD_REG=l.FS_KD_REG
				LEFT  JOIN  HOSPITAL.dbo.ta_trs_tdk_umum2 aa ON l.fs_kd_trs=aa.fs_kd_trs
				LEFT  JOIN  HOSPITAL.dbo.ta_tarif bb ON aa.fs_kd_tarif=bb.fs_kd_tarif
				LEFT  JOIN  HOSPITAL.dbo.ta_grup_jenis_pemeriksaan cc ON bb.fs_kd_grup_jenis_pemeriksaan = cc.fs_kd_grup_jenis_pemeriksaan 
				LEFT  JOIN  HOSPITAL.dbo.ta_tarif6 dd ON bb.fs_kd_tarif=dd.fs_kd_tarif
				LEFT  JOIN  HOSPITAL.dbo.ta_jenis_pemeriksaan ee ON dd.fs_kd_jenis_pemeriksaan=ee.fs_kd_jenis_pemeriksaan  
				LEFT  JOIN  HOSPITAL.dbo.ta_grup_jenis_pemeriksaan_sub gg ON ee.fs_kd_grup_jenis_pemeriksaan_sub = gg.fs_kd_grup_jenis_pemeriksaan_sub
				LEFT  JOIN  HOSPITAL.dbo.ta_metode_uji  hh ON hh.fs_kd_metode_uji=ee.fs_kd_metode_uji
				LEFT  JOIN  HOSPITAL.dbo.ta_trs_tdk_umum5 jj ON l.fs_kd_trs=jj.fs_kd_trs
				INNER JOIN HOSPITAL.dbo.tz_user bbb ON b.fs_kd_petugas = bbb.fs_kd_user  
				LEFT JOIN  HOSPITAL.dbo.tz_user ccc ON b.fs_kd_petugas_void = ccc.fs_kd_user  
				LEFT JOIN  HOSPITAL.dbo.tz_user ddd ON b.fs_kd_petugas_keluar = ddd.fs_kd_user  
				LEFT JOIN  HOSPITAL.dbo.tz_user eee ON b.fs_kd_petugas_cancel_out = eee.fs_kd_user  
				LEFT JOIN  HOSPITAL.dbo.tz_user fff ON b.fs_kd_petugas_kasir_masuk = fff.fs_kd_user  
				LEFT JOIN  HOSPITAL.dbo.tz_user ggg ON b.fs_kd_petugas_kasir_keluar = ggg.fs_kd_user 
                WHERE b.FS_KD_REG = ? and l.FS_KD_LAYANAN = 'P013' and aa.fs_kd_tarif='23202378'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
	
	function get_px_by_trs_pcr_ranap($params) {
        $sql = "SELECT a.FS_KD_REG,e.FS_KD_TRS,b.FS_NM_PASIEN,b.FS_NM_PASIEN2,c.FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,e.FS_NO_LAB,e.FS_JAM_TRS,
                h.FS_NM_LAYANAN, a.FS_KD_LAYANAN,a.FS_KD_LAYANAN2,a.FS_KD_LAYANAN3,e.FD_TGL_TRS,j.FS_NM_PEG
                FROM HOSPITAL.dbo.TC_MR a
                INNER JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON b.FS_KD_REG = c.FS_KD_REG
				LEFT JOIN HOSPITAL.dbo.TZ_TRS_SURAT d ON b.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_TDK_UMUM e ON b.FS_KD_REG = e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_TDK_UMUM2 f ON e.FS_KD_TRS = f.FS_KD_TRS
				LEFT JOIN HOSPITAL.dbo.TA_TARIF g ON g.FS_KD_TARIF = f.FS_KD_TARIF
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN h ON b.FS_KD_LAYANAN = h.FS_KD_LAYANAN
				LEFT JOIN HOSPITAL.dbo.TD_PEG i ON b.FS_KD_MEDIS=i.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG j ON b.FS_KD_MEDIS2=j.FS_KD_PEG
                WHERE e.FS_KD_TRS= ? AND f.FS_KD_TARIF='23202378'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
	
	public function get_data_hsl_pcr_perempuan($params) {
        $sql = "SELECT a.*, d.FS_NM_METODE_UJI,c.FS_NM_JENIS_PEMERIKSAAN,e.FS_KET_NORMAL,c.FS_SATUAN,c.FS_SATUAN_SI, e.FS_SEX, b.FD_TGL_HASIL_LAB
		FROM HOSPITAL.dbo.TA_TRS_TDK_UMUM5 a
		LEFT  JOIN HOSPITAL.dbo.TA_TRS_TDK_UMUM b ON a.FS_KD_TRS = b.FS_KD_TRS
		LEFT  JOIN  HOSPITAL.dbo.TA_JENIS_PEMERIKSAAN c ON a.FS_KD_JENIS_PEMERIKSAAN = c.FS_KD_JENIS_PEMERIKSAAN  
		LEFT  JOIN  HOSPITAL.dbo.TA_METODE_UJI d ON c.FS_KD_METODE_UJI = d.FS_KD_METODE_UJI
		LEFT  JOIN  HOSPITAL.dbo.TA_JENIS_PEMERIKSAAN_DTL e ON a.FS_KD_JENIS_PEMERIKSAAN = e.FS_KD_JENIS_PEMERIKSAAN
		WHERE b.FS_KD_REG = ? and e.FS_SEX = '1' and a.fs_kd_tarif='23202378'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
	
	public function get_data_hsl_pcr_laki($params) {
        $sql = "SELECT a.*, d.FS_NM_METODE_UJI,c.FS_NM_JENIS_PEMERIKSAAN,e.FS_KET_NORMAL,c.FS_SATUAN,c.FS_SATUAN_SI, e.FS_SEX, b.FD_TGL_HASIL_LAB
		FROM HOSPITAL.dbo.TA_TRS_TDK_UMUM5 a
		LEFT  JOIN HOSPITAL.dbo.TA_TRS_TDK_UMUM b ON a.FS_KD_TRS = b.FS_KD_TRS
		LEFT  JOIN  HOSPITAL.dbo.TA_JENIS_PEMERIKSAAN c ON a.FS_KD_JENIS_PEMERIKSAAN = c.FS_KD_JENIS_PEMERIKSAAN  
		LEFT  JOIN  HOSPITAL.dbo.TA_METODE_UJI d ON c.FS_KD_METODE_UJI = d.FS_KD_METODE_UJI
		LEFT  JOIN  HOSPITAL.dbo.TA_JENIS_PEMERIKSAAN_DTL e ON a.FS_KD_JENIS_PEMERIKSAAN = e.FS_KD_JENIS_PEMERIKSAAN
		WHERE b.FS_KD_REG = ? and e.FS_SEX = '0' and a.fs_kd_tarif='23202378'";
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
        $sql = "SELECT *
                FROM TAC_RI_MEDIS
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
}
