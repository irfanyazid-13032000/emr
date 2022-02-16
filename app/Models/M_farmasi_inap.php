<?php namespace App\Models;

class M_farmasi_inap {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    function get_pasien_by_trs($params) {
        $sql = "SELECT RIGHT(c.FS_MR,8) 'MR',a.FS_KD_REG,c.FD_TGL_LAHIR,FS_NM_PASIEN,
                FS_ALM_PASIEN,FS_NM_JAMINAN,FS_JNS_KELAMIN,FS_TB,FS_BB,g.FS_DIAGNOSA,c.FS_ALERGI,
                FS_NO_SJP,FS_NO_PESERTA,FS_NM_PEG,FS_NO_IJIN_PRAKTEK,FD_TGL_TRS,a.FS_KD_TRS, i.FS_NM_LAYANAN
                FROM HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA a
                LEFT JOIN HOSPITAL.dbo.TA_REGISTRASI b ON a.FS_KD_REG=b.FS_KD_REG
                LEFT JOIN HOSPITAL.dbo.TC_MR c ON b.FS_MR=c.FS_MR
                LEFT JOIN HOSPITAL.dbo.TA_TIPE_JAMINAN d ON b.FS_KD_TIPE_JAMINAN=d.FS_KD_TIPE_JAMINAN
                LEFT JOIN HOSPITAL.dbo.TA_JAMINAN e ON e.FS_KD_JAMINAN=d.FS_KD_JAMINAN
                LEFT JOIN TAC_RJ_VITAL_SIGN f ON b.FS_KD_REG=f.FS_KD_REG
                LEFT JOIN TAC_RJ_MEDIS g ON b.FS_KD_REG=g.FS_KD_REG
				LEFT JOIN HOSPITAL.dbo.TA_LAYANAN i on a.FS_KD_LAYANAN = i.FS_KD_LAYANAN
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

    function get_resep_by_trs($params) {
        $sql = "SELECT FS_KD_BARANG,FS_NM_BARANG,FN_QTY_BARANG,FS_KD_SATUAN,
                FN_ETIKET_QTY,FN_ETIKET_HARI,b.FS_ETIKET_CATATAN
                FROM HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA a
                LEFT JOIN HOSPITAL.dbo.TA_TRS_KARTU_PERIKSA3 b ON a.FS_KD_TRS=b.FS_KD_TRS
                WHERE a.FS_KD_TRS = ? AND a.FD_TGL_VOID = '3000-01-01'";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_px_by_farmasi($params) {
        $sql = "SELECT bb.fs_jam_trs, fs_nm_layanan, dd.fs_nm_peg, oo.fs_nm_tipe_jaminan, 
                CASE 
                WHEN nn.fd_tgl_void <> '3000-01-01' then ' ' 
                ELSE ISNULL(nn.fs_kd_trs, ' ')
                end As fs_kd_du,bb.fs_kd_trs, mm.fs_nm_pasien,RIGHT(rr.fs_mr,8) AS 'FS_MR', rr.FD_TGL_KELUAR 
                FROM        HOSPITAL.dbo.ta_trs_kartu_periksa bb 
                INNER JOIN HOSPITAL.dbo.td_peg dd on bb.fs_kd_medis_resep = dd.fs_kd_peg 
                INNER JOIN HOSPITAL.dbo.ta_layanan ll on bb.fs_kd_layanan = ll.fs_kd_layanan 
                INNER JOIN HOSPITAL.dbo.ta_registrasi rr on bb.fs_kd_reg  = rr.fs_kd_reg 
                INNER JOIN HOSPITAL.dbo.tc_mr mm on rr.fs_mr = mm.fs_mr 
                LEFT JOIN  HOSPITAL.dbo.tb_trs_dobill_umum nn on bb.fs_kd_trs = nn.fs_kd_resep and nn.fd_tgl_void = '3000-01-01' 
                LEFT JOIN  HOSPITAL.dbo.ta_tipe_jaminan oo on rr.fs_kd_tipe_jaminan = oo.fs_kd_tipe_jaminan 
                WHERE rr.fs_kd_jenis_reg = '1' AND fb_close_resep = 0 AND bb.fd_tgl_trs = ?  AND bb.fd_tgl_void = '3000-01-01' 
                AND bb.fs_kd_trs IN (SELECT fs_kd_trs FROM HOSPITAL.dbo.ta_trs_kartu_periksa3) 
                ORDER BY       bb.fs_jam_trs DESC, fs_nm_layanan, dd.fs_nm_peg, ISNULL(oo.fs_nm_tipe_jaminan,''), bb.fs_kd_trs, mm.fs_nm_pasien, RIGHT(rr.fs_mr,8)";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_pasien_udd_by_trs($params) {
        $sql = "SELECT RIGHT(cc.FS_MR,8) 'MR',cc.FS_NM_PASIEN,FD_TGL_LAHIR,
                ISNULL(ee.fs_nm_bed, ' ') fs_nm_bed,FS_NAMA_OBAT,FS_DOSIS_OBAT,
                FS_INTERVAL, bb.FS_KD_REG
                FROM ( 
                    SELECT      fs_kd_trs 
                    FROM        HOSPITAL.dbo.TA_TRS_BED 
                    WHERE       fd_tgl_in <= ? 
                    AND fd_tgl_out + fs_jam_out >= ? 
                    AND fd_tgl_void = '3000-01-01' 
                    ) aa1 
                LEFT JOIN HOSPITAL.dbo.ta_trs_bed aa ON aa1.fs_kd_trs = aa.fs_kd_trs 
                LEFT JOIN HOSPITAL.dbo.ta_registrasi bb ON aa.fs_kd_reg = bb.fs_kd_reg 
                LEFT JOIN HOSPITAL.dbo.tc_mr cc ON bb.fs_mr = cc.fs_mr 
                LEFT JOIN HOSPITAL.dbo.ta_layanan dd ON aa.fs_kd_layanan = dd.fs_kd_layanan 
                LEFT JOIN HOSPITAL.dbo.ta_bed ee ON aa.fs_kd_bed = ee.fs_kd_bed 
                LEFT JOIN HOSPITAL.dbo.ta_kamar ff ON ee.fs_kd_kamar = ff.fs_kd_kamar 
                LEFT JOIN HOSPITAL.dbo.ta_bangsal gg ON ff.fs_kd_bangsal = gg.fs_kd_bangsal
                LEFT JOIN TAB_RM_17 hh on bb.FS_KD_REG = hh.FS_KD_REG 
                WHERE hh.FS_KD_RM17 = ? AND bb.FD_TGL_VOID = '3000-01-01'";
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
