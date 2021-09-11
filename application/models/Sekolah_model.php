<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah_model extends CI_Model{

    public function sekolah($id_provinsi, $id_kota_kab){
        return $this->db->get_where('sekolah', array('id_provinsi' => $id_provinsi, 'id_kota_kab' => $id_kota_kab, 'is_enable' => 1))->result();
    }

    public function sekolah_jurusan(){
        return $this->db->get_where('sekolah_jurusan', array('is_enable' => 1))->result();
    }

    public function universitas(){
        $this->db->select('id, nama');
        return $this->db->get_where('universitas', array('is_enable' => 1))->result();
    }

    public function universitas_jurusan($id_universitas){
        $this->db->select('id, nama');
        return $this->db->get_where('universitas_jurusan', array('id_universitas' => $id_universitas, 'is_enable' => 1))->result();
    }

    public function akreditasi(){
        $this->db->select('id, nama');
        return $this->db->get_where('akreditasi', array('is_enable' => 1))->result();
    }

    public function jurusan_group(){
        $this->db->select('id, nama');
        return $this->db->get_where('jurusan_group', array('is_enable' => 1))->result();
    }

    public function get_jurusan_universitas_by_id($id){
        $this->db->select('universitas_jurusan.*, universitas.nama AS nama_universitas, wilayah.nama AS nama_wilayah, jurusan_group.nama AS nama_jurusan_group');
        $this->db->from('universitas_jurusan');
        $this->db->join('universitas', 'universitas_jurusan.id_universitas = universitas.id');
        $this->db->join('wilayah', 'universitas_jurusan.id_wilayah = wilayah.id');
        $this->db->join('jurusan_group', 'universitas_jurusan.id_jurusan_group = jurusan_group.id');
        $this->db->where('universitas_jurusan.id', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_all_data_universitas(){
        $this->db->select('universitas.*, provinsi.nama AS nama_provinsi');
        $this->db->from('universitas');
        $this->db->join('provinsi', 'universitas.id_provinsi = provinsi.id');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_all_data_universitas_by_id($id){
        $this->db->select('universitas.*, provinsi.nama AS nama_provinsi');
        $this->db->from('universitas');
        $this->db->join('provinsi', 'universitas.id_provinsi = provinsi.id');
        $this->db->where('universitas.id', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function top_school()
	{
		$query = $this->db->query("
                    SELECT
                            DISTINCT(T2.nama) AS school,
                            T4.nama AS kota_kab,
                            T5.nama AS provinsi,
                            COUNT(T2.nama) AS count_data
                        FROM peserta AS T1
                        JOIN sekolah AS T2 ON T1.id_sekolah = T2.id
                        JOIN peserta_hasil AS T3 ON T3.id_peserta = T1.id
                        JOIN kota_kabupaten AS T4 ON T2.id_kota_kab = T4.id
                        JOIN provinsi AS T5 ON T2.id_provinsi = T5.id
                        WHERE T3.is_enable = 1
                        AND T1.is_verified = 1
                        AND T1.is_enable = 1
                        GROUP BY T2.nama
                        ORDER BY count_data DESC
                        LIMIT 10
					");
        $num = $query->num_rows();
        if($num>0){
            return $query->result();
        }
        else{
            return false;
        }
    }
    
    public function top_university()
	{
		$query = $this->db->query("
                    SELECT
                            DISTINCT(T3.nama) AS university,
                            T5.nama AS provinsi,
                            COUNT(T3.nama) AS count_data
                        FROM peserta AS T1
                        JOIN peserta_prodi AS T2 ON T2.id_peserta = T1.id
                        JOIN universitas AS T3 ON T2.id_universitas = T3.id
                        JOIN peserta_hasil AS T4 ON T4.id_peserta = T1.id
                        JOIN provinsi AS T5 ON T3.id_provinsi = T5.id
                        WHERE T1.is_verified = 1
                        AND T1.is_enable = 1
                        AND T2.is_enable = 1
                        AND T4.is_enable = 1
                        GROUP BY T3.nama
                        ORDER BY count_data DESC
                        LIMIT 10
					");
        $num = $query->num_rows();
        if($num>0){
            return $query->result();
        }
        else{
            return false;
        }
    }
    
    public function input_tambah_sekolah($data){
        $this->db->trans_start();
        $this->db->insert('sekolah', $data);
        $id_insert = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $id_insert;
		}
    }

}