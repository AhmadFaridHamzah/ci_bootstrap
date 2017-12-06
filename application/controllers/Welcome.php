<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$d['title']='user list';
	$data['contaniner']=$this->load->view('admin/user',$d,true);
		$this->load->view('template',$data);
	}


	public function add_user(){


	$d['title']='add user';

	$d['listdptm']=['unit it','unit kewangan'];

	$data['contaniner']=$this->load->view('admin/add_user',$d,true);
    $this->load->view('template',$data);

	}







}
