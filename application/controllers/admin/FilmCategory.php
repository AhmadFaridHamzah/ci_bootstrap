<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class FilmCategory extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->model('M_film');

	}


	public function index(){

		$d['title']='List Film';

		$data['contaniner']=$this->load->view('film/list_category',$d,true);

		$this->load->view('template_admin',$data);

	}

	public function film_dataTable() {
    	//Important to NOT load the model and let the library load it instead.  
		$this -> load -> library('Datatable', array('model' => 'M_listcategories_dt', 'rowIdCol' => 'fc.film_id'));

		        $this->datatable->setPreResultCallback(
		            function (&$json) {
		                $rows =& $json['data'];
		                foreach ($rows as &$r) {

		                	$btnInfo = '<a href="#modal_infofilm" title="info" data-id="'.$r['$']['action_btn'].'" class="btn_info" type="button" data-toggle="modal"><i class="fa fa-fw fa-info-circle"></i></a>';
		                	
		                	$btnEdit = '<a href="#modal_editfilm" title="edit" data-id="'.$r['$']['action_btn'].'" class="btn_edit" type="button" data-toggle="modal"><i class="fa fa-fw fa-edit"></i></a>';

                            $btnDelete = '<a href="modal_deletefilm" title="delete" data-id="'.$r['$']['action_btn'].'" type="button" data-toggle="modal" class="btn_delete" ><i class="fa fa-fw fa-trash"></i></a>';

		                    $r['$']['action_btn'] = $btnInfo . "" . $btnEdit . "" . $btnDelete;
		                }
		            }
		        );
        
        //format array is optional, but shown here for the sake of example
        $json = $this -> datatable -> datatableJson(
			array(
				'a_date_col' => 'date',
				'a_boolean_col' => 'boolean',
				'a_percent_col' => 'percent',
				'a_currency_col' => 'currency'
			)
		);
        
        $this -> output -> set_header("Pragma: no-cache");
        $this -> output -> set_header("Cache-Control: no-store, no-cache");
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($json));
 
    }

    public function info_film($id){

		$info_data= $this->M_film->get_info_film($id);

        echo json_encode($info_data);
    }

    public function edit_filminfo(){

   		 $datafilm = array(
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'release_year' => $this->input->post('release_year'),
                        'language_id' => $this->input->post('language_id'),
                        'length' => $this->input->post('length'),
                    );

   		$id_film = $this->input->post('film_id');

    	$edit_film= $this->M_film->edit_info_film($datafilm,$id_film);

    	redirect('admin/filmcategory/', 'refresh');

    }

    public function delete_film($id){

    	 $deletefilm = $this->M_film->delete_film($id);

        echo json_encode($deletefilm);
    }

}