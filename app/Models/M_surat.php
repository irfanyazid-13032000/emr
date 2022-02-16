<?php namespace App\Models;

class M_surat {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function insert($params) {
        $sql = "INSERT INTO HOSPITAL.dbo.TZ_TRS_SURAT(FS_KD_TRS, FD_TGL_TRS, FS_JAM_TRS, FN_JENIS_SURAT, FS_NO_SURAT, FS_KD_REG, FS_KD_MEDIS,
                FS_KETERANGAN14, FS_KETERANGAN13, FS_KD_PETUGAS, FS_KD_PEG)
                VALUES     (?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
	
	function insert_rapid($params) {
        $sql = "INSERT INTO HOSPITAL.dbo.TZ_TRS_SURAT(FS_KD_TRS, FD_TGL_TRS, FS_JAM_TRS, FN_JENIS_SURAT, FS_NO_SURAT, FS_KD_REG, FS_KD_MEDIS,
                FS_KONDISI_PERTAMA, FS_KONDISI_KEDUA, FS_KETERANGAN15, FD_TGL_RAPID, FS_REAKTIF, FS_REAKTIF_IGG, FS_REAKTIF_IGG_IGM, FS_NON_REAKTIF, FS_KD_PETUGAS, FS_KD_PEG)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
	
	function insert_pcr($params) {
        $sql = "INSERT INTO HOSPITAL.dbo.TZ_TRS_SURAT(FS_KD_TRS, FD_TGL_TRS, FS_JAM_TRS, FN_JENIS_SURAT, FS_NO_SURAT, FS_KD_REG, FS_KD_MEDIS,
                FS_PCR_POSITIF, FS_PCR_NEGATIF, FS_KD_PETUGAS, FS_KD_PEG)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
	
	function insert_pcr_cetak($params) {
        $sql = "INSERT INTO HOSPITAL.dbo.TA_TRS_TDK_UMUM5(FS_KD_TRS, FS_KD_TARIF, FS_KD_JENIS_PEMERIKSAAN, FS_HASIL, FS_KETERANGAN,
		FD_TGL_TEST, FS_JAM_TEST, FB_VERIFIKASI_JENIS, CRTTGL, CRTJAM, CRTIPA, CRTVER, CRTUSR, UPDTGL, UPDJAM, UPDIPA, UPDVER, UPDUSR)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
		
	function insert_rapid_antigen($params) {
        $sql = "INSERT INTO HOSPITAL.dbo.TZ_TRS_SURAT(FS_KD_TRS, FD_TGL_TRS, FS_JAM_TRS, FN_JENIS_SURAT, FS_NO_SURAT, FS_KD_REG, FS_KD_MEDIS,
                FS_RAPID_ANTIGEN_POSITIF, FS_RAPID_ANTIGEN_NEGATIF, FS_KD_PETUGAS, FS_KD_PEG)
                VALUES     (?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
	
    function update($params) {
        $sql = "UPDATE HOSPITAL.dbo.TZ_TRS_SURAT SET FS_KETERANGAN14=?, FS_KETERANGAN13=? WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }
	
	function update_rapid($params) {
        $sql = "UPDATE HOSPITAL.dbo.TZ_TRS_SURAT SET FS_KONDISI_PERTAMA=?, FS_KONDISI_KEDUA=?, FS_KETERANGAN15=?, FD_TGL_RAPID=?, FS_REAKTIF=?, FS_REAKTIF_IGG=?, FS_REAKTIF_IGG_IGM=?, FS_NON_REAKTIF=? WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }
	
	function update_pcr($params) {
        $sql = "UPDATE HOSPITAL.dbo.TZ_TRS_SURAT SET FS_PCR_POSITIF=?, FS_PCR_NEGATIF=? WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }
	
	function update_rapid_antigen($params) {
        $sql = "UPDATE HOSPITAL.dbo.TZ_TRS_SURAT SET FS_RAPID_ANTIGEN_POSITIF=?, FS_RAPID_ANTIGEN_NEGATIF=? WHERE FS_KD_TRS = ?";
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
	
	function get_px_by_dokter_wait_pcr($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_TERAPI,a.FS_KD_LAYANAN,a.FS_KD_LAYANAN2,a.FS_KD_LAYANAN3,d.FS_KD_TRS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TZ_TRS_SURAT d ON a.FS_KD_REG = d.FS_KD_REG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
				AND a.FS_KD_LAYANAN='P069'
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
	
	function get_px_by_dokter_wait_pcr_saliva($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_TERAPI,a.FS_KD_LAYANAN,a.FS_KD_LAYANAN2,a.FS_KD_LAYANAN3,d.FS_KD_TRS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TZ_TRS_SURAT d ON a.FS_KD_REG = d.FS_KD_REG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
				AND a.FS_KD_LAYANAN='P071'
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
	
	function get_px_by_dokter_wait_pcr_ranap($params) {
        $sql = "SELECT a.FS_KD_REG,e.FS_KD_TRS,b.FS_NM_PASIEN,c.FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                h.FS_NM_LAYANAN, a.FS_KD_LAYANAN,a.FS_KD_LAYANAN2,a.FS_KD_LAYANAN3,e.FD_TGL_TRS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
				LEFT JOIN HOSPITAL.dbo.TZ_TRS_SURAT d ON a.FS_KD_REG = d.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_TDK_UMUM e ON a.FS_KD_REG = e.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_TDK_UMUM2 f ON e.FS_KD_TRS = f.FS_KD_TRS
				LEFT JOIN HOSPITAL.dbo.TA_TARIF g ON g.FS_KD_TARIF = f.FS_KD_TARIF
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN h ON a.FS_KD_LAYANAN = h.FS_KD_LAYANAN
                WHERE e.FD_TGL_TRS = ? AND a.FS_KD_JENIS_REG = '1' AND f.FS_KD_TARIF='23202378'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
	
	
	
	function get_px_by_dokter_wait_rta($params) {
        $sql = "SELECT a.FS_KD_REG,b.FS_NM_PASIEN,FN_NO_URUT,a.FS_MR,b.FS_ALM_PASIEN,
                FS_TERAPI,a.FS_KD_LAYANAN,a.FS_KD_LAYANAN2,a.FS_KD_LAYANAN3,d.FS_KD_TRS
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TRS_ANTRIAN c ON a.FS_KD_REG = c.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TZ_TRS_SURAT d ON a.FS_KD_REG = d.FS_KD_REG
                WHERE a.FD_TGL_MASUK = ? AND a.FD_TGL_VOID = '3000-01-01'
                AND a.FS_KD_JENIS_REG <> '1' AND (a.FS_KD_MEDIS = ? OR FS_KD_MEDIS2 = ? OR FS_KD_MEDIS3=?) AND a.FS_KD_LAYANAN='P070'
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
