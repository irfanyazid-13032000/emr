<?php namespace App\Models;

class M_prioritas {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
        $this->mysql = \Config\Database::connect('sismadak', TRUE);
    }

    // get last inserted id
    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function get_unit_sismadak() {
        $sql = "select * from hospital_department
                where department_record_status = 'A'
                order by department_name ASC";
        $query = $this->mysql->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_prioritas_wajib() {
        $sql = "select *
                from hospital_survey_indicator a
                WHERE fs_status_indikator = 'P'
                GROUP BY indicator_id";
        $query = $this->mysql->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_prioritas_lokal($params) {
        $sql = "select *
                from hospital_survey_indicator_for_hospital a
                WHERE fs_status_indikator = 'P'
                GROUP BY indicator_id
                ";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_data_prioritas_wajib_jan($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '01' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_prioritas_wajib_feb($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '02' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_prioritas_wajib_mar($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '03' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_apr($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '04' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_mei($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '05' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_jun($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '06' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_jul($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '07' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_agt($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '08' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_sep($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '09' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_okt($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '10' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_nov($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '11' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_wajib_des($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation 
                WHERE MONTH(result_period) = '12' AND YEAR(result_period) = ?
                AND result_indicator_id =?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_jan($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '01' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            return $result;
        } else {
            return 0;
        }
    }
    
    
    function get_data_prioritas_lokal_feb($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '02' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_data_prioritas_lokal_mar($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '03' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_apr($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '04' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_mei($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '05' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_jun($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '06' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_jul($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '07' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_agt($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '08' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_sep($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '09' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_okt($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '10' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_nov($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '11' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_data_prioritas_lokal_des($params) {
        $sql = "SELECT  FORMAT(AVG((result_numerator_value/result_denumerator_value)*100),2) 'pencapaian',result_verif_status
                FROM hospital_survey_indicator_result_recapitulation_for_hospital 
                WHERE MONTH(result_period) = '12' AND YEAR(result_period) = ?
                AND result_indicator_id =? ";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_prioritas_by_unit($params) {
        $sql = "SELECT indicator_id,indicator_element 
                FROM hospital_survey_indicator a
                WHERE indicator_id = ?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    function get_prioritas_lokal_by_unit($params) {
        $sql = "SELECT indicator_id,indicator_element 
                FROM hospital_survey_indicator_for_hospital a
                WHERE indicator_id = ?";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_prioritas_by_unit_periode($params) {
        $sql = "SELECT b.result_numerator_value,b.result_denumerator_value,FORMAT((b.result_numerator_value/b.result_denumerator_value)*100,2) 'hasil',result_period 
                FROM hospital_survey_indicator a
                LEFT JOIN hospital_survey_indicator_result_recapitulation b ON a.indicator_id=b.result_indicator_id
                WHERE indicator_id = ? AND MONTH(result_period) = ? 
                AND YEAR(result_period) = ?
                ORDER BY result_period ASC";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_prioritas_lokal_by_unit_periode($params) {
        $sql = "SELECT b.result_numerator_value,b.result_denumerator_value,FORMAT((b.result_numerator_value/b.result_denumerator_value)*100,2) 'hasil',result_period 
                FROM hospital_survey_indicator_for_hospital a
                LEFT JOIN hospital_survey_indicator_result_recapitulation_for_hospital b ON a.indicator_id=b.result_indicator_id
                WHERE indicator_id = ? AND MONTH(result_period) = ? 
                AND YEAR(result_period) = ?
                ORDER BY result_period ASC";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_verif_by_unit_periode($params) {
        $sql = "SELECT result_verif_status
                FROM hospital_survey_indicator_result_recapitulation
                WHERE result_indicator_id = ? AND MONTH(result_period) = ? 
                AND YEAR(result_period) = ?
                GROUP BY result_verif_status
                ORDER BY result_period ASC";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
    
    function get_verif_lokal_by_unit_periode($params) {
        $sql = "SELECT result_verif_status
                FROM hospital_survey_indicator_result_for_hospital
                WHERE result_indicator_id = ? AND MONTH(result_period) = ? 
                AND YEAR(result_period) = ?
                GROUP BY result_verif_status
                ORDER BY result_period ASC";
        $query = $this->mysql->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    // insert surat masuk
    function insert($params) {
        $sql = "INSERT INTO hospital_survey_indicator_verif (verif_status,verif_indicator_id,verif_department_id, 
                verif_periode_bulan,verif_periode_tahun)
                VALUES(?,?,?,?,?)";
        return $this->mysql->query($sql, $params);
    }

    function update($params) {
        $sql = "UPDATE hospital_survey_indicator_result_recapitulation SET result_verif_status =?
                WHERE result_indicator_id = ? AND MONTH(result_period) = ? 
                AND YEAR(result_period) = ?";
        return $this->mysql->query($sql, $params);
    }
    
    function update_lokal($params) {
        $sql = "UPDATE hospital_survey_indicator_result_recapitulation_for_hospital SET result_verif_status =?
                WHERE result_indicator_id = ? AND MONTH(result_period) = ? 
                AND YEAR(result_period) = ?";
        return $this->mysql->query($sql, $params);
    }
}
