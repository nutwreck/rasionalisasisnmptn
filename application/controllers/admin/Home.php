<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends CI_Controller {

	private $tbl_admin = 'admin'; //SET TABEL ADMIN
	private $tbl_tanggal = 'tanggal_rasionalisasi'; //SET TABEL TANGGAL RASIONALISASI

    function __construct()
	{
        parent::__construct();
        if (!$this->session->has_userdata('has_login')){
            redirect('admin/login');
        } 
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('encryption');
		$this->load->model('Core_model','core');
		$this->load->model('Peserta_model','peserta');
		$this->load->model('Sekolah_model','sekolah');
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
	public function index()
	{
		$page['title_page'] = 'Dashboard';
        $data['total_user'] = $this->peserta->get_total_user();
		$data['total_user_not_verified'] = $this->peserta->get_total_user_not_verified();
		$data['total_user_verified'] = $this->peserta->get_total_user_verified();
		$data['total_user_input_data'] = $this->peserta->get_total_user_input_data();
		$data['total_user_input_data'] = $this->peserta->get_total_user_input_data();
		$data['top_school'] = $this->sekolah->top_school();
        $data['top_university'] = $this->sekolah->top_university();
        $data['sms_sent'] = $this->core->sms_sent();
        $data['sms_not_sent'] = $this->core->sms_not_sent();
        $data['user_click'] = $this->core->user_click();
        $data['user_not_click'] = $this->core->user_not_click();
        $css = NULL;
        $content = 'admin/home/home';
        $js = 'admin/home/js_home';
		$this->_view($page, $css, $content, $js, $data);
	}
	public function download_excel($id){
		if($id == 1) { //TOTAL USER
			$data = $this->peserta->get_total_user_data();
			$filename = 'SemuaPeserta';
		} else if($id == 2){ //TOTAL USER BELUM VERIFIKASI
			$data = $this->peserta->get_total_user_not_verified_data();
			$filename = 'PesertaBelumTerverifikasi';
		} else if($id == 3){ //TOTAL USER BELUM VERIFIKASI
			$data = $this->peserta->get_total_user_verified_data();
			$filename = 'PesertaTerverifikasi';
		} else if($id == 4) { //TOTAL USER INPUT DATA
			$data = $this->peserta->get_total_user_input_datas();
			$filename = 'PesertaInputData';
		} else if($id == 5) { //TOTAL USER CLICK GRANDSBMPTN
			$data = $this->peserta->get_total_user_click();
			$filename = 'PesertaClickWebsiteGrandsbmptn';
		} else if($id == 6) { //TOTAL USER TIDAK CLICK GRANDSBMPTN
			$data = $this->peserta->get_total_user_not_click();
			$filename = 'PesertaTidakClickWebsiteGrandsbmptn';
		} else {
			$this->session->set_flashdata('error', 'Akses Ditolak!');
			redirect('admin');
		}
		/* var_Dump($data);die(); */

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'No Telepon');

        $kolom = 2;
        $nomor = 1;
        foreach($data as $val) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, ucwords($val->nama_peserta))
                        ->setCellValue('C' . $kolom, $val->no_telp);

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
	}
	
    /** 
     *          
     * 
     * ADMIN */
    public function access_admin()
	{
        $page['title_page'] = 'Access Admin';
        $tbl = $this->tbl_admin;
		$get_data = $this->core->get_all_data($tbl);
		foreach($get_data as $val){
			$id = $val->id;
			$username = $val->username;
			$password = $val->password;
		}
		$data['id'] = $id;
        $data['username'] = $username;
        $data['password'] = $this->encryption->decrypt($password);

        //Data tanggal
        $tbl_tanggal = $this->tbl_tanggal;
		$get_data_tanggal = $this->core->get_all_data($tbl_tanggal);
        foreach($get_data_tanggal as $val){
			$id_tanggal = $val->id;
			$tanggal = $val->tanggal;
		}
        $data['id_tanggal'] = $id_tanggal;
        $data['tanggal'] = $tanggal;

        $css = NULL;
        $content = 'admin/access_admin';
        $js = 'admin/js_access_admin';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_update_access_admin()
	{
        $id = $this->input->post('id', TRUE);
        $data['username'] = $this->input->post('username', TRUE);
        $data['password'] = $this->encryption->encrypt($this->input->post('password', TRUE));
        $tbl = $this->tbl_admin;
        $update = $this->core->update_data($tbl, $data, $id);

        $urly = 'admin/access';
        $urlx = 'admin/access';
        $this->update_end($update, $urly, $urlx);
    }
    public function submit_update_tanggal_pengumuman()
	{
        $id = $this->input->post('id', TRUE);
        $data['tanggal'] = $this->input->post('tanggal', TRUE);
        $tbl = $this->tbl_tanggal;
        $update = $this->core->update_data($tbl, $data, $id);

        $urly = 'admin/access';
        $urlx = 'admin/access';
        $this->update_end($update, $urly, $urlx);
    }
    /** 
     *          
     * 
     * END ADMIN */

    public function logout(){
        $this->session->sess_destroy();
        redirect("admin/login");
    }
}
