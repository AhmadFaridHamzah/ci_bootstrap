<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_film extends CI_Model {


	public function get_info_film($id){

		$this->db->select('*');
		$this->db->from('film f');
		$this->db->join('language l','l.language_id=f.language_id','right');
		$this->db->where('f.film_id',$id);

		$query=$this->db->get();

		if($query->num_rows()>0){

			return $query->row();
		}

	}

	public function edit_info_film($data,$id){

		$this->db->where('film_id', $id);
        $this->db->update('film', $data);
        return $id;
	}

	public function delete_film($id){

		$sql = "DELETE fa FROM film_actor fa JOIN film f ON f.film_id = fa.film_id WHERE fa.film_id = ?";

		$this->db->query($sql, array($id));

		$sql = "DELETE fc FROM film_category fc JOIN film f ON f.film_id = fc.film_id WHERE fc.film_id = ?";

		$this->db->query($sql, array($id));

		// $this->db->delete('film', array('film_id' => $id));

		return true;

	}


}
