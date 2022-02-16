<?php

namespace App\Models;

class M_rawat_jalan_nurse
{

    protected $db;

    function __construct()
    {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_last_inserted_id()
    {
        return $this->db->insertID();
    }

    function insert_alergi($params)
    {
        $sql = "UPDATE HOSPITAL.dbo.TC_MR SET FS_ALERGI = ?, FS_REAK_ALERGI = ?, FS_RIW_PENYAKIT_DAHULU=?, FS_RIW_PENYAKIT_DAHULU2=?
                WHERE FS_MR = ?";
        return $this->db->query($sql, $params);
    }

    function insert_fisio($params)
    {
        $sql = "INSERT INTO TAC_RJ_FISIO (FS_KD_REG, FS_NM_INSPEKSI, FS_NM_PALPASI, FS_NM_PEM_SPESIFIK, FS_NM_DIAG_FISIO,
                FS_NM_INTERVENSI_BPJS,FS_NM_KET_INTERVENSI,FS_CARA_PULANG, mdb, mdd)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function insert_geriatri($params)
    {
        $sql = "INSERT
                INTO TAC_RJ_GERIATRI(FS_KD_REG, FS_GERIATRI1, FS_GERIATRI2, FS_GERIATRI3)
                VALUES (?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function insert_ases($params)
    {
        $sql = "INSERT INTO TAC_ASES_PER2(FS_KD_REG, FS_RIW_PENYAKIT_DAHULU, FS_RIW_PENYAKIT_DAHULU2, FS_RIW_PENYAKIT_KEL, FS_RIW_PENYAKIT_KEL2,
                FS_STATUS_PSIK,FS_STATUS_PSIK2,FS_HUB_KELUARGA,FS_ST_FUNGSIONAL,FS_AGAMA,FS_NILAI_KHUSUS,FS_NILAI_KHUSUS2,FS_ANAMNESA,FS_PENGELIHATAN,
                FS_PENCIUMAN,FS_PENDENGARAN,FS_RIW_IMUNISASI,FS_RIW_IMUNISASI_KET,FS_RIW_TUMBUH,FS_RIW_TUMBUH_KET,FS_HIGH_RISK,FS_EDUKASI,FS_PEMERIKSAAN_FISIK,
                mdb,mdd)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    }

    function update_ases($params)
    {
        $sql = "UPDATE TAC_ASES_PER2 SET FS_RIW_PENYAKIT_DAHULU=?, FS_RIW_PENYAKIT_DAHULU2=?, FS_RIW_PENYAKIT_KEL=?, FS_RIW_PENYAKIT_KEL2=?,
                FS_STATUS_PSIK=?,FS_STATUS_PSIK2=?,FS_HUB_KELUARGA=?,FS_ST_FUNGSIONAL=?,FS_AGAMA=?,FS_NILAI_KHUSUS=?,FS_NILAI_KHUSUS2=?,FS_ANAMNESA=?,
                FS_PENGELIHATAN=?, FS_PENCIUMAN=?,FS_PENDENGARAN=?,FS_RIW_IMUNISASI=?,FS_RIW_IMUNISASI_KET=?,FS_RIW_TUMBUH=?,FS_RIW_TUMBUH_KET=?, FS_HIGH_RISK=?, 
                FS_EDUKASI=?,FS_PEMERIKSAAN_FISIK=?,mdb=?,mdd=?
                WHERE FS_KD_REG =?";
        return $this->db->query($sql, $params);
    }

    function update_geriatri($params)
    {
        $sql = "UPDATE TAC_RJ_GERIATRI SET FS_GERIATRI1=?, FS_GERIATRI2=?, FS_GERIATRI3=?
                WHERE FS_KD_REG =?";
        return $this->db->query($sql, $params);
    }

    function get_px_by_dokter_by_rg2($params)
    {
        $sql = "SELECT b.FS_NO_PESERTA,a.FS_NM_PASIEN,a.FS_MR,a.FS_ALM_PASIEN,FS_JNS_KELAMIN, a.FS_KD_IDENTITAS,
                ISNULL(datediff(year,a.fd_tgl_lahir,?),0) fn_umur,b.FS_KD_REG,
                d.FS_NM_JAMINAN,e.FS_NM_PEG,a.FD_TGL_LAHIR,b.FD_TGL_MASUK,FS_NM_LAYANAN,b.FS_KD_LAYANAN,
                b.FS_KD_LAYANAN2,b.FS_KD_LAYANAN3,b.FS_KD_MEDIS,e.FS_NO_IJIN_PRAKTEK,RIGHT(a.FS_MR,8) 'MR',g.FS_TB,g.FS_BB,h.FS_NM_PEG 'DOK2',
                i.FS_KD_TRS,a.FS_TEMP_LAHIR,b.FS_NO_SJP,a.FS_HIGH_RISK,i.mdd,a.FS_ALERGI,f.FS_KD_LAYANAN_BPJS,a.FS_NM_SUAMI,a.FS_TGL_LAHIR_SUAMI
                ,b.FS_NO_SJP,b.FS_KD_TIPE_JAMINAN,k.FS_KD_TRS AS 'FS_KD_TRS_KP',a.FS_REAK_ALERGI,a.FS_RIW_PENYAKIT_DAHULU,i.FS_CARA_PULANG,
                a.FS_RIW_PENYAKIT_DAHULU2,l.FS_ANAMNESA,l.FS_EDUKASI,l.FS_PEMERIKSAAN_FISIK,m.FS_NM_PEKERJAAN_DK,n.FS_NM_PENDIDIKAN_DK
                FROM HOSPITAL.dbo.TC_MR a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN c ON b.FS_KD_TIPE_JAMINAN=c.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN d ON c.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG e ON b.FS_KD_MEDIS=e.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TD_PEG h ON b.FS_KD_MEDIS2=h.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN f ON b.FS_KD_LAYANAN=f.FS_KD_LAYANAN
                LEFT JOIN TAC_RJ_VITAL_SIGN g ON b.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS i ON b.FS_KD_REG=i.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA k ON b.FS_KD_REG=k.FS_KD_REG
                LEFT JOIN TAC_ASES_PER2 l ON b.FS_KD_REG=l.FS_KD_REG
				LEFT JOIN HOSPITAL.dbo.TA_PEKERJAAN_DK m ON a.FS_KD_PEKERJAAN_DK=m.FS_KD_PEKERJAAN_DK
				LEFT JOIN HOSPITAL.dbo.TA_PENDIDIKAN_DK n ON a.FS_KD_PENDIDIKAN_DK=n.FS_KD_PENDIDIKAN_DK
                WHERE b.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_px_history($params)
    {
        $sql = "SELECT TOP 100 a.FS_KD_REG,b.FS_NM_PASIEN,a.FS_MR,a.FD_TGL_MASUK,c.FS_NM_PEG
                ,a.FS_KD_JENIS_REG,d.FS_NM_LAYANAN,MAX_RG,g.FS_KD_MEDIS,i.FS_NM_PEG 'DOK2',
                g.FS_KD_TRS,k.FS_NM_LAYANAN 'LAYANAN2',a.FD_TGL_KELUAR,g.FS_CARA_PULANG,g.FS_TERAPI,FS_FORM
                FROM HOSPITAL.dbo.TA_REGISTRASI a
                INNER JOIN HOSPITAL.dbo.TC_MR b ON a.FS_MR=b.FS_MR
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON a.FS_KD_MEDIS = c.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI h ON a.FS_KD_REG = h.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG i ON h.FS_KD_MEDIS2 = i.FS_KD_PEG
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN d ON a.FS_KD_LAYANAN = d.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN k ON a.FS_KD_LAYANAN2 = k.FS_KD_LAYANAN
                LEFT JOIN (
                    SELECT FS_KD_REG 'MAX_RG',FS_MR
                    FROM HOSPITAL.dbo.TA_REGISTRASI 
                    WHERE FD_TGL_MASUK = ? AND (FS_KD_MEDIS = ? OR FS_KD_MEDIS2 = ? OR FS_KD_MEDIS3 = ?)
                    AND FD_TGL_VOID = '3000-01-01'
                )e ON a.FS_MR = e.FS_MR
                LEFT JOIN TAC_RJ_MEDIS g ON a.FS_KD_REG=g.FS_KD_REG
                LEFT JOIN TAC_RJ_STATUS j ON a.FS_KD_REG=j.FS_KD_REG
                 LEFT JOIN (
                    SELECT DISTINCT FS_KD_REG
                    FROM HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA
                    WHERE FS_KD_MEDIS_RESEP <>''
                )f ON a.FS_KD_REG=f.FS_KD_REG
                WHERE a.FS_MR = ? AND a.FD_TGL_VOID = '3000-01-01'
                ORDER BY a.FD_TGL_MASUK DESC,a.FS_JAM_MASUK DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_data_skdp_by_rg($params)
    {
        $sql = "SELECT a.*,b.FS_NM_SKDP_ALASAN,c.FS_NM_SKDP_RENCANA,d.FS_NM_PEG
                FROM TAC_RJ_SKDP a
                LEFT JOIN TAC_COM_PARAMETER_SKDP_ALASAN b ON a.FS_SKDP_1=b.FS_KD_TRS
                LEFT JOIN TAC_COM_PARAMETER_SKDP_RENCANA c ON a.FS_SKDP_2=c.FS_KD_TRS
                LEFT JOIN HOSPITAL.dbo.TD_PEG d ON a.mdb=d.FS_KD_PEG
                WHERE a.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function list_masalah_kep_by_rg($params)
    {
        $sql = "SELECT *
                FROM TAC_RJ_MASALAH_KEP a
                LEFT JOIN TAC_COM_DAFTAR_DIAG b ON a.FS_KD_MASALAH_KEP=b.FS_KD_DAFTAR_DIAGNOSA
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

    function list_rencana_kep_by_rg($params)
    {
        $sql = "SELECT * FROM
                TAC_RJ_REN_KEP a
                LEFT JOIN TAC_COM_PARAM_REN_KEP b ON a.FS_KD_REN_KEP=b.FS_KD_TRS
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

    function mencari_keperawatan($params)
    {
        $sql = "SELECT * FROM
        TAC_RJ_REN_KEP
        INNER JOIN TAC_COM_PARAM_REN_KEP ON TAC_RJ_REN_KEP.FS_KD_REN_KEP=TAC_COM_PARAM_REN_KEP.FS_KD_TRS 
        WHERE TAC_RJ_REN_KEP.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function mencari_kebenaran($params)
    {
        $sql = "SELECT * FROM
        TAC_RJ_REN_KEP
        
        WHERE TAC_RJ_REN_KEP.FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_data_geritri_by_rg($params)
    {
        $sql = "SELECT *
                FROM TAC_RJ_GERIATRI
                WHERE FS_KD_REG = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return [];
        }
    }

    function get_resume_rawat_jalan($params)
    {
        $sql = "SELECT a.mdd,c.FS_NM_PEG,a.FS_DIAGNOSA,a.FS_TERAPI,a.FS_ANAMNESA,f.FS_NM_PEG 'PPA', a.FS_TINDAKAN, a.FS_CATATAN_FISIK, a.FS_EDUKASI, a.FS_DAFTAR_MASALAH
                FROM TAC_RJ_MEDIS a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON a.FS_KD_MEDIS=c.FS_KD_PEG
                LEFT JOIN TAC_RJ_VITAL_SIGN d ON b.FS_KD_REG=d.FS_KD_REG
                LEFT JOIN TAC_COM_USER e ON d.mdb=e.user_id
                LEFT JOIN HOSPITAL.dbo.TD_PEG f ON e.user_name=f.FS_KD_PEG
                WHERE b.FS_MR = ?
                ORDER BY mdd DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }
}
