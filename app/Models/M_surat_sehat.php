<?php namespace App\Models;

class M_surat_sehat {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function insert($params) {
        $sql = "INSERT INTO HOSPITAL.dbo.TZ_TRS_SURAT(FS_KD_TRS, FD_TGL_TRS, FS_JAM_TRS, FN_JENIS_SURAT, FS_NO_SURAT, FS_KD_REG, FS_KD_MEDIS,
                FS_KETERANGAN1, FS_KETERANGAN2, FS_KETERANGAN3, FS_KETERANGAN6, FS_KETERANGAN7, FS_KETERANGAN8, FS_KETERANGAN9, FS_KETERANGAN10
				FS_KETERANGAN11, FS_KETERANGAN4, FS_KETERANGAN5, FS_KD_PETUGAS, FS_KD_PEG)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    function update($params) {
        $sql = "UPDATE HOSPITAL.dbo.TZ_TRS_SURAT SET FS_KETERANGAN1=?, FS_KETERANGAN2=?, FS_KETERANGAN3=?, FS_KETERANGAN6=?, FS_KETERANGAN7=?, FS_KETERANGAN8=?,
				FS_KETERANGAN9=?, FS_KETERANGAN10=?, FS_KETERANGAN11=?, FS_KETERANGAN4=?, FS_KETERANGAN5=? WHERE FS_KD_TRS=?";
        return $this->db->query($sql, $params);
    }

    function update_tz_parameter_no_surat($params) {
        $sql = "UPDATE HOSPITAL.dbo.TZ_PARAMETER_NO SET FN_VALUE=? WHERE FS_KD_PARAMETER= 'NOSURAT'";
        return $this->db->query($sql, $params);
    }

    function get_no_surat() {
        $sql = "SELECT RIGHT(FN_VALUE+100000000,8)'SURAT'  FROM   HOSPITAL.dbo.tz_parameter_no  WHERE  fs_kd_parameter= 'NOSURAT'";
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
                FS_TERAPI,a.FS_KD_LAYANAN,a.FS_KD_LAYANAN2,a.FS_KD_LAYANAN3,d.FS_KD_TRS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TZ_TRS_SURAT d ON a.FS_KD_REG = d.FS_KD_REG
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
                FROM HOSPITAL.dbo.TZ_TRS_SURAT 
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
        $sql = "SELECT *,b.FS_NM_PEG
                FROM HOSPITAL.dbo.TZ_TRS_SURAT a
                LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.FS_KD_MEDIS=b.FS_KD_PEG
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
