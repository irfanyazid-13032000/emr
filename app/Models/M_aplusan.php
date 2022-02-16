<?php namespace App\Models;

class M_aplusan {

    protected $db;

    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }

    /*
     * SURAT MASUK
     */

    // get last inserted id
    function get_last_inserted_id() {
        return $this->db->insertID();
    }

    function cek_aplusan($params) {
        $sql = "SELECT * FROM TAB_APLUSAN WHERE FS_SHIFT = ? AND FS_KD_REG = ?
                AND mdd = ?";
        $query = $this->db->query($sql, $params);
        $result = $query->getNumRows();
        $query->freeResult();
        return $result;
    }

    // get all instansi
    function get_all_pegawai() {
        $sql = "SELECT FS_KD_PEG,FS_NM_PEG FROM HOSPITAL.dbo.TD_PEG
                where ISNUMERIC(FS_KD_PEG) = 1
                GROUP BY FS_KD_PEG,FS_NM_PEG
                ORDER BY FS_NM_PEG ";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // get list pegawai
    function get_total_apulsan_task($params) {
        $sql = "SELECT COUNT(*) 'total'
                FROM TAB_APULSAN 
                WHERE FS_STATUS = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return array();
        }
    }

    function get_apulsan_by_id($params) {
        $sql = "SELECT a.*,b.FS_NM_LAYANAN,c.FS_NM_PEG FROM TAB_APULSAN a
                LEFT JOIN HOSPITAL.dbo.TA_LAYANAN b ON a.FS_KD_LAYANAN=b.FS_KD_LAYANAN
                LEFT JOIN HOSPITAL.dbo.TD_PEG c ON a.FS_KD_PEG=c.FS_KD_PEG
                WHERE FS_KD_APULSAN = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    // total surat masuk
    function get_total_aplusan_lap($params) {
        $sql = "SELECT COUNT(*)'total' FROM
                    (
                        SELECT *
                        FROM TAB_APLUSAN
                        WHERE FS_KD_LAYANAN LIKE ? AND MONTH(mdd) LIKE ? AND YEAR(mdd) LIKE ? 
                       
                    ) result
                    ";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result['total'];
        } else {
            return 0;
        }
    }

    // list surat masuk
    function get_aplusan_by_id($params) {
        $sql = " SELECT     aa.fs_kd_reg, bb.fs_mr, cc.fs_kd_identitas,
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien, 
            ISNULL(datediff(year,cc.fd_tgl_lahir,isnull(nn1.fd_tgl_in,bb.fd_tgl_masuk)),0) fn_umur, 
            ISNULL(zz.FS_KONDISI_PASIEN, ' ') FS_KONDISI_PASIEN, 
            isnull(zz.FS_TINDAKAN,' ') FS_TINDAKAN, 
            ISNULL(zz.FS_RESPON, ' ') FS_RESPON, 
            ISNULL(dd.fs_nm_layanan, ' ') fs_nm_layanan, 
            ISNULL(zz.FS_CATATAN, ' ')FS_CATATAN, 
            ISNULL(pp.FS_NM_INSTALASI, 0) fs_nm_instalasi, 
            ISNULL(gg.fs_nm_bangsal, ' ') fs_nm_bangsal, 
            ISNULL(ff.fs_nm_kamar, ' ') fs_nm_kamar, 
            ISNULL(ee.fs_nm_bed, ' ') fs_nm_bed, 
            ISNULL(jj.fs_nm_peg,' ') FS_NM_PEG, 
            ISNULL(jj.fs_kd_peg,' ') FS_KD_PEG, 
            ISNULL(zz.mdd, ' ') mdd, 
            ISNULL(zz.fs_kd_apulsan, ' ') fs_kd_apulsan, 
            ISNULL(zx.FS_ADMINISTRATIF, ' ') FS_ADMINISTRATIF, 
            ISNULL(zx.FS_KD_APULSAN_ADMIN, ' ') FS_KD_APULSAN_ADMIN, 
            ISNULL(aa.fd_tgl_in, ' ') fd_tgl_bed, 
            ISNULL(bb.fd_tgl_masuk, ' ') fd_tgl_masuk, 
            ISNULL(zz.FS_SHIFT, ' ') FS_SHIFT, ISNULL(mm1.fn_hari_bed,0) fn_hari_bed, 
            ISNULL(aa2.fs_no_sep, ' ') fs_no_sep, ISNULL(ll1.fn_hari_rawat, 0) fn_hari_rawat, 
            CASE ISNULL(kk1.fn_count_tdk,0) 
                WHEN 0 THEN 'BELUM ADA' 
                ELSE CAST(kk1.fn_count_tdk AS VARCHAR(20)) + ' x' 
            END AS fs_status, 
            CASE bb.fb_dpp 
            WHEN 1 THEN 'Dokter Pilihan Pasien' 
                   ELSE 'Dokter Pilihan RS' 
            END as fs_nm_dpp,  
            ISNULL(nn.fs_nm_kelas, ' ') fs_nm_kelas, 
            ISNULL(oo.fn_nilai_deposit, 0) fn_nilai_deposit, 
            ISNULL(qq.fs_nm_kelas, ' ') fs_kelas_polis, 
            iSNUll(gj.fs_nm_grup_jaminan, '')fs_nm_grup_jaminan, 
            ISNULL(bb.fs_anamnese, ' ')fs_anamnese, 
            ISNULL(ll1.fs_kd_range, ' ') fs_kd_range,  
            ISNULL(ti.fs_nm_tujuan_inap,'')fs_nm_tujuan_inap, 
            CASE ISNULL(ll1.fs_kd_range, ' ')  
                WHEN 'A' THEN 'Kurang dari 10 Hari' 
                WHEN 'B' THEN '10 s/d 20 Hari' 
                WHEN 'C' THEN '20 s/d 30 Hari' 
                WHEN 'D' THEN 'Lebih dari 30 hari' 
                ELSE ' '
            END AS fs_nm_range
        FROM       ( 
                    SELECT      fs_kd_trs 
                    FROM        HOSPITAL.dbo.TA_TRS_BED 
                    WHERE       fd_tgl_in <= ? 
                            AND fd_tgl_out + fs_jam_out >= ? 
                            AND fd_tgl_void = '3000-01-01' 
                    ) aa1 
        LEFT JOIN  HOSPITAL.dbo.ta_trs_bed aa ON aa1.fs_kd_trs = aa.fs_kd_trs 
        LEFT JOIN  HOSPITAL.dbo.ta_registrasi bb ON aa.fs_kd_reg = bb.fs_kd_reg 
        LEFT JOIN  HOSPITAL.dbo.tc_mr cc ON bb.fs_mr = cc.fs_mr 
        LEFT JOIN  HOSPITAL.dbo.ta_layanan dd ON aa.fs_kd_layanan = dd.fs_kd_layanan 
        LEFT JOIN  HOSPITAL.dbo.ta_bed ee ON aa.fs_kd_bed = ee.fs_kd_bed 
        LEFT JOIN  HOSPITAL.dbo.ta_kamar ff ON ee.fs_kd_kamar = ff.fs_kd_kamar 
        LEFT JOIN  HOSPITAL.dbo.ta_bangsal gg ON ff.fs_kd_bangsal = gg.fs_kd_bangsal 
        LEFT JOIN  HOSPITAL.dbo.ta_tipe_jaminan hh ON bb.fs_kd_tipe_jaminan = hh.fs_kd_tipe_jaminan 
        LEFT JOIN  HOSPITAL.dbo.ta_jaminan ii ON hh.fs_kd_jaminan = ii.fs_kd_jaminan 

        LEFT JOIN  HOSPITAL.dbo.TD_PEG kk ON bb.FS_KD_MEDIS = kk.FS_KD_PEG 
        LEFT JOIN  HOSPITAL.dbo.ta_agama mm ON cc.FS_KD_AGAMA = mm.FS_KD_AGAMA 
        LEFT JOIN  HOSPITAL.dbo.ta_kelas qq ON hh.fs_kd_kelas = qq.fs_kd_kelas 
        LEFT JOIN  HOSPITAL.dbo.tl_fbagian tl ON dd.fs_kd_fbagian = tl.fs_kd_fbagian 
        LEFT JOIN  HOSPITAL.dbo.ta_grup_jaminan gj ON ii.fs_kd_grup_jaminan = gj.fs_kd_grup_jaminan 
        LEFT JOIN  HOSPITAL.dbo.ta_trs_sep aa2 ON bb.fs_kd_reg = aa2.fs_kd_reg 
        LEFT JOIN (
                SELECT          xx1.fs_kd_reg, xx2.fs_no_polis, xx2.fs_atas_nama, xx2.fs_kd_tipe_jaminan, xx3.fs_kd_status,
                                xx4.fs_kd_bu ,xx4.fs_nm_bu, xx5.fs_nm_status_peserta 
                FROM            HOSPITAL.dbo.TA_REG_JAMINAN xx1 
                LEFT JOIN       HOSPITAL.dbo.TA_REGISTRASI x on xx1.FS_KD_REG = x.FS_KD_REG        LEFT JOIN       HOSPITAL.dbo.TA_POLIS xx2 ON   xx1.FS_KD_POLIS = xx2.FS_KD_POLIS 
                LEFT JOIN       HOSPITAL.dbo.TA_POLIS_COVER xx3 ON xx2.fs_kd_polis = xx3.fs_kd_polis and xx3.FS_MR = x.FS_MR
                LEFT JOIN       HOSPITAL.dbo.TA_BU xx4 ON xx2.fs_kd_bu = xx4.fs_kd_bu 
                LEFT JOIN       HOSPITAL.dbo.TA_STATUS_PESERTA xx5 ON xx3.fs_kd_status = xx5.fs_kd_status_peserta 
                    ) xxx ON bb.fs_kd_reg = xxx.fs_kd_reg AND bb.fs_kd_tipe_jaminan = xxx.fs_kd_tipe_jaminan 
        LEFT JOIN   HOSPITAL.dbo.ta_reg_inap rr ON bb.fs_kd_reg = rr.fs_kd_reg  LEFT JOIN   HOSPITAL.dbo.ta_jenis_inap ji ON bb.fs_kd_jenis_inap = ji.fs_kd_jenis_inap 
        LEFT JOIN   HOSPITAL.dbo.ta_trs_booking_bed tt ON rr.fs_kd_trs_booking_bed = tt.fs_kd_trs 
        LEFT JOIN   HOSPITAL.dbo.ta_tujuan_inap ti ON tt.fs_kd_tujuan_inap = ti.fs_kd_tujuan_inap 
        LEFT JOIN   HOSPITAL.dbo.TD_PEG kkz ON rr.fs_kd_medis_sekunder = kkz.FS_KD_PEG
        LEFT JOIN  ( 
                    SELECT      fs_kd_reg, sum(fn_total_bayar) fn_nilai_deposit 
                    FROM        HOSPITAL.dbo.TA_TRS_DEPOSIT 
                    WHERE       FD_TGL_VOID = '3000-01-01' 
                    GROUP BY    fs_kd_reg 
                    ) oo ON aa.fs_kd_reg = oo.fs_kd_reg 
        LEFT JOIN  ( 
                    SELECT      fs_kd_reg, fs_kd_layanan, COUNT(fs_kd_trs) fn_count_tdk 
                    FROM        HOSPITAL.dbo.ta_trs_tdk_umum 
                    WHERE       fd_tgl_trs = ?
                            AND fd_tgl_void = '3000-01-01' 
                    GROUP BY    fs_kd_reg, fs_kd_layanan 
                    ) kk1 ON aa.fs_kd_reg = kk1.fs_kd_reg AND aa.fs_kd_layanan = kk1.fs_kd_layanan 
        LEFT JOIN  ( 
                    SELECT      fs_kd_reg, DATEDIFF(day, fd_tgl_masuk, ? ) + 1 fn_hari_rawat, 
                        CASE 
                            WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 < 10  THEN 'A' 
                            WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 >= 10 AND  DATEDIFF(day, fd_tgl_masuk,?  ) + 1 <= 20 THEN 'B' 
                            WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 > 20 AND DATEDIFF(day, fd_tgl_masuk, ?  ) + 1 <= 30 THEN 'C' 
                            WHEN DATEDIFF(day, fd_tgl_masuk, ?  ) + 1 >= 31  THEN 'D'
                        END As fs_kd_range 
                    FROM        HOSPITAL.dbo.ta_registrasi 
                    WHERE       fd_tgl_void = '3000-01-01' 
                    ) ll1 ON aa.fs_kd_reg = ll1.fs_kd_reg 
        LEFT JOIN  ( 
                    SELECT      fs_kd_trs, DATEDIFF(day, fd_tgl_in, ? ) + 1 fn_hari_bed 
                    FROM        HOSPITAL.dbo.ta_trs_bed 
                    WHERE       fd_tgl_void = '3000-01-01' 
                    ) mm1 ON aa.fs_kd_trs = mm1.fs_kd_trs 
        LEFT JOIN ( 
                SELECT        FS_KD_REG, MAX(fs_kd_trs) fs_kd_trs, MAX(FD_TGL_IN) fd_tgl_in 
                FROM          HOSPITAL.dbo.TA_TRS_BED 
                WHERE         FD_TGL_VOID = '3000-01-01' 
                GROUP BY      FS_KD_REG 
                ) nn1 ON aa.fs_kd_reg = nn1.fs_kd_reg 
        LEFT JOIN  (SELECT '1' fs_kd_dpp, 'Dokter Pilihan Pasien' fs_nm_dpp 
                    UNION 
                    SELECT '0' fs_kd_dpp, 'Dokter Pilihan RS' fs_nm_dpp) yy ON 
                    bb.fb_dpp = yy.fs_kd_dpp 
        LEFT JOIN  HOSPITAL.dbo.ta_kelas nn ON aa.fs_kd_kelas_tindakan = nn.fs_kd_kelas 
        LEFT JOIN  HOSPITAL.dbo.TA_JENIS_KELAMIN ss ON cc.FS_JNS_KELAMIN = ss.FS_KD_JENIS_KELAMIN 
        LEFT JOIN  HOSPITAL.dbo.TA_INSTALASI pp ON dd.FS_KD_INSTALASI = pp.FS_KD_INSTALASI
        INNER JOIN TAB_APLUSAN zz ON cc.fs_mr=zz.fs_mr
        LEFT JOIN TAB_APULSAN_ADMIN zx ON zz.FS_MR=zx.FS_MR
        LEFT JOIN  HOSPITAL.dbo.td_peg jj ON zz.PPJP = jj.fs_kd_peg 
        WHERE zz.FS_KD_APULSAN = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // list surat masuk
    function get_list_aplusan_lap($params) {
        $sql = "    SELECT     aa.fs_kd_reg, hh.mdd, 
                    ISNULL(ee.fs_nm_bed, ' ') fs_nm_bed, 
                    ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien,FS_SHIFT,bb.fs_mr,
                    FS_KONDISI_PASIEN,hh.FS_CATATAN,FS_NM_PEG,mdb,FS_KD_APULSAN
                    FROM       ( 
                               SELECT      fs_kd_trs 
                               FROM        HOSPITAL.dbo.TA_TRS_BED 
                               WHERE       fd_tgl_in <= ? 
                                       AND fd_tgl_out + fs_jam_out >= ? 
                                       AND fd_tgl_void = '3000-01-01' 
                               ) aa1 
                    LEFT JOIN  HOSPITAL.dbo.ta_trs_bed aa ON aa1.fs_kd_trs = aa.fs_kd_trs 
                    LEFT JOIN  HOSPITAL.dbo.ta_registrasi bb ON aa.fs_kd_reg = bb.fs_kd_reg 
                    LEFT JOIN  HOSPITAL.dbo.tc_mr cc ON bb.fs_mr = cc.fs_mr 
                    LEFT JOIN  HOSPITAL.dbo.ta_layanan dd ON aa.fs_kd_layanan = dd.fs_kd_layanan 
                    LEFT JOIN  HOSPITAL.dbo.ta_bed ee ON aa.fs_kd_bed = ee.fs_kd_bed 
                    LEFT JOIN  HOSPITAL.dbo.ta_kamar ff ON ee.fs_kd_kamar = ff.fs_kd_kamar 
                    LEFT JOIN  HOSPITAL.dbo.ta_bangsal gg ON ff.fs_kd_bangsal = gg.fs_kd_bangsal
                    LEFT JOIN  TAB_APLUSAN hh ON aa.fs_kd_reg = hh.fs_kd_reg
                    LEFT JOIN HOSPITAL.dbo.td_peg ii ON hh.PPJP=ii.FS_KD_PEG
                   WHERE dd.FS_KD_LAYANAN LIKE ? AND hh.mdd LIKE ? ORDER BY ee.fs_nm_bed, hh.mdd DESC,hh.FS_SHIFT DESC,dd.fs_kd_layanan DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

     function get_pasien_bangsal($params) {
        $sql = " SELECT     aa.fs_kd_reg, bb.fs_mr, cc.fs_kd_identitas,
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien
            FROM       ( 
                        SELECT      fs_kd_trs 
                        FROM        HOSPITAL.dbo.TA_TRS_BED 
                        WHERE       fd_tgl_in <= ? 
                                AND fd_tgl_out + fs_jam_out >= ? 
                                AND fd_tgl_void = '3000-01-01' 
                        ) aa1 
            LEFT JOIN  HOSPITAL.dbo.ta_trs_bed aa ON aa1.fs_kd_trs = aa.fs_kd_trs 
            LEFT JOIN  HOSPITAL.dbo.ta_registrasi bb ON aa.fs_kd_reg = bb.fs_kd_reg 
            LEFT JOIN  HOSPITAL.dbo.tc_mr cc ON bb.fs_mr = cc.fs_mr 
            LEFT JOIN  HOSPITAL.dbo.ta_layanan dd ON aa.fs_kd_layanan = dd.fs_kd_layanan 
            LEFT JOIN  HOSPITAL.dbo.ta_bed ee ON aa.fs_kd_bed = ee.fs_kd_bed 
            LEFT JOIN  HOSPITAL.dbo.ta_kamar ff ON ee.fs_kd_kamar = ff.fs_kd_kamar 
            LEFT JOIN  HOSPITAL.dbo.ta_bangsal gg ON ff.fs_kd_bangsal = gg.fs_kd_bangsal 
            LEFT JOIN  HOSPITAL.dbo.ta_tipe_jaminan hh ON bb.fs_kd_tipe_jaminan = hh.fs_kd_tipe_jaminan 
            LEFT JOIN  HOSPITAL.dbo.ta_jaminan ii ON hh.fs_kd_jaminan = ii.fs_kd_jaminan 
            LEFT JOIN  HOSPITAL.dbo.td_peg jj ON bb.fs_kd_medis = jj.fs_kd_peg 
            LEFT JOIN  HOSPITAL.dbo.TD_PEG kk ON bb.FS_KD_MEDIS = kk.FS_KD_PEG 
            LEFT JOIN  HOSPITAL.dbo.ta_agama mm ON cc.FS_KD_AGAMA = mm.FS_KD_AGAMA 
            LEFT JOIN  HOSPITAL.dbo.ta_kelas qq ON hh.fs_kd_kelas = qq.fs_kd_kelas 
            LEFT JOIN  HOSPITAL.dbo.tl_fbagian tl ON dd.fs_kd_fbagian = tl.fs_kd_fbagian 
            LEFT JOIN  HOSPITAL.dbo.ta_grup_jaminan gj ON ii.fs_kd_grup_jaminan = gj.fs_kd_grup_jaminan 
            LEFT JOIN  HOSPITAL.dbo.ta_trs_sep aa2 ON bb.fs_kd_reg = aa2.fs_kd_reg 
            LEFT JOIN (
                    SELECT          xx1.fs_kd_reg, xx2.fs_no_polis, xx2.fs_atas_nama, xx2.fs_kd_tipe_jaminan, xx3.fs_kd_status,
                                    xx4.fs_kd_bu ,xx4.fs_nm_bu, xx5.fs_nm_status_peserta 
                    FROM            HOSPITAL.dbo.TA_REG_JAMINAN xx1 
                    LEFT JOIN       HOSPITAL.dbo.TA_REGISTRASI x on xx1.FS_KD_REG = x.FS_KD_REG        LEFT JOIN       HOSPITAL.dbo.TA_POLIS xx2 ON   xx1.FS_KD_POLIS = xx2.FS_KD_POLIS 
                    LEFT JOIN       HOSPITAL.dbo.TA_POLIS_COVER xx3 ON xx2.fs_kd_polis = xx3.fs_kd_polis and xx3.FS_MR = x.FS_MR
                    LEFT JOIN       HOSPITAL.dbo.TA_BU xx4 ON xx2.fs_kd_bu = xx4.fs_kd_bu 
                    LEFT JOIN       HOSPITAL.dbo.TA_STATUS_PESERTA xx5 ON xx3.fs_kd_status = xx5.fs_kd_status_peserta 
                        ) xxx ON bb.fs_kd_reg = xxx.fs_kd_reg AND bb.fs_kd_tipe_jaminan = xxx.fs_kd_tipe_jaminan 
            LEFT JOIN   HOSPITAL.dbo.ta_reg_inap rr ON bb.fs_kd_reg = rr.fs_kd_reg  LEFT JOIN   HOSPITAL.dbo.ta_jenis_inap ji ON bb.fs_kd_jenis_inap = ji.fs_kd_jenis_inap 
            LEFT JOIN   HOSPITAL.dbo.ta_trs_booking_bed tt ON rr.fs_kd_trs_booking_bed = tt.fs_kd_trs 
            LEFT JOIN   HOSPITAL.dbo.ta_tujuan_inap ti ON tt.fs_kd_tujuan_inap = ti.fs_kd_tujuan_inap 
            LEFT JOIN   HOSPITAL.dbo.TD_PEG kkz ON rr.fs_kd_medis_sekunder = kkz.FS_KD_PEG
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, sum(fn_total_bayar) fn_nilai_deposit 
                        FROM        HOSPITAL.dbo.TA_TRS_DEPOSIT 
                        WHERE       FD_TGL_VOID = '3000-01-01' 
                        GROUP BY    fs_kd_reg 
                        ) oo ON aa.fs_kd_reg = oo.fs_kd_reg 
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, fs_kd_layanan, COUNT(fs_kd_trs) fn_count_tdk 
                        FROM        HOSPITAL.dbo.ta_trs_tdk_umum 
                        WHERE       fd_tgl_trs = ?
                                AND fd_tgl_void = '3000-01-01' 
                        GROUP BY    fs_kd_reg, fs_kd_layanan 
                        ) kk1 ON aa.fs_kd_reg = kk1.fs_kd_reg AND aa.fs_kd_layanan = kk1.fs_kd_layanan 
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, DATEDIFF(day, fd_tgl_masuk, ? ) + 1 fn_hari_rawat, 
                            CASE 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 < 10  THEN 'A' 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 >= 10 AND  DATEDIFF(day, fd_tgl_masuk,?  ) + 1 <= 20 THEN 'B' 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 > 20 AND DATEDIFF(day, fd_tgl_masuk, ?  ) + 1 <= 30 THEN 'C' 
                                WHEN DATEDIFF(day, fd_tgl_masuk, ?  ) + 1 >= 31  THEN 'D'
                            END As fs_kd_range 
                        FROM        HOSPITAL.dbo.ta_registrasi 
                        WHERE       fd_tgl_void = '3000-01-01' 
                        ) ll1 ON aa.fs_kd_reg = ll1.fs_kd_reg 
            LEFT JOIN  ( 
                        SELECT      fs_kd_trs, DATEDIFF(day, fd_tgl_in, ? ) + 1 fn_hari_bed 
                        FROM        HOSPITAL.dbo.ta_trs_bed 
                        WHERE       fd_tgl_void = '3000-01-01' 
                        ) mm1 ON aa.fs_kd_trs = mm1.fs_kd_trs 
            LEFT JOIN ( 
                    SELECT        FS_KD_REG, MAX(fs_kd_trs) fs_kd_trs, MAX(FD_TGL_IN) fd_tgl_in 
                    FROM          HOSPITAL.dbo.TA_TRS_BED 
                    WHERE         FD_TGL_VOID = '3000-01-01' 
                    GROUP BY      FS_KD_REG 
                    ) nn1 ON aa.fs_kd_reg = nn1.fs_kd_reg 
            LEFT JOIN  (SELECT '1' fs_kd_dpp, 'Dokter Pilihan Pasien' fs_nm_dpp 
                        UNION 
                        SELECT '0' fs_kd_dpp, 'Dokter Pilihan RS' fs_nm_dpp) yy ON 
                        bb.fb_dpp = yy.fs_kd_dpp 
            LEFT JOIN  HOSPITAL.dbo.ta_kelas nn ON aa.fs_kd_kelas_tindakan = nn.fs_kd_kelas 
            LEFT JOIN  HOSPITAL.dbo.TA_JENIS_KELAMIN ss ON cc.FS_JNS_KELAMIN = ss.FS_KD_JENIS_KELAMIN 
            LEFT JOIN  HOSPITAL.dbo.TA_INSTALASI pp ON dd.FS_KD_INSTALASI = pp.FS_KD_INSTALASI";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
    function get_list_aplusan_lap2($params) {
        $sql = " SELECT     aa.fs_kd_reg, bb.fs_mr, 
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien, 
            ISNULL(datediff(year,cc.fd_tgl_lahir,isnull(nn1.fd_tgl_in,bb.fd_tgl_masuk)),0) fn_umur, 
            ISNULL(zz.FS_ADMINISTRATIF, ' ') FS_ADMINISTRATIF, 
            ISNULL(pp.FS_NM_INSTALASI, 0) fs_nm_instalasi, 
            ISNULL(gg.fs_nm_bangsal, ' ') fs_nm_bangsal, 
            ISNULL(dd.fs_nm_layanan, ' ') fs_nm_layanan, 
            ISNULL(ff.fs_nm_kamar, ' ') fs_nm_kamar, 
            ISNULL(ee.fs_nm_bed, ' ') fs_nm_bed, 
            ISNULL(kk.fs_nm_peg,' ') FS_NM_PEG, 
            ISNULL(kkz.fs_nm_peg,' ') FS_NM_PEG_SEKUNDER, 
            ISNULL(zz.mdd, ' ') mdd, 
            ISNULL(aa.fd_tgl_in, ' ') fd_tgl_bed, 
            ISNULL(bb.fd_tgl_masuk, ' ') fd_tgl_masuk, 
            ISNULL(mm1.fn_hari_bed,0) fn_hari_bed, 
            ISNULL(aa2.fs_no_sep, ' ') fs_no_sep, ISNULL(ll1.fn_hari_rawat, 0) fn_hari_rawat, 
            CASE ISNULL(kk1.fn_count_tdk,0) 
                WHEN 0 THEN 'BELUM ADA' 
                ELSE CAST(kk1.fn_count_tdk AS VARCHAR(20)) + ' x' 
            END AS fs_status, 
            CASE bb.fb_dpp 
            WHEN 1 THEN 'Dokter Pilihan Pasien' 
                   ELSE 'Dokter Pilihan RS' 
            END as fs_nm_dpp,  
            ISNULL(nn.fs_nm_kelas, ' ') fs_nm_kelas, 
            ISNULL(oo.fn_nilai_deposit, 0) fn_nilai_deposit, 
            ISNULL(qq.fs_nm_kelas, ' ') fs_kelas_polis, 
            iSNUll(gj.fs_nm_grup_jaminan, '')fs_nm_grup_jaminan, 
            ISNULL(bb.fs_anamnese, ' ')fs_anamnese, 
            ISNULL(ll1.fs_kd_range, ' ') fs_kd_range,  
            ISNULL(ti.fs_nm_tujuan_inap,'')fs_nm_tujuan_inap, 
            CASE ISNULL(ll1.fs_kd_range, ' ')  
                WHEN 'A' THEN 'Kurang dari 10 Hari' 
                WHEN 'B' THEN '10 s/d 20 Hari' 
                WHEN 'C' THEN '20 s/d 30 Hari' 
                WHEN 'D' THEN 'Lebih dari 30 hari' 
                ELSE ' '
            END AS fs_nm_range
            FROM       ( 
                        SELECT      fs_kd_trs 
                        FROM        HOSPITAL.dbo.TA_TRS_BED 
                        WHERE       fd_tgl_in <= ? 
                                AND fd_tgl_out + fs_jam_out >= ? 
                                AND fd_tgl_void = '3000-01-01' 
                        ) aa1 
            LEFT JOIN  HOSPITAL.dbo.ta_trs_bed aa ON aa1.fs_kd_trs = aa.fs_kd_trs 
            LEFT JOIN  HOSPITAL.dbo.ta_registrasi bb ON aa.fs_kd_reg = bb.fs_kd_reg 
            LEFT JOIN  HOSPITAL.dbo.tc_mr cc ON bb.fs_mr = cc.fs_mr 
            LEFT JOIN  HOSPITAL.dbo.ta_layanan dd ON aa.fs_kd_layanan = dd.fs_kd_layanan 
            LEFT JOIN  HOSPITAL.dbo.ta_bed ee ON aa.fs_kd_bed = ee.fs_kd_bed 
            LEFT JOIN  HOSPITAL.dbo.ta_kamar ff ON ee.fs_kd_kamar = ff.fs_kd_kamar 
            LEFT JOIN  HOSPITAL.dbo.ta_bangsal gg ON ff.fs_kd_bangsal = gg.fs_kd_bangsal 
            LEFT JOIN  HOSPITAL.dbo.ta_tipe_jaminan hh ON bb.fs_kd_tipe_jaminan = hh.fs_kd_tipe_jaminan 
            LEFT JOIN  HOSPITAL.dbo.ta_jaminan ii ON hh.fs_kd_jaminan = ii.fs_kd_jaminan 
            LEFT JOIN  HOSPITAL.dbo.td_peg jj ON bb.fs_kd_medis = jj.fs_kd_peg 
            LEFT JOIN  HOSPITAL.dbo.TD_PEG kk ON bb.FS_KD_MEDIS = kk.FS_KD_PEG 
            LEFT JOIN  HOSPITAL.dbo.ta_agama mm ON cc.FS_KD_AGAMA = mm.FS_KD_AGAMA 
            LEFT JOIN  HOSPITAL.dbo.ta_kelas qq ON hh.fs_kd_kelas = qq.fs_kd_kelas 
            LEFT JOIN  HOSPITAL.dbo.tl_fbagian tl ON dd.fs_kd_fbagian = tl.fs_kd_fbagian 
            LEFT JOIN  HOSPITAL.dbo.ta_grup_jaminan gj ON ii.fs_kd_grup_jaminan = gj.fs_kd_grup_jaminan 
            LEFT JOIN  HOSPITAL.dbo.ta_trs_sep aa2 ON bb.fs_kd_reg = aa2.fs_kd_reg 
            LEFT JOIN (
                    SELECT          xx1.fs_kd_reg, xx2.fs_no_polis, xx2.fs_atas_nama, xx2.fs_kd_tipe_jaminan, xx3.fs_kd_status,
                                    xx4.fs_kd_bu ,xx4.fs_nm_bu, xx5.fs_nm_status_peserta 
                    FROM            HOSPITAL.dbo.TA_REG_JAMINAN xx1 
                    LEFT JOIN       HOSPITAL.dbo.TA_REGISTRASI x on xx1.FS_KD_REG = x.FS_KD_REG        LEFT JOIN       HOSPITAL.dbo.TA_POLIS xx2 ON   xx1.FS_KD_POLIS = xx2.FS_KD_POLIS 
                    LEFT JOIN       HOSPITAL.dbo.TA_POLIS_COVER xx3 ON xx2.fs_kd_polis = xx3.fs_kd_polis and xx3.FS_MR = x.FS_MR
                    LEFT JOIN       HOSPITAL.dbo.TA_BU xx4 ON xx2.fs_kd_bu = xx4.fs_kd_bu 
                    LEFT JOIN       HOSPITAL.dbo.TA_STATUS_PESERTA xx5 ON xx3.fs_kd_status = xx5.fs_kd_status_peserta 
                        ) xxx ON bb.fs_kd_reg = xxx.fs_kd_reg AND bb.fs_kd_tipe_jaminan = xxx.fs_kd_tipe_jaminan 
            LEFT JOIN   HOSPITAL.dbo.ta_reg_inap rr ON bb.fs_kd_reg = rr.fs_kd_reg  LEFT JOIN   HOSPITAL.dbo.ta_jenis_inap ji ON bb.fs_kd_jenis_inap = ji.fs_kd_jenis_inap 
            LEFT JOIN   HOSPITAL.dbo.ta_trs_booking_bed tt ON rr.fs_kd_trs_booking_bed = tt.fs_kd_trs 
            LEFT JOIN   HOSPITAL.dbo.ta_tujuan_inap ti ON tt.fs_kd_tujuan_inap = ti.fs_kd_tujuan_inap 
            LEFT JOIN   HOSPITAL.dbo.TD_PEG kkz ON rr.fs_kd_medis_sekunder = kkz.FS_KD_PEG
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, sum(fn_total_bayar) fn_nilai_deposit 
                        FROM        HOSPITAL.dbo.TA_TRS_DEPOSIT 
                        WHERE       FD_TGL_VOID = '3000-01-01' 
                        GROUP BY    fs_kd_reg 
                        ) oo ON aa.fs_kd_reg = oo.fs_kd_reg 
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, fs_kd_layanan, COUNT(fs_kd_trs) fn_count_tdk 
                        FROM        HOSPITAL.dbo.ta_trs_tdk_umum 
                        WHERE       fd_tgl_trs = ?
                                AND fd_tgl_void = '3000-01-01' 
                        GROUP BY    fs_kd_reg, fs_kd_layanan 
                        ) kk1 ON aa.fs_kd_reg = kk1.fs_kd_reg AND aa.fs_kd_layanan = kk1.fs_kd_layanan 
            LEFT JOIN  ( 
                        SELECT      fs_kd_reg, DATEDIFF(day, fd_tgl_masuk, ? ) + 1 fn_hari_rawat, 
                            CASE 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 < 10  THEN 'A' 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 >= 10 AND  DATEDIFF(day, fd_tgl_masuk,?  ) + 1 <= 20 THEN 'B' 
                                WHEN DATEDIFF(day, fd_tgl_masuk,? ) + 1 > 20 AND DATEDIFF(day, fd_tgl_masuk, ?  ) + 1 <= 30 THEN 'C' 
                                WHEN DATEDIFF(day, fd_tgl_masuk, ?  ) + 1 >= 31  THEN 'D'
                            END As fs_kd_range 
                        FROM        HOSPITAL.dbo.ta_registrasi 
                        WHERE       fd_tgl_void = '3000-01-01' 
                        ) ll1 ON aa.fs_kd_reg = ll1.fs_kd_reg 
            LEFT JOIN  ( 
                        SELECT      fs_kd_trs, DATEDIFF(day, fd_tgl_in, ? ) + 1 fn_hari_bed 
                        FROM        HOSPITAL.dbo.ta_trs_bed 
                        WHERE       fd_tgl_void = '3000-01-01' 
                        ) mm1 ON aa.fs_kd_trs = mm1.fs_kd_trs 
            LEFT JOIN ( 
                    SELECT        FS_KD_REG, MAX(fs_kd_trs) fs_kd_trs, MAX(FD_TGL_IN) fd_tgl_in 
                    FROM          HOSPITAL.dbo.TA_TRS_BED 
                    WHERE         FD_TGL_VOID = '3000-01-01' 
                    GROUP BY      FS_KD_REG 
                    ) nn1 ON aa.fs_kd_reg = nn1.fs_kd_reg 
            LEFT JOIN  (SELECT '1' fs_kd_dpp, 'Dokter Pilihan Pasien' fs_nm_dpp 
                        UNION 
                        SELECT '0' fs_kd_dpp, 'Dokter Pilihan RS' fs_nm_dpp) yy ON 
                        bb.fb_dpp = yy.fs_kd_dpp 
            LEFT JOIN  HOSPITAL.dbo.ta_kelas nn ON aa.fs_kd_kelas_tindakan = nn.fs_kd_kelas 
            LEFT JOIN  HOSPITAL.dbo.TA_JENIS_KELAMIN ss ON cc.FS_JNS_KELAMIN = ss.FS_KD_JENIS_KELAMIN 
            LEFT JOIN  HOSPITAL.dbo.TA_INSTALASI pp ON dd.FS_KD_INSTALASI = pp.FS_KD_INSTALASI
            INNER JOIN TAB_APULSAN_ADMIN zz ON cc.fs_mr=zz.fs_mr
            WHERE dd.FS_KD_LAYANAN LIKE ? AND zz.mdd LIKE ? ORDER BY mdd DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    function get_pasien_by_rg($params) {
        $sql = " SELECT     aa.fs_kd_reg,bb.fs_mr, cc.fd_tgl_lahir, cc.FS_ALM_PASIEN, m.FS_NM_PEKERJAAN_DK, n.FS_NM_PENDIDIKAN_DK, 
            www.fs_nm_agama, zzz.fs_nm_bed, cc.fs_kd_identitas, cc.FS_JNS_KELAMIN,
            ISNULL(datediff(year,cc.fd_tgl_lahir,bb.fd_tgl_masuk),0) fn_umur, 
                  ISNULL(ee.fs_nm_bed, ' ') fs_nm_bed, 
            ISNULL(cc.fs_nm_pasien, ' ') fs_nm_pasien,cc.fd_tgl_lahir,cc.fs_alm_pasien,
            dd.fs_kd_layanan
            
            FROM       ( 
                       SELECT      fs_kd_trs 
                       FROM        HOSPITAL.dbo.TA_TRS_BED 
                       WHERE       fd_tgl_in <= ? 
                               AND fd_tgl_out + fs_jam_out >= ? 
                               AND fd_tgl_void = '3000-01-01' 
                       ) aa1 
            LEFT JOIN  HOSPITAL.dbo.ta_trs_bed aa ON aa1.fs_kd_trs = aa.fs_kd_trs 
            LEFT JOIN  HOSPITAL.dbo.ta_registrasi bb ON aa.fs_kd_reg = bb.fs_kd_reg 
            LEFT JOIN  HOSPITAL.dbo.tc_mr cc ON bb.fs_mr = cc.fs_mr 
            LEFT JOIN  HOSPITAL.dbo.ta_layanan dd ON aa.fs_kd_layanan = dd.fs_kd_layanan 
            LEFT JOIN  HOSPITAL.dbo.ta_bed ee ON aa.fs_kd_bed = ee.fs_kd_bed 
            LEFT JOIN  HOSPITAL.dbo.ta_kamar ff ON ee.fs_kd_kamar = ff.fs_kd_kamar 
            LEFT JOIN  HOSPITAL.dbo.ta_bangsal gg ON ff.fs_kd_bangsal = gg.fs_kd_bangsal
            LEFT JOIN HOSPITAL.dbo.TA_PEKERJAAN_DK m ON cc.FS_KD_PEKERJAAN_DK=m.FS_KD_PEKERJAAN_DK
            LEFT JOIN HOSPITAL.dbo.TA_PENDIDIKAN_DK n ON cc.FS_KD_PENDIDIKAN_DK=n.FS_KD_PENDIDIKAN_DK
            LEFT JOIN  HOSPITAL.dbo.ta_agama www ON cc.fs_kd_agama = www.fs_kd_agama
            LEFT JOIN  HOSPITAL.dbo.ta_trs_bed zz     ON aa.fs_kd_reg = zz.fs_kd_reg
            LEFT JOIN  HOSPITAL.dbo.ta_bed zzz ON zz.fs_kd_bed = zzz.fs_kd_bed
            
            WHERE bb.fs_kd_reg = ?";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return 0;
        }
    }

    function get_cppt_by_trs($params) {
        $sql = "SELECT a.*,b.FS_NM_PEG FROM TAC_RI_CPPT a
                LEFT JOIN HOSPITAL.dbo.TD_PEG b ON a.mdb=b.FS_KD_PEG
                WHERE FS_KD_TRS = ? 
                ORDER BY mdd_time DESC";
        $query = $this->db->query($sql, $params);
        if ($query->getNumRows() > 0) {
            $result = $query->getRowArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
    
     function get_unit_kerja() {
        $sql = "SELECT FS_KD_LAYANAN,FS_NM_LAYANAN FROM HOSPITAL.dbo.TA_LAYANAN WHERE FS_KD_INSTALASI = 'RI' ORDER BY FS_NM_LAYANAN ASC";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }
     function get_unit_kerja_layanan($params) {
        $sql = "SELECT FS_KD_LAYANAN,FS_NM_LAYANAN FROM HOSPITAL.dbo.TA_LAYANAN WHERE FS_KD_INSTALASI = 'RI' AND FS_KD_LAYANAN = ? ORDER BY FS_NM_LAYANAN ASC";
        $query = $this->db->query($sql,$params);
        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
            $query->freeResult();
            return $result;
        } else {
            return array();
        }
    }

    // insert surat masuk
    function insert_catatan_admin($params) {
        $sql = "INSERT INTO TAB_APULSAN_ADMIN (FS_MR,FS_ADMINISTRATIF, mdb, mdd) 
                VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    function insert($params) {
        $sql = "INSERT INTO TAB_APLUSAN (FS_KD_LAYANAN, FS_SHIFT, FS_MR, FS_KONDISI_PASIEN, FS_TINDAKAN, FS_RESPON, FS_CATATAN, mdb, mdd,PPJP,FS_KD_REG) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    // insert surat masuk
    function update($params) {
        $sql = "UPDATE TAB_APLUSAN SET FS_SHIFT =? , FS_MR = ?, FS_KONDISI_PASIEN = ? , FS_TINDAKAN = ?, FS_RESPON = ?, 
                FS_CATATAN= ?, MDB = ?, MDD = ?, PPJP = ?, FS_KD_REG=? WHERE FS_KD_APULSAN = ?";
        return $this->db->query($sql, $params);
    }

    // update surat masuk
    function update_catatan_admin($params) {
        $sql = "UPDATE TAB_APULSAN_ADMIN SET FS_MR = ?, FS_ADMINISTRATIF = ?, mdb = ?, mdd=?,FS_KD_REG=?
                WHERE FS_KD_APULSAN_ADMIN = ?";
        return $this->db->query($sql, $params);
    }

}
