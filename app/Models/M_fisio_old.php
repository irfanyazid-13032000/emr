<?php namespace App\Models;

class M_fisio {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }
    
    function list_intervensi_umum_by_rg($params) {
        $sql = "SELECT FS_NM_INT_UMUM FROM
                TAC_RJ_FISIO4 a
                LEFT JOIN TAC_COM_FIS_MASTER_UMUM b ON a.FS_KD_FISIO_INTERVENSI_UMUM=b.FS_KD_TRS
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