<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_model extends CI_Model{

    public function provinsi(){
        return $this->db->get_where('provinsi', array('is_enable' => 1))->result();
    }

    public function kota_kabupaten($id_provinsi){
        return $this->db->get_where('kota_kabupaten', array('id_provinsi' => $id_provinsi, 'is_enable' => 1))->result();
    }

    public function get_wilayah_prodi(){
        return $this->db->get_where('wilayah', array('is_enable' => 1))->result();
    }

    /** 
     *          
     * 
     * KOTA KAB */
    public function get_all_data_kota_kab(){
        $this->db->select('kota_kabupaten.*, provinsi.nama AS nama_provinsi');
        $this->db->from('kota_kabupaten');
        $this->db->join('provinsi', 'kota_kabupaten.id_provinsi = provinsi.id');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_all_data_kota_kab_id($id){
        $this->db->select('kota_kabupaten.*, provinsi.nama AS nama_provinsi');
        $this->db->from('kota_kabupaten');
        $this->db->join('provinsi', 'kota_kabupaten.id_provinsi = provinsi.id');
        $this->db->where('kota_kabupaten.id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    /** 
     *          
     * 
     * END KOTA KAB */

    /** 
     *          
     * 
     * SEKOLAH */
   /*  public function get_all_data_sekolah(){
        $this->db->select('sekolah.*, provinsi.nama AS nama_provinsi, kota_kabupaten.nama AS nama_kota_kabupaten, akreditasi.nama AS nama_akreditasi');
        $this->db->from('sekolah');
        $this->db->join('provinsi', 'sekolah.id_provinsi = provinsi.id');
        $this->db->join('kota_kabupaten', 'sekolah.id_kota_kab = kota_kabupaten.id');
        $this->db->join('akreditasi', 'sekolah.id_akreditasi = akreditasi.id');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_all_data_sekolah_id($id){
        $this->db->select('sekolah.*, provinsi.nama AS nama_provinsi, kota_kabupaten.nama AS nama_kota_kabupaten, akreditasi.nama AS nama_akreditasi');
        $this->db->from('sekolah');
        $this->db->join('provinsi', 'sekolah.id_provinsi = provinsi.id');
        $this->db->join('kota_kabupaten', 'sekolah.id_kota_kab = kota_kabupaten.id');
        $this->db->join('akreditasi', 'sekolah.id_akreditasi = akreditasi.id');
        $this->db->where('sekolah.id', $id);
        $query = $this->db->get()->result();
        return $query;
    } */
    /** 
     *          
     * 
     * END SEKOLAH */
}