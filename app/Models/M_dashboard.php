<?php namespace App\Models;

class M_dashboard {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    /*
     * SURAT MASUK
     */

    // get user detail
    function get_str_6month($params) {
        $sql = "SELECT a.*,b.FS_NM_PEG
                FROM HOSPITAL.dbo.TD_PEG2 a
                LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.FS_KD_PEG=b.FS_KD_PEG
                WHERE FD_TGL_EXP_REGISTER BETWEEN ? AND ?
                AND b.FB_AKTIF_DINAS = 1
                ORDER BY FD_TGL_EXP_REGISTER ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        }
        return array();
    }
    function get_sip_6month($params) {
        $sql = "SELECT *
                FROM HOSPITAL.dbo.TD_PEG
                WHERE FD_TGL_AKHIR_IJIN_PRAKTEK BETWEEN ? AND ?
                AND FB_AKTIF_DINAS = 1
                ORDER BY FD_TGL_AKHIR_IJIN_PRAKTEK ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        }
        return array();
    }
    function get_sik_6month($params) {
        $sql = "SELECT *
                FROM HOSPITAL.dbo.TD_PEG
                WHERE FD_TGL_AKHIR_IJIN_KERJA BETWEEN ? AND ?
                AND FB_AKTIF_DINAS = 1
                ORDER BY FD_TGL_AKHIR_IJIN_KERJA ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        }
        return array();
    }
    
    
}