<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_model extends CI_Model{

    public function check_phone($no_telp){
        return $this->db->get_where('peserta', array('no_telp' => $no_telp, 'is_verified' => 1, 'is_enable' => 1))->result();
    }

    public function check_otp($codeRandom){
        return $this->db->get_where('peserta', array('otp' => $codeRandom, 'is_otp_expired' => 0, 'is_verified' => 0, 'is_enable' => 1))->result();
    }

    public function check_peserta($id_peserta){
        $this->db->select('id, nama, is_verified, is_enable');
        return $this->db->get_where('peserta', array('id' => $id_peserta))->row();
    }

    public function check_peserta_prodi($id_peserta){
        $this->db->select('id');
        return $this->db->get_where('peserta_prodi', array('id_peserta' => $id_peserta, 'id_universitas' => 0, 'id_universitas_jurusan' => 0, 'is_enable' => 1))->row();
    }

    public function check_data_hasil($id_peserta){
        $this->db->select('id');
        return $this->db->get_where('peserta_hasil', array('id_peserta' => $id_peserta, 'is_enable' => 1))->result();
    }

    public function input_personal_info($datas){
        $this->db->trans_start();
        $this->db->insert('peserta', $datas);
        $id_insert = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $id_insert;
		}
    }

    public function update_personal_info($datas, $id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $query = $this->db->update('peserta', $datas);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function get_confirmpeserta_byid($id_peserta){
        $this->db->select('id, no_telp, otp, otp_expired, count_otp_send');
        return $this->db->get_where('peserta', array('id' => $id_peserta, 'is_verified' => 0, 'is_enable' => 1))->row();
    }

    public function update_smspeserta_byid($id_peserta, $sms_verification){
        $this->db->trans_start();
        $this->db->set('count_otp_send', 'count_otp_send+1', FALSE);
        $this->db->set('is_sms_send', $sms_verification);
        $this->db->where('id', $id_peserta);
        $query = $this->db->update('peserta');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
        }
    }

    public function update_expiredpeserta_byid($id_peserta){
        $this->db->trans_start();
        $this->db->set('is_otp_expired', 1);
        $this->db->set('is_verified', 0);
        $this->db->where('id', $id_peserta);
        $query = $this->db->update('peserta');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function update_resetexppeserta_byid($id_peserta, $otp, $otp_expired){
        $this->db->trans_start();
        $this->db->set('otp', $otp);
        $this->db->set('otp_expired', $otp_expired);
        $this->db->set('is_otp_expired', 0);
        $this->db->set('is_verified', 0);
        $this->db->where('id', $id_peserta);
        $query = $this->db->update('peserta');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function get_confirmotppeserta_byid($id_peserta, $otp){
        $this->db->select('id');
        return $this->db->get_where('peserta', array('id' => $id_peserta, 'otp' => $otp, 'is_otp_expired' => 0, 'is_verified' => 0, 'is_enable' => 1))->row();
    }

    public function update_verificationpeserta_byid($id_peserta){
        $this->db->trans_start();
        $this->db->set('is_sms_send', 1);
        $this->db->set('is_otp_expired', 1);
        $this->db->set('is_verified', 1);
        $this->db->where('id', $id_peserta);
        $query = $this->db->update('peserta');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function input_nilai_semester($data){
        $this->db->trans_start();
        $query = $this->db->insert('peserta_nilai_semester', $data);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function get_prestasi(){
        return $this->db->get_where('prestasi', array('nama <>' => 'NONPRESTASI', 'is_enable' => 1))->result();
    }

    public function get_juara(){
        return $this->db->get_where('juara', array('is_enable' => 1))->result();
    }

    public function input_prestasi($datas){
        $this->db->trans_start();
        $query = $this->db->insert_batch('peserta_prestasi', $datas);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function input_program_studi($datas){
        $this->db->trans_start();
        $query = $this->db->insert_batch('peserta_prodi', $datas);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function clean_fix_peserta_prodi($get_id_peserta_prodi){
        $this->db->trans_start();
        $this->db->set('is_enable', 0);
        $this->db->where('id', $get_id_peserta_prodi);
        $query = $this->db->update('peserta_prodi');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function input_hasil_rasionalisasi($datas){
        $this->db->trans_start();
        $query = $this->db->insert('peserta_hasil', $datas);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    
    /**HASIL PERSONAL INFO */
    public function get_hasil_personal_info($id){
        $this->db->select('peserta.nama, peserta.email, peserta.no_telp, sekolah.nama AS nama_sekolah, sekolah_jurusan.nama AS nama_jurusan');
        $this->db->from('peserta');
        $this->db->join('sekolah', 'peserta.id_sekolah = sekolah.id');
        $this->db->join('sekolah_jurusan', 'peserta.id_sekolah_jurusan = sekolah_jurusan.id');
        $this->db->where('peserta.id', $id);
        $this->db->where('peserta.is_enable', 1);
        $this->db->where('peserta.is_verified', 1);
        $this->db->where('sekolah.is_enable', 1);
        $this->db->where('sekolah_jurusan.is_enable', 1);
        $query = $this->db->get()->result();
        return $query;
    }
    /**HASIL NILAI SEMESTER */
    public function get_hasil_nilai_semester($id){
        $this->db->select('nilai_smt1, nilai_smt2, nilai_smt3, nilai_smt4, nilai_smt5, kkm_smt1, kkm_smt2, kkm_smt3, kkm_smt4, kkm_smt5');
        $this->db->from('peserta_nilai_semester');
        $this->db->where('id_peserta', $id);
        $this->db->where('is_enable', 1);
        $query = $this->db->get()->result();
        return $query;
    }
    /**HASIL PRESTASI */
    public function get_hasil_prestasi($id){
        $this->db->select('peserta_prestasi.nama, prestasi.nama AS nama_prestasi, juara.nama AS nama_juara');
        $this->db->from('peserta_prestasi');
        $this->db->join('prestasi', 'peserta_prestasi.id_prestasi = prestasi.id');
        $this->db->join('juara', 'peserta_prestasi.id_juara = juara.id');
        $this->db->where('peserta_prestasi.id_peserta', $id);
        $this->db->where('peserta_prestasi.is_enable', 1);
        $this->db->where('prestasi.is_enable', 1);
        $this->db->where('juara.is_enable', 1);
        $query = $this->db->get()->result();
        return $query;
    }
    /**HASIL PRESTASI */
    public function get_hasil_prodi($id){
        $this->db->select('universitas.nama AS nama_universitas, universitas_jurusan.nama AS nama_universitas_jurusan, peserta_prodi.jumlah_alumni');
        $this->db->from('peserta_prodi');
        $this->db->join('universitas', 'peserta_prodi.id_universitas = universitas.id');
        $this->db->join('universitas_jurusan', 'peserta_prodi.id_universitas_jurusan = universitas_jurusan.id');
        $this->db->where('peserta_prodi.id_peserta', $id);
        $this->db->where('peserta_prodi.is_enable', 1);
        $this->db->where('universitas.is_enable', 1);
        $this->db->where('universitas_jurusan.is_enable', 1);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_hasil_prodi_pertama($id){
        $this->db->select('universitas_jurusan.nama AS nama_universitas_jurusan');
        $this->db->from('peserta_prodi');
        $this->db->join('universitas', 'peserta_prodi.id_universitas = universitas.id');
        $this->db->join('universitas_jurusan', 'peserta_prodi.id_universitas_jurusan = universitas_jurusan.id');
        $this->db->where('peserta_prodi.id_peserta', $id);
        $this->db->where('peserta_prodi.is_enable', 1);
        $this->db->where('universitas.is_enable', 1);
        $this->db->where('universitas_jurusan.is_enable', 1);
        $this->db->order_by('peserta_prodi.id', 'ASC');
        $this->db->limit(1); 
        $query = $this->db->get()->result();
        return $query;
    }

    /**HAPUS KHUSUS USER PENGUJI */
    //DELETE PESERTA
    public function delete_peserta_ow($id_peserta){
        $this->db->trans_start();
        $this->db->set('is_enable', 0);
        $this->db->where('id', $id_peserta);
        $query = $this->db->update('peserta');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    //DELETE PESERTA HASIL
    public function delete_peserta_hasil_ow($id_peserta){
        $this->db->trans_start();
        $this->db->set('is_enable', 0);
        $this->db->where('id_peserta', $id_peserta);
        $query = $this->db->update('peserta_hasil');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    //DELETE PESERTA NILAI
    public function delete_peserta_nilai_ow($id_peserta){
        $this->db->trans_start();
        $this->db->set('is_enable', 0);
        $this->db->where('id_peserta', $id_peserta);
        $query = $this->db->update('peserta_nilai_semester');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    //DELETE PESERTA PRESTASI
    public function delete_peserta_prestasi_ow($id_peserta){
        $this->db->trans_start();
        $this->db->set('is_enable', 0);
        $this->db->where('id_peserta', $id_peserta);
        $query = $this->db->update('peserta_prestasi');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    //DELETE PESERTA PRODI
    public function delete_peserta_prodi_ow($id_peserta){
        $this->db->trans_start();
        $this->db->set('is_enable', 0);
        $this->db->where('id_peserta', $id_peserta);
        $query = $this->db->update('peserta_prodi');
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }

    public function get_all_peserta(){
        $this->db->select('*');
        return $this->db->get('view_all_peserta_enable')->result();
    }

    public function get_all_peserta_nilai_semester(){
        $this->db->select('*');
        return $this->db->get('view_all_peserta_nilai_semester_enable')->result();
    }

    public function get_all_peserta_prestasi(){
        $this->db->select('*');
        return $this->db->get('view_all_peserta_prestasi_enable')->result();
    }

    public function get_all_peserta_prodi(){
        $this->db->select('*');
        return $this->db->get('view_all_peserta_prodi_enable')->result();
    }

    public function get_all_peserta_hasil(){
        $this->db->select('*');
        return $this->db->get('view_all_peserta_hasil_enable')->result();
    }

    public function get_tanggal_rasionalisasi(){
        $this->db->select('*');
        return $this->db->get('tanggal_rasionalisasi')->row();
    }

    public function get_total_user()
	{
		$query = $this->db->query("
				SELECT id
                    FROM peserta
                    WHERE is_enable = 1
					");
		$num = $query->num_rows();
		if($num>0){
		   return $num;
        }
        else{
            return false;
        }
    }
    
    public function get_total_user_not_verified()
	{
		$query = $this->db->query("
				SELECT id
                    FROM peserta
                    WHERE is_enable = 1 AND is_verified = 0
					");
		$num = $query->num_rows();
		if($num>0){
		   return $num;
        }
        else{
            return false;
        }
	}

    public function get_total_user_verified()
	{
		$query = $this->db->query("
				SELECT id
                    FROM peserta
                    WHERE is_enable = 1 AND is_verified = 1
					");
		$num = $query->num_rows();
		if($num>0){
		   return $num;
        }
        else{
            return false;
        }
    }
    
    public function get_total_user_input_data()
	{
		$query = $this->db->query("
				SELECT peserta.id
                    FROM peserta
                    JOIN peserta_hasil ON peserta_hasil.id_peserta = peserta.id
                    WHERE peserta.is_enable = 1 
                    AND peserta.is_verified = 1
                    AND peserta_hasil.is_enable = 1
					");
		$num = $query->num_rows();
		if($num>0){
		   return $num;
        }
        else{
            return false;
        }
    }
    
    public function get_total_user_data()
	{
		$query = $this->db->query("
                SELECT nama as nama_peserta,
                no_telp
                    FROM peserta
                    WHERE is_enable = 1
					");
        $num = $query->num_rows();
        if($num>0){
            return $query->result();
        }
        else{
            return false;
        }
    }

    public function get_total_user_not_verified_data()
	{
		$query = $this->db->query("
				SELECT nama as nama_peserta,
                no_telp
                    FROM peserta
                    WHERE is_enable = 1 AND is_verified = 0
					");
        $num = $query->num_rows();
        if($num>0){
            return $query->result();
        }
        else{
            return false;
        }
    }
    
    public function get_total_user_verified_data()
	{
		$query = $this->db->query("
				SELECT nama as nama_peserta,
                no_telp
                    FROM peserta
                    WHERE is_enable = 1 AND is_verified = 1
					");
        $num = $query->num_rows();
        if($num>0){
            return $query->result();
        }
        else{
            return false;
        }
    }

    public function get_total_user_input_datas()
	{
		$query = $this->db->query("
				SELECT peserta.nama as nama_peserta,
                peserta.no_telp
                    FROM peserta
                    JOIN peserta_hasil ON peserta_hasil.id_peserta = peserta.id
                    WHERE peserta.is_enable = 1 
                    AND peserta.is_verified = 1
                    AND peserta_hasil.is_enable = 1
					");
        $num = $query->num_rows();
        if($num>0){
            return $query->result();
        }
        else{
            return false;
        }
    }

    public function get_total_user_click()
	{
		$query = $this->db->query("
				SELECT nama as nama_peserta,
                no_telp
                    FROM peserta
                    WHERE is_enable = 1 
                    AND is_verified = 1
                    AND is_click = 1
					");
        $num = $query->num_rows();
        if($num>0){
            return $query->result();
        }
        else{
            return false;
        }
    }

    public function get_total_user_not_click()
	{
		$query = $this->db->query("
				SELECT nama as nama_peserta,
                no_telp
                    FROM peserta
                    WHERE is_enable = 1 
                    AND is_verified = 1
                    AND is_click = 0
					");
        $num = $query->num_rows();
        if($num>0){
            return $query->result();
        }
        else{
            return false;
        }
    }

}