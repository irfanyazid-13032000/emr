<?php

namespace App\Controllers\Nurse;

use App\Controllers\BaseController;

class Hd extends BaseController
{

  // constructor


  // list surat masuk
  public function index()
  {

    $data = [];
    $data['title'] = "Hemodialisa";
    $search = session('nurse_rawat_jalan');
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
    //$FS_KD_PEG = empty($search['FS_KD_PEG']) ? : $search['FS_KD_PEG'];
    $now = date('Y-m-d');
    // get search parameter
    $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
    $data["rs_dokter"] = $this->m_rawat_jalan->get_dokter();
    $data["rs_pasien"] = $this->m_rawat_jalan->get_px_by_dokter_wait_hd([$FD_TGL_MASUK]);
    //$this->smarty->assign("rs_pasien2", $this->m_rawat_jalan->get_px_by_dokter_finish_perawat(array($now, $FS_KD_PEG)));
    // notification
    // $this->tnotification->display_notification();
    // $this->tnotification->display_last_field();
    // output
    return view('nurse/hd/index', $data);
  }

  // searching
  public function proses_cari()
  {
    //set page rules
    // $this->_set_page_rule("R");
    //data
    if ($this->request->getVar('save') == "Reset") {
      session()->remove("nurse_rawat_jalan");
    } else {
      $params = array(
        "FD_TGL_MASUK" => $this->request->getVar("FD_TGL_MASUK"),
        "FS_KD_PEG" => $this->request->getVar("FS_KD_PEG")
      );
      session()->set("nurse_rawat_jalan", $params);
    }
    // redirect
    return redirect()->to('nurse/hd');
  }

  public function history($FS_MR = "", $FS_KD_PEG = "")
  {
    $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
    // set page rules
    // set template content
    // $this->smarty->assign("template_content", "nurse/hd/history.html");
    // $this->smarty->load_javascript('resource/js/jquery.datatables/jquery.dataTables.js');
    // $this->smarty->load_javascript('resource/js/jquery.datatables/dataTables.fixedHeader.js');
    // $this->smarty->load_style("jquery.ui/redmond/jquery-ui-1.8.13.custom.css");
    // $this->smarty->load_style("jquery.ui/datatables/jquery.dataTables.css");
    // load javascript
    // $this->smarty->load_javascript('resource/js/jquery/jquery-ui-1.9.2.custom.min.js');
    // get search parameter
    $now = date('Y-m-d');
    $data["FS_KD_MEDIS"] = $FS_KD_PEG;
    $data["result"] = $this->m_rawat_jalan->get_px_by_dokter_by_rm([$now, $FS_MR]);
    $data["rs_pasien"] = $this->m_rawat_jalan->get_px_history_nurse([$now, $FS_MR]);
    $data['no'] = 1;

    // $form_rm = $this->m_rawat_jalan->get_berkas_by_rg([$FS_KD_REG]);


    // notification
    // $this->tnotification->display_notification();
    // $this->tnotification->display_last_field();
    // output
    // parent::display();
    return view('nurse/hd/history', $data);
    // return print_r($data);
  }

  public function add($FS_KD_REG = "", $FS_KD_MEDIS = "", $FS_JNS_ASESMEN = "")
  {
    $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
    $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();
    // load style ui
    $now = date('Y-m-d');
    $data["result"] = $this->m_rawat_jalan_nurse->get_px_by_dokter_by_rg2(array($now, $FS_KD_REG));
    $data['tujuan'] = $this->m_rawat_jalan->list_masalah_kep();
    $data['tembusan'] = $this->m_rawat_jalan->list_rencana_kep();
    $data["FS_KD_MEDIS"] = $FS_KD_MEDIS;
    $data["rs_monitoring_hd"] = $this->m_rawat_jalan->get_monitoring_hd($FS_KD_REG);
    $data["FS_JNS_ASESMEN"] = $FS_JNS_ASESMEN;
    // notification
    // output
    return view("nurse/hd/add", $data);
    // return print_r($data);
  }



  public function add_process()
  {
    // set page rules
    // $this->_set_page_rule("C");
    // cek input
    // $this->tnotification->set_rules('FS_KD_REG', 'KODE REGISTER', 'trim|required');

    helper(['form', 'url']);
    $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
    $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();

    $input = $this->validate([
      'FS_KD_REG' => 'required',
      'FS_SUHU' => 'required',
      'FS_R' => 'required|numeric|max_length[10]'
    ]);

    // process
    if ($input !== FALSE) {

      if ($this->request->getVar('FS_JNS_ASESMEN') == NULL) {
        $FN_JNS_ASESMEN = '';
      }

      $params = array(
        $this->request->getVar('FS_KD_REG'),
        '1',
        '2',
        $FN_JNS_ASESMEN,
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

        if ($this->request->getVar('FS_RIW_IMUNISASI') == NULL) {
          $FS_RIW_IMUNISASI = '';
        }

        if ($this->request->getVar('FS_RIW_IMUNISASI_KET') == NULL) {
          $FS_RIW_IMUNISASI_KET = '';
        }

        if ($this->request->getVar('FS_RIW_TUMBUH') == NULL) {
          $FS_RIW_TUMBUH = '';
        }

        if ($this->request->getVar('FS_RIW_TUMBUH_KET') == NULL) {
          $FS_RIW_TUMBUH_KET = '';
        }

        $params4 = array(
          $this->request->getVar('FS_KD_REG'),
          '',
          '',
          '',
          '',
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
          $FS_RIW_IMUNISASI,
          $FS_RIW_IMUNISASI_KET,
          $FS_RIW_TUMBUH,
          $FS_RIW_TUMBUH_KET,
          '',
          $this->request->getVar('FS_EDUKASI'),
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


        if ($this->request->getVar('FS_NUTRISI_ANAK1') == NULL) {
          $FS_NUTRISI_ANAK1 = '';
        }

        if ($this->request->getVar('FS_NUTRISI_ANAK2') == NULL) {
          $FS_NUTRISI_ANAK2 = '';
        }

        if ($this->request->getVar('FS_NUTRISI_ANAK3') == NULL) {
          $FS_NUTRISI_ANAK3 = '';
        }

        if ($this->request->getVar('FS_NUTRISI_ANAK4') == NULL) {
          $FS_NUTRISI_ANAK4 = '';
        }


        $params6 = array(
          $this->request->getVar('FS_KD_REG'),
          $this->request->getVar('FS_NUTRISI1'),
          $this->request->getVar('FS_NUTRISI2'),
          $FS_NUTRISI_ANAK1,
          $FS_NUTRISI_ANAK2,
          $FS_NUTRISI_ANAK3,
          $FS_NUTRISI_ANAK4,
          session('user_id'),
          date('Y-m-d')
        );
        $this->m_rawat_jalan->insert_nutrisi($params6);

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

        if ($this->request->getVar('informed_concent_tgl') == NULL) {
          $informed_concent_tgl = '';
        }

        // $instruksi_resepHD = '';
        // $instruksi_dialisat_asetat = '';
        // $instruksi_dialisat_conductivity = '';
        // // $instruksi_dialisat_temperatur = '';
        // $instruksi_femoral = '';
        // $instruksi_HD_catheter = '';
        // $instruksi_dialisat_temperatur_text = '';
        // $instruksi_dosis_sirkulasi = '';
        // $instruksi_dosis_sirkulasi_text = '';
        // $instruksi_dosis_awal = '';
        // $instruksi_dosis_awal_text = '';
        // $instruksi_dosis_main = '';
        // $instruksi_dosis_maintenance = '';
        // $instruksi_dosis_main_intermitten_text = '';
        // $instruksi_LMWH = '';
        // // $instruksi_LMWH_text = '';
        // $instruksi_tanpa_heparin = '';
        // $instruksi_program_bilas = '';
        // $instruksi_edukasi = '';
        // $instruksi_edukasi_text = '';
        // $instruksi_catatan_lain = '';

        $params7 = array(
          $this->request->getVar('FS_KD_REG'),
          $FS_KD_TRS,
          $this->request->getVar('informed_concent_tgl'),
          date('Y-m-d'),
          $this->request->getVar('instruksi_resepHD'),
          $this->request->getVar('instruksi_resepHD_TD'),
          $this->request->getVar('instruksi_resepHD_QB'),
          $this->request->getVar('instruksi_resepHD_QD'),
          $this->request->getVar('instruksi_resepHD_UFgoal'),
          '',
          '',
          '',
          $this->request->getVar('instruksi_av_fistula'),
          $this->request->getVar('instruksi_femoral'),
          $this->request->getVar('instruksi_HD_catheter'),
          $this->request->getVar('instruksi_dialisat_asetat'),
          $this->request->getVar('instruksi_dialisat_bicarbonat'),
          $this->request->getVar('instruksi_dialisat_conductivity'),
          $this->request->getVar('instruksi_dialisat_conductivity_text'),
          $this->request->getVar('instruksi_dialisat_temperatur'),
          $this->request->getVar('instruksi_dialisat_temperatur_text'),
          $this->request->getVar('instruksi_dosis_sirkulasi'),
          $this->request->getVar('instruksi_dosis_sirkulasi_text'),
          $this->request->getVar('instruksi_dosis_awal'),
          $this->request->getVar('instruksi_dosis_awal_text'),
          $this->request->getVar('instruksi_dosis_maintenance'),
          $this->request->getVar('instruksi_dosis_main'),
          $this->request->getVar('instruksi_dosis_main_continue_text'),
          $this->request->getVar('instruksi_dosis_main_intermitten_text'),
          $this->request->getVar('instruksi_LMWH'),
          $this->request->getVar('instruksi_LMWH_text'),
          $this->request->getVar('instruksi_tanpa_heparin'),
          $this->request->getVar('instruksi_tanpa_heparin_text'),
          $this->request->getVar('instruksi_program_bilas'),
          $this->request->getVar('instruksi_edukasi'),
          $this->request->getVar('instruksi_edukasi_text'),
          $this->request->getVar('instruksi_catatan_lain'),

          $this->com_user['user_id'],
          date('Y-m-d')
        );
        $this->m_rawat_jalan->insert_instruksi_medis($params7);
        // return var_dump($params7);
        // die();

        // if ($this->request->getVar('tindakan_anthd_perdarahan') == NULL) {
        //   $tindakan_anthd_perdarahan = '';
        // }

        $tindakan_anthd_condk = '';

        $params8 = array(
          $this->request->getVar('FS_KD_REG'),
          $this->request->getVar('tindakan_anthd_jam'),
          $this->request->getVar('tindakan_anthd_qb'),
          '',
          '',
          $this->request->getVar('tindakan_anthd_suhu'),
          $this->request->getVar('tindakan_anthd_td'),
          $this->request->getVar('tindakan_anthd_uf'),
          $this->request->getVar('tindakan_anthd_uf_rate'),
          $tindakan_anthd_condk,
          $this->request->getVar('tindakan_anthd_washout'),
          $this->request->getVar('tindakan_anthd_tranfusi'),
          $this->request->getVar('tindakan_anthd_makan'),
          $this->request->getVar('tindakan_anthd_urin'),
          $this->request->getVar('tindakan_anthd_muntah'),
          $this->request->getVar('tindakan_anthd_perdarahan'),
          $this->request->getVar('tindakan_anthd_keterangan'),
          $this->request->getVar('tindakan_anthd_nadi'),
          session('user_id'),
          date('Y-m-d')
        );
        $this->m_rawat_jalan->insert_monitoring_hd($params8);
        // return var_dump($params8);
        // die();

        // notification
        // $this->tnotification->delete_last_field();
        // $this->tnotification->sent_notification("success", "Detail berhasil disimpan");
      } else {
        // default error
        // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
      }
    } else {
      // default error
      // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
    }
    // default redirect
    if ($this->request->getVar('FS_KD_LAYANAN') == 'P004') {
      return redirect()->to("nurse/hd/add_riw_kehamilan/" . $this->request->getVar('FS_KD_REG') . '/' . $this->request->getVar('FS_KD_MEDIS'));
    } else {
      return redirect()->to("nurse/hd");
    }
  }

  public function edit($FS_KD_REG = "")
  {


    $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
    $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();



    $now = date('Y-m-d');
    $data["result"] = $this->m_rawat_jalan_nurse->get_px_by_dokter_by_rg2([$now, $FS_KD_REG]);
    $data["vs"] = $this->m_rawat_jalan->get_data_vs_by_rg([$FS_KD_REG]);
    $data["nyeri"] = $this->m_rawat_jalan->get_data_nyeri_by_rg([$FS_KD_REG]);
    $data["jatuh"] = $this->m_rawat_jalan->get_data_jatuh_by_rg([$FS_KD_REG]);
    $data["ases2"] = $this->m_rawat_jalan->get_data_ases2_by_rg([$FS_KD_REG]);
    $data["alergi"] = $this->m_rawat_jalan->get_data_alergi_by_rg([$FS_KD_REG]);
    $data["nutrisi"] = $this->m_rawat_jalan->get_data_nutrisi_by_rg([$FS_KD_REG]);
    $data["rs_monitoring_hd"] = $this->m_rawat_jalan->get_monitoring_hd($FS_KD_REG);
    $data["medis"] = $this->m_rawat_jalan->get_data_instruksi_medis_hd_by_rg($FS_KD_REG);
    // get instansi tujuan


    $data['rs_tujuan'] = $this->m_rawat_jalan->list_masalah_kep_by_rg($FS_KD_REG);;

    $data['rs_tembusan'] = $this->m_rawat_jalan->list_rencana_kep_by_rg($FS_KD_REG);
    // notification
    // output
    return view('nurse/hd/edit', $data);
    // return var_dump($data['medis']);
  }

  public function edit_process()
  {
    // set page rules
    // $this->_set_page_rule("U");

    // cek input
    // $this->tnotification->set_rules('FS_KD_REG', 'KODE REGISTER', 'trim|required');
    $input = $this->validate([
      'FS_KD_REG' => 'required',
      'tindakan_anthd_suhu' => 'required',
      'tindakan_anthd_tranfusi' => 'required'
    ]);
    // process
    if ($input !== FALSE) {
      if ($this->request->getVar('save') == 'Simpan') {
        $params = array(
          $this->request->getVar('FS_KD_REG'),
          $this->request->getVar('tindakan_anthd_jam'),
          $this->request->getVar('tindakan_anthd_qb'),
          '',
          '',
          $this->request->getVar('tindakan_anthd_suhu'),
          $this->request->getVar('tindakan_anthd_td'),
          $this->request->getVar('tindakan_anthd_uf'),
          $this->request->getVar('tindakan_anthd_uf_rate'),
          $this->request->getVar('tindakan_anthd_condk'),
          $this->request->getVar('tindakan_anthd_washout'),
          $this->request->getVar('tindakan_anthd_tranfusi'),
          $this->request->getVar('tindakan_anthd_makan'),
          $this->request->getVar('tindakan_anthd_urin'),
          $this->request->getVar('tindakan_anthd_muntah'),
          $this->request->getVar('tindakan_anthd_perdarahan'),
          $this->request->getVar('tindakan_anthd_keterangan'),
          $this->request->getVar('tindakan_anthd_nadi'),
          $this->com_user['user_id'],
          date('Y-m-d')
        );
        // insert
        if ($this->m_rawat_jalan->insert_monitoring_hd($params)) {
          // notification
          // $this->tnotification->delete_last_field();
          // $this->tnotification->sent_notification("success", "Detail berhasil disimpan");
          redirect("nurse/hd/edit/" . $this->request->getVar('FS_KD_REG'));
        } else {
          // default error
          // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
          redirect("nurse/hd/edit/" . $this->request->getVar('FS_KD_REG'));
        }
      } elseif ($this->request->getVar('save') == 'Kirim') {
        $params = array(
          '1',
          $this->com_user['user_id'],
          date('Y-m-d'),
          $this->request->getVar('FS_KD_REG')
        );
        // insert
        if ($this->m_rawat_jalan->update($params)) {
          $params1 = array(
            $this->request->getVar('FS_SUHU'),
            $this->request->getVar('FS_NADI'),
            $this->request->getVar('FS_R'),
            $this->request->getVar('FS_TD'),
            $this->request->getVar('FS_TB'),
            $this->request->getVar('FS_BB'),
            $this->request->getVar('FS_BB_KERING'),
            $this->com_user['user_id'],
            date('Y-m-d'),
            $this->request->getVar('FS_KD_REG')
          );
          $this->m_rawat_jalan->update_vs($params1);
          // insert
          $params2 = array(
            $this->request->getVar('FS_NYERIP'),
            $this->request->getVar('FS_NYERIQ'),
            $this->request->getVar('FS_NYERIR'),
            $this->request->getVar('FS_NYERIS'),
            $this->request->getVar('FS_NYERIT'),
            $this->com_user['user_id'],
            date('Y-m-d'),
            $this->request->getVar('FS_NYERI'),
            $this->request->getVar('FS_KD_REG')
          );
          $this->m_rawat_jalan->update_nyeri($params2);
          $params3 = array(
            $this->request->getVar('FS_CARA_BERJALAN1'),
            $this->request->getVar('FS_CARA_BERJALAN2'),
            $this->request->getVar('FS_CARA_DUDUK'),
            $this->com_user['user_id'],
            date('Y-m-d'),
            $this->request->getVar('FS_KD_REG')
          );
          $this->m_rawat_jalan->update_jatuh($params3);


          if ($this->request->getVar('FS_RIW_IMUNISASI') == NULL) {
            $FS_RIW_IMUNISASI = '';
          }

          if ($this->request->getVar('FS_RIW_IMUNISASI_KET') == NULL) {
            $FS_RIW_IMUNISASI_KET = '';
          }

          if ($this->request->getVar('FS_RIW_TUMBUH') == NULL) {
            $FS_RIW_TUMBUH = '';
          }

          if ($this->request->getVar('FS_RIW_TUMBUH_KET') == NULL) {
            $FS_RIW_TUMBUH_KET = '';
          }

          $params4 = array(
            '',
            '',
            '',
            '',
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
            $FS_RIW_IMUNISASI,
            $FS_RIW_IMUNISASI_KET,
            $FS_RIW_TUMBUH,
            $FS_RIW_TUMBUH_KET,
            '',
            $this->request->getVar('FS_EDUKASI'),
            $this->com_user['user_id'],
            date('Y-m-d'),
            $this->request->getVar('FS_KD_REG')
          );
          $this->m_rawat_jalan->update_ases($params4);

          $params5 = array(
            $this->request->getVar('FS_ALERGI'),
            $this->request->getVar('FS_REAK_ALERGI'),
            $this->request->getVar('FS_RIW_PENYAKIT_DAHULU'),
            $this->request->getVar('FS_RIW_PENYAKIT_DAHULU2'),
            $this->request->getVar('FS_MR')
          );
          $params6 = array(
            $this->request->getVar('FS_NUTRISI1'),
            $this->request->getVar('FS_NUTRISI2'),
            $this->request->getVar('FS_NUTRISI_ANAK1'),
            $this->request->getVar('FS_NUTRISI_ANAK2'),
            $this->request->getVar('FS_NUTRISI_ANAK3'),
            $this->request->getVar('FS_NUTRISI_ANAK4'),
            $this->com_user['user_id'],
            date('Y-m-d'),
            $this->request->getVar('FS_KD_REG')
          );
          $this->m_rawat_jalan->update_nutrisi($params6);
          $masalah_kep = $this->request->getVar('tujuan');
          $this->m_rawat_jalan->delete_masalah_kep($this->request->getVar('FS_KD_REG'));
          if (!empty($masalah_kep)) {
            foreach ($masalah_kep as $value) {
              $this->m_rawat_jalan->insert_masalah_kep(array($this->request->getVar('FS_KD_REG'), $value));
            }
          }
          $rencana_kep = $this->request->getVar('tembusan');
          $this->m_rawat_jalan->delete_rencana_kep($this->request->getVar('FS_KD_REG'));
          if (!empty($rencana_kep)) {
            foreach ($rencana_kep as $value) {
              $this->m_rawat_jalan->insert_rencana_kep(array($this->request->getVar('FS_KD_REG'), $value));
            }
          }
          $params7 = array(

            $this->request->getVar('informed_concent_tgl'),
            date('Y-m-d'),
            $this->request->getVar('instruksi_resepHD'),
            $this->request->getVar('instruksi_resepHD_TD'),
            $this->request->getVar('instruksi_resepHD_QB'),
            $this->request->getVar('instruksi_resepHD_QD'),
            $this->request->getVar('instruksi_resepHD_UFgoal'),
            $this->request->getVar('instruksi_profilling_Na'),
            $this->request->getVar('instruksi_profilling_NaStat'),
            $this->request->getVar('instruksi_profilling_UF'),
            $this->request->getVar('instruksi_av_fistula'),
            $this->request->getVar('instruksi_femoral'),
            $this->request->getVar('instruksi_HD_catheter'),
            $this->request->getVar('instruksi_dialisat_asetat'),
            $this->request->getVar('instruksi_dialisat_bicarbonat'),
            $this->request->getVar('instruksi_dialisat_conductivity'),
            $this->request->getVar('instruksi_dialisat_conductivity_text'),
            $this->request->getVar('instruksi_dialisat_temperatur'),
            $this->request->getVar('instruksi_dialisat_temperatur_text'),
            $this->request->getVar('instruksi_dosis_sirkulasi'),
            $this->request->getVar('instruksi_dosis_sirkulasi_text'),
            $this->request->getVar('instruksi_dosis_awal'),
            $this->request->getVar('instruksi_dosis_awal_text'),
            $this->request->getVar('instruksi_dosis_maintenance'),
            $this->request->getVar('instruksi_dosis_main'),
            $this->request->getVar('instruksi_dosis_main_continue_text'),
            $this->request->getVar('instruksi_dosis_main_intermitten_text'),
            $this->request->getVar('instruksi_LMWH'),
            $this->request->getVar('instruksi_LMWH_text'),
            $this->request->getVar('instruksi_tanpa_heparin'),
            $this->request->getVar('instruksi_tanpa_heparin_text'),
            $this->request->getVar('instruksi_program_bilas'),
            $this->request->getVar('instruksi_edukasi'),
            $this->request->getVar('instruksi_edukasi_text'),
            $this->request->getVar('instruksi_catatan_lain'),


            $this->request->getVar('FS_KD_REG')
          );
          $this->m_rawat_jalan->update_instruksi_medis($params7);

          // notification
          // $this->tnotification->delete_last_field();
          // $this->tnotification->sent_notification("success", "Detail berhasil disimpan");
        } else {
          // default error
          // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
        }
      }
    } else {
      // default error
      // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
    }
    // default redirect
    return redirect("nurse/hd");
  }

  public function delete_process_tindakan_monitoring($FS_KD_HD_TINDAKAN_MONITORING = "", $FS_KD_REG = "")
  {
    // set page rules
    $this->_set_page_rule("D");
    // insert
    if ($this->m_rawat_jalan->delete_tindakan_monitoring($FS_KD_HD_TINDAKAN_MONITORING)) {
      $this->tnotification->delete_last_field();
      $this->tnotification->sent_notification("success", "Data berhasil dihapus");
      // default redirect
      redirect("nurse/hd/add/" . $FS_KD_REG);
    } else {
      // default error
      $this->tnotification->sent_notification("error", "Data gagal dihapus");
    }
    // default redirect
    redirect("nurse/hd/add/" . $FS_KD_REG);
  }
  public function delete_process_tindakan_monitoring_edit($FS_KD_HD_TINDAKAN_MONITORING = "", $FS_KD_REG = "")
  {
    // set page rules
    $this->_set_page_rule("D");
    // insert
    if ($this->m_rawat_jalan->delete_tindakan_monitoring($FS_KD_HD_TINDAKAN_MONITORING)) {
      $this->tnotification->delete_last_field();
      $this->tnotification->sent_notification("success", "Data berhasil dihapus");
      // default redirect
      redirect("nurse/hd/edit/" . $FS_KD_REG);
    } else {
      // default error
      $this->tnotification->sent_notification("error", "Data gagal dihapus");
    }
    // default redirect
    redirect("nurse/hd/edit/" . $FS_KD_REG);
  }

  public function rekap_excel()
  {
    // load excel
    $this->load->library('phpexcel');
    // create excell
    $filepath = "resource/doc/excel/rekap_resume_rawat_jalan.xlsx";
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $this->phpexcel = $objReader->load($filepath);
    $objWorksheet = $this->phpexcel->setActiveSheetIndex(0);
    // search param
    $year = date("Y");
    $month = date("m");
    $search = $this->tsession->userdata('nurse_rawat_jalan');
    $FD_TGL_MASUK = empty($search['FD_TGL_MASUK']) ?: $search['FD_TGL_MASUK'];
    $FS_KD_PEG = empty($search['FS_KD_PEG']) ?: $search['FS_KD_PEG'];
    $now = date('Y-m-d');
    // surat
    $surat = $this->m_rawat_jalan->get_px_by_dokter_wait(array($FD_TGL_MASUK, $FS_KD_PEG, $FS_KD_PEG, $FS_KD_PEG));
    $dokter = $this->m_rawat_jalan->get_dokter2($FS_KD_PEG);
    $bln = array(
      '01' => 'Januari',
      '02' => 'Februari',
      '03' => 'Maret',
      '04' => 'April',
      '05' => 'Mei',
      '06' => 'Juni',
      '07' => 'Juli',
      '08' => 'Agustus',
      '09' => 'September',
      '10' => 'Oktober',
      '11' => 'November',
      '12' => 'Desember'
    );
    foreach ($bln as $key => $value) {
      if ($key == $bulan) {
        $bulann = $value;
      }
    }
    /*
         * SET DATA EXCELL
         */
    $objWorksheet->setCellValue('A6', 'DATA PASIEN RAWAT JALAN DOKTER ' . $dokter['FS_NM_PEG'] . ' Tanggal ' . strtoupper($now));

    $i = 9;
    $no = 1;
    foreach ($surat as $data) {
      $objWorksheet->setCellValue('A' . $i, $no++ . '.');
      $objWorksheet->setCellValue('B' . $i, $data['FS_KD_REG']);
      $objWorksheet->setCellValue('C' . $i, $data['FS_MR']);
      $objWorksheet->setCellValue('D' . $i, $data['FS_NM_PASIEN']);
      $objWorksheet->setCellValue('E' . $i, $data['FS_ALM_PASIEN']);
      $objWorksheet->setCellValue('F' . $i, strip_tags($data['FS_DIAGNOSA']));
      $objWorksheet->setCellValue('G' . $i, strip_tags($data['FS_TINDAKAN']));
      // insert
      if (($i - 8) != count($surat)) {
        $objWorksheet->insertNewRowBefore(($i + 1), 1);
      }
      // next row
      $i++;
    }
    // file_name
    $file_name = "DATA_PASIEN_RAWAT_JALAN_DOKTER_" . $dokter['FS_NM_PEG'] . "_Tanggal_" . strtoupper($now);
    //--
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename=' . $file_name . '.xlsx');
    header('Cache-Control: max-age=0');
    // output
    $obj_writer = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
    $obj_writer->save('php://output');
    exit();
  }

  public function list_masalah_kep()
  {
    $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
    $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();
    $instansi = $this->m_rawat_jalan->list_masalah_kep();
    $data[] = array();
    $i = 0;
    foreach ($instansi as $key => $value) {
      $data[$i] = array(
        'text' => $value['FS_NM_DIAGNOSA'],
        'id' => $value['FS_KD_DAFTAR_DIAGNOSA']
      );
      $i++;
    }
    // $objek = ["results" => $data];
    echo json_encode($data);
  }

  public function list_rencana_kep()
  {
    $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
    $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();
    $instansi = $this->m_rawat_jalan->list_rencana_kep();
    $data[] = array();
    $i = 0;
    foreach ($instansi as $key => $value) {
      $data[$i] = array(
        'text' => $value['FS_NM_REN_KEP'],
        'id' => $value['FS_KD_TRS']
      );
      $i++;
    }
    // $objek = ["results" => $data];
    echo json_encode($data);
  }
}
