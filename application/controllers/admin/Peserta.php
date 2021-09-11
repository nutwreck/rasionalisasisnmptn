<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Peserta extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        if (!$this->session->has_userdata('has_login')){
            redirect('admin/login');
        } 
        date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Sekolah_model','sekolah');
        $this->load->model('Lokasi_model','lokasi');
        $this->load->model('Core_model','core');
        $this->load->model('Peserta_model','peserta');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }

    /**
     * TEMPLATE
     */
    private function _view($page, $css, $content, $js, $data){
        $this->load->view('admin/_partials/header', $page);
        if(!empty($css)){
            $this->load->view($css);
        } else {
            
        }
        $this->load->view('admin/_partials/sidebar');
        if(!empty($data)){ 
            $this->load->view($content, $data); 
        } else {
            $this->load->view($content);
        }
        $this->load->view('admin/_partials/footer');
        if(!empty($js)){
            $this->load->view($js);
        } else {
            
        }
    }

    private function input_end($input, $urly, $urlx){
        if(!empty($input)){
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
		    redirect($urly);
        } else {
            $this->session->set_flashdata('error', 'Data gagal disimpan!');
		    redirect($urlx);
        }
    }

    private function update_end($update, $urly, $urlx){
        if(!empty($update)){
            $this->session->set_flashdata('success', 'Data berhasil diedit');
		    redirect($urly);
        } else {
            $this->session->set_flashdata('error', 'Data gagal terupdate!');
		    redirect($urlx);
        }
    }

    private function delete_end($delete, $urly, $urlx){
        if(!empty($delete)){
            $this->session->set_flashdata('success', 'Data berhasil dinonaktifkan');
		    redirect($urly);
        } else {
            $this->session->set_flashdata('error', 'Data gagal ternonaktifkan!');
		    redirect($urlx);
        }
    }

    private function active_end($active, $urly, $urlx){
        if(!empty($active)){
            $this->session->set_flashdata('success', 'Data berhasil diaktifkan');
		    redirect($urly);
        } else {
            $this->session->set_flashdata('error', 'Data gagal diaktifkan!');
		    redirect($urlx);
        }
    }
    /**
     * END TEMPLATE
     */
    
    /**
     * PESERTA
     */
    public function peserta()
	{
        $data = NULL;
        $page['title_page'] = 'Peserta';
        $css = NULL;
        $content = 'admin/peserta/peserta/peserta';
        $js = 'admin/peserta/peserta/js_peserta';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function peserta_all(){
        $this->load->model('Peserta_model_admin','peserta_admin');
        $list = $this->peserta_admin->get_datatables();
		$data = array();
        $no = $_POST['start'];
		foreach ($list as $field) {
            $no++;
            $ig = $field->instagram == 0 ? '' : 'IG : '.$field->instagram;
            $telegram = $field->telegram == 0 ? '' : 'Telegram : '.$field->telegram;
			$row = array();
			$row[] = $no;
			$row[] = ucwords($field->nama);
			$row[] = $field->email;
            $row[] = $field->no_telp;
            $row[] = $ig.'<br />'.$telegram;
            $row[] = $field->nama_provinsi;
            $row[] = $field->nama_sekolah.' ('.$field->nama_sekolah_jurusan.')';
            $row[] = $field->status_data;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->peserta_admin->count_all(),
			"recordsFiltered" => $this->peserta_admin->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    public function peserta_excel(){
		$data = $this->peserta->get_all_peserta();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Email')
                    ->setCellValue('D1', 'No Telepon')
                    ->setCellValue('E1', 'Instagram')
                    ->setCellValue('F1', 'Telegram')
                    ->setCellValue('G1', 'Provinsi')
                    ->setCellValue('H1', 'Sekolah')
                    ->setCellValue('I1', 'Jurusan')
                    ->setCellValue('J1', 'Status Peserta');

        $kolom = 2;
        $nomor = 1;
        foreach($data as $val) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, ucwords($val->nama))
                        ->setCellValue('C' . $kolom, $val->email)
                        ->setCellValue('D' . $kolom, $val->no_telp)
                        ->setCellValue('E' . $kolom, $val->instagram == 0 ? '' : $val->instagram)
                        ->setCellValue('F' . $kolom, $val->telegram == 0 ? '' : $val->telegram)
                        ->setCellValue('G' . $kolom, $val->nama_provinsi)
                        ->setCellValue('H' . $kolom, $val->nama_sekolah)
                        ->setCellValue('I' . $kolom, $val->nama_jurusan)
                        ->setCellValue('J' . $kolom, $val->status_data);

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Peserta.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    /**
     * END PESERTA
     */
    /**
     * NILAI SEMESTER
     */
    public function nilai_semester()
	{
        $data = NULL;
        $page['title_page'] = 'Nilai Semester';
        $css = NULL;
        $content = 'admin/peserta/nilai_semester/nilai_semester';
        $js = 'admin/peserta/nilai_semester/js_nilai_semester';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function nilai_semester_all(){
        $this->load->model('Peserta_nilai_semester_model_admin','peserta_nilai_semester_admin');
        $list = $this->peserta_nilai_semester_admin->get_datatables();
		$data = array();
        $no = $_POST['start'];
		foreach ($list as $field) {
            $no++;
			$row = array();
			$row[] = $no;
			$row[] = ucwords($field->nama_peserta).'<br />'.'<small>'.$field->email.'</small>'.'<br />'.'<small>'.$field->no_telp.'</small>';
			$row[] = $field->nilai_smt1;
            $row[] = $field->kkm_smt1;
            $row[] = $field->nilai_smt2;
            $row[] = $field->kkm_smt2;
            $row[] = $field->nilai_smt3;
            $row[] = $field->kkm_smt3;
            $row[] = $field->nilai_smt4;
            $row[] = $field->kkm_smt4;
            $row[] = $field->nilai_smt5;
            $row[] = $field->kkm_smt5;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->peserta_nilai_semester_admin->count_all(),
			"recordsFiltered" => $this->peserta_nilai_semester_admin->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    public function nilai_semester_excel(){
		$data = $this->peserta->get_all_peserta_nilai_semester();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Email')
                    ->setCellValue('D1', 'No Telepon')
                    ->setCellValue('E1', 'Provinsi')
                    ->setCellValue('F1', 'Kota/Kabupaten')
                    ->setCellValue('G1', 'Sekolah')
                    ->setCellValue('H1', 'Jurusan')
                    ->setCellValue('I1', 'Nilai Semester 1')
                    ->setCellValue('J1', 'Nilai Semester 2')
                    ->setCellValue('K1', 'Nilai Semester 3')
                    ->setCellValue('L1', 'Nilai Semester 4')
                    ->setCellValue('M1', 'Nilai Semester 5')
                    ->setCellValue('N1', 'KKM Semester 1')
                    ->setCellValue('O1', 'KKM Semester 2')
                    ->setCellValue('P1', 'KKM Semester 3')
                    ->setCellValue('Q1', 'KKM Semester 4')
                    ->setCellValue('R1', 'KKM Semester 5')
                    ->setCellValue('S1', 'Status Data Nilai');

        $kolom = 2;
        $nomor = 1;
        foreach($data as $val) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, ucwords($val->nama_peserta))
                        ->setCellValue('C' . $kolom, $val->email)
                        ->setCellValue('D' . $kolom, $val->no_telp)
                        ->setCellValue('E' . $kolom, $val->nama_provinsi)
                        ->setCellValue('F' . $kolom, $val->nama_kota_kabupaten)
                        ->setCellValue('G' . $kolom, $val->nama_sekolah)
                        ->setCellValue('H' . $kolom, $val->nama_sekolah_jurusan)
                        ->setCellValue('I' . $kolom, $val->nilai_smt1)
                        ->setCellValue('J' . $kolom, $val->nilai_smt2)
                        ->setCellValue('K' . $kolom, $val->nilai_smt3)
                        ->setCellValue('L' . $kolom, $val->nilai_smt4)
                        ->setCellValue('M' . $kolom, $val->nilai_smt5)
                        ->setCellValue('N' . $kolom, $val->kkm_smt1)
                        ->setCellValue('O' . $kolom, $val->kkm_smt2)
                        ->setCellValue('P' . $kolom, $val->kkm_smt3)
                        ->setCellValue('Q' . $kolom, $val->kkm_smt4)
                        ->setCellValue('R' . $kolom, $val->kkm_smt5)
                        ->setCellValue('S' . $kolom, $val->status_data);

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PesertaNilaiSemester.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    /**
     * END NILAI SEMESTER
     */
    /**
     * PRESTASI
     */
    public function prestasi()
	{
        $data = NULL;
        $page['title_page'] = 'Prestasi';
        $css = NULL;
        $content = 'admin/peserta/prestasi/prestasi';
        $js = 'admin/peserta/prestasi/js_prestasi';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function prestasi_all(){
        $this->load->model('Peserta_prestasi_model_admin','peserta_prestasi_admin');
        $list = $this->peserta_prestasi_admin->get_datatables();
		$data = array();
        $no = $_POST['start'];
		foreach ($list as $field) {
            $no++;
			$row = array();
			$row[] = $no;
			$row[] = ucwords($field->nama_peserta);
			$row[] = $field->email;
            $row[] = $field->no_telp;
            $row[] = strtoupper($field->nama_prestasi);
            $row[] = strtoupper($field->nama_juara);
            $row[] = $field->status_data;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->peserta_prestasi_admin->count_all(),
			"recordsFiltered" => $this->peserta_prestasi_admin->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    public function prestasi_excel(){
		$data = $this->peserta->get_all_peserta_prestasi();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Email')
                    ->setCellValue('D1', 'No Telepon')
                    ->setCellValue('E1', 'Provinsi')
                    ->setCellValue('F1', 'Kota/Kabupaten')
                    ->setCellValue('G1', 'Sekolah')
                    ->setCellValue('H1', 'Jurusan')
                    ->setCellValue('I1', 'Prestasi')
                    ->setCellValue('J1', 'Juara')
                    ->setCellValue('K1', 'Status Data');

        $kolom = 2;
        $nomor = 1;
        foreach($data as $val) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, ucwords($val->nama_peserta))
                        ->setCellValue('C' . $kolom, $val->email)
                        ->setCellValue('D' . $kolom, $val->no_telp)
                        ->setCellValue('E' . $kolom, $val->nama_provinsi)
                        ->setCellValue('F' . $kolom, $val->nama_kota_kabupaten)
                        ->setCellValue('G' . $kolom, $val->nama_sekolah)
                        ->setCellValue('H' . $kolom, $val->nama_sekolah_jurusan)
                        ->setCellValue('I' . $kolom, strtoupper($val->nama_prestasi))
                        ->setCellValue('J' . $kolom, strtoupper($val->nama_juara))
                        ->setCellValue('K' . $kolom, $val->status_data);

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PesertaPrestasi.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    /**
     * END PRESTASI
     */
    /**
     * PROGRAM STUDI
     */
    public function program_studi()
	{
        $data = NULL;
        $page['title_page'] = 'Program Studi';
        $css = NULL;
        $content = 'admin/peserta/program_studi/program_studi';
        $js = 'admin/peserta/program_studi/js_program_studi';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function program_studi_all(){
        $this->load->model('Peserta_prodi_model_admin','peserta_prodi_admin');
        $list = $this->peserta_prodi_admin->get_datatables();
		$data = array();
        $no = $_POST['start'];
		foreach ($list as $field) {
            $no++;
			$row = array();
			$row[] = $no;
			$row[] = ucwords($field->nama_peserta).'<br />'.'<small>'.$field->email.'</small>'.'<br />'.'<small>'.$field->no_telp.'</small>';
			$row[] = $field->nama_universitas.' <small>('.$field->nama_universitas_jurusan.')</small>';
            $row[] = $field->daya_tampung;
            $row[] = $field->nilai_raport;
            $row[] = $field->jumlah_alumni;
            $row[] = $field->status_data;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->peserta_prodi_admin->count_all(),
			"recordsFiltered" => $this->peserta_prodi_admin->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    public function program_studi_excel(){
		$data = $this->peserta->get_all_peserta_prodi();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Email')
                    ->setCellValue('D1', 'No Telepon')
                    ->setCellValue('E1', 'Sekolah')
                    ->setCellValue('F1', 'Jurusan Sekolah')
                    ->setCellValue('G1', 'Universitas')
                    ->setCellValue('H1', 'Wilayah')
                    ->setCellValue('I1', 'Provinsi')
                    ->setCellValue('J1', 'Penjurusan')
                    ->setCellValue('K1', 'Kode Jurusan')
                    ->setCellValue('L1', 'Nama Jurusan')
                    ->setCellValue('M1', 'Daya Tampung')
                    ->setCellValue('N1', 'Nilai Raport')
                    ->setCellValue('O1', 'Jumlah Alumni')
                    ->setCellValue('P1', 'Status Data');

        $kolom = 2;
        $nomor = 1;
        foreach($data as $val) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, ucwords($val->nama_peserta))
                        ->setCellValue('C' . $kolom, $val->email)
                        ->setCellValue('D' . $kolom, $val->no_telp)
                        ->setCellValue('E' . $kolom, $val->nama_sekolah)
                        ->setCellValue('F' . $kolom, $val->nama_sekolah_jurusan)
                        ->setCellValue('G' . $kolom, $val->nama_universitas)
                        ->setCellValue('H' . $kolom, $val->nama_wilayah)
                        ->setCellValue('I' . $kolom, $val->nama_provinsi)
                        ->setCellValue('J' . $kolom, $val->nama_jurusan_group)
                        ->setCellValue('K' . $kolom, $val->kode)
                        ->setCellValue('L' . $kolom, $val->nama_universitas_jurusan)
                        ->setCellValue('M' . $kolom, $val->daya_tampung)
                        ->setCellValue('N' . $kolom, $val->nilai_raport)
                        ->setCellValue('O' . $kolom, $val->jumlah_alumni)
                        ->setCellValue('P' . $kolom, $val->status_data);

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PesertaProdi.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    /**
     * END PROGRAM STUDI
     */
    /**
     * HASIL RASIONALISASI
     */
    public function hasil_rasionalisasi()
	{
        $data = NULL;
        $page['title_page'] = 'Hasil Rasionalisasi';
        $css = NULL;
        $content = 'admin/peserta/hasil_rasionalisasi/hasil_rasionalisasi';
        $js = 'admin/peserta/hasil_rasionalisasi/js_hasil_rasionalisasi';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function hasil_rasionalisasi_all(){
        $this->load->model('Peserta_hasil_rasionalisasi_model_admin','peserta_hasil_rasionalisasi_admin');
        $list = $this->peserta_hasil_rasionalisasi_admin->get_datatables();
		$data = array();
        $no = $_POST['start'];
		foreach ($list as $field) {
            $no++;
			$row = array();
			$row[] = $no;
			$row[] = ucwords($field->nama_peserta).'<br />'.'<small>'.$field->email.'</small>'.'<br />'.'<small>'.$field->no_telp.'</small>';
			$row[] = $field->nama_sekolah.' ('.$field->nama_sekolah_jurusan.')';
            $row[] = $field->nama_akreditasi;
            $row[] = $field->persentase.'% ('.$field->kategori.')';
            $row[] = $field->status_data;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->peserta_hasil_rasionalisasi_admin->count_all(),
			"recordsFiltered" => $this->peserta_hasil_rasionalisasi_admin->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    public function hasil_rasionalisasi_excel(){
		$data = $this->peserta->get_all_peserta_hasil();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Email')
                    ->setCellValue('D1', 'No Telepon')
                    ->setCellValue('E1', 'Sekolah')
                    ->setCellValue('F1', 'Akreditasi')
                    ->setCellValue('G1', 'Jurusan Sekolah')
                    ->setCellValue('H1', 'Provinsi')
                    ->setCellValue('I1', 'Kota/Kabupaten')
                    ->setCellValue('J1', 'Persentase')
                    ->setCellValue('K1', 'Kategori')
                    ->setCellValue('L1', 'Status Data')
                    ->setCellValue('M1', 'Universitas Pilihan')
                    ->setCellValue('N1', 'Kode Jurusan Universitas')
                    ->setCellValue('O1', 'Jurusan Universitas');

        $kolom = 2;
        $nomor = 1;
        foreach($data as $val) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, ucwords($val->nama_peserta))
                        ->setCellValue('C' . $kolom, $val->email)
                        ->setCellValue('D' . $kolom, $val->no_telp)
                        ->setCellValue('E' . $kolom, $val->nama_sekolah)
                        ->setCellValue('F' . $kolom, $val->nama_akreditasi)
                        ->setCellValue('G' . $kolom, $val->nama_sekolah_jurusan)
                        ->setCellValue('H' . $kolom, $val->nama_provinsi)
                        ->setCellValue('I' . $kolom, $val->nama_kota_kabupaten)
                        ->setCellValue('J' . $kolom, $val->persentase.'%')
                        ->setCellValue('K' . $kolom, $val->kategori)
                        ->setCellValue('L' . $kolom, $val->status_data)
                        ->setCellValue('M' . $kolom, $val->nama_universitas)
                        ->setCellValue('N' . $kolom, $val->kode_jurusan)
                        ->setCellValue('O' . $kolom, $val->nama_universitas_jurusan);
            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PesertaHasilRasionalisasi.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    /**
     * END HASIL RASIONALISASI
     */
}