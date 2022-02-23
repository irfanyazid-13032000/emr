<?php

namespace App\Controllers\Nurse;

use App\Controllers\BaseController;

class Rawat_jalan_kb extends BaseController
{
    // list surat masuk
    public function index()
    {
        $data = [];
        $data["title"] = "Rawat Jalan Kebidanan";

        $search = session('nurse_rawat_jalan_kb');
        if (!empty($search)) {
            $data["search"] = $search;
        }
        if (empty($search['FS_KD_PEG'])) {
            $search['FS_KD_PEG'] = 'S000';
            $data["search"] = $search;
        }
        if (empty($search['FD_TGL_MASUK'])) {
            $search['FD_TGL_MASUK'] = date('Y-m-d');
            $data["search"] = $search;
        }
        $data["FS_KD_PEG"] = $search['FS_KD_PEG'];
        $data["FD_TGL_MASUK"] = $search['FD_TGL_MASUK'];
        // search parameters
        $FD_TGL_MASUK = empty($search['FD_TGL_MASUK']) ?: $search['FD_TGL_MASUK'];
        $FS_KD_PEG = empty($search['FS_KD_PEG']) ?: $search['FS_KD_PEG'];
        $now = date('Y-m-d');
        // get search parameter
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
        $data["rs_dokter"] = $this->m_rawat_jalan->get_dokter_keb();
        $data["rs_pasien"] = $this->m_rawat_jalan->get_px_by_dokter_wait(array($FD_TGL_MASUK, $FS_KD_PEG, $FS_KD_PEG, $FS_KD_PEG));
        //$this->smarty->assign("rs_pasien2", $this->m_rawat_jalan->get_px_by_dokter_finish_perawat(array($now, $FS_KD_PEG)));
        // notification
        // $this->tnotification->display_notification();
        // $this->tnotification->display_last_field();
        // // output
        return view("nurse/rawat_jalan_kb/index", $data);
    }

    // searching
    public function proses_cari()
    {
        //set page rules
        // $this->_set_page_rule("R");
        //data
        if ($this->request->getVar('save') == "Reset") {
            session()->remove("nurse_rawat_jalan_kb");
        } else {
            $params = array(
                "FD_TGL_MASUK" => $this->request->getVar("FD_TGL_MASUK"),
                "FS_KD_PEG" => $this->request->getVar("FS_KD_PEG")
            );
            session()->set("nurse_rawat_jalan_kb", $params);
        }
        // redirect
        return redirect()->to("nurse/rawat_jalan_kb");
    }


    public function history($FS_MR = "", $FS_KD_PEG = "")
    {
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
        $now = date('Y-m-d');
        $medis = $FS_KD_PEG;
        $data["no"] = '1';
        $data["FS_KD_MEDIS"] = $FS_KD_PEG;
        $data["result"] = $this->m_rawat_jalan->get_px_by_dokter_by_rm(array($now, $FS_MR));
        $data["rs_pasien"] = $this->m_rawat_jalan->get_px_history(array($now, $medis, $medis, $medis, $FS_MR));

        //$data["form", $this->m_rawat_jalan->get_px_form(array($now, $medis, $medis, $medis, $FS_MR)));
        // notification
        // $this->tnotification->display_notification();
        // $this->tnotification->display_last_field();
        // output
        // parent::display();
        return view("nurse/rawat_jalan_kb/history", $data);
    }

    public function add($FS_KD_REG = "", $FS_KD_MEDIS = "", $FS_JNS_ASESMEN = "")
    {
        $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();
        $now = date('Y-m-d');
        $data["result"] = $this->m_rawat_jalan_nurse->get_px_by_dokter_by_rg2(array($now, $FS_KD_REG));
        $data["FS_KD_MEDIS"] = $FS_KD_MEDIS;
        $data["FS_JNS_ASESMEN"] = $FS_JNS_ASESMEN;
        return view("nurse/rawat_jalan_kb/add", $data);
    }

    public function add_process()
    {
        // set page rules
        // $this->_set_page_rule("C");
        // cek input

        helper(['form', 'url']);
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
        $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();

        $input = $this->validate([
            'FS_KD_REG' => 'required',
            'FS_ANAMNESA' => 'required',
            'FS_ALERGI' => 'required',
            'FS_REAK_ALERGI' => 'required'
        ]);
        // $this->tnotification->set_rules('FS_KD_REG', 'KODE REGISTER', 'trim|required');
        // $this->tnotification->set_rules('FS_ANAMNESA', 'Anamnesa', 'trim|required');
        // $this->tnotification->set_rules('FS_ALERGI', 'Alergi', 'trim|required');
        // $this->tnotification->set_rules('FS_REAK_ALERGI', 'Reaksi Alergi', 'trim|required');
        // process
        if ($input !== FALSE) {
            $params = array(
                $this->request->getVar('FS_KD_REG'),
                '1',
                '3',
                $this->request->getVar('FS_JNS_ASESMEN'),
                session('user_id'),
                date('Y-m-d')
            );
            // insert
            if ($this->m_rawat_jalan->insert($params)) {
                $params1 = array(
                    $this->request->getVar('FS_KD_REG'),
                    $this->request->getVar('FS_SUHU'),
                    $this->request->getVar('FS_NADI'),
                    $this->request->getVar('FS_R'),
                    $this->request->getVar('FS_TD'),
                    $this->request->getVar('FS_TB'),
                    $this->request->getVar('FS_BB'),
                    $this->request->getVar('FS_BB_KERING'),
                    $this->request->getVar('FS_KD_MEDIS'),
                    session('user_id'),
                    date('Y-m-d'),
                    date('H:i:s')
                );
                $this->m_rawat_jalan->insert_vs($params1);
                // insert
                $params2 = array(
                    $this->request->getVar('FS_KD_REG'),
                    $this->request->getVar('FS_NYERIP'),
                    $this->request->getVar('FS_NYERIQ'),
                    $this->request->getVar('FS_NYERIR'),
                    $this->request->getVar('FS_NYERIS'),
                    $this->request->getVar('FS_NYERIT'),
                    session('user_id'),
                    date('Y-m-d'),
                    $this->request->getVar('FS_NYERI')
                );
                $this->m_rawat_jalan->insert_nyeri($params2);
                $params3 = array(
                    $this->request->getVar('FS_KD_REG'),
                    $this->request->getVar('FS_CARA_BERJALAN1'),
                    $this->request->getVar('FS_CARA_BERJALAN2'),
                    $this->request->getVar('FS_CARA_DUDUK'),
                    session('user_id'),
                    date('Y-m-d')
                );
                $this->m_rawat_jalan->insert_jatuh($params3);
                $params4 = array(
                    $this->request->getVar('FS_KD_REG'),
                    '',
                    '',
                    $this->request->getVar('FS_RIW_PENYAKIT_KEL'),
                    $this->request->getVar('FS_RIW_PENYAKIT_KEL2'),
                    $this->request->getVar('FS_STATUS_PSIK'),
                    $this->request->getVar('FS_STATUS_PSIK2'),
                    $this->request->getVar('FS_HUB_KELUARGA'),
                    $this->request->getVar('FS_ST_FUNGSIONAL'),
                    $this->request->getVar('FS_AGAMA'),
                    $this->request->getVar('FS_NILAI_KHUSUS'),
                    $this->request->getVar('FS_NILAI_KHUSUS2'),
                    $this->request->getVar('FS_ANAMNESA'),
                    $this->request->getVar('FS_PENGELIHATAN'),
                    $this->request->getVar('FS_PENCIUMAN'),
                    $this->request->getVar('FS_PENDENGARAN'),
                    $this->request->getVar('FS_RIW_IMUNISASI'),
                    $this->request->getVar('FS_RIW_IMUNISASI_KET'),
                    $this->request->getVar('FS_RIW_TUMBUH'),
                    $this->request->getVar('FS_RIW_TUMBUH_KET'),
                    '',
                    '',
                    session('user_id'),
                    date('Y-m-d')
                );
                $this->m_rawat_jalan->insert_ases($params4);

                $params5 = array(
                    $this->request->getVar('FS_ALERGI'),
                    $this->request->getVar('FS_REAK_ALERGI'),
                    $this->request->getVar('FS_RIW_PENYAKIT_DAHULU'),
                    $this->request->getVar('FS_RIW_PENYAKIT_DAHULU2'),
                    $this->request->getVar('FS_MR')
                );
                $this->m_rawat_jalan_nurse->insert_alergi($params5);

                $params6 = array(
                    $this->request->getVar('FS_KD_REG'),
                    $this->request->getVar('FS_NUTRISI1'),
                    $this->request->getVar('FS_NUTRISI2'),
                    $this->request->getVar('FS_NUTRISI_ANAK1'),
                    $this->request->getVar('FS_NUTRISI_ANAK2'),
                    $this->request->getVar('FS_NUTRISI_ANAK3'),
                    $this->request->getVar('FS_NUTRISI_ANAK4'),
                    session('user_id'),
                    date('Y-m-d')
                );
                $this->m_rawat_jalan->insert_nutrisi($params6);

                // insert tujuan
                $masalah_kep = $this->request->getVar('tujuan');
                if (!empty($masalah_kep)) {
                    foreach ($masalah_kep as $value) {
                        $this->m_rawat_jalan->insert_masalah_kep(array($this->request->getVar('FS_KD_REG'), $value));
                    }
                }
                $rencana_kep = $this->request->getVar('tembusan');
                if (!empty($rencana_kep)) {
                    foreach ($rencana_kep as $value) {
                        $this->m_rawat_jalan->insert_rencana_kep(array($this->request->getVar('FS_KD_REG'), $value));
                    }
                }
                $params7 = array(
                    $this->request->getVar('FS_KD_REG'),
                    '',
                    '',
                    $this->request->getVar('FS_RIWAYAT_GYNEKOLOGI'),
                    $this->request->getVar('FS_RIWAYAT_GYNEKOLOGI_KET'),
                    $this->request->getVar('FS_RIW_MENS_UMUR_MENARCHE'),
                    $this->request->getVar('FS_RIW_MENS_LAMA_HAID'),
                    $this->request->getVar('FS_RIW_MENS_GANTI_PEMBALUT'),
                    date('Y-m-d', strtotime($this->request->getVar('FS_RIW_MENS_HPM'))),
                    $this->request->getVar('FS_RIW_MENS_KELUHAN'),
                    $this->request->getVar('FS_RIW_MENS_KELUHAN_KET'),
                    $this->request->getVar('FS_RIW_KB_METODE_1'),
                    $this->request->getVar('FS_RIW_KB_METODE_LAMA_1'),
                    $this->request->getVar('FS_RIW_KB_METODE_2'),
                    $this->request->getVar('FS_RIW_KB_METODE_LAMA_2'),
                    $this->request->getVar('FS_RIW_KB_KOMPLIKASI'),
                    $this->request->getVar('FS_RIW_KB_KOMPLIKASI_KET'),
                    $this->request->getVar('FS_MASALAH_KEBIDANAN'),
                    $this->request->getVar('FS_RENCANA_KEBIDANAN'),
                    $this->request->getVar('G'),
                    $this->request->getVar('P'),
                    $this->request->getVar('A'),
                    $this->request->getVar('FS_RIW_MENS_HPL'),
                    $this->request->getVar('FS_KOMPLIKASI'),
                    $this->request->getVar('FS_K1'),
                    $this->request->getVar('FS_K4'),
                    $this->request->getVar('FS_HB'),
                    $this->request->getVar('FS_STATUS_TT'),
                    $this->request->getVar('FS_BUKU_KIA'),
                    $this->request->getVar('FS_HPHT'),
                    $this->request->getVar('FS_UK'),
                    $this->com_user['user_name'],
                    date('Y-m-d')
                );
                $this->m_rawat_jalan->insert_kebidanan($params7);
                $params8 = array(
                    $this->request->getVar('FS_HIGH_RISK'),
                    $this->request->getVar('FS_NM_SUAMI'),
                    $this->request->getVar('FS_TGL_LAHIR_SUAMI'),
                    $this->request->getVar('FS_MR')
                );
                $this->m_rawat_jalan->update_high_risk($params8);
                // notification
                // $this->tnotification->delete_last_field();
                // $this->tnotification->sent_notification("success", "Detail berhasil disimpan");
            } else {
                // default error
                // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
                return redirect()->to("nurse/rawat_jalan_kb/history/" . $this->request->getVar('FS_MR') . "/" . $this->request->getVar('FS_KD_MEDIS') . "");
            }
        } else {
            // default error
            // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
            return redirect()->to("nurse/rawat_jalan_kb/history/" . $this->request->getVar('FS_MR') . "/" . $this->request->getVar('FS_KD_MEDIS') . "");
        }
        // default redirect
        return redirect()->to("nurse/rawat_jalan_kb/add_riw_kehamilan/" . $this->request->getVar('FS_KD_REG') . '/' . $this->request->getVar('FS_KD_MEDIS'));
    }


    public function add_riw_kehamilan($FS_KD_REG = "", $FS_KD_MEDIS = "")
    {

        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
        $now = date('Y-m-d');
        $data["result"] = $this->m_rawat_jalan->get_px_by_dokter_by_rg2(array($now, $FS_KD_REG));
        $data["rs_riw_kehamilan"] = $this->m_rawat_jalan->get_px_by_riw_kehamilan_by_rg(array($FS_KD_REG));
        $data["FS_KD_MEDIS"] = $FS_KD_MEDIS;
        return view('nurse/rawat_jalan_kb/add_riw_kehamilan', $data);
    }
}
