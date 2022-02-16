<?php namespace App\Models;

class M_gabung_ri {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    //update data
    function update_gabung_ri($params) {
        $sql = "UPDATE TAC_RI_MEDIS 
                SET  FS_KD_REG = ? ,FS_STATUS=? WHERE FS_MR = ? AND FS_STATUS = '1'";
        return $this->db->query($sql, $params);
    }

    //get all data
    function get_px_history($params) {
        $sql = "SELECT TOP 1 FD_TGL_MASUK,b.FS_KD_REG,FS_NM_PEG,FS_NM_LAYANAN,FS_STATUS,a.FS_MR 
                FROM PKU.dbo.TAC_RI_MEDIS a
                INNER JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN c ON b.FS_KD_LAYANAN=c.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.FS_KD_MEDIS=d.FS_KD_PEG
                WHERE a.FS_STATUS = '1' AND a.FS_MR LIKE ? AND b.FD_TGL_VOID = '3000-01-01'
		ORDER BY FS_KD_REG DESC";
        $query = $this->db->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    //get by id for searching
    function get_jabatan_by_id($id) {
        $sql = "SELECT * FROM jabatan WHERE jabatan_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    //get total data
    function get_total_jabatan($params) {
        $sql = "SELECT COUNT(*)'total' FROM jabatan";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }

    //get all data for pagination
    function get_all_jabatan_limit($params) {
        $sql = "SELECT * FROM jabatan LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get all jabatan name by parent
    function get_all_jabs_by_parent($params) {
        $sql = "SELECT * FROM jabatan WHERE jabatan_parent = ?
            ORDER BY jabatan_nama ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    //gabung get_all_jabatan_limit + get_all_jabatan_by_parent
    function get_all_jabatan_by_parent($params) {
        $sql = "SELECT * FROM jabatan WHERE jabatan_parent = ? 
            ORDER BY jabatan_nama ASC";
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
