<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Peserta_model','peserta');
        $this->load->model('Sekolah_model','sekolah');
        $this->load->model('Lokasi_model','lokasi');
        $this->load->model('Core_model','core');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }

    public function test(){
        $identity = 'MjY';
        $data['identity'] = $identity;
            $data['id_peserta'] = $this->safe_b64decode($identity);

            $check_peserta = $this->peserta->check_peserta($data['id_peserta']);
            $id_peserta = $check_peserta->id;
            $is_verified = $check_peserta->is_verified;
            $is_enable = $check_peserta->is_enable;
            $data['nama_peserta'] = $check_peserta->nama;

            if(!empty($check_peserta) && $is_verified == 1 && $is_enable == 1){
                $average_value = $this->core->average_value($data['id_peserta']);
                $konsistensi_nilai = $this->core->konsistensi_nilai($data['id_peserta']);
                $average_kkm = $this->core->average_kkm($data['id_peserta']);
                $akreditasi_sma = $this->core->akreditasi_sma($data['id_peserta']);
                $daya_saing = $this->core->daya_saing($data['id_peserta']);
                $prestasi = $this->core->prestasi($data['id_peserta']);
                $prediksi_nilai_ptn = $this->core->prediksi_nilai_ptn($data['id_peserta']);

                if(!empty($prestasi->score)){
                    $prestasi = $prestasi->score;
                } else {
                    $prestasi = 1;
                }

                $pembilang = $average_value->average_value*$akreditasi_sma->bobot*$konsistensi_nilai->konsistensi_value*$average_kkm->average_kkm*$prestasi*$daya_saing->daya_saing_provinsi*$daya_saing->alumni;
                $penyebut = $prediksi_nilai_ptn->nilai_raport*3*1.25*3*1.5*2;

                $result = ROUND(($pembilang/$penyebut)*100, 0);

                if($result >= 90){
                    $data['result_final'] = 90;
                } else {
                    $data['result_final'] = $result;
                }

                if($data['result_final'] > 60){
                    $data['result_kategori'] = 'Tinggi';
                    $data['color_circle'] = 'bg-success';
                } elseif($data['result_final'] <= 60 && $data['result_final'] >= 30){
                    $data['result_kategori'] = 'Sedang';
                    $data['color_circle'] = 'bg-warning';
                } else {
                    $data['result_kategori'] = 'Rendah';
                    $data['color_circle'] = 'bg-danger';
                }

                $datas = array(
                    'id_peserta' => $id_peserta,
                    'persentase' => $data['result_final'],
                    'kategori' => $data['result_kategori']
                );

                $check_data_hasil = $this->peserta->check_data_hasil($id_peserta);

                if($check_data_hasil){
                    $input_hasil = 'sudah terisi';
                } else {
                    $input_hasil = $this->peserta->input_hasil_rasionalisasi($datas);
                }

                if(!empty($input_hasil)){
                    /* echo 'Rata-rata Nilai : '.$average_value->average_value.'<br />';
                    echo 'Akreditasi : '.$akreditasi_sma->bobot.'<br />';
                    echo 'Konsistensi Nilai : '.$konsistensi_nilai->konsistensi_value.'<br />';
                    echo 'KKM : '.$average_kkm->average_kkm.'<br />';
                    echo 'Prestasi : '.$prestasi.'<br />';
                    echo 'Daya saing provinsi : '.$daya_saing->daya_saing_provinsi.'<br />';
                    echo 'Alumni : '.$daya_saing->alumni.'<br />';
                    echo 'Prediksi nilai PTN : '.$prediksi_nilai_ptn->nilai_raport.'<br />';
                    echo 'Pembilang : '.$pembilang.'<br />';
                    echo 'penyebut : '.$penyebut.'<br />';
                    echo 'Hasil : '.$result_final.'% '.$result_kategori; */
                    /* unset($_SESSION['no_telp']); */

                    /**Personal info */
                    $data['personal_info'] = $this->peserta->get_hasil_personal_info($data['id_peserta']);
                    $data['nilai_semester'] = $this->peserta->get_hasil_nilai_semester($data['id_peserta']);
                    $data['prestasi'] = $this->peserta->get_hasil_prestasi($data['id_peserta']);
                    $data['prodi'] = $this->peserta->get_hasil_prodi($data['id_peserta']);
                    $data['prodi_pertama'] = $this->peserta->get_hasil_prodi_pertama($data['id_peserta']);
                    $this->session->set_flashdata('success', 'Hasil perhitungan berdasarkan inputan kamu udh selesai');
                    $this->load->view('user/partials_/header');
                    $this->load->view('user/peserta/css_hasil_rasionalisasi');
                    $this->load->view('user/peserta/hasil_rasionalisasi', $data);
                    $this->load->view('user/partials_/footer');
                } else {
                    $this->session->set_flashdata('info', 'Kesalahan sistem saat menyimpan data, atau silahkan refresh halaman ini');
                    $data['msg'] = 'Kesalahan sistem saat menyimpan data, atau silahkan refresh halaman ini.';
                    $this->load->view('user/partials_/header');
                    $this->load->view('user/peserta/css_hasil_rasionalisasi');
                    $this->load->view('user/peserta/hasil_rasionalisasi_error', $data);
                    $this->load->view('user/partials_/footer');
                }
            } elseif(!empty($check_peserta) && $is_verified == 0 && $is_enable == 1){
                $this->session->set_flashdata('warning', 'Anda belum melakukkan verifikasi nomor telepon!');
                redirect(base_url());
            } else {
                $this->session->set_flashdata('warning', 'Akses ke halaman perhitungan hasil ditolak!');
                redirect(base_url());
            }
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

    public function submit_result($identity){
        if(isset($_SESSION['no_telp'])){
            $new_identity = $identity;
            $data['identity'] = $identity;
            $data['id_peserta'] = $this->safe_b64decode($identity);

            $check_peserta = $this->peserta->check_peserta($data['id_peserta']);
            $id_peserta = $check_peserta->id;
            $is_verified = $check_peserta->is_verified;
            $is_enable = $check_peserta->is_enable;
            $data['nama_peserta'] = $check_peserta->nama;

            if(!empty($check_peserta) && $is_verified == 1 && $is_enable == 1){
                $average_value = $this->core->average_value($data['id_peserta']);
                $konsistensi_nilai = $this->core->konsistensi_nilai($data['id_peserta']);
                $average_kkm = $this->core->average_kkm($data['id_peserta']);
                $akreditasi_sma = $this->core->akreditasi_sma($data['id_peserta']);
                $daya_saing = $this->core->daya_saing($data['id_peserta']);
                $prestasi = $this->core->prestasi($data['id_peserta']);
                $prediksi_nilai_ptn = $this->core->prediksi_nilai_ptn($data['id_peserta']);

                if(!empty($prestasi->score)){
                    $prestasi = $prestasi->score;
                } else {
                    $prestasi = 1;
                }

                $pembilang = $average_value->average_value*$akreditasi_sma->bobot*$konsistensi_nilai->konsistensi_value*$average_kkm->average_kkm*$prestasi*$daya_saing->daya_saing_provinsi*$daya_saing->alumni;
                $penyebut = $prediksi_nilai_ptn->nilai_raport*3*1.25*3*1.5*2;

                $result = ROUND(($pembilang/$penyebut)*100, 0);

                if($result >= 90){
                    $data['result_final'] = 90;
                } else {
                    $data['result_final'] = $result;
                }

                if($data['result_final'] > 60){
                    $data['result_kategori'] = 'Tinggi';
                    $data['color_circle'] = 'bg-success';
                } elseif($data['result_final'] <= 60 && $data['result_final'] >= 30){
                    $data['result_kategori'] = 'Sedang';
                    $data['color_circle'] = 'bg-warning';
                } else {
                    $data['result_kategori'] = 'Rendah';
                    $data['color_circle'] = 'bg-danger';
                }

                $datas = array(
                    'id_peserta' => $id_peserta,
                    'persentase' => $data['result_final'],
                    'kategori' => $data['result_kategori']
                );

                $check_data_hasil = $this->peserta->check_data_hasil($id_peserta);

                if($check_data_hasil){
                    $input_hasil = 'sudah terisi';
                } else {
                    $input_hasil = $this->peserta->input_hasil_rasionalisasi($datas);
                }

                if(!empty($input_hasil)){
                    /* echo 'Rata-rata Nilai : '.$average_value->average_value.'<br />';
                    echo 'Akreditasi : '.$akreditasi_sma->bobot.'<br />';
                    echo 'Konsistensi Nilai : '.$konsistensi_nilai->konsistensi_value.'<br />';
                    echo 'KKM : '.$average_kkm->average_kkm.'<br />';
                    echo 'Prestasi : '.$prestasi.'<br />';
                    echo 'Daya saing provinsi : '.$daya_saing->daya_saing_provinsi.'<br />';
                    echo 'Alumni : '.$daya_saing->alumni.'<br />';
                    echo 'Prediksi nilai PTN : '.$prediksi_nilai_ptn->nilai_raport.'<br />';
                    echo 'Pembilang : '.$pembilang.'<br />';
                    echo 'penyebut : '.$penyebut.'<br />';
                    echo 'Hasil : '.$result_final.'% '.$result_kategori; */
                    /* unset($_SESSION['no_telp']); */

                    /**Personal info */
                    $data['personal_info'] = $this->peserta->get_hasil_personal_info($data['id_peserta']);
                    $data['nilai_semester'] = $this->peserta->get_hasil_nilai_semester($data['id_peserta']);
                    $data['prestasi'] = $this->peserta->get_hasil_prestasi($data['id_peserta']);
                    $data['prodi'] = $this->peserta->get_hasil_prodi($data['id_peserta']);
                    $data['prodi_pertama'] = $this->peserta->get_hasil_prodi_pertama($data['id_peserta']);
                    $data['tanggal_rasionalisasi'] = $this->peserta->get_tanggal_rasionalisasi();
                    $this->session->set_flashdata('success', 'Hasil perhitungan berdasarkan inputan kamu udh selesai');
                    $this->load->view('user/partials_/header');
                    $this->load->view('user/peserta/css_hasil_rasionalisasi');
                    $this->load->view('user/peserta/hasil_rasionalisasi_lite', $data); //Full Page change hasil_rasionalisasi
                    $this->load->view('user/partials_/footer');
                } else {
                    $this->session->set_flashdata('info', 'Kesalahan sistem saat menyimpan data, atau silahkan refresh halaman ini');
                    $data['msg'] = 'Kesalahan sistem saat menyimpan data, atau silahkan refresh halaman ini.';
                    $this->load->view('user/partials_/header');
                    $this->load->view('user/peserta/css_hasil_rasionalisasi');
                    $this->load->view('user/peserta/hasil_rasionalisasi_error', $data);
                    $this->load->view('user/partials_/footer');
                }
            } elseif(!empty($check_peserta) && $is_verified == 0 && $is_enable == 1){
                $this->session->set_flashdata('warning', 'Anda belum melakukkan verifikasi nomor telepon!');
                redirect(base_url());
            } else {
                $this->session->set_flashdata('warning', 'Akses ke halaman perhitungan hasil ditolak!');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('warning', 'Akses ke halaman perhitungan hasil ditolak!');
            redirect(base_url());
        }
        
    }

    public function click_grandsbmptn($identity){
        $id = $this->safe_b64decode($identity);
        $data['is_click'] = 1;
        $tbl = 'peserta';
        $this->core->update_data($tbl, $data, $id);

        redirect('https://grandsbmptn.com/');
    }

}