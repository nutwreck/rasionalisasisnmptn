<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class peserta extends CI_Controller {

    private $minutes = 1; //SET MENIT UNTUK EXPIRED OTP

    function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Peserta_model','peserta');
        $this->load->model('Sekolah_model','sekolah');
        $this->load->model('Lokasi_model','lokasi');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }
    
    public function test(){
        /* $id_peserta= 26;
        echo $this->safe_b64encode($id_peserta); */
            $id_peserta = $this->safe_b64decode($identity=0);

            $data['id_peserta'] = $id_peserta;
            $data['provinsi'] = $this->lokasi->provinsi();
            $data['sekolah_jurusan'] = $this->sekolah->sekolah_jurusan();
            $this->load->view('user/partials_/header');
            $this->load->view('user/peserta/input_personal_info',$data);
            $this->load->view('user/partials_/footer');
            $this->load->view('user/peserta/js_personal_info',$data);
    }

    private function intCodeRandom($length = 6)
    {
        $intMin = (10 ** $length) / 10; // 100...
        $intMax = (10 ** $length) - 1;  // 999...

        $codeRandom = mt_rand($intMin, $intMax);

        $check_code = $this->peserta->check_otp($codeRandom);

        if($check_code){
            $this->intCodeRandom;
        } else {
            return $codeRandom;
        }
    }

    private function dateExpired($minutes){
        $date_now = date('Y-m-d H:i:s');
        $date_expired = date('Y-m-d H:i:s', strtotime($date_now. ' + '.$minutes.' minutes'));

        return $date_expired;
    }

    private function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	private function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    private function send_sms_confirm($nohp, $otp, $minutes){
        $msg = urlencode('ZAMBERT: '.$otp.'. Berlaku untuk '.$minutes.' menit.');
        $url = "https://websms.co.id/api/smsgateway?token=65b04ea9f70a93ecfe78ee99f72aa10e&to=".$nohp."&msg=".$msg;

        $header = array(
            'Accept: application/json',
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        $decode = json_decode($result);
        $status = $decode->status;

        if($status == 'success'){
            $state = 1;
        } else {
            $state = 0;
        }

        return $state;
    }

    private function set_upload_options()
    {   
        $config = array();
        $config['upload_path']   = './assets/raport/raw';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = '1024';
        $config['overwrite']     = FALSE;
        $config['encrypt_name']  = TRUE;

        return $config;
    }

    private function convert_decimal_number($number){
        $clean_number = str_replace(",",".",$number);
        $result = number_format((float)$clean_number, 2, '.', '');

        return $result;
    }
    
    public function submit_register(){
        $nama = ucwords(str_replace("'","`",$this->input->post('nama', TRUE)));
        $no_telp = $this->input->post('no_telp', TRUE);
        
        //cek no telp, sudah terdaftar atau belum
        $check_phone = $this->peserta->check_phone($no_telp);

        if($check_phone && ($no_telp == '085826046069' || $no_telp == '081325012994' || $no_telp == '081252451601' || $no_telp == '081286364461')){
            foreach($check_phone as $value){
                $id_peserta = $value->id;
            }    
            //DELETE PESERTA
            $this->peserta->delete_peserta_ow($id_peserta);
            //DELETE PESERTA HASIL
            $this->peserta->delete_peserta_hasil_ow($id_peserta);
            //DELETE PESERTA NILAI SEMESTER
            $this->peserta->delete_peserta_nilai_ow($id_peserta);
            //DELETE PESERTA PRESTASI
            $this->peserta->delete_peserta_prestasi_ow($id_peserta);
            //DELETE PESERTA PRODI
            $this->peserta->delete_peserta_prodi_ow($id_peserta);

            //cek no telp, sudah terdaftar atau belum //REPEAT
            $check_phone = $this->peserta->check_phone($no_telp);
        }
        
        if($nama == '' || $no_telp = ''){
            $this->session->set_flashdata('warning', 'Data kamu ada yang belum lengkap!');
		    redirect(base_url());
        } elseif($check_phone){
            $this->session->set_flashdata('warning', 'No telp sudah terdaftar!');
		    redirect(base_url());
        } else {
            $otp = $this->intCodeRandom(); //KODE OTP
            $otp_expired = $this->dateExpired($this->minutes); //OTP EXPIRED
            $no_telp = $this->input->post('no_telp', TRUE);

            $datas = array(
                'nama' => $nama,
                'no_telp' => $no_telp,
                'otp' => $otp,
                'otp_expired' => $otp_expired
            );

            $input_personal_info = $this->peserta->input_personal_info($datas);

            if(!empty($input_personal_info)){
                $sess = array(
                    'no_telp'  => $no_telp,
                );
                $this->session->set_userdata($sess);

                $identity = $this->safe_b64encode($input_personal_info);
                redirect('confirm-phone/'.$identity);
            } else {
                $this->session->set_flashdata('warning', 'Data kamu ada yang belum lengkap!');
		        redirect(base_url());
            }
        }
    }

	public function confirm_phone($identity){
        if(isset($_SESSION['no_telp'])){
            $id_peserta = $this->safe_b64decode($identity);
            $datas = $this->peserta->get_confirmpeserta_byid($id_peserta);

            if(isset($datas)){
                $count_sms = $datas->count_otp_send;
               
                $data['id_peserta'] = $datas->id;
                $data['otp_expired'] = $datas->otp_expired;
                $data['no_telp'] = $datas->no_telp;
                $no_telp = $data['no_telp'];
                $otp = $datas->otp;

                /* Pecah String OTP */
                $arr = str_split($otp);
                $data_otp['otp1'] = $arr[0];
                $data_otp['otp2'] = $arr[1];
                $data_otp['otp3'] = $arr[2];
                $data_otp['otp4'] = $arr[3];
                $data_otp['otp5'] = $arr[4];
                $data_otp['otp6'] = $arr[5];

                if($count_sms == 0){
                    $sms_verification = 1;//$this->send_sms_confirm($no_telp, $otp, $this->minutes);
                    $is_sms_send = $this->peserta->update_smspeserta_byid($id_peserta, $sms_verification);
                }

                $this->load->view('user/partials_/header');
                $this->load->view('user/peserta/css_confirm');
                $this->load->view('user/peserta/konfirmasi', $data);
                $this->load->view('user/partials_/footer');
                $this->load->view('user/peserta/js_confirm', $data_otp);
            } else {
                $this->session->set_flashdata('warning', 'Akses ke halaman verifikasi ditolak!');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('warning', 'Akses ke halaman verifikasi ditolak!');
            redirect(base_url());
        }
        
    }

    public function verification_expired(){
        $id_peserta = $this->input->post('id_peserta', TRUE);
        $is_otp_expired = $this->peserta->update_expiredpeserta_byid($id_peserta);

        if($is_otp_expired){
            $data = array(
                'log' => 1,
                'hash' => $this->security->get_csrf_hash(),
            );
        } else {
            $data = array(
                'log' => 0,
                'hash' => $this->security->get_csrf_hash(),
            );
        }

        echo json_encode($data);
    }

    public function verification_reset(){
        $id_peserta = $this->input->post('id_peserta', TRUE);
        $datas = $this->peserta->get_confirmpeserta_byid($id_peserta);

        if($datas){
            $count_sms = $datas->count_otp_send;
            if($count_sms >= 2){
                $data = array(
                    'log' => 2,
                    'hash' => $this->security->get_csrf_hash(),
                    'otp_expired' => ''
                );
            } else {
                $no_telp = $datas->no_telp;

                $otp = $this->intCodeRandom();//KODE OTP
                $otp_expired = $this->dateExpired($this->minutes);//UPDATE DATE EXPIRED OTP
                $sms_verification = 1;//$this->send_sms_confirm($no_telp, $otp, $this->minutes); //KIRIM SMS VERIFIKASI

                $is_sms_send = $this->peserta->update_smspeserta_byid($id_peserta, $sms_verification);
                $is_otp_reset = $this->peserta->update_resetexppeserta_byid($id_peserta, $otp, $otp_expired);

                if($is_otp_reset){
                    $data = array(
                        'log' => 1,
                        'hash' => $this->security->get_csrf_hash(),
                        'otp_expired' => $otp_expired
                    );
                } else {
                    $data = array(
                        'log' => 0,
                        'hash' => $this->security->get_csrf_hash(),
                        'otp_expired' => ''
                    );
                }
            }
            echo json_encode($data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
		    redirect(base_url());
        }
    }

    public function verification_code(){
        $id_peserta = $this->input->post('id_peserta', TRUE);
        $otp = $this->input->post('otp', TRUE);

        $datas = $this->peserta->get_confirmotppeserta_byid($id_peserta, $otp);
        
        if($datas){
            $is_verification = $this->peserta->update_verificationpeserta_byid($id_peserta);

            if($is_verification){
                $data = array(
                    'log' => 1,
                    'hash' => $this->security->get_csrf_hash(),
                    'text' => 'success',
                    'id_peserta' => $id_peserta
                );
            } else {
                $data = array(
                    'log' => 0,
                    'hash' => $this->security->get_csrf_hash(),
                    'text' => 'kode OTP kamu salah, input/kirim ulang kode OTP',
                    'id_peserta' => 0
                );
            }
        } else {
            $data = array(
                'log' => 0,
                'hash' => $this->security->get_csrf_hash(),
                'text' => 'kode OTP kamu salah, input/kirim ulang kode OTP',
                'id_peserta' => 0
            );
        }

        echo json_encode($data);
    }

    public function verification_success($id_peserta){
        if(isset($_SESSION['no_telp'])){
            $data['id_peserta'] = $this->safe_b64encode($id_peserta);

            $this->load->view('user/partials_/header');
            $this->load->view('user/peserta/css_confirm');
            $this->load->view('user/peserta/konfirmasi_sukses', $data);
            $this->load->view('user/partials_/footer');
            $this->load->view('user/peserta/js_confirm_success');
        } else {
            $this->session->set_flashdata('warning', 'Akses ke halaman verifikasi ditolak!');
            redirect(base_url());
        }
    }

    public function kota_kabupaten(){
		$id_provinsi = $this->input->post('id_provinsi', TRUE);
 		$data['hash'] = $this->security->get_csrf_hash();
		$data['kota_kabupaten'] = $this->lokasi->kota_kabupaten($id_provinsi);
		echo json_encode($data);
	}

	public function sekolah(){
		$id_provinsi = $this->input->post('id_provinsi', TRUE);
		$id_kota_kab = $this->input->post('id_kota_kab', TRUE);
		$data['hash'] = $this->security->get_csrf_hash();
		$data['sekolah'] = $this->sekolah->sekolah($id_provinsi, $id_kota_kab);
		echo json_encode($data);
    }

    public function personal_info($identity){
        if(isset($_SESSION['no_telp'])){
            $id_peserta = $this->safe_b64decode($identity);

            $data['id_peserta'] = $id_peserta;
            $data['provinsi'] = $this->lokasi->provinsi();
            $data['sekolah_jurusan'] = $this->sekolah->sekolah_jurusan();
            $this->load->view('user/partials_/header');
            $this->load->view('user/peserta/input_personal_info',$data);
            $this->load->view('user/partials_/footer');
            $this->load->view('user/peserta/js_personal_info',$data);
        } else {
            $this->session->set_flashdata('warning', 'Akses ke halaman personal info ditolak!');
            redirect(base_url());
        }
    }

    public function menambahkan_sekolah_baru(){
        $data['nama'] = strtoupper($this->input->post('nama', TRUE));
        $data['id_kota_kab'] = $this->input->post('id_kota_kab', TRUE);
        $data['id_provinsi'] = $this->input->post('id_provinsi', TRUE);
        $data['id_akreditasi'] = 4;

        $id_peserta = $this->input->post('id_peserta', TRUE);
        $identity = $this->safe_b64encode($id_peserta);

        $input_tambah_sekolah = $this->sekolah->input_tambah_sekolah($data);

        if(!empty($input_tambah_sekolah)){
            $data['hash'] = $this->security->get_csrf_hash();
            $data['id_sekolah'] = $input_tambah_sekolah;
            echo json_encode($data);
        } else {
            $this->session->set_flashdata('warning', 'Terjadi kesalahan saat menambahkan data, silahkan ulangi lagi!');
            redirect('register-personal-info/'.$identity);
        }
    }

	public function submit_personal_info()
	{
        $id_peserta = $this->input->post('id_peserta', TRUE);
        $email = $this->input->post('email', TRUE);
        $instagram = $this->input->post('instagram', TRUE);
        $telegram = $this->input->post('telegram', TRUE);
        $id_provinsi = $this->input->post('id_provinsi', TRUE);
        $id_sekolah = $this->input->post('id_sekolah', TRUE);
        $id_sekolah_jurusan = $this->input->post('id_sekolah_jurusan', TRUE);

        if($id_peserta == '' || $email == '' || $id_provinsi == '' || $id_sekolah == '' || $id_sekolah_jurusan == ''){
            $this->session->set_flashdata('warning', 'Data kamu ada yang belum lengkap!');
            redirect(base_url());
        } else {

            $datas = array(
                'email' => $email,
                'instagram' => $instagram,
                'telegram' => $telegram,
                'id_provinsi' => $id_provinsi,
                'id_sekolah' => $id_sekolah,
                'id_sekolah_jurusan' => $id_sekolah_jurusan,
            );

            $update_personal_info = $this->peserta->update_personal_info($datas, $id_peserta);

            if(!empty($update_personal_info)){
                $identity = $this->safe_b64encode($id_peserta);
                redirect('nilai-raport/'.$identity);
            } else {
                $this->session->set_flashdata('warning', 'Data kamu ada yang belum lengkap!');
                redirect(base_url());
            }
        }
	}

    public function input_nilai_raport($identity){
        if(isset($_SESSION['no_telp'])){
            $data['id_peserta'] = $this->safe_b64decode($identity);

            $this->load->view('user/partials_/header');
            $this->load->view('user/peserta/input_nilai_raport', $data);
            $this->load->view('user/partials_/footer');
            $this->load->view('user/peserta/js_nilai_raport');
        } else {
            $this->session->set_flashdata('warning', 'Akses ke halaman input nilai raport ditolak!');
            redirect(base_url());
        }
    }

    public function submit_nilai_raport()
	{
        //gambar disimpan di folder raport, gambar asli di folder raw, yang diluar raw adalah gambar hasil kompress, backup raw jika storage server penuh
        $this->load->library('upload');
        $dataInfo = array();
        $files = $_FILES;
        $cpt = count($_FILES['img_smt']['name']);
        /* $path = ''; */
        /* $allowed_types = 'jpeg|jpg|png';
        $max_size = '1024'; */
        $id_peserta = $this->input->post('id_peserta', TRUE);

        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['img_smt']['name']= $files['img_smt']['name'][$i];
            $_FILES['img_smt']['type']= $files['img_smt']['type'][$i];
            $_FILES['img_smt']['tmp_name']= $files['img_smt']['tmp_name'][$i];
            $_FILES['img_smt']['error']= $files['img_smt']['error'][$i];
            $_FILES['img_smt']['size']= $files['img_smt']['size'][$i];    

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload('img_smt');
           
            $dataInfo[] = $this->upload->data();

            $data_file = array('upload_data' => $this->upload->data());
            $target_path = './assets/raport/';
            $path=$data_file['upload_data']['full_path'];
            //$q['name']=$data['upload_data']['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']   = $path;
            $config['new_image']   = $target_path;
            $config['maintain_ratio'] = TRUE;
            $config['quality'] = '60%';
            $config['width']  = 700; // new size
            $this->load->library('image_lib');
            $this->image_lib->initialize($config);    
            $this->image_lib->resize();
        }

        $data = array(
            'id_peserta' => $this->input->post('id_peserta', TRUE),
            'nilai_smt1' => $this->convert_decimal_number($this->input->post('nilai_smt1', TRUE)),
            'nilai_smt2' => $this->convert_decimal_number($this->input->post('nilai_smt2', TRUE)),
            'nilai_smt3' => $this->convert_decimal_number($this->input->post('nilai_smt3', TRUE)),
            'nilai_smt4' => $this->convert_decimal_number($this->input->post('nilai_smt4', TRUE)),
            'nilai_smt5' => $this->convert_decimal_number($this->input->post('nilai_smt5', TRUE)),
            'img_smt1' => $dataInfo[0]['file_name'],
            'img_smt2' => $dataInfo[1]['file_name'],
            'img_smt3' => $dataInfo[2]['file_name'],
            'img_smt4' => $dataInfo[3]['file_name'],
            'img_smt5' => $dataInfo[4]['file_name'],
            'kkm_smt1' => $this->convert_decimal_number($this->input->post('kkm_smt1', TRUE)),
            'kkm_smt2' => $this->convert_decimal_number($this->input->post('kkm_smt2', TRUE)),
            'kkm_smt3' => $this->convert_decimal_number($this->input->post('kkm_smt3', TRUE)),
            'kkm_smt4' => $this->convert_decimal_number($this->input->post('kkm_smt4', TRUE)),
            'kkm_smt5' => $this->convert_decimal_number($this->input->post('kkm_smt5', TRUE)),
        );

        $result = $this->peserta->input_nilai_semester($data);
        $identity = $this->safe_b64encode($id_peserta);

        if(!empty($result)){
            $this->session->set_flashdata('success', 'Input nilai sukses, selanjutnya input prestasi kamu');
		    redirect('prestasi/'.$identity);
        } else {
            $this->session->set_flashdata('warning', 'Input nilai gagal, ulangi kembali dan pastikan input sesuai ketentuan');
		    redirect('nilai-raport/'.$identity);
        }
    }

    public function input_prestasi($identity){
        if(isset($_SESSION['no_telp'])){
            $data['id_peserta'] = $this->safe_b64decode($identity);
            $data['prestasi'] = $this->peserta->get_prestasi();
            $data['juara'] = $this->peserta->get_juara();

            $this->load->view('user/partials_/header');
            $this->load->view('user/peserta/input_prestasi', $data);
            $this->load->view('user/partials_/footer');
            $this->load->view('user/peserta/js_prestasi');
        } else {
            $this->session->set_flashdata('warning', 'Akses ke halaman input prestasi ditolak!');
            redirect(base_url());
        }
        
    }

    public function submit_input_prestasi(){
        $datas = array();
        $id_peserta = $this->input->post('id_peserta', TRUE);
        foreach ($_POST['nama'] as $key => $val) {
            $datas[] = array(             
                'id_peserta' => $id_peserta,
                'nama' => $_POST['nama'][$key],
                'id_prestasi' => $_POST['id_prestasi'][$key],
                'id_juara' => $_POST['id_juara'][$key],
                'is_enable' => $_POST['nama'][$key] == '' ? 0 : 1
            );      
        }      
        $result = $this->peserta->input_prestasi($datas);
        
        $identity = $this->safe_b64encode($id_peserta);

        if(!empty($result)){
            $this->session->set_flashdata('success', 'Input nilai sukses, selanjutnya input program studi yang kamu inginkan');
		    redirect('prodi/'.$identity);
        } else {
            $this->session->set_flashdata('warning', 'Input prestasi gagal, ulangi kembali dan pastikan input sesuai ketentuan');
		    redirect('prestasi/'.$identity);
        }
    }

    public function input_program_studi($identity){
        if(isset($_SESSION['no_telp'])){
            $data['id_peserta'] = $this->safe_b64decode($identity);
            $data['universitas'] = $this->sekolah->universitas();

            $this->load->view('user/partials_/header');
            $this->load->view('user/peserta/input_program_studi', $data);
            $this->load->view('user/partials_/footer');
            $this->load->view('user/peserta/js_program_studi');
        } else {
            $this->session->set_flashdata('warning', 'Akses ke halaman input program studi ditolak!');
            redirect(base_url());
        }  
    }

    public function universitas_jurusan(){
        $id_universitas = $this->input->post('id_universitas', TRUE);
        $data['hash'] = $this->security->get_csrf_hash();
		$data['universitas_jurusan'] = $this->sekolah->universitas_jurusan($id_universitas);
		echo json_encode($data);
    }
    
    public function submit_input_program_studi(){
        $datas = array();
        $id_peserta = $this->input->post('id_peserta', TRUE);
        foreach ($_POST['id_universitas_jurusan'] as $key => $val) {
            $datas[] = array(             
                'id_peserta' => $id_peserta,
                'id_universitas' => $_POST['id_universitas'][$key],
                'id_universitas_jurusan' => $_POST['id_universitas_jurusan'][$key],
                'jumlah_alumni' => $_POST['jumlah_alumni'][$key] == 0 || empty($_POST['jumlah_alumni'][$key]) || $_POST['jumlah_alumni'][$key] === NULL || $_POST['jumlah_alumni'][$key] == '' ? 1 :  $_POST['jumlah_alumni'][$key],
                'is_enable' => $_POST['id_universitas'][$key] == 0 || empty($_POST['id_universitas'][$key]) || $_POST['id_universitas'][$key] === NULL || $_POST['id_universitas'][$key] == '' ? 0 :  1
            );      
        }      
        $result = $this->peserta->input_program_studi($datas);
        $clean_data_prodi = $this->peserta->check_peserta_prodi($id_peserta);
        $get_id_peserta_prodi = $clean_data_prodi->id;
        $clean_fix_prodi = $this->peserta->clean_fix_peserta_prodi($get_id_peserta_prodi);

        $identity = $this->safe_b64encode($id_peserta);

        if(!empty($result)){
            $this->session->set_flashdata('success', 'Proses selesai');
		    redirect('result/'.$identity);
        } else {
            $this->session->set_flashdata('warning', 'Input program studi gagal, ulangi kembali dan pastikan input sesuai ketentuan');
		    redirect('prodi/'.$identity);
        }
    }

}
