<?php namespace App\Models;

class M_personnel {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    // get last inserted id
    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    // get total users
    function get_total_personnel() {
        $sql = "SELECT COUNT(*)'total' 
                FROM (
                SELECT a.*
                FROM PKU.dbo.tac_com_user a
                LEFT JOIN users b ON a.user_id = b.user_id
                LEFT JOIN unit_kerja c ON b.unit_id = c.unit_id
                INNER JOIN PKU.dbo.tac_com_role_user d ON a.`user_id` = d.`user_id`
                INNER JOIN PKU.dbo.tac_com_role e ON d.`role_id` = e.`role_id`
                WHERE (a.user_id <> 1 AND a.user_id <> 56 ) AND e.`portal_id` = 2 AND (e.`role_id` < 8 AND e.role_id >1)
                ORDER BY b.nama_lengkap ASC
                )result";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    // get all users
    function get_all_personnel($params) {
        $sql = "SELECT b.*, c.unit_cd, c.unit_nm, a.user_id
                FROM PKU.dbo.tac_com_user a
                LEFT JOIN users b ON a.user_id = b.user_id
                LEFT JOIN unit_kerja c ON b.unit_id = c.unit_id
                INNER JOIN PKU.dbo.tac_com_role_user d ON a.`user_id` = d.`user_id`
                INNER JOIN PKU.dbo.tac_com_role e ON d.`role_id` = e.`role_id`
                WHERE (a.user_id <> 1 AND a.user_id <> 56 ) AND e.`portal_id` = 2 AND (e.`role_id` < 8 AND e.role_id >1)
                ORDER BY b.nama_lengkap ASC 
                LIMIT ?, ?";
        $query = $this->db->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    // insert users
    function insert_users($params) {
        $sql = "INSERT INTO users (user_id, nama_lengkap, jenis_kelamin, tgl_lahir, tmp_lahir, marital_st, lama_bekerja, unit_id, alamat, no_telp, jabatan, nip, bahasa_utama, bahasa_khusus, bahasa_lainnya, spesialisasi, spesialisasi_level, mdb, mdd)
                VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        return $this->db->query($sql, $params);
    }

    // update users
    function update_users($params) {
        $sql = "UPDATE users SET nama_lengkap = ?, jenis_kelamin = ?, tgl_lahir = ?, tmp_lahir = ?, marital_st = ?,
            lama_bekerja = ?, unit_id = ?, alamat = ?, no_telp = ?, jabatan= ?, nip = ?, bahasa_utama = ?,
            bahasa_khusus = ?, bahasa_lainnya = ?, spesialisasi = ?, spesialisasi_level = ?,  mdb = ?, mdd = NOW() 
            WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // update users
    function update_user_detail($params) {
        $sql = "UPDATE users SET nama_lengkap = ?, alamat = ?, no_telp = ?, mdb = ?, mdd = NOW() 
            WHERE user_id = ? ";
        return $this->db->query($sql, $params);
    }

    // update nama file gambar
    function update_nama_file($params) {
        $sql = "UPDATE users SET user_img = ? 
            WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // delete users
    function delete_users($params) {
        $sql = "DELETE FROM users WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // get user by id
    function get_users_by_id($id) {
        $sql = "SELECT a.*, b.*, a.user_id, c.role_id, d.role_nm FROM PKU.dbo.tac_com_user a
                LEFT JOIN PKU.dbo.tac_com_role_user c ON a.user_id = c.user_id
                LEFT JOIN PKU.dbo.tac_com_role d ON c.role_id = d.role_id
                LEFT JOIN users b ON a.user_id = b.user_id WHERE a.user_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    //get unit
    function get_list_unit() {
        $sql = "SELECT * FROM unit_kerja";
        $query = $this->db->query($sql);

        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get total user
    function get_total_operator($param) {
        $sql = "SELECT COUNT(*)'total' 
            FROM PKU.dbo.tac_com_user a 
            JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id 
            LEFT JOIN PKU.dbo.tac_com_role c ON b.role_id = c.role_id 
            WHERE b.role_id<>1 AND user_name LIKE ? AND operator_name LIKE ? AND b.role_id LIKE ?";
        $query = $this->db->query($sql, $param);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }

    // get all user
    function get_all_operator($params) {
        $sql = "SELECT a.*, b.role_id, c.role_nm
            FROM PKU.dbo.tac_com_user a 
            JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
            JOIN PKU.dbo.tac_com_role c ON b.role_id = c.role_id
            WHERE b.role_id<>1 AND a.user_name LIKE ? AND a.operator_name LIKE ? AND b.role_id LIKE ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get all user limit
    function get_all_operator_limit($params) {
        $sql = "SELECT a.*, b.role_id, c.role_nm
            FROM PKU.dbo.tac_com_user a 
            JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
            JOIN PKU.dbo.tac_com_role c ON b.role_id = c.role_id
            WHERE b.role_id<>1 AND a.user_name LIKE ? AND a.operator_name LIKE ? AND b.role_id LIKE ?
            ORDER BY a.user_name ASC LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get detail user by id
    function get_detail_operator_by_id($params) {
        $sql = "SELECT a.*, b.role_id, c.role_nm, c.default_page
                FROM PKU.dbo.tac_com_user a
                LEFT JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
                LEFT JOIN PKU.dbo.tac_com_role c ON b.role_id = c.role_id
                WHERE a.user_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get detail user by id
    function get_detail_users_by_id($params) {
        $sql = "SELECT * from users WHERE user_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    //get detail user for cv
    function get_user_data_cv_by_id($params){
        $sql = "SELECT a.nama_lengkap, a.nip, a.marital_st, a.tgl_lahir, a.bahasa_utama, a.bahasa_khusus, a.bahasa_lainnya
                FROM users a WHERE user_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // check username
    function is_exist_username($params) {
        $sql = "SELECT * FROM PKU.dbo.tac_com_user WHERE user_name = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $query->freeResult();
            return true;
        } else {
            return false;
        }
    }
    
    // check password
    function is_exist_password($user_id, $password) {
        $sql = "SELECT * FROM PKU.dbo.tac_com_user WHERE user_id = ?";
        $query = $this->db->query($sql, $user_id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
        } else {
            return false;
        }
        // --
        return password_verify($password, $result['password_hash']);
    }

    // check email
    function is_exist_email($email) {
        $sql = "SELECT COUNT(*)'total' FROM PKU.dbo.tac_com_user WHERE user_mail = ?";
        $query = $this->db->query($sql, $email);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            if ($result['total'] == 0) {
                return false;
            }
        }
        return true;
    }

    // update PKU.dbo.tac_com_user
    function update_operator($params) {
        $sql = "UPDATE PKU.dbo.tac_com_user SET user_name = ?, user_pass = ?, user_key = ?, 
                user_mail = ? , mdb = ?, mdd = NOW()
                WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // insert operator
    function insert($params) {

        $sql = "INSERT INTO PKU.dbo.tac_com_user (user_name, user_pass, user_key, user_mail, lock_st, mdb, mdd)
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
        return $this->db->query($sql, $params);
    }

    // insert role
    function insert_role($params) {
        $sql = "INSERT INTO PKU.dbo.tac_com_role_user (role_id, user_id)
                VALUES (?, ?)";
        return $this->db->query($sql, $params);
    }

    // get all user limit
    function get_operator_by_idd($params) {
        $sql = "SELECT* FROM(
                    SELECT a.*, b.role_id, c.role_nm 
                    FROM PKU.dbo.tac_com_user a 
                    JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id 
                    RIGHT JOIN PKU.dbo.tac_com_role c ON b.role_id = c.role_id
                )r1
                WHERE r1.role_id <> 1 AND r1.user_id=?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // update operator
    function update($params) {
        $sql = "UPDATE PKU.dbo.tac_com_user SET user_name=?,user_pass=?,user_key=?,lock_st=?,user_mail=?,operator_name=?,
                operator_phone=?,operator_hp=?,operator_notes=?,mdb=?, mdd=NOW() WHERE user_id=? ";
        return $this->db->query($sql, $params);
    }

    // update role
    function update_role($params) {
        $sql = "UPDATE PKU.dbo.tac_com_role_user SET role_id = ?, user_id = ? WHERE user_id = ? ";
        return $this->db->query($sql, $params);
    }

    // delete
    function delete($params) {
        $sql = "DELETE FROM PKU.dbo.tac_com_user WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // delete  role
    function delete_role($params) {
        $sql = "DELETE FROM PKU.dbo.tac_com_role_user WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    //----------SCHOOL---------------
    function get_school_by_id($id) {
        $sql = "SELECT a.*, b.nama_lengkap FROM user_school a
            LEFT JOIN users b ON a.user_id = b.user_id
            WHERE data_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_school_by_users($id) {
        $sql = "SELECT * FROM user_school WHERE user_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // insert school
    function insert_school($params) {
        $sql = "INSERT INTO user_school (user_id, school_nm, school_address, school_start, school_end, school_certificate, mdb, mdd)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        return $this->db->query($sql, $params);
    }

    // update school
    function update_school($params) {
        $sql = "UPDATE user_school SET user_id = ?, school_nm = ?, school_address = ?, school_start = ?, school_end = ?, 
            school_certificate = ?, mdb = ?, mdd = NOW()
            WHERE data_id = ? ";
        return $this->db->query($sql, $params);
    }

    // delete  school
    function delete_school($params) {
        $sql = "DELETE FROM user_school WHERE data_id = ?";
        return $this->db->query($sql, $params);
    }

    //----------COLLEGE---------------
    function get_college_by_id($id) {
        $sql = "SELECT a.*, b.nama_lengkap FROM user_college a
            LEFT JOIN users b ON a.user_id = b.user_id
            WHERE data_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_college_by_users($id) {
        $sql = "SELECT * FROM user_college WHERE user_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // insert college
    function insert_college($params) {
        $sql = "INSERT INTO user_college (user_id, college_nm, college_address, college_subject, college_start, college_end, college_certificate, mdb, mdd)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        return $this->db->query($sql, $params);
    }

    // update college
    function update_college($params) {
        $sql = "UPDATE user_college SET user_id = ?, college_nm = ?, college_address = ?, college_subject = ?, college_start = ?, 
            college_end = ?, college_certificate = ?, mdb = ?, mdd = NOW()
            WHERE data_id = ?";
        return $this->db->query($sql, $params);
    }

    // delete  college
    function delete_college($params) {
        $sql = "DELETE FROM user_college WHERE data_id = ?";
        return $this->db->query($sql, $params);
    }

    //----------TRAINING---------------
    function get_training_by_id($id) {
        $sql = "SELECT a.*, b.nama_lengkap FROM user_training a
            LEFT JOIN users b ON a.user_id = b.user_id
            WHERE data_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_training_by_users($id) {
        $sql = "SELECT * FROM user_training WHERE user_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // insert training
    function insert_training($params) {
        $sql = "INSERT INTO user_training (user_id, training_place, training_subject, training_year, training_duration, training_certificate, mdb, mdd)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        return $this->db->query($sql, $params);
    }

    // update training
    function update_training($params) {
        $sql = "UPDATE user_training SET user_id = ?, training_place = ?, training_subject = ?, training_year = ?, training_duration = ?, 
            training_certificate = ?, mdb = ?, mdd = NOW()
            WHERE data_id = ? ";
        return $this->db->query($sql, $params);
    }

    // delete  training
    function delete_training($params) {
        $sql = "DELETE FROM user_training WHERE data_id = ?";
        return $this->db->query($sql, $params);
    }

    //----------WORK---------------
    function get_work_by_id($id) {
        $sql = "SELECT a.*, b.nama_lengkap FROM user_work a
            LEFT JOIN users b ON a.user_id = b.user_id
            WHERE data_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_work_by_users($id) {
        $sql = "SELECT * FROM user_work WHERE user_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // insert work
    function insert_work($params) {
        $sql = "INSERT INTO user_work (user_id, company_nm, work_position, work_from, work_to, job_dec, notes, mdb, mdd)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        return $this->db->query($sql, $params);
    }

    // update work
    function update_work($params) {
        $sql = "UPDATE user_work SET user_id = ?, company_nm = ?, work_position = ?, work_from = ?, work_to = ?, 
            job_dec = ?, notes = ?, mdb = ?, mdd = NOW()
            WHERE data_id = ? ";
        return $this->db->query($sql, $params);
    }

    // delete  work
    function delete_work($params) {
        $sql = "DELETE FROM user_work WHERE data_id = ?";
        return $this->db->query($sql, $params);
    }
    
    //----------PERMISSIONS---------------
    
    // get role bukan superadmin
    function get_all_role() {
        $sql = "SELECT * FROM PKU.dbo.tac_com_role WHERE portal_id =2 ORDER BY role_nm ASC";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    // get check role
    function check_is_selected($params) {
        $sql = "SELECT COUNT(*) AS total
            FROM PKU.dbo.tac_com_role_user
            WHERE role_id = ? AND user_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }
    // get permission by id
    function get_permission_by_id($id) {
        $sql = "SELECT a.*, b.*, d.role_nm, d.role_id 
            FROM users a
            LEFT JOIN PKU.dbo.tac_com_user b ON a.user_id = b.user_id
            LEFT JOIN PKU.dbo.tac_com_role_user c ON b.user_id = c.user_id 
            LEFT JOIN PKU.dbo.tac_com_role d ON c.role_id = d.role_id
            WHERE a.user_id = ?
            ORDER BY a.user_id ASC";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }    
    // delete role by user_id
    function delete_role_by_user_id($params) {
        $sql = "DELETE FROM PKU.dbo.tac_com_role_user WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }
    // is role already exist
    function is_exist_role($params) {
        $sql = "SELECT * FROM PKU.dbo.tac_com_role_user WHERE user_id = ? AND role_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $query->freeResult();
            return true;
        } else {
            return false;
        }
    }
    // insert role
    function insert_com_role_user($params) {
        $sql = "INSERT INTO PKU.dbo.tac_com_role_user (role_id, user_id)
            VALUES (?, ?)";
        return $this->db->query($sql, $params);
    }
    
    //----------ACCOUNT---------------
    // get user account
    function get_user_account($id) {
        $sql = "SELECT a.*, b.user_id, b.nama_lengkap, c.`role_id`, d.`role_nm` FROM PKU.dbo.tac_com_user a
	    LEFT JOIN PKU.dbo.tac_com_role_user c ON a.`user_id` = c.`user_id`
	    LEFT JOIN PKU.dbo.tac_com_role d ON c.`role_id` = d.`role_id`
            LEFT JOIN users b ON a.user_id = b.user_id
            WHERE b.user_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    // update account
    function update_account($params) {
        $sql = "SELECT * FROM PKU.dbo.tac_com_user WHERE user_id = ?";
        $query = $this->db->query($sql, $params[2]);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
        } else {
            return false;
        }
        // encode password
        $params[1] = password_hash($params[1]);
        // update 
        $sql = "UPDATE PKU.dbo.tac_com_user SET user_name = ?, user_pass = ? WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }
}

