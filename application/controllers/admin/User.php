<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

function __construct(){

	parent::__construct();
	$this->load->model('M_user');
}



public function index(){

	$d['title']='user list';

	$data['contaniner']=$this->load->view('admin/user',$d,true);

		$this->load->view('template_admin',$data);

}


public function add_user(){



	  $d['title']='Add User';



	  	$this->form_validation->set_rules('username','Username','required');


	  	$this->form_validation->set_rules('email','Email','valid_email|is_unique[staff.email]');
	
	   

		if($this->form_validation->run()==FALSE){

		
		$data['contaniner']=$this->load->view('admin/add_user',$d,true);

		$this->load->view('template_admin',$data);

		}else{
			$first_name=$this->input->post('username');
			$email=$this->input->post('email');

				$datain=['first_name'=>$first_name,
						'username'=>$first_name,
						'store_id'=>1,
						'email'=>$email];

			$id=$this->M_user->add_user($datain);		

			if($id){
			redirect('admin/user/seccus_add/'.$id);
			}

			

		}







}



public function seccus_add($id){

	$d['title']='Berjaya Tambah';

	$d['staffdetail']=$this->M_user->get_staff_detail($id);

	$data['contaniner']=$this->load->view('admin/seccus_add',$d,true);
	$this->load->view('template_admin',$data);

}




}