<?php namespace App\Models;

class M_permissions {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    // get total permission
    function get_total_permission() {
        $sql = "SELECT COUNT(*)'total' 
            FROM users a 
            JOIN PKU.dbo.tac_com_user b ON a.user_id = b.user_id
            JOIN PKU.dbo.tac_com_role_user c ON b.user_id = c.user_id 
            LEFT JOIN PKU.dbo.tac_com_role d ON c.role_id = d.role_id
            WHERE a.user_id <> 1";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    // get all permission limit
    function get_all_permission_limit($params) {
        $sql = "SELECT a.*, b.*, c.*
            FROM PKU.dbo.tac_com_user a
            INNER JOIN users b ON a.user_id = b.user_id
            LEFT JOIN unit_kerja c ON b.unit_id = c.unit_id
            WHERE a.user_id <> 1
            ORDER BY b.nama_lengkap ASC 
            LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get all users
    function check_is_selected($params) {
        $sql = "SELECT COUNT(*) AS total
            FROM PKU.dbo.tac_com_role_user
            WHERE role_id = ? AND user_id = ? ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
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

    // update users
//    function update_role($params) {
//        $sql = "SELECT a.role_nm, a.role_id
//            FROM PKU.dbo.tac_com_role a
//            LEFT JOIN (SELECT * FROM PKU.dbo.tac_com_role_user
//                WHERE user_id = ?)b ON a.role_id = b.role_id";
//        return $this->db->query($sql, $params);
//    }
    // update users
    function update_role($params) {
        $sql = "UPDATE PKU.dbo.tac_com_role_user SET role_id = ?, user_id = ? WHERE user_id = ?";
        return $this->db->query($sql, $params);
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

    // update com_user
    function update_operator($params) {
        $sql = "UPDATE PKU.dbo.tac_com_user SET user_name = ?, user_pass = ?, user_key = ?, 
                user_mail = ? , mdb = ?, mdd = NOW()
                WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // get role
    function get_all_role() {
        $sql = "SELECT * FROM PKU.dbo.tac_com_role WHERE role_id <> 1";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
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

    // insert role user
    function insert_role_user($params) {
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

}
