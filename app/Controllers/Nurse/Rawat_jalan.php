<?php

namespace App\Controllers\Nurse;


use App\Controllers\BaseController;
use App\Libraries\Phpexcel;

class Rawat_jalan extends BaseController
{
    public function index()
    {
        $data = [];
        $data['title'] = 'Rawat Jalan';
        $search = session('nurse_rawat_jalan');


        if (!empty($search)) {
            $data["search"] = $search;
        }
        if (empty($search['FS_KD_PEG'])) {
            $search['FS_KD_PEG'] = 'S000';
            $data["search"] = $search;
        }
        if (empty($search['FD_TGL_MASUK'])) {
            $search['FD_TGL_MASUK'] = '2021-02-02';
            $data["search"] = $search;
        }
        $data["FS_KD_PEG"] = $search['FS_KD_PEG'];
        $data["FD_TGL_MASUK"] = $search['FD_TGL_MASUK'];
        // search parameters
        $FD_TGL_MASUK = empty($search['FD_TGL_MASUK']) ?: $search['FD_TGL_MASUK'];

        $FS_KD_PEG = empty($search['FS_KD_PEG']) ?: $search['FS_KD_PEG'];
        $now = date('Y-m-d');
        // get search parameter
        $data["no"] = '1';
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
        $data["rs_dokter"] = $this->m_rawat_jalan->get_dokter();
        $data["rs_pasien"] = $this->m_rawat_jalan->get_px_by_dokter_wait([$FD_TGL_MASUK, $FS_KD_PEG, $FS_KD_PEG, $FS_KD_PEG]);

        return view('nurse/rawat_jalan/index', $data);
    }

    // searching
    public function proses_cari()
    {

        //------------------------------------------------------------------------------------------------------------------
        // $this->_set_page_rule("R");

        //====================================================================================================================

        if ($this->request->getVar('save') == "Reset") {
            session()->remove("nurse_rawat_jalan");
        } else {
            $params = [
                "FD_TGL_MASUK" => $this->request->getVar("FD_TGL_MASUK"),
                "FS_KD_PEG" => $this->request->getVar("FS_KD_PEG")
            ];
            session()->set("nurse_rawat_jalan", $params);
        }
        // redirect
        return redirect()->to("nurse/rawat_jalan/");
    }


    public function history($FS_MR = "", $FS_KD_PEG = "")
    {
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
        $data = [];



        $now = date('Y-m-d');
        $medis = $FS_KD_PEG;
        $data["no"] = '1';
        $data["FS_KD_MEDIS"] = $FS_KD_PEG;
        $data["result"] = $this->m_rawat_jalan->get_px_by_dokter_by_rm([$now, $FS_MR]);
        $data["rs_pasien"] = $this->m_rawat_jalan->get_px_history([$now, $medis, $medis, $medis, $FS_MR]);


        return view('nurse/rawat_jalan/history', $data);
        // return print_r($form);
    }


    public function add($FS_KD_REG = "", $FS_KD_MEDIS = "", $FS_JNS_ASESMEN = "")
    {
        $data = [];
        $now = date('Y-m-d');
        $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();

        $data["result"] = $this->m_rawat_jalan_nurse->get_px_by_dokter_by_rg2([$now, $FS_KD_REG]);
        $data['tujuan'] = $this->m_rawat_jalan->list_masalah_kep();
        $data['tembusan'] = $this->m_rawat_jalan->list_rencana_kep();
        $data["FS_KD_MEDIS"] = $FS_KD_MEDIS;
        $data["FS_JNS_ASESMEN"] = $FS_JNS_ASESMEN;
        // $data['user_id'] = $this->m_rawat_jalan->user_id_search();






        return view('nurse/rawat_jalan/add', $data);
        // return var_dump(session('user_id'));
    }


    public function add_process()
    {
        helper(['form', 'url']);
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
        $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();

        $input = $this->validate([
            'FS_KD_REG' => 'required',
            'FS_SUHU' => 'required',
            'FS_R' => 'required|numeric|max_length[10]'
        ]);


        // ==================================================================================================================================================================
        if ($input !== FALSE) {
            $params = array(
                $this->request->getVar('FS_KD_REG'),
                '1',
                '1',
                $this->request->getVar('FS_JNS_ASESMEN'),
                session('user_id'),
                date('Y-m-d')
            );

            // =================================================================================================================================================================================
            // insert
            if ($this->m_rawat_jalan->insert($params)) {
                $params1 = [
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
                ];
                $this->m_rawat_jalan->insert_vs($params1);
                // insert
                $params2 = [
                    $this->request->getVar('FS_KD_REG'),
                    $this->request->getVar('FS_NYERIP'),
                    $this->request->getVar('FS_NYERIQ'),
                    $this->request->getVar('FS_NYERIR'),
                    $this->request->getVar('FS_NYERIS'),
                    $this->request->getVar('FS_NYERIT'),
                    session('user_id'),
                    date('Y-m-d'),
                    $this->request->getVar('FS_NYERI')
                ];
                $this->m_rawat_jalan->insert_nyeri($params2);
                $params3 = [
                    $this->request->getVar('FS_KD_REG'),
                    $this->request->getVar('FS_CARA_BERJALAN1'),
                    $this->request->getVar('FS_CARA_BERJALAN2'),
                    $this->request->getVar('FS_CARA_DUDUK'),
                    session('user_id'),
                    date('Y-m-d')
                ];
                $this->m_rawat_jalan->insert_jatuh($params3);
                if ($this->request->getVar('FS_RIW_IMUNISASI') === NULL) {
                    $FS_RIW_IMUNISASI = '';
                }
                if ($this->request->getVar('FS_RIW_IMUNISASI_KET') === NULL) {
                    $FS_RIW_IMUNISASI_KET = '';
                }
                if ($this->request->getVar('FS_RIW_TUMBUH') === NULL) {
                    $FS_RIW_TUMBUH = '';
                }
                if ($this->request->getVar('FS_RIW_TUMBUH_KET') === NULL) {
                    $FS_RIW_TUMBUH_KET = '';
                }
                $params4 = [
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
                    $this->request->getVar('FS_PEMERIKSAAN_FISIK'),
                    session('user_id'),
                    date('Y-m-d')
                ];
                $this->m_rawat_jalan_nurse->insert_ases($params4);

                $params5 = [
                    $this->request->getVar('FS_ALERGI'),
                    $this->request->getVar('FS_REAK_ALERGI'),
                    $this->request->getVar('FS_RIW_PENYAKIT_DAHULU'),
                    $this->request->getVar('FS_RIW_PENYAKIT_DAHULU2'),
                    $this->request->getVar('FS_MR')
                ];
                $this->m_rawat_jalan_nurse->insert_alergi($params5);

                if ($this->request->getVar('FS_NUTRISI_ANAK1') === NULL) {
                    $FS_NUTRISI_ANAK1 = '';
                }
                if ($this->request->getVar('FS_NUTRISI_ANAK2') === NULL) {
                    $FS_NUTRISI_ANAK2 = '';
                }
                if ($this->request->getVar('FS_NUTRISI_ANAK3') === NULL) {
                    $FS_NUTRISI_ANAK3 = '';
                }
                if ($this->request->getVar('FS_NUTRISI_ANAK4') === NULL) {
                    $FS_NUTRISI_ANAK4 = '';
                }

                $params6 = [
                    $this->request->getVar('FS_KD_REG'),
                    $this->request->getVar('FS_NUTRISI1'),
                    $this->request->getVar('FS_NUTRISI2'),
                    $FS_NUTRISI_ANAK1,
                    $FS_NUTRISI_ANAK2,
                    $FS_NUTRISI_ANAK3,
                    $FS_NUTRISI_ANAK4,
                    session('user_id'),
                    date('Y-m-d')
                ];
                $this->m_rawat_jalan->insert_nutrisi($params6);

                $params7 = [
                    $this->request->getVar('FS_KD_REG'),
                    $this->request->getVar('FS_GERIATRI1'),
                    $this->request->getVar('FS_GERIATRI2'),
                    $this->request->getVar('FS_GERIATRI3')
                ];
                $this->m_rawat_jalan_nurse->insert_geriatri($params7);

                $this->m_rawat_jalan->insert_masalah_kep(array($this->request->getVar('FS_KD_REG'), $this->request->getVar('tujuan')));


                $this->m_rawat_jalan->insert_rencana_kep(array($this->request->getVar('FS_KD_REG'), $this->request->getVar('tembusan')));

                // notification
                // $this->tnotification->delete_last_field();
                // $this->tnotification->sent_notification("success", "Detail berhasil disimpan");
                return  redirect()->to("nurse/rawat_jalan");
            } else {
                // default error
                // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
                return  redirect()->to("nurse/rawat_jalan/history/" . $this->request->getVar('FS_MR') . "/" . $this->request->getVar('FS_KD_MEDIS') . "");
            }
        } else {
            // default error
            // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
            return redirect()->to("nurse/rawat_jalan/history/" . $this->request->getVar('FS_MR') . "/" . $this->request->getVar('FS_KD_MEDIS') . "");
        }
        // default redirect
        return redirect()->to("nurse/rawat_jalan");
    }


    public function edit($FS_KD_REG = "")
    {
        $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();
        $data = [];




        $now = date('Y-m-d');
        $data["result"] = $this->m_rawat_jalan_nurse->get_px_by_dokter_by_rg2([$now, $FS_KD_REG]);
        $data["vs"] = $this->m_rawat_jalan->get_data_vs_by_rg([$FS_KD_REG]);
        $data["nyeri"] = $this->m_rawat_jalan->get_data_nyeri_by_rg([$FS_KD_REG]);
        $data["jatuh"] = $this->m_rawat_jalan->get_data_jatuh_by_rg([$FS_KD_REG]);
        $data["ases2"] = $this->m_rawat_jalan->get_data_ases2_by_rg([$FS_KD_REG]);
        $data["nutrisi"] = $this->m_rawat_jalan->get_data_nutrisi_by_rg([$FS_KD_REG]);
        $data["geriatri"] = $this->m_rawat_jalan_nurse->get_data_geritri_by_rg([$FS_KD_REG]);
        $data['tujuan'] = $this->m_rawat_jalan->list_masalah_kep();
        $data['tembusan'] = $this->m_rawat_jalan->list_rencana_kep();
        $data['masalah'] = $this->m_rawat_jalan->get_data_masalah_by_rg([$FS_KD_REG])[0];
        $data['rencana'] = $this->m_rawat_jalan_nurse->mencari_keperawatan([$FS_KD_REG])[0];






        return view("nurse/rawat_jalan/edit", $data);
        // return var_dump($data['geriatri']);
    }

    public function edit_process()
    {
        $this->m_rawat_jalan_nurse = new \App\Models\M_rawat_jalan_nurse();
        $this->m_rawat_jalan = new \App\Models\M_rawat_jalan();

        // set page rules
        // cek input


        $input = $this->validate([
            'FS_KD_REG' => 'required',
            'FS_SUHU' => 'required',
            'FS_R' => 'required|numeric|max_length[10]'
        ]);




        if ($input !== FALSE) {
            $params = array(
                '1',
                session('user_id'),
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
                    session('user_id'),
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
                    session('user_id'),
                    date('Y-m-d'),
                    $this->request->getVar('FS_NYERI'),
                    $this->request->getVar('FS_KD_REG')
                );
                $this->m_rawat_jalan->update_nyeri($params2);
                $params3 = array(
                    $this->request->getVar('FS_CARA_BERJALAN1'),
                    $this->request->getVar('FS_CARA_BERJALAN2'),
                    $this->request->getVar('FS_CARA_DUDUK'),
                    session('user_id'),
                    date('Y-m-d'),
                    $this->request->getVar('FS_KD_REG')
                );
                $this->m_rawat_jalan->update_jatuh($params3);
                //$this->m_rawat_jalan->delete_ases($params4);

                if ($this->request->getVar('FS_RIW_IMUNISASI') === NULL) {
                    $FS_RIW_IMUNISASI = '';
                }
                if ($this->request->getVar('FS_RIW_IMUNISASI_KET') === NULL) {
                    $FS_RIW_IMUNISASI_KET = '';
                }
                if ($this->request->getVar('FS_RIW_TUMBUH') === NULL) {
                    $FS_RIW_TUMBUH = '';
                }
                if ($this->request->getVar('FS_RIW_TUMBUH_KET') === NULL) {
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
                    $this->request->getVar('FS_PEMERIKSAAN_FISIK'),
                    session('user_id'),
                    date('Y-m-d'),
                    $this->request->getVar('FS_KD_REG')
                );
                $this->m_rawat_jalan_nurse->update_ases($params4);

                $params5 = array(
                    $this->request->getVar('FS_ALERGI'),
                    $this->request->getVar('FS_REAK_ALERGI'),
                    $this->request->getVar('FS_RIW_PENYAKIT_DAHULU'),
                    $this->request->getVar('FS_RIW_PENYAKIT_DAHULU2'),
                    $this->request->getVar('FS_MR')
                );
                $this->m_rawat_jalan_nurse->insert_alergi($params5);

                if ($this->request->getVar('FS_NUTRISI_ANAK1') === NULL) {
                    $FS_NUTRISI_ANAK1 = '';
                }
                if ($this->request->getVar('FS_NUTRISI_ANAK2') === NULL) {
                    $FS_NUTRISI_ANAK2 = '';
                }
                if ($this->request->getVar('FS_NUTRISI_ANAK3') === NULL) {
                    $FS_NUTRISI_ANAK3 = '';
                }
                if ($this->request->getVar('FS_NUTRISI_ANAK4') === NULL) {
                    $FS_NUTRISI_ANAK4 = '';
                }



                $params6 = array(
                    $this->request->getVar('FS_NUTRISI1'),
                    $this->request->getVar('FS_NUTRISI2'),
                    $FS_NUTRISI_ANAK1,
                    $FS_NUTRISI_ANAK2,
                    $FS_NUTRISI_ANAK3,
                    $FS_NUTRISI_ANAK4,
                    session('user_id'),
                    date('Y-m-d'),
                    $this->request->getVar('FS_KD_REG')
                );
                $this->m_rawat_jalan->update_nutrisi($params6);

                $params7 = array(
                    $this->request->getVar('FS_GERIATRI1'),
                    $this->request->getVar('FS_GERIATRI2'),
                    $this->request->getVar('FS_GERIATRI3'),
                    $this->request->getVar('FS_KD_REG')
                );
                $this->m_rawat_jalan_nurse->update_geriatri($params7);



                $this->m_rawat_jalan->delete_masalah_kep($this->request->getVar('FS_KD_REG'));
                $this->m_rawat_jalan->insert_masalah_kep(array($this->request->getVar('FS_KD_REG'), $this->request->getVar('tujuan')));


                $this->m_rawat_jalan->delete_rencana_kep($this->request->getVar('FS_KD_REG'));
                $this->m_rawat_jalan->insert_rencana_kep(array($this->request->getVar('FS_KD_REG'), $this->request->getVar('tembusan')));
            }
            // notification
            // $this->tnotification->delete_last_field();
            // $this->tnotification->sent_notification("success", "Detail berhasil disimpan");
            return redirect()->to('/nurse/rawat_jalan');
        } else {
            // default error
            // $this->tnotification->sent_notification("error", "Detail gagal disimpan");
            echo "<script>alert('detail gagal disimpan')</script>";
            return redirect()->to('/nurse/rawat_jalan/edit/' . $this->request->getVar('FS_KD_REG'));
        }
    }


    public function rekap_excel()
    {
        // load excel
        // $this->load->library('phpexcel');
        $this->phpexcel = new Phpexcel();
        // create excell
        $filepath = "resource/doc/excel/rekap_resume_rawat_jalan.xlsx";
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $this->phpexcel = $objReader->load($filepath);
        $objWorksheet = $this->phpexcel->setActiveSheetIndex(0);
        // search param
        $year = date("Y");
        $month = date("m");
        $search = session('nurse_rawat_jalan');
        $FD_TGL_MASUK = empty($search['FD_TGL_MASUK']) ?: $search['FD_TGL_MASUK'];
        $FS_KD_PEG = empty($search['FS_KD_PEG']) ?: $search['FS_KD_PEG'];
        $now = date('Y-m-d');
        // surat
        $surat = $this->m_rawat_jalan->get_px_by_dokter_wait(array($now, $FS_KD_PEG, $FS_KD_PEG, $FS_KD_PEG));
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
                $bulan = $value;
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
}
