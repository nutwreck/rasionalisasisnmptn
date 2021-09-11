<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends CI_Model{

    public function average_value($id_peserta){
        $query = $this->db->query("SELECT
                    ROUND((nilai_smt1+nilai_smt2+nilai_smt3+nilai_smt4+nilai_smt5)/5, 2) AS average_value
                    FROM peserta_nilai_semester
                    WHERE id_peserta = '".$id_peserta."'
                    AND is_enable = 1
                ");
        return $query->row();
    }

    public function konsistensi_nilai($id_peserta){
        $query = $this->db->query("SELECT
                    CASE
                        WHEN ((nilai_smt5-nilai_smt4)+(nilai_smt4-nilai_smt3)+(nilai_smt3-nilai_smt2)+(nilai_smt2-nilai_smt1)) >= 0 THEN 1.25
                        ELSE 1
                    END AS konsistensi_value
                    FROM peserta_nilai_semester
                    WHERE id_peserta = '".$id_peserta."'
                    AND is_enable = 1
                ");
        return $query->row();
    }

    public function average_kkm($id_peserta){
        $query = $this->db->query("SELECT
                    CASE
                        WHEN ((kkm_smt1+kkm_smt2+kkm_smt3+kkm_smt4+kkm_smt5)/5) > 71 THEN 3
                        WHEN ((kkm_smt1+kkm_smt2+kkm_smt3+kkm_smt4+kkm_smt5)/5) BETWEEN 65 AND 70 THEN 2
                        WHEN ((kkm_smt1+kkm_smt2+kkm_smt3+kkm_smt4+kkm_smt5)/5) < 65 THEN 1
                        ELSE 1
                    END AS average_kkm
                    FROM peserta_nilai_semester
                    WHERE id_peserta = '".$id_peserta."'
                    AND is_enable = 1
                ");
        return $query->row();
    }

    public function akreditasi_sma($id_peserta){
        $query = $this->db->query("SELECT
                        T3.bobot
                    FROM peserta AS T1
                    JOIN sekolah AS T2 ON T1.id_sekolah = T2.id
                    JOIN akreditasi AS T3 ON T2.id_akreditasi = T3.id
                    WHERE T1.id = '".$id_peserta."'
                    AND T2.is_enable = 1
                    AND T3.is_enable = 1
                ");
        return $query->row();
    }

    public function daya_saing($id_peserta){
        $query = $this->db->query("SELECT
                        CASE
                            WHEN T1.id_provinsi = T3.id_provinsi THEN 2
                            ELSE 1
                        END AS daya_saing_provinsi,
                        CASE
                            WHEN T2.jumlah_alumni > 5 THEN 1.5
                            WHEN T2.jumlah_alumni BETWEEN 4 AND 5 THEN 1.2
                            WHEN T2.jumlah_alumni BETWEEN 0 AND 3 THEN 1.1
                        END AS alumni
                    FROM peserta AS T1
                    JOIN peserta_prodi AS T2 ON T1.id = T2.id_peserta
                    JOIN universitas AS T3 ON T2.id_universitas = T3.id
                    WHERE T1.id = '".$id_peserta."'
                    AND T2.is_enable = 1
                    AND T3.is_enable = 1
                    ORDER BY T2.id ASC
                    LIMIT 1
                ");
        return $query->row();
    }

    public function prestasi($id_peserta){
        $query = $this->db->query("SELECT
                        T2.score
                    FROM peserta_prestasi AS T1
                    JOIN prestasi_score AS T2 ON T1.id_prestasi = T2.id_prestasi AND T1.id_juara = T2.id_juara
                    WHERE T1.id_peserta = '".$id_peserta."'
                    AND T1.is_enable = 1
                    AND T2.is_enable = 1
                    ORDER BY T1.id ASC
                    LIMIT 1
                ");
        return $query->row();
    }

    public function prediksi_nilai_ptn($id_peserta){
        $query = $this->db->query("SELECT
                        T2.nilai_raport
                    FROM peserta_prodi AS T1
                    JOIN universitas_jurusan AS T2 ON T1.id_universitas_jurusan = T2.id AND T1.id_universitas = T2.id_universitas 
                    WHERE T1.id_peserta = '".$id_peserta."'
                    AND T1.is_enable = 1
                    AND T2.is_enable = 1
                    ORDER BY T1.id ASC
                    LIMIT 1
                ");
        return $query->row();
    }

    /** 
     *          
     * 
     * FUNCTION */
    public function get_all_data($tbl){
        return $this->db->get($tbl)->result();
    }
    public function get_data_by_id($tbl, $id){
        return $this->db->get_where($tbl, array('id' => $id))->result();
    }
    public function input_data($tbl, $datas){
        $this->db->trans_start();
        $query = $this->db->insert($tbl, $datas);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    public function update_data($tbl, $data, $id){
        $this->db->where('id', $id);
        $query = $this->db->update($tbl, $data);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    public function delete_data($tbl, $id){
        $this->db->trans_start();
        $this->db->set('is_enable', 0);
        $this->db->where('id', $id);
        $query = $this->db->update($tbl);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    public function active_data($tbl,$id){
        $this->db->trans_start();
        $this->db->set('is_enable', 1);
        $this->db->where('id', $id);
        $query = $this->db->update($tbl);
        if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return null;
		} else{
			$this->db->trans_commit();
			return $query;
		}
    }
    /** 
     *          
     * 
     * END FUNCTION */

    public function sms_sent()
	{
		$query = $this->db->query("
				SELECT id
                    FROM peserta
                    WHERE is_enable = 1 AND
                    is_sms_send = 1
					");
		$num = $query->num_rows();
		if($num>0){
		   return $num;
        }
        else{
            return false;
        }
    }

    public function sms_not_sent()
	{
		$query = $this->db->query("
				SELECT id
                    FROM peserta
                    WHERE is_enable = 1 AND
                    is_sms_send = 0
					");
		$num = $query->num_rows();
		if($num>0){
		   return $num;
        }
        else{
            return false;
        }
    }

    public function user_click()
	{
		$query = $this->db->query("
				SELECT id
                    FROM peserta
                    WHERE is_enable = 1 
                    AND is_verified = 1
                    AND is_click = 1
					");
		$num = $query->num_rows();
		if($num>0){
		   return $num;
        }
        else{
            return false;
        }
    }

    public function user_not_click()
	{
		$query = $this->db->query("
                SELECT id
                    FROM peserta
                    WHERE is_enable = 1 
                    AND is_verified = 1
                    AND is_click = 0
					");
		$num = $query->num_rows();
		if($num>0){
		   return $num;
        }
        else{
            return false;
        }
    }

    function login_admin($data){
		$query = $this->db->query("
            SELECT  id ,
                username,
                password
					FROM admin
					WHERE username = '".$data['username']."'
				");
		$num = $query->num_rows();
		if($num>0){
            return $query->result_array();
        }
        else{
            return false;
        }
	}

}
