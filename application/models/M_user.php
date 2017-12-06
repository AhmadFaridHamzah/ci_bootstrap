<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {


	public function add_user($data){

		if($this->db->insert('staff',$data)){

			return $this->db->insert_id();
		}else{
			return false;
		}


	}


	public function get_staff_detail($id){

		$this->db->select('username,email,address');
		$this->db->from('staff s');
		$this->db->join('store st','st.store_id=s.store_id','right');
		$this->db->join('address ad','ad.address_id=st.store_id','right');
		$this->db->where('staff_id',$id);



		$query=$this->db->get();

		if($query->num_rows()>0){

			return $query->row();
		}




	}


}
