<?php namespace App\Models;

class M_igd {

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

    function insert_medis($params) {
        $sql = "INSERT INTO HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA(FS_KD_TRS, FD_TGL_TRS, FS_JAM_TRS, FS_KD_PETUGAS, FD_TGL_VOID, FS_JAM_VOID, FS_KD_REG, 
                FS_KD_LAYANAN, FS_KD_PETUGAS_MEDIS, FS_ANAMNESA, FS_DIAGNOSA, FS_TINDAKAN, 
                FS_CATATAN_FISIK, FS_KD_TIPE_BARANG, FN_CETAK)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_tac_rj_medis($params) {
        $sql = "INSERT INTO TAC_RJ_MEDIS(FS_KD_KP,FS_KD_REG, FS_DIAGNOSA, FS_ANAMNESA, FS_TINDAKAN, FS_TERAPI, FS_CATATAN_FISIK,FS_KD_MEDIS,FS_CARA_PULANG,FS_DAFTAR_MASALAH,FS_PLANNING, mdb, mdd,FS_JAM_TRS)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_tac_rj_skdp($params) {
        $sql = "INSERT INTO TAC_RJ_SKDP(FS_KD_REG, FS_SKDP_1, FS_SKDP_2,FS_SKDP_KET,FS_SKDP_KONTROL, mdb, mdd, mdd_time)
                VALUES (?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_vs($params) {
        $sql = "INSERT INTO TAC_RJ_VITAL_SIGN(FS_KD_REG, FS_SUHU, FS_NADI, FS_R, FS_TD,FS_TB,FS_BB,FS_KD_MEDIS, mdb, mdd, FS_JAM_TRS)
                VALUEs (?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_nyeri($params) {
        $sql = "INSERT INTO TAC_RJ_NYERI(FS_KD_REG, FS_NYERIP, FS_NYERIQ, FS_NYERIR, FS_NYERIS, FS_NYERIT, mdb, mdd, FS_NYERI)
                VALUES (?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_jatuh($params) {
        $sql = "INSERT INTO TAC_RJ_JATUH(FS_KD_REG, FS_CARA_BERJALAN1, FS_CARA_BERJALAN2, FS_CARA_DUDUK, mdd, mdb)
                VALUES (?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_alergi($params) {
        $sql = "INSERT INTO TAC_RJ_ALERGI(FS_KD_REG, FS_ALERGI, FS_ALERGI2, FS_REAK_ALERGI, mdb, mdd)
                VALUES (?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_nutrisi($params) {
        $sql = "INSERT INTO TAC_RJ_NUTRISI(FS_KD_REG, FS_NUTRISI1, FS_NUTRISI2,FS_NUTRISI_ANAK1, FS_NUTRISI_ANAK2,FS_NUTRISI_ANAK3,FS_NUTRISI_ANAK4, mdb, mdd)
                VALUES (?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_nutrisi_anak($params) {
        $sql = "INSERT INTO TAC_RJ_NUTRISI(FS_KD_REG, FS_NUTRISI_ANAK1, FS_NUTRISI_ANAK2,FS_NUTRISI_ANAK3,FS_NUTRISI_ANAK4, mdb, mdd)
                VALUES (?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_masalah_kep($params) {
        $sql = "INSERT INTO TAC_RJ_MASALAH_KEP(FS_KD_REG, FS_KD_MASALAH_KEP)
                VALUES (?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_rencana_kep($params) {
        $sql = "INSERT INTO TAC_RJ_REN_KEP(FS_KD_REG, FS_KD_REN_KEP)
                VALUES (?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_ases($params) {
        $sql = "INSERT INTO TAC_ASES_PER2(FS_KD_REG, FS_RIW_PENYAKIT_DAHULU, FS_RIW_PENYAKIT_DAHULU2, FS_RIW_PENYAKIT_KEL, FS_RIW_PENYAKIT_KEL2,
                FS_STATUS_PSIK,FS_STATUS_PSIK2,FS_HUB_KELUARGA,FS_ST_FUNGSIONAL,FS_AGAMA,FS_NILAI_KHUSUS,FS_NILAI_KHUSUS2,FS_ANAMNESA,FS_PENGELIHATAN,
                FS_PENCIUMAN,FS_PENDENGARAN,FS_RIW_IMUNISASI,FS_RIW_IMUNISASI_KET,FS_RIW_TUMBUH,FS_RIW_TUMBUH_KET,FS_HIGH_RISK,mdb,mdd)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_kebidanan($params) {
        $sql = "INSERT INTO TAC_RJ_ASES_KEBID(FS_KD_REG, FS_NM_SUAMI, FS_TGL_LAHIR_SUAMI, FS_RIWAYAT_GYNEKOLOGI, FS_RIWAYAT_GYNEKOLOGI_KET, 
                FS_RIW_MENS_UMUR_MENARCHE, FS_RIW_MENS_LAMA_HAID, FS_RIW_MENS_GANTI_PEMBALUT, FS_RIW_MENS_HPM, FS_RIW_MENS_KELUHAN, 
                FS_RIW_MENS_KELUHAN_KET, FS_RIW_KB_METODE_1, FS_RIW_KB_METODE_LAMA_1, FS_RIW_KB_METODE_2, FS_RIW_KB_METODE_LAMA_2, 
                FS_RIW_KB_KOMPLIKASI, FS_RIW_KB_KOMPLIKASI_KET, FS_MASALAH_KEBIDANAN, FS_RENCANA_KEBIDANAN,G,P,A,FS_RIW_MENS_HPL,
                FS_KOMPLIKASI,FS_K1,FS_K4,FS_HB,FS_STATUS_TT,FS_BUKU_KIA,mdb,mdd)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_kebidanan2($params) {
        $sql = "INSERT INTO TAC_RJ_ASES_KEBID2(FS_KD_REG, FS_RIW_KEHAMILAN_THN_PARTUS, FS_RIW_KEHAMILAN_TMPT_PARTUS, FS_RIW_KEHAMILAN_UMUR_HAMIL, 
                FS_RIW_KEHAMILAN_JNS_PERSALINAN, FS_RIW_KEHAMILAN_PENOLONG_PERSALINAN, FS_RIW_KEHAMILAN_PENYULIT, FS_RIW_KEHAMILAN_JK, 
                FS_RIW_KEHAMILAN_KEADAAN_ANAK,mdb,mdd)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_antenatal($params) {
        $sql = "INSERT INTO TAC_ASES_PER2(FS_KD_REG,FS_ANAMNESA,FS_USIA_KEHAMILAN
                ,FS_HMT,mdb,mdd) VALUES (?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_instruksi_medis($params) {
        $sql = "INSERT INTO TAC_HD_INSTRUKSI_MEDIS(FS_KD_REG,instruksi_hd_id,informed_concent_tgl,instruksi_tgl,instruksi_resepHD,instruksi_resepHD_TD,instruksi_resepHD_QB,instruksi_resepHD_QD,instruksi_resepHD_UFgoal,instruksi_profilling_Na,
                instruksi_profilling_NaStat,instruksi_profilling_UF,instruksi_dialisat_asetat,instruksi_dialisat_bicarbonat,instruksi_dialisat_conductivity,instruksi_dialisat_conductivity_text,instruksi_dialisat_temperatur,instruksi_dialisat_temperatur_text,
                instruksi_dosis_sirkulasi,instruksi_dosis_sirkulasi_text,instruksi_dosis_awal,instruksi_dosis_awal_text,instruksi_dosis_maintenance,instruksi_dosis_main,instruksi_dosis_main_continue_text,instruksi_dosis_main_intermitten_text,
                instruksi_LMWH,instruksi_LMWH_text,instruksi_tanpa_heparin,instruksi_tanpa_heparin_text,instruksi_program_bilas,instruksi_edukasi,instruksi_edukasi_text,instruksi_catatan_lain,
                mdb,mdd) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function update_ases($params) {
        $sql = "UPDATE TAC_ASES_PER2 SET FS_RIW_PENYAKIT_DAHULU=?, FS_RIW_PENYAKIT_DAHULU2=?, FS_RIW_PENYAKIT_KEL=?, FS_RIW_PENYAKIT_KEL2=?,
                FS_STATUS_PSIK=?,FS_STATUS_PSIK2=?,FS_HUB_KELUARGA=?,FS_ST_FUNGSIONAL=?,FS_AGAMA=?,FS_NILAI_KHUSUS=?,FS_NILAI_KHUSUS2=?,FS_ANAMNESA=?,
                FS_PENGELIHATAN=?, FS_PENCIUMAN=?,FS_PENDENGARAN=?,FS_RIW_IMUNISASI=?,FS_RIW_IMUNISASI_KET=?,FS_RIW_TUMBUH=?,FS_RIW_TUMBUH_KET=?, FS_HIGH_RISK=?, mdb=?,mdd=?
                WHERE FS_KD_REG =?";
        return $this->db->query($sql, $params);
    }
    
    function update_kebidanan($params) {
        $sql = "UPDATE  TAC_RJ_ASES_KEBID SET FS_NM_SUAMI= ?, FS_TGL_LAHIR_SUAMI= ?, FS_RIWAYAT_GYNEKOLOGI= ?, FS_RIWAYAT_GYNEKOLOGI_KET= ?, 
                FS_RIW_MENS_UMUR_MENARCHE= ?, FS_RIW_MENS_LAMA_HAID= ?, FS_RIW_MENS_GANTI_PEMBALUT= ?, FS_RIW_MENS_HPM= ?, FS_RIW_MENS_KELUHAN= ?, 
                FS_RIW_MENS_KELUHAN_KET= ?, FS_RIW_KB_METODE_1= ?, FS_RIW_KB_METODE_LAMA_1= ?, FS_RIW_KB_METODE_2= ?, FS_RIW_KB_METODE_LAMA_2= ?, 
                FS_RIW_KB_KOMPLIKASI= ?, FS_RIW_KB_KOMPLIKASI_KET= ?, FS_MASALAH_KEBIDANAN= ?, FS_RENCANA_KEBIDANAN= ?,G= ?,P= ?,A= ?,FS_RIW_MENS_HPL= ? WHERE FS_KD_REG = ?
                ";
        return $this->db->query($sql, $params);
    }
function update_kebidanan2($params) {
        $sql = "UPDATE TAC_RJ_ASES_KEBID2 SET FS_RIW_KEHAMILAN_THN_PARTUS = ?, FS_RIW_KEHAMILAN_TMPT_PARTUS = ?, FS_RIW_KEHAMILAN_UMUR_HAMIL = ?, 
                FS_RIW_KEHAMILAN_JNS_PERSALINAN = ?, FS_RIW_KEHAMILAN_PENOLONG_PERSALINAN = ?, FS_RIW_KEHAMILAN_PENYULIT = ?, FS_RIW_KEHAMILAN_JK = ?, 
                FS_RIW_KEHAMILAN_KEADAAN_ANAK = ? WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }
    function update($params) {
        $sql = "UPDATE TAC_RJ_STATUS SET FS_STATUS = ?, mdb = ?, mdd = ? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_vs($params) {
        $sql = "UPDATE TAC_RJ_VITAL_SIGN SET FS_SUHU = ?, FS_NADI =?, FS_R=?, FS_TD=?, FS_TB=?, FS_BB=?, mdb=?, mdd=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_nyeri($params) {
        $sql = "UPDATE TAC_RJ_NYERI SET FS_NYERIP = ?, FS_NYERIQ = ?, FS_NYERIR = ?, FS_NYERIS = ?, FS_NYERIT = ?, mdb = ?, mdd = ?,FS_NYERI=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_jatuh($params) {
        $sql = "UPDATE TAC_RJ_JATUH SET FS_CARA_BERJALAN1 = ?, FS_CARA_BERJALAN2 = ?, FS_CARA_DUDUK = ?, mdd = ?, mdb=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_alergi($params) {
        $sql = "UPDATE TAC_RJ_ALERGI SET FS_ALERGI = ?, FS_ALERGI2 = ?, FS_REAK_ALERGI = ?, mdb = ?, mdd=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_nutrisi($params) {
        $sql = "UPDATE TAC_RJ_NUTRISI SET FS_NUTRISI1 = ?, FS_NUTRISI2 = ?,FS_NUTRISI_ANAK1=?,FS_NUTRISI_ANAK2=?,FS_NUTRISI_ANAK3=?,
                FS_NUTRISI_ANAK4=?,  mdb = ?, mdd=? WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_tz_parameter_no_kp($params) {
        $sql = "UPDATE HOSPITAL.dbo.TZ_PARAMETER_NO SET FN_VALUE=? WHERE FS_KD_PARAMETER= 'NOKRTPRKSA'";
        return $this->db->query($sql, $params);
    }

    function update_level_medis($params) {
        $sql = "UPDATE TAC_RJ_STATUS SET FS_STATUS=? WHERE FS_KD_REG= ?";
        return $this->db->query($sql, $params);
    }

    function update_medis($params) {
        $sql = "UPDATE HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA SET FS_ANAMNESA = ?, FS_DIAGNOSA=?, FS_TINDAKAN=?, 
                FS_CATATAN_FISIK =?, FS_KD_TIPE_BARANG=?, FN_CETAK=? WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }

    function update_tac_rj_medis($params) {
        $sql = "UPDATE TAC_RJ_MEDIS SET FS_DIAGNOSA = ?, FS_ANAMNESA = ?, FS_TINDAKAN =?, FS_TERAPI=?, FS_CATATAN_FISIK=?, 
                FS_CARA_PULANG=?,FS_DAFTAR_MASALAH=?,mdb=?, mdd=?
                WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }

    function update_tac_rj_skdp($params) {
        $sql = "UPDATE TAC_RJ_SKDP SET FS_SKDP_1 = ?, FS_SKDP_2 = ?,FS_SKDP_KET=?,FS_SKDP_KONTROL=?
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function update_ases_antenatal($params) {
        $sql = "UPDATE TAC_ASES_PER2 SET FS_ANAMNESA = ?, FS_USIA_KEHAMILAN = ?,FS_HMT=?
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }
    function update_high_risk($params) {
        $sql = "UPDATE HOSPITAL.dbo.TC_MR SET FS_HIGH_RISK = ?
                WHERE FS_MR = ?";
        return $this->db->query($sql, $params);
    }

    function update_instruksi_medis($params) {
        $sql = "UPDATE    TAC_HD_INSTRUKSI_MEDIS
SET              informed_concent_tgl = ?, instruksi_tgl = ?, instruksi_resepHD = ?, instruksi_resepHD_TD = ?, 
                      instruksi_resepHD_QB = ?, instruksi_resepHD_QD = ?, instruksi_resepHD_UFgoal = ?, instruksi_profilling_Na = ?, instruksi_profilling_NaStat = ?, instruksi_profilling_UF = ?, 
                      instruksi_dialisat_asetat =?, instruksi_dialisat_bicarbonat =?, instruksi_dialisat_conductivity =?, instruksi_dialisat_conductivity_text =?, instruksi_dialisat_temperatur = ?, 
                      instruksi_dialisat_temperatur_text = ?, instruksi_dosis_sirkulasi = ?, instruksi_dosis_sirkulasi_text = ?, instruksi_dosis_awal = ?, instruksi_dosis_awal_text = ?, 
                      instruksi_dosis_maintenance = ?, instruksi_dosis_main = ?, instruksi_dosis_main_continue_text = ?, instruksi_dosis_main_intermitten_text = ?, instruksi_LMWH = ?, 
                      instruksi_LMWH_text =?, instruksi_tanpa_heparin =?, instruksi_tanpa_heparin_text =?, instruksi_program_bilas =?, instruksi_edukasi =?, instruksi_edukasi_text =?, 
                      instruksi_catatan_lain =?  WHERE FS_KD_REG= ?";
        return $this->db->query($sql, $params);
    }

    function insert_monitoring_hd($params) {
        $sql = "INSERT INTO TAC_HD_TINDAKAN_MONITORING(FS_KD_REG,tindakan_anthd_jam,tindakan_anthd_qb,tindakan_anthd_vp,tindakan_anthd_tmp,tindakan_anthd_suhu,tindakan_anthd_td,tindakan_anthd_uf,
                tindakan_anthd_condk,tindakan_anthd_washout,tindakan_anthd_tranfusi,tindakan_anthd_makan,tindakan_anthd_urin,tindakan_anthd_muntah,tindakan_anthd_perdarahan,tindakan_anthd_keterangan,
                tindakan_anthd_nadi,mdb,mdd) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function delete_ases($params) {
        $sql = "DELETE TAC_ASES_PER2 
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function delete_masalah_kep($params) {
        $sql = "DELETE TAC_RJ_MASALAH_KEP 
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function delete_rencana_kep($params) {
        $sql = "DELETE TAC_RJ_REN_KEP 
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function delete_riw_kehamilan($params) {
        $sql = "DELETE TAC_RJ_ASES_KEBID2 
                WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }

    function delete_tindakan_monitoring($params) {
        $sql = "DELETE FROM TAC_HD_TINDAKAN_MONITORING WHERE FS_KD_HD_TINDAKAN_MONITORING = ?";
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

    function get_px_by_riw_kehamilan_by_rg($params) {
        $sql = "SELECT * FROM
                TAC_RJ_ASES_KEBID2
                WHERE FS_KD_REG = ?
                ORDER BY FS_RIW_KEHAMILAN_THN_PARTUS ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_px_by_riw_kehamilan_by_trs($params) {
        $sql = "SELECT * FROM
                TAC_RJ_ASES_KEBID2
                WHERE FS_KD_TRS = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_cek_skdp($params) {
        $sql = "SELECT * FROM
                TAC_RJ_SKDP
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
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

    function get_px_by_dokter_wait_igd($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_STATUS,FS_TERAPI,e.FS_KD_TRS,e.FS_DIAGNOSA,e.FS_TINDAKAN,e.FS_CARA_PULANG
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RJ_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1'
                AND (a.FS_KD_LAYANAN = 'P012' OR a.FS_KD_LAYANAN = 'P014') AND a.FD_TGL_KELUAR='3000-01-01'
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

    function get_px_by_dokter_finish_perawat($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_STATUS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RJ_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
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
                LEFT JOIN TAC_RJ_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON e.FS_KD_MEDIS=f.FS_KD_PEG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1' AND 
                a.FS_KD_LAYANAN = 'P012' AND a.FD_TGL_KELUAR='3000-01-01'
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
                LEFT JOIN TAC_RJ_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
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
                LEFT JOIN TAC_RJ_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
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
                LEFT JOIN TAC_RJ_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
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
                    WHERE FD_TGL_MASUK = ? AND FS_KD_LAYANAN = ?
                )e ON a.FS_MR = e.FS_MR
                LEFT JOIN TAC_RJ_STATUS f ON a.FS_KD_REG=f.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS g ON a.FS_KD_REG=g.FS_KD_REG
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
                LEFT JOIN TAC_RJ_STATUS f ON a.FS_KD_REG=f.FS_KD_REG
                LEFT JOIN TAC_RJ_STATUS g ON a.FS_KD_REG=g.FS_KD_REG
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
                LEFT JOIN TAC_RJ_STATUS f ON a.FS_KD_REG=f.FS_KD_REG
                INNER JOIN TAC_RJ_MEDIS g ON a.FS_KD_REG=g.FS_KD_REG
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
                LEFT JOIN TAC_RJ_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
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
        $sql = "SELECT a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN, a.FS_KD_IDENTITAS,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,FS_NM_LAYANAN,b.FS_KD_LAYANAN,
                b.FS_KD_LAYANAN2,b.FS_KD_LAYANAN3,b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB,h.FS_NM_PEG 'DOK2',
                i.FS_KD_TRS,a.FS_TEMP_LAHIR,b.FS_NO_SJP,a.FS_HIGH_RISK,i.mdd,j.FS_ALERGI2
                FROM HOSPITAL.dbo.TC_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN c ON b.FS_KD_TIPE_JAMINAN=c.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN d ON c.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON b.FS_KD_MEDIS=e.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON b.FS_KD_MEDIS2=h.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN f ON b.FS_KD_LAYANAN=f.FS_KD_LAYANAN
                LEFT JOIN TAC_RJ_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS i ON b.FS_KD_REG=i.FS_KD_REG
                LEFT JOIN TAC_RJ_ALERGI j ON b.FS_KD_REG=j.FS_KD_REG
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
                FROM TAC_RJ_VITAL_SIGN a
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
                FROM TAC_RJ_NYERI
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
                FROM TAC_RJ_ALERGI
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
                FROM TAC_RJ_NUTRISI
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
                FROM TAC_RJ_ASES_KEBID
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
                FROM TAC_RJ_MASALAH_KEP a 
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
                FROM TAC_RJ_JATUH
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
                FROM TAC_ASES_PER2
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
                FROM TAC_RJ_ASES_KEBID
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
                FROM TAC_RJ_MEDIS a
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
                FROM TAC_RJ_MEDIS a
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
                FROM TAC_RJ_MEDIS a
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
                FROM TAC_RJ_SKDP a
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
        $sql = "SELECT FS_KD_REG  FROM TAC_RJ_MEDIS WHERE FS_KD_REG= ?";
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

    function get_tac_com_parameter_rencana($params) {
        $sql = "SELECT * FROM TAC_COM_PARAMETER_SKDP_RENCANA WHERE FS_KD_TRS_SKDP_ALASAN = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_masalah_kep($params) {
        $sql = "SELECT * FROM TAC_COM_DAFTAR_DIAG";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_rencana_kep($params) {
        $sql = "SELECT * FROM TAC_COM_PARAM_REN_KEP";
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
        $sql = "SELECT * FROM TAC_RJ_MASALAH_KEP WHERE FS_KD_REG = ?";
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
        $sql = "SELECT * FROM TAC_RJ_REN_KEP WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_monitoring_hd($params) {
        $sql = "SELECT * FROM TAC_HD_TINDAKAN_MONITORING WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_berkas_by_rg($params) {
        $sql = "SELECT * FROM TAC_RM_BERKAS WHERE FS_KD_REG = ? AND FS_JENIS_BERKAS = '1'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
function get_header1() {
        $sql = "SELECT pref_value FROM tac_com_preferences WHERE pref_group = 'header' AND pref_nm='header1'";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
function get_header2() {
        $sql = "SELECT pref_value FROM tac_com_preferences WHERE pref_group = 'header' AND pref_nm='header2'";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
}
