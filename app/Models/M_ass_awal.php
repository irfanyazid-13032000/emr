<?php namespace App\Models;

class M_ass_awal {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function insert($params) {
        $sql = "INSERT INTO TAC_RJ_STATUS( FS_KD_REG, FS_STATUS,FS_FORM, mdb, mdd)
                VALUES(?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    
    function insert_vs($params) {
        $sql = "INSERT INTO TAC_RI_VITAL_SIGN(FS_KD_REG, FS_SUHU, FS_NADI, FS_R, FS_TD,FS_TB,FS_BB,FS_KD_MEDIS, mdb, mdd, FS_JAM_TRS)
                VALUEs (?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_nyeri($params) {
        $sql = "INSERT INTO TAC_RI_NYERI(FS_KD_REG, FS_NYERIP, FS_NYERIQ, FS_NYERIR, FS_NYERIS, FS_NYERIT, mdb, mdd, FS_NYERI)
                VALUES (?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    function insert_jatuh($params) {
        $sql = "INSERT INTO TAC_RI_JATUH(FS_KD_REG, FS_SCORE, mdb, mdd)
                VALUES (?,?,?,?)";
        return $this->db->query($sql, $params);
    }

     function insert_alergi($params) {
        $sql = "UPDATE HOSPITAL.dbo.TC_MR SET FS_ALERGI = ?, FS_REAK_ALERGI = ?, FS_RIW_PENYAKIT_DAHULU = ?, FS_RIW_PENYAKIT_DAHULU2 = ?
                WHERE FS_MR = ?";
        return $this->db->query($sql, $params);
    }

    function insert_nutrisi($params) {
        $sql = "INSERT INTO TAC_RI_NUTRISI(FS_KD_REG, FS_NUTRISI1, FS_NUTRISI2,FS_NUTRISI_ANAK1, FS_NUTRISI_ANAK2,FS_NUTRISI_ANAK3,FS_NUTRISI_ANAK4, mdb, mdd)
                VALUES (?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_masalah_kep($params) {
        $sql = "INSERT INTO TAC_RI_MASALAH_KEP(FS_KD_REG, FS_KD_MASALAH_KEP)
                VALUES (?,?)";
        return $this->db->query($sql, $params);
    }
    function insert_keb_spirit($params) {
        $sql = "INSERT INTO TAC_RI_SPIRITUAL(FS_KD_REG, FS_KD_SPIRITUAL)
                VALUES (?,?)";
        return $this->db->query($sql, $params);
    }
    function insert_edukasi($params) {
        $sql = "INSERT INTO TAC_RI_EDUKASI(FS_KD_REG, FS_KD_EDUKASI)
                VALUES (?,?)";
        return $this->db->query($sql, $params);
    }
    function insert_planning($params) {
        $sql = "INSERT INTO TAC_RI_PLANNING(FS_KD_REG, FS_KD_PLANNING)
                VALUES (?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_ases($params) {
        $sql = "INSERT INTO TAC_RI_ASES_PER2(FS_KD_REG, FS_RIW_PENYAKIT_DAHULU, FS_RIW_PENYAKIT_DAHULU2, FS_RIW_PENYAKIT_KEL, FS_RIW_PENYAKIT_KEL2,
                FS_STATUS_PSIK,FS_STATUS_PSIK2,FS_HUB_KELUARGA,FS_ST_FUNGSIONAL,FS_AGAMA,FS_NILAI_KHUSUS,FS_NILAI_KHUSUS2,FS_PEMERIKSAAN_FISIK,FS_PENGELIHATAN,
                FS_PENCIUMAN,FS_PENDENGARAN,FS_RIW_IMUNISASI,FS_RIW_IMUNISASI_KET,FS_RIW_TUMBUH,FS_RIW_TUMBUH_KET,FS_HIGH_RISK,FS_ANAMNESA,mdb,mdd,FS_VERIF_PPJA,
                mdb_ppja,mdd_date_ppja,mdd_time_ppja)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    
    function insert_fungsional($params) {
        $sql = "INSERT
                INTO TAC_RI_ASES_PER3(FS_KD_REG, FS_FUNGSIONAL1, FS_FUNGSIONAL2, FS_FUNGSIONAL3, FS_FUNGSIONAL4, FS_FUNGSIONAL5, FS_FUNGSIONAL6, 
                FS_FUNGSIONAL7, FS_FUNGSIONAL8, FS_FUNGSIONAL9, FS_FUNGSIONAL10, mdb, mdd_date, mdd_time)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function update_ases($params) {
        $sql = "UPDATE TAC_RI_ASES_PER2 SET FS_RIW_PENYAKIT_DAHULU=?, FS_RIW_PENYAKIT_DAHULU2=?, FS_RIW_PENYAKIT_KEL=?, FS_RIW_PENYAKIT_KEL2=?,
                FS_STATUS_PSIK=?,FS_STATUS_PSIK2=?,FS_HUB_KELUARGA=?,FS_ST_FUNGSIONAL=?,FS_AGAMA=?,FS_NILAI_KHUSUS=?,FS_NILAI_KHUSUS2=?,FS_PEMERIKSAAN_FISIK=?,
                FS_PENGELIHATAN=?, FS_PENCIUMAN=?,FS_PENDENGARAN=?,FS_RIW_IMUNISASI=?,FS_RIW_IMUNISASI_KET=?,FS_RIW_TUMBUH=?,FS_RIW_TUMBUH_KET=?, FS_HIGH_RISK=?, 
                FS_ANAMNESA=?,mdb=?,mdd=?,FS_VERIF_PPJA=?,mdb_ppja=?,mdd_date_ppja=?,mdd_time_ppja=?
                WHERE FS_KD_REG =?";
        return $this->db->query($sql, $params);
    }
    
    function update($params) {
        $sql = "UPDATE TAC_RI_STATUS SET FS_STATUS = ?, mdb = ?, mdd = ? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_vs($params) {
        $sql = "UPDATE TAC_RI_VITAL_SIGN SET FS_SUHU = ?, FS_NADI =?, FS_R=?, FS_TD=?, FS_TB=?, FS_BB=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_nyeri($params) {
        $sql = "UPDATE TAC_RI_NYERI SET FS_NYERIP = ?, FS_NYERIQ = ?, FS_NYERIR = ?, FS_NYERIS = ?, FS_NYERIT = ?, mdb = ?, mdd = ?,FS_NYERI=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_jatuh($params) {
        $sql = "UPDATE TAC_RI_JATUH SET FS_SCORE = ?, mdb = ?, mdd=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_alergi($params) {
        $sql = "UPDATE TAC_RI_ALERGI SET FS_ALERGI = ?, FS_ALERGI2 = ?, FS_REAK_ALERGI = ?, mdb = ?, mdd=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_nutrisi($params) {
        $sql = "UPDATE TAC_RI_NUTRISI SET FS_NUTRISI1 = ?, FS_NUTRISI2 = ?,FS_NUTRISI_ANAK1=?,FS_NUTRISI_ANAK2=?,FS_NUTRISI_ANAK3=?,
                FS_NUTRISI_ANAK4=?,  mdb = ?, mdd=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }
    
    function update_fungsional($params) {
        $sql = "UPDATE TAC_RI_ASES_PER3
                SET FS_FUNGSIONAL1 = ?, FS_FUNGSIONAL2 = ?, FS_FUNGSIONAL3 = ?, FS_FUNGSIONAL4 = ?, FS_FUNGSIONAL5 = ?, FS_FUNGSIONAL6 = ?, FS_FUNGSIONAL7 = ?, 
                FS_FUNGSIONAL8 = ?, FS_FUNGSIONAL9 = ?, FS_FUNGSIONAL10 = ? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

 
    function delete_masalah_kep($params) {
        $sql = "DELETE TAC_RI_MASALAH_KEP 
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function delete_keb_spirit($params) {
        $sql = "DELETE TAC_RI_SPIRITUAL 
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }
    function delete_edukasi($params) {
        $sql = "DELETE TAC_RI_EDUKASI 
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }
    function delete_planning($params) {
        $sql = "DELETE TAC_RI_PLANNING 
                WHERE FS_KD_REG = ?";
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

    function cek_ass_awal($params) {
        $sql = "SELECT FS_KD_REG FROM TAC_RI_ASES_PER2 WHERE FS_KD_REG = ?";
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
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien,cc.fd_tgl_lahir,
            (substring(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),1,3)+' Thn '+substring(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),5,2)+' bln ' 
            +right(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),2)+' hr')as fs_umur 
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
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien,cc.fd_tgl_lahir,
            (substring(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),1,3)+' Thn '+substring(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),5,2)+' bln ' 
            +right(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),2)+' hr')as fs_umur 
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
    
    function get_pasien_bangsal_kby($params) {
        $sql = " SELECT     aa.fs_kd_reg, RIGHT(bb.fs_mr,8) 'FS_MR',
            ISNULL(ee.fs_nm_bed, ' ') fs_nm_bed, 
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien,cc.fd_tgl_lahir,
            (substring(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),1,3)+' Thn '+substring(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),5,2)+' bln ' 
            +right(HOSPITAL.dbo.if_get_umur_by_reg(bb.fs_kd_reg),2)+' hr')as fs_umur 
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
            WHERE (dd.fs_kd_layanan = 'B15') OR (dd.fs_kd_layanan = 'B18')";
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
            aa.fs_kd_sesion_poli,aa.fs_anamnese,aa.fs_kd_trs_antrian, aa.fs_kd_trs_antrian2, aa.fs_kd_trs_antrian3, 
            aa.fs_kd_medis2, aa.fs_kd_medis3, fs_kd_bed_awal, fs_kd_trs_bed_awal, fs_kd_jenis_reg, fs_no_sjp, fs_kd_trs_sjp, xx.fs_nm_layanan 'layanan_akhir', hh.FS_JNS_KELAMIN, 
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
            ISNULL(ww.fs_asal_jenazah,'')fs_asal_jenazah, ISNULL(ww.fs_yayasan_jenazah,'')fs_yayasan_jenazah,
            nn.fs_nm_peg,FS_HIGH_RISK,hh.FS_ALERGI,FS_REAK_ALERGI,FS_RIW_PENYAKIT_DAHULU,FS_RIW_PENYAKIT_DAHULU2,
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

    function get_dokter($params) {
        $sql = "SELECT a.FS_KD_PEG,a.FS_NM_PEG FROM
                HOSPITAL.dbo.TD_PEG a
                WHERE a.FS_KD_PEG LIKE 'S%' AND a.FB_AKTIF_DINAS = '1'
                ORDER BY a.FS_NM_PEG ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_dokter2($params) {
        $sql = "SELECT a.FS_KD_PEG,a.FS_NM_PEG FROM
                HOSPITAL.dbo.TD_PEG a
                WHERE a.FS_KD_PEG = ? AND a.FB_AKTIF_DINAS = '1'
                ORDER BY a.FS_NM_PEG ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_dokter_by_id($params) {
        $sql = "SELECT a.FS_KD_PEG,a.FS_NM_PEG FROM
                HOSPITAL.dbo.TD_PEG a
                WHERE a.FS_KD_PEG = ? AND a.FB_AKTIF_DINAS = '1'
                ORDER BY a.FS_NM_PEG ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_all_ass_awal($params) {
        $sql = "SELECT FS_KD_REG FROM TAC_RI_ASES_PER2 WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
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
    
    

    function get_px_by_dokter_finish_perawat($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_STATUS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RI_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1' AND FS_KD_MEDIS = ?
                AND FS_STATUS = '1'
                ORDER BY c.FN_NO_URUT";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_by_dokter_wait_dokter($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_STATUS,FS_TERAPI,e.FS_KD_TRS,f.FS_NM_PEG,d.FS_FORM
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RI_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_RI_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON e.FS_KD_MEDIS=f.FS_KD_PEG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1' AND (a.FS_KD_MEDIS = ? OR FS_KD_MEDIS2 = ? OR FS_KD_MEDIS3 = ?)
                AND (a.FS_KD_LAYANAN <> 'P023' AND a.FS_KD_LAYANAN <> 'P015')
                ORDER BY c.FN_NO_URUT";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_by_dokter_wait_dokter_hd($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_STATUS,FS_TERAPI,e.FS_KD_TRS,f.FS_NM_PEG
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RI_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_RI_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON e.FS_KD_MEDIS=f.FS_KD_PEG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1'
                AND a.FS_KD_LAYANAN = 'P023'
                ORDER BY c.FN_NO_URUT";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_by_dokter_wait_farmasi($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_STATUS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RI_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1' AND FS_KD_MEDIS = ?
                AND FS_STATUS = '2'
                ORDER BY c.FN_NO_URUT";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_by_farmasi($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_STATUS,FS_TERAPI,f.FS_NM_PEG,e.FS_KD_TRS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RI_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_RI_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON e.FS_KD_MEDIS = f.FS_KD_PEG
                WHERE a.FS_KD_REG LIKE ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_history($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,a.FS_MR,a.FD_TGL_MASUK,c.FS_NM_PEG
                ,a.FS_KD_JENIS_REG,d.FS_NM_LAYANAN,MAX_RG,f.FS_STATUS,g.FS_KD_MEDIS,i.FS_NM_PEG 'DOK2',
                g.FS_KD_TRS,k.FS_NM_LAYANAN 'LAYANAN2',f.FS_FORM
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON a.FS_KD_MEDIS = c.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI h ON a.FS_KD_REG = h.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG i ON h.FS_KD_MEDIS2 = i.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON a.FS_KD_LAYANAN = d.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN k ON a.FS_KD_LAYANAN2 = k.FS_KD_LAYANAN
                LEFT JOIN (
                    SELECT FS_KD_REG 'MAX_RG',FS_MR
                    FROM HOSPITAL.dbo.TA_REGISTRASI 
                    WHERE FD_TGL_MASUK = ? AND (FS_KD_MEDIS = ? OR FS_KD_MEDIS2 = ? OR FS_KD_MEDIS3 = ?)
                )e ON a.FS_MR = e.FS_MR
                LEFT JOIN TAC_RI_STATUS f ON a.FS_KD_REG=f.FS_KD_REG
                LEFT JOIN TAC_RI_MEDIS g ON a.FS_KD_REG=g.FS_KD_REG
                WHERE a.FS_MR = ? AND a.FD_TGL_VOID = '3000-01-01'
                ORDER BY a.FD_TGL_MASUK DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_history_nurse($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,a.FS_MR,a.FD_TGL_MASUK,c.FS_NM_PEG
                ,a.FS_KD_JENIS_REG,d.FS_NM_LAYANAN,MAX_RG,f.FS_STATUS,g.FS_KD_REG 'FS_KD_REG_NURSE' ,i.FS_NM_PEG 'DOK2',
                g.FS_KD_TRS,k.FS_NM_LAYANAN 'LAYANAN2'
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON a.FS_KD_MEDIS = c.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI h ON a.FS_KD_REG = h.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG i ON h.FS_KD_MEDIS2 = i.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON a.FS_KD_LAYANAN = d.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN k ON a.FS_KD_LAYANAN2 = k.FS_KD_LAYANAN
                LEFT JOIN (
                    SELECT FS_KD_REG 'MAX_RG',FS_MR
                    FROM HOSPITAL.dbo.TA_REGISTRASI 
                    WHERE FD_TGL_MASUK = ? 
                )e ON a.FS_MR = e.FS_MR
                LEFT JOIN TAC_RI_STATUS f ON a.FS_KD_REG=f.FS_KD_REG
                LEFT JOIN TAC_RI_STATUS g ON a.FS_KD_REG=g.FS_KD_REG
                WHERE a.FS_MR = ? AND a.FD_TGL_VOID = '3000-01-01'
                ORDER BY a.FD_TGL_MASUK DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_history2($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,a.FS_MR,a.FD_TGL_MASUK,c.FS_NM_PEG
                ,a.FS_KD_JENIS_REG,d.FS_NM_LAYANAN,f.FS_STATUS,g.FS_KD_TRS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON a.FS_KD_MEDIS = c.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON a.FS_KD_LAYANAN = d.FS_KD_LAYANAN
                LEFT JOIN TAC_RI_STATUS f ON a.FS_KD_REG=f.FS_KD_REG
                INNER JOIN TAC_RI_MEDIS g ON a.FS_KD_REG=g.FS_KD_REG
                WHERE a.FS_MR LIKE ? AND a.FD_TGL_VOID = '3000-01-01' AND a.FS_KD_JENIS_REG <> '1'
                ORDER BY a.FD_TGL_MASUK DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_by_dokter_by_rm($params) {
        $sql = "SELECT a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur
                FROM HOSPITAL.dbo.TC_MR a
                WHERE a.FS_MR = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_px_by_dokter_by_rg($params) {
        $sql = "SELECT a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,FS_NM_LAYANAN,b.FS_KD_LAYANAN,
                b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB
                FROM HOSPITAL.dbo.TC_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN c ON b.FS_KD_TIPE_JAMINAN=c.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN d ON c.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON b.FS_KD_MEDIS=e.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN f ON b.FS_KD_LAYANAN=f.FS_KD_LAYANAN
                LEFT JOIN TAC_RI_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
                WHERE b.FS_KD_REG = ? AND (b.FS_KD_MEDIS = ? OR b.FS_KD_MEDIS2 = ? OR b.FS_KD_MEDIS3 = ?)";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_px_by_dokter_by_rg2($params) {
        $sql = "SELECT a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,FS_NM_LAYANAN,b.FS_KD_LAYANAN,
                b.FS_KD_LAYANAN2,b.FS_KD_LAYANAN3,b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB,h.FS_NM_PEG 'DOK2',
                i.FS_KD_TRS,a.FS_TEMP_LAHIR,b.FS_NO_SJP,a.FS_HIGH_RISK,i.mdd
                FROM HOSPITAL.dbo.TC_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN c ON b.FS_KD_TIPE_JAMINAN=c.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN d ON c.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON b.FS_KD_MEDIS=e.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON b.FS_KD_MEDIS2=h.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN f ON b.FS_KD_LAYANAN=f.FS_KD_LAYANAN
                LEFT JOIN TAC_RI_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAC_RI_MEDIS i ON b.FS_KD_REG=i.FS_KD_REG
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

    function get_data_vs_by_rg($params) {
        $sql = "SELECT a.*,c.FS_NM_PEG,b.user_name
                FROM TAC_RI_VITAL_SIGN a
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

    function get_data_nyeri_by_rg($params) {
        $sql = "SELECT *
                FROM TAC_RI_NYERI
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

    function get_data_alergi_by_rg($params) {
        $sql = "SELECT *
                FROM TAC_RI_ALERGI
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

    function get_data_nutrisi_by_rg($params) {
        $sql = "SELECT *
                FROM TAC_RI_NUTRISI
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
        $sql = "SELECT *,b.FS_NM_PEG
                FROM TAC_RI_ASES_PER2 a
                LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.mdb_ppja=b.FS_KD_PEG 
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
    function get_data_fungsi_by_rg($params) {
        $sql = "SELECT *
                FROM TAC_RI_ASES_PER3
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

    function get_data_ases_kebid_by_rg($params) {
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
        $sql = "SELECT a.* ,b.FS_NM_DIAGNOSA
                FROM TAC_RI_MASALAH_KEP a
                LEFT JOIN TAC_COM_DAFTAR_DIAG b ON a.FS_KD_MASALAH_KEP=b.FS_KD_DAFTAR_DIAGNOSA
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
        $sql = "SELECT a.*,b.FS_NM_SPIRITUAL
               FROM TAC_RI_SPIRITUAL a
                LEFT JOIN TAC_COM_PARAM_SPIRITUAL b ON a.FS_KD_SPIRITUAL=b.FS_KD_TRS
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
        $sql = "SELECT a.*,b.FS_NM_EDUKASI
               FROM TAC_RI_EDUKASI a
                LEFT JOIN TAC_COM_PARAM_EDUKASI b ON a.FS_KD_EDUKASI=b.FS_KD_TRS
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
        $sql = "SELECT a.*,b.FS_NM_PLANNING
                FROM TAC_RI_PLANNING a
                LEFT JOIN TAC_COM_PARAM_PLANNING b ON a.FS_KD_PLANNING=b.FS_KD_TRS
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
