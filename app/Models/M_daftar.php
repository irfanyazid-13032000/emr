<?php namespace App\Models;

class M_daftar {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
        $this->mysql = \Config\Database::connect('sismadak', TRUE);
    }

    // get last inserted id
    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function daftar_indikator() {
        $sql = "select * from hospital_survey_indicator order by indicator_element ASC";
        $query = $this->mysql->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function daftar_indikator_lokal() {
        $sql = "select * from hospital_survey_indicator_for_hospital order by indicator_element ASC";
        $query = $this->mysql->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function daftar_indikator_by_id($params) {
        $sql = "select * from hospital_survey_indicator
                WHERE indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function daftar_indikator_lokal_by_id($params) {
        $sql = "select * from hospital_survey_indicator_for_hospital
                WHERE indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_unit($params) {
        $sql = "SELECT  *
                FROM hospital_department
                WHERE department_record_status = 'A'
                ORDER BY department_name";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            return $result;
        } else {
            return array();
        }
    }

    function list_unit_mutu_by_id($params) {
        $sql = "SELECT  a.*,b.department_name
                FROM hospital_survey_indicator_group a
                LEFT JOIN hospital_department b ON a.group_department_id=b.department_id
                WHERE group_indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function list_unit_lokal_mutu_by_id($params) {
        $sql = "SELECT  a.*,b.department_name
                FROM hospital_survey_indicator_group_for_hospital a
                LEFT JOIN hospital_department b ON a.group_department_id=b.department_id
                WHERE group_indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_pj_mutu_by_id($params) {
        $sql = "SELECT *
                FROM hospital_survey_indicator_pj
                WHERE group_indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function list_pj_lokal_mutu_by_id($params) {
        $sql = "SELECT *
                FROM hospital_survey_indicator_pj_for_hospital
                WHERE group_indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function list_analisa_mutu_by_id($params) {
        $sql = "SELECT  *
                FROM hospital_survey_indicator_analisa
                WHERE group_indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function list_analisa_lokal_mutu_by_id($params) {
        $sql = "SELECT  *
                FROM hospital_survey_indicator_analisa_for_hospital
                WHERE group_indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_data_pegawai() {
        $sql = "SELECT FS_NM_PEG,FS_KD_PEG
                FROM HOSPITAL.dbo.TD_PEG
                WHERE FB_AKTIF_DINAS = '1'
                ORDER BY FS_NM_PEG ASC
                ";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function daftar_numerator_by_id($params) {
        $sql = "SELECT variable_name
                FROM hospital_survey_indicator_variable
                WHERE variable_indicator_id = ? AND variable_type = 'N'";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function daftar_numerator_lokal_by_id($params) {
        $sql = "SELECT variable_name
                FROM hospital_survey_indicator_variable_for_hospital
                WHERE variable_indicator_id = ? AND variable_type = 'N'";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function daftar_denumerator_by_id($params) {
        $sql = "SELECT variable_name
                FROM hospital_survey_indicator_variable
                WHERE variable_indicator_id = ? AND variable_type = 'D'";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function daftar_denumerator_lokal_by_id($params) {
        $sql = "SELECT variable_name
                FROM hospital_survey_indicator_variable_for_hospital
                WHERE variable_indicator_id = ? AND variable_type = 'D'";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_indikator_by($params) {
        $sql = "SELECT * FROM hospital_survey_indicator
                WHERE indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    function get_indikator_lokal_by($params) {
        $sql = "SELECT * FROM hospital_survey_indicator_for_hospital
                WHERE indicator_id = ?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function list_pj_mutu_by_peg($params) {
        $sql = "SELECT FS_NM_PEG
                FROM HOSPITAL.dbo.TD_PEG
                WHERE FS_KD_PEG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function insert_unit($params) {
        $sql = " INSERT INTO hospital_survey_indicator_group (group_indicator_id,group_department_id)
	VALUES(?,?)";
        return $this->mysql->query($sql, $params);
    }
    
    function insert_unit_lokal($params) {
        $sql = " INSERT INTO hospital_survey_indicator_group_for_hospital (group_indicator_id,group_department_id)
	VALUES(?,?)";
        return $this->mysql->query($sql, $params);
    }

    function insert_pj($params) {
        $sql = " INSERT INTO hospital_survey_indicator_pj (group_indicator_id,group_department_id)
	VALUES(?,?)";
        return $this->mysql->query($sql, $params);
    }
    
    function insert_pj_lokal($params) {
        $sql = " INSERT INTO hospital_survey_indicator_pj_for_hospital (group_indicator_id,group_department_id)
	VALUES(?,?)";
        return $this->mysql->query($sql, $params);
    }

    function insert_analisa($params) {
        $sql = " INSERT INTO hospital_survey_indicator_analisa (group_indicator_id,group_department_id)
	VALUES(?,?)";
        return $this->mysql->query($sql, $params);
    }
    
    function insert_analisa_lokal($params) {
        $sql = " INSERT INTO hospital_survey_indicator_analisa_for_hospital (group_indicator_id,group_department_id)
	VALUES(?,?)";
        return $this->mysql->query($sql, $params);
    }

    function update($params) {
        $sql = "UPDATE hospital_survey_indicator 
                SET indicator_definition = ?, indicator_criteria_inclusive = ?, 
                indicator_criteria_exclusive = ?,indicator_element = ?,indicator_source_of_data = ?, 
                indicator_type = ?, indicator_value_standard = ?, indicator_monitoring_area = ?,indicator_frequency = ?,
                indicator_target = ?,fs_dasar_pemikiran = ?, 
                fs_formula = ?, 
                fs_metodologi = ? ,fs_waktu_pelaporan = ?,fs_jumlah_sample = ?, 
                fs_komunikasi_hasil = ?
                WHERE
                indicator_id = ?";
        return $this->mysql->query($sql, $params);
    }
    function update_lokal($params) {
        $sql = "UPDATE hospital_survey_indicator_for_hospital 
                SET indicator_definition = ?, indicator_criteria_inclusive = ?, 
                indicator_criteria_exclusive = ?,indicator_element = ?,indicator_source_of_data = ?, 
                indicator_type = ?, indicator_value_standard = ?, indicator_monitoring_area = ?,indicator_frequency = ?,
                indicator_target = ?,fs_dasar_pemikiran = ?, 
                fs_formula = ?, 
                fs_metodologi = ? ,fs_waktu_pelaporan = ?,fs_jumlah_sample = ?, 
                fs_komunikasi_hasil = ?
                WHERE
                indicator_id = ?";
        return $this->mysql->query($sql, $params);
    }

    function update_numerator($params) {
        $sql = "UPDATE hospital_survey_indicator_variable
                SET variable_name = ?
                WHERE
                variable_indicator_id = ? and variable_type = 'N'";
        return $this->mysql->query($sql, $params);
    }
    
    function update_numerator_lokal($params) {
        $sql = "UPDATE hospital_survey_indicator_variable_for_hospital
                SET variable_name = ?
                WHERE
                variable_indicator_id = ? and variable_type = 'N'";
        return $this->mysql->query($sql, $params);
    }

    function update_denumerator($params) {
        $sql = "UPDATE hospital_survey_indicator_variable
                SET variable_name = ?
                WHERE
                variable_indicator_id = ? and variable_type = 'D'";
        return $this->mysql->query($sql, $params);
    }
    
    function update_denumerator_lokal($params) {
        $sql = "UPDATE hospital_survey_indicator_variable_for_hospital
                SET variable_name = ?
                WHERE
                variable_indicator_id = ? and variable_type = 'D'";
        return $this->mysql->query($sql, $params);
    }

    function delete_unit($params) {
        $sql = "DELETE FROM hospital_survey_indicator_group WHERE group_indicator_id = ?";
        return $this->mysql->query($sql, $params);
    }

    function delete_pj($params) {
        $sql = "DELETE FROM hospital_survey_indicator_pj WHERE group_indicator_id = ?";
        return $this->mysql->query($sql, $params);
    }

    function delete_analisa($params) {
        $sql = "DELETE FROM hospital_survey_indicator_analisa WHERE group_indicator_id = ?";
        return $this->mysql->query($sql, $params);
    }
    function delete_unit_lokal($params) {
        $sql = "DELETE FROM hospital_survey_indicator_group_for_hospital WHERE group_indicator_id = ?";
        return $this->mysql->query($sql, $params);
    }

    function delete_pj_lokal($params) {
        $sql = "DELETE FROM hospital_survey_indicator_pj_for_hospital WHERE group_indicator_id = ?";
        return $this->mysql->query($sql, $params);
    }

    function delete_analisa_lokal($params) {
        $sql = "DELETE FROM hospital_survey_indicator_analisa_for_hospital WHERE group_indicator_id = ?";
        return $this->mysql->query($sql, $params);
    }

}
