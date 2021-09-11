<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_master extends CI_Controller {

    private $tbl_provinsi = 'provinsi'; //SET TABEL PROVINSI
    private $tbl_kota_kab = 'kota_kabupaten'; //SET TABEL PROVINSI
    private $tbl_jurusan_sekolah = 'sekolah_jurusan'; //SET TABEL sekolah jurusan
    private $tbl_sekolah = 'sekolah'; //SET TABEL sekolah
    private $tbl_jurusan_universitas = 'universitas_jurusan'; //SET TABEL sekolah jurusan
    private $tbl_universitas = 'universitas'; //SET TABEL sekolah jurusan

    function __construct()
	{
        parent::__construct();
        if (!$this->session->has_userdata('has_login')){
            redirect('admin/login');
        } 
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Sekolah_model','sekolah');
        $this->load->model('Lokasi_model','lokasi');
        $this->load->model('Sekolah_model_admin','sekolah_admin');
        $this->load->model('Jurusan_universitas_model_admin','jurusan_universitas_admin');
        $this->load->model('Core_model','core');
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
    public function index(){
        echo 'a';
    }
    /** 
     *          
     * 
     * PROVINSI */
	public function provinsi()
	{
        $tbl = $this->tbl_provinsi;
        $data['all_provinsi'] = $this->core->get_all_data($tbl);
        $page['title_page'] = 'Provinsi';
        $css = NULL;
        $content = 'admin/data_master/provinsi/provinsi';
        $js = 'admin/data_master/provinsi/js_provinsi';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function add_provinsi()
	{
        $page['title_page'] = 'Add Provinsi';
        $css = NULL;
        $data = NULL;
        $content = 'admin/data_master/provinsi/add_provinsi';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_add_provinsi()
	{
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $tbl = $this->tbl_provinsi;
        $input = $this->core->input_data($tbl, $data);

        $urly = 'admin/master/provinsi';
        $urlx = 'admin/master/add-provinsi';
        $this->input_end($input, $urly, $urlx);
    }
    public function update_provinsi($id)
	{
        $page['title_page'] = 'Update Provinsi';
        $tbl = $this->tbl_provinsi;
        $data['get_provinsi'] = $this->core->get_data_by_id($tbl, $id);
        $css = NULL;
        $content = 'admin/data_master/provinsi/update_provinsi';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_update_provinsi()
	{
        $id = $this->input->post('id', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $tbl = $this->tbl_provinsi;
        $update = $this->core->update_data($tbl, $data, $id);

        $urly = 'admin/master/provinsi';
        $urlx = 'admin/master/update-provinsi/'.$id;
        $this->update_end($update, $urly, $urlx);
    }
    public function delete_provinsi($id)
	{
        $tbl = $this->tbl_provinsi;
        $delete = $this->core->delete_data($tbl, $id);

        $urly = 'admin/master/provinsi';
        $urlx = 'admin/master/provinsi';
        $this->delete_end($delete, $urly, $urlx);
    }
    public function active_provinsi($id)
	{
        $tbl = $this->tbl_provinsi;
        $active = $this->core->active_data($tbl, $id);

        $urly = 'admin/master/provinsi';
        $urlx = 'admin/master/provinsi';
        $this->active_end($active, $urly, $urlx);
    }
    /** 
     *          
     * 
     * END PROVINSI */

    /** 
     *          
     * 
     * KOTA KAB */
    public function kota_kab()
	{
        $data['all_kota_kab'] = $this->lokasi->get_all_data_kota_kab();
        $page['title_page'] = 'Kota/Kabupaten';
        $css = NULL;
        $content = 'admin/data_master/kota_kab/kota_kab';
        $js = 'admin/data_master/kota_kab/js_kota_kab';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function add_kota_kab()
	{
        $page['title_page'] = 'Add Kota/Kabupaten';
        $css = NULL;
        $data['provinsi'] = $this->lokasi->provinsi();
        $content = 'admin/data_master/kota_kab/add_kota_kab';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_add_kota_kab()
	{
        $data['id_provinsi'] = $this->input->post('id_provinsi', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $tbl = $this->tbl_kota_kab;
        $input = $this->core->input_data($tbl, $data);

        $urly = 'admin/master/kota-kab';
        $urlx = 'admin/master/add-kota-kab';
        $this->input_end($input, $urly, $urlx);
    }
    public function update_kota_kab($id)
	{
        $page['title_page'] = 'Update Kota/Kabupaten';
        $data['get_kota_kab'] = $this->lokasi->get_all_data_kota_kab_id($id);
        $data['provinsi'] = $this->lokasi->provinsi();
        $css = NULL;
        $content = 'admin/data_master/kota_kab/update_kota_kab';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_update_kota_kab()
	{
        $id = $this->input->post('id', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $tbl = $this->tbl_kota_kab;
        $update = $this->core->update_data($tbl, $data, $id);

        $urly = 'admin/master/kota-kab';
        $urlx = 'admin/master/update-kota-kab/'.$id;
        $this->update_end($update, $urly, $urlx);
    }
    public function delete_kota_kab($id)
	{
        $tbl = $this->tbl_kota_kab;
        $delete = $this->core->delete_data($tbl, $id);

        $urly = 'admin/master/kota-kab';
        $urlx = 'admin/master/kota-kab';
        $this->delete_end($delete, $urly, $urlx);
    }
    public function active_kota_kab($id)
	{
        $tbl = $this->tbl_kota_kab;
        $active = $this->core->active_data($tbl, $id);

        $urly = 'admin/master/kota-kab';
        $urlx = 'admin/master/kota-kab';
        $this->active_end($active, $urly, $urlx);
    }
    /** 
     *          
     * 
     * END KOTA KAB */

    /** 
     *          
     * 
     * JURUSAN SEKOLAH */
    public function jurusan_sekolah()
	{
        $tbl = $this->tbl_jurusan_sekolah;
        $data['all_sekolah_jurusan'] = $this->core->get_all_data($tbl);
        $page['title_page'] = 'Jurusan Sekolah';
        $css = NULL;
        $content = 'admin/data_master/jurusan_sekolah/jurusan_sekolah';
        $js = 'admin/data_master/jurusan_sekolah/js_jurusan_sekolah';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function add_jurusan_sekolah()
	{
        $page['title_page'] = 'Add Jurusan Sekolah';
        $css = NULL;
        $data = NULL;
        $content = 'admin/data_master/jurusan_sekolah/add_jurusan_sekolah';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_add_jurusan_sekolah()
	{
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $tbl = $this->tbl_jurusan_sekolah;
        $input = $this->core->input_data($tbl, $data);

        $urly = 'admin/master/jurusan-sekolah';
        $urlx = 'admin/master/add-jurusan-sekolah';
        $this->input_end($input, $urly, $urlx);
    }
    public function update_jurusan_sekolah($id)
	{
        $tbl = $this->tbl_jurusan_sekolah;
        $page['title_page'] = 'Update Jurusan Sekolah';
        $data['get_jurusan_sekolah'] = $this->core->get_data_by_id($tbl, $id);
        $css = NULL;
        $content = 'admin/data_master/jurusan_sekolah/update_jurusan_sekolah';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_update_jurusan_sekolah()
	{
        $id = $this->input->post('id', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $tbl = $this->tbl_jurusan_sekolah;
        $update = $this->core->update_data($tbl, $data, $id);

        $urly = 'admin/master/jurusan-sekolah';
        $urlx = 'admin/master/update-jurusan-sekolah/'.$id;
        $this->update_end($update, $urly, $urlx);
    }
    public function delete_jurusan_sekolah($id)
	{
        $tbl = $this->tbl_jurusan_sekolah;
        $delete = $this->core->delete_data($tbl, $id);

        $urly = 'admin/master/jurusan-sekolah';
        $urlx = 'admin/master/jurusan-sekolah';
        $this->delete_end($delete, $urly, $urlx);
    }
    public function active_jurusan_sekolah($id)
	{
        $tbl = $this->tbl_jurusan_sekolah;
        $active = $this->core->active_data($tbl, $id);

        $urly = 'admin/master/jurusan-sekolah';
        $urlx = 'admin/master/jurusan-sekolah';
        $this->active_end($active, $urly, $urlx);
    }
    /** 
     *          
     * 
     * END JURUSAN SEKOLAH */

    /** 
     *          
     * 
     * SEKOLAH */
    public function sekolah()
	{
        $data = NULL;
        $page['title_page'] = 'Sekolah';
        $css = NULL;
        $content = 'admin/data_master/sekolah/sekolah';
        $js = 'admin/data_master/sekolah/js_sekolah';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function sekolah_all(){
        $list = $this->sekolah_admin->get_datatables();
		$data = array();
        $no = $_POST['start'];
        $url_edit = base_url().'admin/master/update-sekolah/';
        $url_del = base_url().'admin/master/delete-sekolah/';
        $url_active = base_url().'admin/master/active-sekolah/';
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_provinsi;
			$row[] = $field->nama_kota_kab;
            $row[] = $field->nama;
            $row[] = $field->nama_akreditasi;
            $row[] = $field->status_data;
            $row[] = $field->is_enable == 1 ? '<div class="table-data-feature">
                        <a href="'.$url_edit.$field->id.'" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                        </a>
                        <a href="'.$url_del.$field->id.'" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                        </a>
                    </div>' : '<div class="table-data-feature">
                        <a href="'.$url_active.$field->id.'" class="item" data-toggle="tooltip" data-placement="top" title="Active">
                            <i class="zmdi zmdi-check"></i>
                        </a>
                    </div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->sekolah_admin->count_all(),
			"recordsFiltered" => $this->sekolah_admin->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    public function kota_kabupaten(){
		$id_provinsi = $this->input->post('id_provinsi', TRUE);
 		$data['hash'] = $this->security->get_csrf_hash();
		$data['kota_kabupaten'] = $this->lokasi->kota_kabupaten($id_provinsi);
		echo json_encode($data);
	}
    public function add_sekolah()
	{
        $page['title_page'] = 'Add Sekolah';
        $css = NULL;
        $data['provinsi'] = $this->lokasi->provinsi();
        $data['akreditasi'] = $this->sekolah->akreditasi();
        $content = 'admin/data_master/sekolah/add_sekolah';
        $js = 'admin/data_master/sekolah/js_sekolah';;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_add_sekolah()
	{
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $data['id_provinsi'] = $this->input->post('id_provinsi', TRUE);
        $data['id_kota_kab'] = $this->input->post('id_kota_kab', TRUE);
        $data['id_akreditasi'] = $this->input->post('id_akreditasi', TRUE);
        $tbl = $this->tbl_sekolah;
        $input = $this->core->input_data($tbl, $data);

        $urly = 'admin/master/sekolah';
        $urlx = 'admin/master/add-sekolah';
        $this->input_end($input, $urly, $urlx);
    }
    public function update_sekolah($id)
	{
        $tbl = 'view_all_sekolah';
        $page['title_page'] = 'Update Sekolah';
        $data['get_sekolah'] = $this->core->get_data_by_id($tbl, $id);
        $data['provinsi'] = $this->lokasi->provinsi();
        $data['akreditasi'] = $this->sekolah->akreditasi();
        $css = NULL;
        $content = 'admin/data_master/sekolah/update_sekolah';
        $js = 'admin/data_master/sekolah/js_sekolah';;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_update_sekolah()
	{
        $id = $this->input->post('id', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $data['id_provinsi'] = $this->input->post('id_provinsi', TRUE);
        $data['id_kota_kab'] = $this->input->post('id_kota_kab', TRUE);
        $data['id_akreditasi'] = $this->input->post('id_akreditasi', TRUE);
        $tbl = $this->tbl_sekolah;
        $update = $this->core->update_data($tbl, $data, $id);

        $urly = 'admin/master/sekolah';
        $urlx = 'admin/master/update-sekolah/'.$id;
        $this->update_end($update, $urly, $urlx);
    }
    public function delete_sekolah($id)
	{
        $tbl = $this->tbl_sekolah;
        $delete = $this->core->delete_data($tbl, $id);

        $urly = 'admin/master/sekolah';
        $urlx = 'admin/master/sekolah';
        $this->delete_end($delete, $urly, $urlx);
    }
    public function active_sekolah($id)
	{
        $tbl = $this->tbl_sekolah;
        $active = $this->core->active_data($tbl, $id);

        $urly = 'admin/master/sekolah';
        $urlx = 'admin/master/sekolah';
        $this->active_end($active, $urly, $urlx);
    }
    /** 
     *          
     * 
     * END JURUSAN SEKOLAH */

    /** 
     *          
     * 
     * JURUSAN UNIVERSITAS */
    public function jurusan_universitas()
	{
        $data = NULL;
        $page['title_page'] = 'Jurusan Universitas';
        $css = NULL;
        $content = 'admin/data_master/jurusan_universitas/jurusan_universitas';
        $js = 'admin/data_master/jurusan_universitas/js_jurusan_universitas';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function jurusan_universitas_all(){
        $list = $this->jurusan_universitas_admin->get_datatables();
		$data = array();
        $no = $_POST['start'];
        $url_edit = base_url().'admin/master/update-prodi/';
        $url_del = base_url().'admin/master/delete-prodi/';
        $url_active = base_url().'admin/master/active-prodi/';
		foreach ($list as $field) {
			$no++;
			$row = array();
            $row[] = $no;
            $row[] = $field->nama_universitas;
            $row[] = $field->kode;
            $row[] = $field->nama;
			$row[] = $field->nama_jurusan_group;
			$row[] = $field->nama_wilayah;
            $row[] = $field->daya_tampung;
            $row[] = $field->nilai_raport;
            $row[] = $field->status_data;
            $row[] = $field->is_enable == 1 ? '<div class="table-data-feature">
                        <a href="'.$url_edit.$field->id.'" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                        </a>
                        <a href="'.$url_del.$field->id.'" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                        </a>
                    </div>' : '<div class="table-data-feature">
                        <a href="'.$url_active.$field->id.'" class="item" data-toggle="tooltip" data-placement="top" title="Active">
                            <i class="zmdi zmdi-check"></i>
                        </a>
                    </div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->jurusan_universitas_admin->count_all(),
			"recordsFiltered" => $this->jurusan_universitas_admin->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    public function add_jurusan_universitas()
	{
        $page['title_page'] = 'Add Program Studi';
        $css = NULL;
        $data['wilayah'] = $this->lokasi->get_wilayah_prodi();
        $data['universitas'] = $this->sekolah->universitas();
        $data['jurusan_group'] = $this->sekolah->jurusan_group();
        $content = 'admin/data_master/jurusan_universitas/add_jurusan_universitas';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_add_jurusan_universitas()
	{
        $data['tahun'] = $this->input->post('tahun', TRUE);
        $data['id_wilayah'] = $this->input->post('id_wilayah', TRUE);
        $data['id_universitas'] = $this->input->post('id_universitas', TRUE);
        $data['id_jurusan_group'] = $this->input->post('id_jurusan_group', TRUE);
        $data['kode'] = $this->input->post('kode', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $data['daya_tampung'] = $this->input->post('daya_tampung', TRUE);
        $data['nilai_raport'] = $this->input->post('nilai_raport', TRUE);

        $tbl = $this->tbl_jurusan_universitas;
        $input = $this->core->input_data($tbl, $data);

        $urly = 'admin/master/prodi';
        $urlx = 'admin/master/add-prodi';
        $this->input_end($input, $urly, $urlx);
    }
    public function update_jurusan_universitas($id)
	{
        $page['title_page'] = 'Update Program Studi';
        $data['get_jurusan_universitas'] = $this->sekolah->get_jurusan_universitas_by_id($id);
        $data['wilayah'] = $this->lokasi->get_wilayah_prodi();
        $data['universitas'] = $this->sekolah->universitas();
        $data['jurusan_group'] = $this->sekolah->jurusan_group();
        $css = NULL;
        $content = 'admin/data_master/jurusan_universitas/update_jurusan_universitas';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_update_jurusan_universitas()
	{
        $id = $this->input->post('id', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $data['tahun'] = $this->input->post('tahun', TRUE);
        $data['id_wilayah'] = $this->input->post('id_wilayah', TRUE);
        $data['id_universitas'] = $this->input->post('id_universitas', TRUE);
        $data['id_jurusan_group'] = $this->input->post('id_jurusan_group', TRUE);
        $data['kode'] = $this->input->post('kode', TRUE);
        $data['daya_tampung'] = $this->input->post('daya_tampung', TRUE);
        $data['nilai_raport'] = $this->input->post('nilai_raport', TRUE);

        $tbl = $this->tbl_jurusan_universitas;
        $update = $this->core->update_data($tbl, $data, $id);

        $urly = 'admin/master/prodi';
        $urlx = 'admin/master/update-prodi/'.$id;
        $this->update_end($update, $urly, $urlx);
    }
    public function delete_jurusan_universitas($id)
	{
        $tbl = $this->tbl_jurusan_universitas;
        $delete = $this->core->delete_data($tbl, $id);

        $urly = 'admin/master/prodi';
        $urlx = 'admin/master/prodi';
        $this->delete_end($delete, $urly, $urlx);
    }
    public function active_jurusan_universitas($id)
	{
        $tbl = $this->tbl_jurusan_universitas;
        $active = $this->core->active_data($tbl, $id);

        $urly = 'admin/master/prodi';
        $urlx = 'admin/master/prodi';
        $this->active_end($active, $urly, $urlx);
    }
    /** 
     *          
     * 
     * END JURUSAN UNIVERSITAS */
    /** 
     *          
     * 
     * UNIVERSITAS */
    public function universitas()
	{
        $data['universitas'] = $this->sekolah->get_all_data_universitas();
        $page['title_page'] = 'Universitas';
        $css = NULL;
        $content = 'admin/data_master/universitas/universitas';
        $js = 'admin/data_master/universitas/js_universitas';
		$this->_view($page, $css, $content, $js, $data);
    }
    public function add_universitas()
	{
        $page['title_page'] = 'Add Universitas';
        $css = NULL;
        $data['provinsi'] = $this->lokasi->provinsi();
        $content = 'admin/data_master/universitas/add_universitas';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_add_universitas()
	{
        $data['id_provinsi'] = $this->input->post('id_provinsi', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $tbl = $this->tbl_universitas;
        $input = $this->core->input_data($tbl, $data);

        $urly = 'admin/master/universitas';
        $urlx = 'admin/master/add-universitas';
        $this->input_end($input, $urly, $urlx);
    }
    public function update_universitas($id)
	{
        $page['title_page'] = 'Update Universitas';
        $data['universitas'] = $this->sekolah->get_all_data_universitas_by_id($id);
        $data['provinsi'] = $this->lokasi->provinsi();
        $css = NULL;
        $content = 'admin/data_master/universitas/update_universitas';
        $js = NULL;
		$this->_view($page, $css, $content, $js, $data);
    }
    public function submit_update_universitas()
	{
        $id = $this->input->post('id', TRUE);
        $data['id_provinsi'] = $this->input->post('id_provinsi', TRUE);
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $tbl = $this->tbl_universitas;
        $update = $this->core->update_data($tbl, $data, $id);

        $urly = 'admin/master/universitas';
        $urlx = 'admin/master/update-universitas/'.$id;
        $this->update_end($update, $urly, $urlx);
    }
    public function delete_universitas($id)
	{
        $tbl = $this->tbl_universitas;
        $delete = $this->core->delete_data($tbl, $id);

        $urly = 'admin/master/universitas';
        $urlx = 'admin/master/universitas';
        $this->delete_end($delete, $urly, $urlx);
    }
    public function active_universitas($id)
	{
        $tbl = $this->tbl_universitas;
        $active = $this->core->active_data($tbl, $id);

        $urly = 'admin/master/universitas';
        $urlx = 'admin/master/universitas';
        $this->active_end($active, $urly, $urlx);
    }
    /** 
     *          
     * 
     * END UNIVERSITAS */
}
