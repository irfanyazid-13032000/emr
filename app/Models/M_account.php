<?php

namespace App\Models;

use CodeIgniter\Model;

class M_account extends Model
{

    protected $db;

    function __construct()
    {
        $this->db = \Config\Database::connect('sqlserver');
    }

    // get user profil
    function get_user_profil($params)
    {
        $sql = "SELECT * FROM 
                (
                        SELECT b.*,a.fs_kd_layanan,a.user_id,a.user_name, d.role_id, d.role_nm, d.role_parent, login_date, ip_address , f.FS_NM_JABATAN
                        FROM PKU.dbo.tac_com_user a
                        INNER JOIN HOSPITAL.dbo.TD_PEG b ON a.user_name = b.FS_KD_PEG
                        INNER JOIN PKU.dbo.tac_com_role_user c ON a.user_id = c.user_id
                        INNER JOIN PKU.dbo.tac_com_role d ON c.role_id = d.role_id
                        LEFT JOIN PKU.dbo.tac_com_user_login e ON a.user_id = e.user_id
                        LEFT JOIN HOSPITAL.dbo.TD_JABATAN f ON b.FS_KD_JABATAN = f.FS_KD_JABATAN
                        WHERE a.user_id = ? AND c.role_id = ?
                        
                ) result 
                ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get all data instansi by id
    function get_instansi_by_id($params)
    {
        $sql = "SELECT * FROM instansi WHERE instansi_type = 'UPT' AND instansi_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get user detail
    function get_user_detail_by_username($params)
    {
        $sql = "SELECT TOP 1 a.*, c.role_id, c.role_nm, c.default_page
                FROM PKU.dbo.tac_com_user a
                LEFT JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
                LEFT JOIN PKU.dbo.tac_com_role c ON b.role_id = c.role_id
                WHERE user_name = ? AND c.role_id = ? 
                AND c.portal_id = ? 
                ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return false;
        }
    }

    // get user default page
    function get_user_default_page($params)
    {
        $sql = "SELECT c.default_page
                FROM PKU.dbo.tac_com_user a
                INNER JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
                INNER JOIN PKU.dbo.tac_com_role c ON b.role_id = c.role_id
                WHERE a.user_id = ? AND c.role_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['default_page'];
        } else {
            return '';
        }
    }

    // get user detail with auto role
    function get_user_detail_by_username_auto_role($params)
    {
        $sql = "SELECT TOP 1 a.*, c.role_id, c.role_nm, c.default_page
                FROM PKU.dbo.tac_com_user a
                LEFT JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
                LEFT JOIN PKU.dbo.tac_com_role c ON b.role_id = c.role_id
                WHERE user_name = ? AND c.portal_id = ? ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return false;
        }
    }

    // get login
    // role => 2; portal = 2
    function get_user_login($username, $password, $role_id, $portal)
    {
        // process
        // get hash key
        $result = $this->get_user_detail_by_username(array($username, $portal, $role_id));
        if (!empty($result)) {
            return password_verify($password, $result['password_hash']);
        } else {
            return FALSE;
        }
    }

    // get login auto role
    function get_user_login_auto_role($username, $password, $portal)
    {
        // process
        // get hash key
        $result = $this->get_user_detail_by_username_auto_role(array($username, $portal));
        if (!empty($result)) {
            return password_verify($password, $result['password_hash']);
        } else {
            return FALSE;
        }
    }

    // save user login
    function save_user_login($user_id, $remote_address)
    {
        // get today login
        $sql = "SELECT * FROM PKU.dbo.tac_com_user_login WHERE user_id = ?";
        $query = $this->db->query($sql, array($user_id));
        if ($query->getNumRows() > 0) {
            // tidak perlu diinputkan lagi
            return false;
        } else {
            $sql = "INSERT INTO PKU.dbo.tac_com_user_login (user_id, login_date, ip_address) VALUES (?, GETDATE(), ?)";
            return $this->db->query($sql, array($user_id, $remote_address));
        }
    }

    // save user logout
    function update_user_logout($user_id)
    {
        // update by this date
        $sql = "UPDATE PKU.dbo.tac_com_user_login SET logout_date = GETDATE() WHERE user_id = ?";
        return $this->db->query($sql, $user_id);
    }

    // get data pribadi
    function get_data_pribadi($params)
    {
        $sql = "SELECT a.*, c.role_id, c.role_nm, d.user_mail
                FROM users a 
                LEFT JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
                LEFT JOIN (SELECT * FROM PKU.dbo.tac_com_role WHERE portal_id = 2) c ON b.role_id = c.role_id
                LEFT JOIN PKU.dbo.tac_com_user d ON d.user_id = a.user_id
                WHERE a.user_id=?
                GROUP BY a.user_id";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    // get data pribadi
    function get_data_pribadi_ch($params)
    {
        $sql = "SELECT a.*, c.role_id, c.role_nm, d.user_mail
                FROM users a 
                LEFT JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
                LEFT JOIN (SELECT * FROM PKU.dbo.tac_com_role WHERE portal_id = 2) c ON b.role_id = c.role_id
                LEFT JOIN PKU.dbo.tac_com_user d ON d.user_id = a.user_id
                WHERE a.user_id=? AND b.role_id = ?
                GROUP BY a.user_id";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    // get data pribadi
    function role_aktif($params)
    {
        $sql = "SELECT a.*, c.role_id, c.role_nm, d.user_mail
                FROM users a 
                LEFT JOIN PKU.dbo.tac_com_role_user b ON a.user_id = b.user_id
                LEFT JOIN (SELECT * FROM PKU.dbo.tac_com_role WHERE portal_id = 2) c ON b.role_id = c.role_id
                LEFT JOIN PKU.dbo.tac_com_user d ON d.user_id = a.user_id
                WHERE a.user_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // update data pribadi
    function update_data_pribadi($user_id)
    {
        $sql = "UPDATE users SET nama_lengkap = ?,jenis_kelamin = ?, tmp_lahir = ?, tgl_lahir = ?, 
                alamat = ?, no_telp = ?,  mdb = ?, mdd = NOW() 
                WHERE user_id = ?";
        return $this->db->query($sql, $user_id);
    }

    //update email users
    function update_email_users($params)
    {
        $sql = "UPDATE PKU.dbo.tac_com_user SET user_mail = ?, mdb = ?, mdd = NOW() 
                WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // update nama file gambar
    function update_nama_file($params)
    {
        $sql = "UPDATE users SET user_img = ? 
            WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    //----------ACCOUNT---------------
    // get user account
    function get_user_account($id)
    {
        $sql = "SELECT a.*, b.* FROM PKU.dbo.tac_com_user a
            LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.user_name = b.FS_KD_PEG
            WHERE a.user_id = ?";
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
    function update_account($params)
    {
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

    // check username
    function is_exist_username($params)
    {
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
    function is_exist_password($user_id, $password)
    {
        $sql = "SELECT * FROM PKU.dbo.tac_com_user WHERE user_id = ?";
        $query = $this->db->query($sql, $user_id);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
        } else {
            return false;
        }

        return password_verify($password, $result['password_hash']);
    }
}
