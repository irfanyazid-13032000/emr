<?php namespace App\Models;

class M_farmasi {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }
    
    function insert($params) {
        $sql = "INSERT INTO TAC_RJ_RESEP( FS_KD_REG, FS_KD_BARANG,FN_QTY_BARANG,FS_KD_SATUAN,FN_DET_ORIG,
                FN_DET,FN_NEDET,FS_KETERANGAN, mdb, mdd)
                VALUES(?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }
    
     function delete($params) {
        $sql = "DELETE FROM TAC_RJ_RESEP WHERE FS_KD_TRS = ?";
        return $this->db->query($sql, $params);
    }
    function get_copy_resep($params) {
        $sql = "SELECT a.*,b.FS_NM_BARANG
                FROM TAC_RJ_RESEP a
                LEFT JOIN HOSPITAL.dbo.TB_BARANG b ON a.FS_KD_BARANG=b.FS_KD_BARANG
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
    
	function get_pasien_by_trs_hd($params) {
        $sql = "SELECT RIGHT(c.FS_MR,8) 'MR',a.FS_KD_REG,c.FD_TGL_LAHIR,FS_NM_PASIEN,
                FS_ALM_PASIEN,FS_NM_JAMINAN,FS_JNS_KELAMIN,FS_TB,FS_BB,g.FS_DIAGNOSA,c.FS_ALERGI,
                FS_NO_SJP,FS_NO_PESERTA,FS_NM_PEG,FS_NO_IJIN_PRAKTEK,FD_TGL_TRS,a.FS_KD_TRS, g.FS_TERAPI
                FROM HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN d ON b.FS_KD_TIPE_JAMINAN=d.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN e ON e.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN TAC_RJ_VITAL_SIGN f ON b.FS_KD_REG=f.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS g ON b.FS_KD_REG=g.FS_KD_REG
                INNER JOIN HOSPITAL.dbo.TD_PEG h on a.FS_KD_MEDIS_RESEP = h.FS_KD_PEG 
                WHERE a.FS_KD_TRS = ? AND a.FD_TGL_VOID = '3000-01-01'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
	
    function get_resep_by_rg($params) {
        $sql = "SELECT FS_KD_BARANG,FS_NM_BARANG,FN_QTY_BARANG,FS_KD_SATUAN 
                FROM HOSPITAL.dbo.TB_TRS_DOBILL_UMUM a
                LEFT JOIN HOSPITAL.dbo.TB_TRS_DOBILL_UMUM2 b ON a.FS_KD_TRS=b.FS_KD_TRS
                WHERE a.FS_KD_REG = ? AND FD_TGL_VOID = '3000-01-01' AND FS_KD_TRS_GEN = ''";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_qty_barang($params) {
        $sql = "SELECT FN_QTY_BARANG,FS_KD_SATUAN
                FROM HOSPITAL.dbo.TB_TRS_DOBILL_UMUM a
                LEFT JOIN HOSPITAL.dbo.TB_TRS_DOBILL_UMUM2 b ON a.FS_KD_TRS=b.FS_KD_TRS
                WHERE a.FS_KD_REG = ? AND FS_KD_BARANG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_resep_by_trs($params) {
        $sql = "SELECT a.FD_TGL_TRS,FS_NM_BARANG,FN_QTY_BARANG,FN_ETIKET_QTY,
                FS_ETIKET_HARI,FS_NM_CARAPAKAI_ETIKET,FS_ETIKET_CATATAN,FS_NM_SATUANPAKAI_ETIKET,
                b.FS_KD_SATUAN
                FROM HOSPITAL.dbo.TB_TRS_DOBILL_UMUM a
                LEFT JOIN HOSPITAL.dbo.TB_TRS_DOBILL_UMUM2 b ON a.FS_KD_TRS=b.FS_KD_TRS
                LEFT JOIN HOSPITAL.dbo.TB_CARAPAKAI_ETIKET c ON b.FS_ETIKET_KD_PAKAI=c.FS_KD_CARAPAKAI_ETIKET
                LEFT JOIN HOSPITAL.dbo.TB_SATUANPAKAI_ETIKET d ON d.FS_KD_SATUANPAKAI_ETIKET=b.FS_ETIKET_KD_SATUAN_PAKAI
                WHERE a.FS_KD_TRS = ? 
                ORDER BY FN_NO_URUT ASC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    function get_data_farmasi($params) {
        $sql = "SELECT FS_KD_TRS
                FROM HOSPITAL.dbo.TB_TRS_DOBILL_UMUM
                WHERE FS_KD_REG = ? AND FS_KD_LAYANAN = 'O004'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_px_by_dokter_by_rg2($params) {
        $sql = "SELECT b.FS_NO_PESERTA,a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,FS_NM_LAYANAN,b.FS_KD_LAYANAN,
                b.FS_KD_LAYANAN2,b.FS_KD_LAYANAN3,b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB,h.FS_NM_PEG 'DOK2',
                i.FS_KD_TRS,a.FS_TEMP_LAHIR,b.FS_NO_SJP,a.FS_HIGH_RISK,i.mdd,j.FS_ALERGI2,f.FS_KD_LAYANAN_BPJS,a.FS_NM_SUAMI,a.FS_TGL_LAHIR_SUAMI
                ,b.FS_NO_SJP,b.FS_KD_TIPE_JAMINAN,k.FS_KD_TRS AS 'FS_KD_TRS_KP',i.FS_DIAGNOSA,l.FD_TGL_TRS,l.FS_KD_TRS,m.FS_NM_BARANG
                FROM HOSPITAL.dbo.TC_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN c ON b.FS_KD_TIPE_JAMINAN=c.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN d ON c.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON b.FS_KD_MEDIS=e.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON b.FS_KD_MEDIS2=h.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN f ON b.FS_KD_LAYANAN=f.FS_KD_LAYANAN
                LEFT JOIN TAC_RJ_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS i ON b.FS_KD_REG=i.FS_KD_REG
                LEFT JOIN TAC_RJ_ALERGI j ON b.FS_KD_REG=j.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA k ON b.FS_KD_REG=k.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TB_TRS_DOBILL_UMUM l ON b.FS_KD_REG=l.FS_KD_REG
				LEFT JOIN HOSPITAL.dbo.TB_TRS_DOBILL_UMUM2 m ON l.FS_KD_TRS=m.FS_KD_TRS
                WHERE b.FS_KD_REG = ? AND l.FS_KD_LAYANAN = 'O004'";
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
