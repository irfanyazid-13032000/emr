<?php namespace App\Models;

class M_morbid {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function insert($params) {
        $sql = "INSERT INTO HOSPITAL.dbo.TC_MR1(FS_KD_REG, FS_KD_KEADAAN_KELUAR_DK, FS_KD_CARA_KELUAR_DK, FS_KD_DIAGNOSA1, FS_KD_LAYANAN_DK, 
                FD_TGL_ENTRY, FS_JAM_ENTRY,FS_KD_PTG_ENTRY, FD_TGL_FIRST_ENTRY, FS_JAM_FIRST_ENTRY, CRTTGL, CRTJAM,CRTUSR)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_diag($params) {
        $sql = "INSERT
                INTO HOSPITAL.dbo.TC_MR2(FS_KD_REG, FS_KD_DIAGNOSA, FS_KD_LAYANAN, FN_URUT, FB_UTAMA, 
                CRTTGL, CRTJAM, CRTUSR)
                VALUES     (?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_pro($params) {
        $sql = "INSERT
                INTO HOSPITAL.dbo.TC_MR5(FS_KD_REG, FN_URUT, FS_KD_DIAGNOSAICD9CM)
                VALUES (?,?,?)";
        return $this->db->query($sql, $params);
    }

    function update($params) {
        $sql = "UPDATE HOSPITAL.dbo.TC_MR1 SET FS_KD_KEADAAN_KELUAR_DK =?, FS_KD_CARA_KELUAR_DK =?, FS_KD_DIAGNOSA1=?, FS_KD_LAYANAN_DK=?, 
                UPDTGL=?, UPDJAM=?,UPDUSR=?
                WHERE FS_KD_REG = ?";
        return $this->db->query($sql, $params);
    }

    function delete_diag($params) {
        $sql = "DELETE FROM HOSPITAL.dbo.TC_MR2 WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }

    function delete_pro($params) {
        $sql = "DELETE FROM HOSPITAL.dbo.TC_MR5 WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }

    function get_px_by_dokter_pulang($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_STATUS,FS_TERAPI,e.FS_KD_TRS,e.FS_DIAGNOSA,e.FS_TINDAKAN,e.FS_CARA_PULANG,
                a.FS_KD_LAYANAN,a.FS_KD_LAYANAN2,a.FS_KD_LAYANAN3,d.FS_FORM,f.fs_kd_diagnosa
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RJ_STATUS d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS e ON a.FS_KD_REG=e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR2 f ON a.FS_KD_REG=f.FS_KD_REG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1' AND FS_STATUS <> ''
                AND a.FS_KD_LAYANAN <> 'P023'
                ORDER BY fs_kd_diagnosa ASC";
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
        $sql = "SELECT TOP 15 a.FS_KD_REG,b.FS_NM_PASIEN,a.FS_MR,a.FD_TGL_MASUK,c.FS_NM_PEG
                ,a.FS_KD_JENIS_REG,d.FS_NM_LAYANAN,MAX_RG,g.FS_KD_MEDIS,i.FS_NM_PEG 'DOK2',
                g.FS_KD_TRS,k.FS_NM_LAYANAN 'LAYANAN2',a.FD_TGL_KELUAR,g.FS_CARA_PULANG,g.FS_TERAPI,
                f.fs_kd_diagnosa
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
                    AND FD_TGL_VOID = '3000-01-01'
                )e ON a.FS_MR = e.FS_MR
                LEFT JOIN TAC_RJ_MEDIS g ON a.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR2 f ON a.FS_KD_REG=f.FS_KD_REG
                WHERE a.FS_MR = ? AND a.FD_TGL_VOID = '3000-01-01'
                ORDER BY a.FD_TGL_MASUK DESC,a.FS_JAM_MASUK DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function cek_morbid_by_rg($params) {
        $sql = "SELECT * FROM HOSPITAL.dbo.TC_MR2 WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_px_by_dokter_by_rg2($params) {
        $sql = "SELECT b.FS_NO_PESERTA,a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,FS_NM_LAYANAN,b.FS_KD_LAYANAN,
                b.FS_KD_LAYANAN2,b.FS_KD_LAYANAN3,b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB,h.FS_NM_PEG 'DOK2',
                i.FS_KD_TRS,a.FS_TEMP_LAHIR,b.FS_NO_SJP,a.FS_HIGH_RISK,i.mdd,a.FS_ALERGI,f.FS_KD_LAYANAN_BPJS,a.FS_NM_SUAMI,a.FS_TGL_LAHIR_SUAMI
                ,b.FS_NO_SJP,b.FS_KD_TIPE_JAMINAN,k.FS_KD_TRS AS 'FS_KD_TRS_KP',a.FS_REAK_ALERGI,a.FS_RIW_PENYAKIT_DAHULU,i.FS_CARA_PULANG,
                a.FS_RIW_PENYAKIT_DAHULU2,f.FS_KD_LAYANAN_DK,i.FS_DIAGNOSA
                FROM HOSPITAL.dbo.TC_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN c ON b.FS_KD_TIPE_JAMINAN=c.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN d ON c.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON b.FS_KD_MEDIS=e.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON b.FS_KD_MEDIS2=h.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN f ON b.FS_KD_LAYANAN=f.FS_KD_LAYANAN
                LEFT JOIN TAC_RJ_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS i ON b.FS_KD_REG=i.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA k ON b.FS_KD_REG=k.FS_KD_REG
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

    function get_morbid_by_rg($params) {
        $sql = "SELECT *
                FROM HOSPITAL.dbo.TC_MR1
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

    function get_all_icd9_row($params) {
        $sql = "SELECT * 
                FROM HOSPITAL.dbo.TC_ICD9CM WHERE FS_KD_ICD9CM_PAR = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getNumRows();
            $query->freeResult();
            return $result;
        } else {
            return 0;
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

    function get_all_icd9($params) {
        $sql = "SELECT * 
                FROM HOSPITAL.dbo.TC_ICD9CM WHERE FS_KD_ICD9CM_PAR = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_max_diag($params) {
        $sql = "SELECT MAX(FN_URUT) 'FN_URUT' 
                FROM HOSPITAL.dbo.TC_MR2 WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_max_pro($params) {
        $sql = "SELECT MAX(FN_URUT) 'FN_URUT' 
                FROM HOSPITAL.dbo.TC_MR5 WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_diag($params) {
        $sql = "SELECT *
                FROM HOSPITAL.dbo.TC_MR2 WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_pro($params) {
        $sql = "SELECT *
                FROM HOSPITAL.dbo.TC_MR5 WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_bill_rg_all_lap($params) {
        $sql = "SELECT a.FS_KD_TRS,a.FS_KD_LAYANAN,b.FS_NM_LAYANAN,a.FD_TGL_TRS,a.FS_KETERANGAN,SUM(a.FN_QTY) 'QTY',a.FN_TOTAL,
                SUM(a.FN_TOTAL) 'TOTAL'
                FROM   HOSPITAL.dbo.ta_trs_billing a
                LEFT JOIN  HOSPITAL.dbo.TA_LAYANAN b ON a.FS_KD_LAYANAN=b.FS_KD_LAYANAN
                WHERE  a.FS_KD_REG = ? AND a.FS_KD_LAYANAN <> 'O004'
                GROUP BY a.FS_KD_TRS,a.FS_KD_LAYANAN,b.FS_NM_LAYANAN,a.FD_TGL_TRS,a.FS_KETERANGAN,a.FN_TOTAL
                ORDER BY b.FS_NM_LAYANAN";
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
