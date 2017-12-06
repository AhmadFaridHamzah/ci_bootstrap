<?php

    class M_listcategories_dt extends CI_Model implements DatatableModel{
			

		public function appendToSelectStr() {
				return array(
		            'action_btn' => 'fc.film_id',
		            'language' => 'l.name'
		        );
				
		}
    	
		public function fromTableStr() {
			return 'film_category fc';
		}
		
    

	    public function joinArray(){
	    	return array(
	    	  'film f|left outer' => 'f.film_id = fc.film_id',
              'category c|left outer' => 'c.category_id = fc.category_id',
              'language l|left outer' => 'l.language_id = f.language_id'
              );
	    }
	    
    	public function whereClauseArray(){
			return NULL;
    	}
   }