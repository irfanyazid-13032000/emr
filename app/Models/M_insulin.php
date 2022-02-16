<?php namespace App\Models;

class M_insulin {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function insert($params) {
        $sql = "INSERT
                INTO TAC_RJ_INSULIN(FS_KD_REG, FS_RIW_PENGOBATAN, FD_TGL_PENGGUNAAN, mdd_date, mdd_time, mdb)
                VALUES (?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    function update($params) {
        $sql = "UPDATE TAC_RJ_INSULIN SET FS_RIW_PENGOBATAN=?, FD_TGL_PENGGUNAAN=? WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }

    function get_px_by_dokter_by_rg2($params) {
        $sql = "SELECT b.FS_NO_PESERTA,a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,FS_NM_LAYANAN,b.FS_KD_LAYANAN,
                b.FS_KD_LAYANAN2,b.FS_KD_LAYANAN3,b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB,h.FS_NM_PEG 'DOK2',
                i.FS_KD_TRS,a.FS_TEMP_LAHIR,b.FS_NO_SJP,a.FS_HIGH_RISK,i.mdd,j.FS_ALERGI2,f.FS_KD_LAYANAN_BPJS,a.FS_NM_SUAMI,a.FS_TGL_LAHIR_SUAMI
                ,b.FS_NO_SJP,b.FS_KD_TIPE_JAMINAN,k.FS_KD_TRS AS 'FS_KD_TRS_KP',i.FS_DIAGNOSA
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

    function get_px_by_dokter_wait($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                a.FS_KD_LAYANAN,a.FS_KD_LAYANAN2,a.FS_KD_LAYANAN3,d.FS_KD_TRS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN TAC_RJ_INSULIN d ON a.FS_KD_REG = d.FS_KD_REG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1' AND (a.FS_KD_MEDIS = ? OR FS_KD_MEDIS2 = ? OR FS_KD_MEDIS3=?)
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
    function get_cek_surat($params) {
        $sql = "SELECT *
                FROM TAC_RJ_INSULIN 
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
    function get_surat_by_trs($params) {
        $sql = "SELECT *
                FROM TAC_RJ_INSULIN
                WHERE FS_KD_TRS = ?";
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
