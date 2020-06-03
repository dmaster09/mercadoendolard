<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->per_page_record = 21;
		$this->load->model('ad_model'); // load job model
		$this->load->model('common_model'); // for common funcitons
		$this->load->library('fields'); // for common funcitons
	}

	//--------------------------------------------------------------
	// Main Index Function

	public function index($title = NULL)
	{	
		if(!$title || is_numeric($title))
		{
			
			
			$count = $this->ad_model->count_all_ads();
			$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			$url = base_url("ads/");

			$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
			$config['uri_segment'] = 2;		
			$this->pagination->initialize($config);

			$data['ads'] = $this->ad_model->get_all_ads($this->per_page_record, $offset, null); // Get all posts

			$data['countries'] = $this->common_model->get_countries_list(); 
			$data['categories'] = $this->common_model->get_categories_list(); 
			$data['registros']=$this->ad_model->count_all_ads();
			foreach ($data['ads'] as $key => $value) {
			$att= atributess_ads_fields($value['id']);

			if(!$att){
				unset($data['ads'][$key]);
				$data['registros']=$data['registros']-1;//
			}
		   }
			$max__price=$this->ad_model->get_select_max_price();			
			$data['max_val_price']=$max__price+50;


			$data['title'] = 'Listado';
			$data['layout'] = 'themes/ads/ad_list';
			

			$this->load->view('themes/layout', $data);
		}
		else
		{
			$data['ad'] = $this->ad_model->get_post_detail_by_slug($title);

			$data['others'] = $this->ad_model->get_post_other_detail_by_slug($title);

			$data['similar_ads'] = $this->ad_model->get_similar_ads_by_category_except_active($data['ad']['category'],$data['ad']['id']);

			$data['title'] = $data['ad']['title'];

			$data['tags'] = 'Ad';

			$data['layout'] = 'themes/ads/ad_detail';

			$this->load->view('themes/layout', $data);
		}
	}
	
	//-------------------------------------------------------------------------------------------
	// Get sub category of category
	public function get_subcategory()
	{
		if($this->input->post('parent'))
		{
			$category = $_POST['parent'];

			$query = $this->db->get_where('ci_subcategories',array('parent' => $category));

			if($query->num_rows() > 0)
			{
				$rows = $query->result_array();
				$options = array('' => 'Selecciona una opción') + array_column($rows,'name','id');
		        $html = form_dropdown('subcategory',$options,'','class="select2 form-control select-subcategory" required');
		        $response =  array('status' => 'success', 'msg' =>  $html);
		    }
		    else
		    {
		    	$html = $this->fields->category_fields($category);
		        $response =  array('status' => 'fields', 'msg' =>  $html);
		    }
		    
			echo json_encode($response);
		}
	}

	//-------------------------------------------------------------------------------------------
	// Get custom fields of sub category
	public function get_subcategory_custom_fields()
	{
		if($this->input->post('parent'))
		{
			$html = $this->fields->subcategory_fields($_POST['parent']);

	        $response =  array('status' => 'success', 'msg' =>  $html);
	        
			echo json_encode($response);
		}
	}
	
	/* Filters */

	//-------------------------------------------------------------------------------------------
	// Get sub category of category
	public function get_subcategory_for_filter()
	{
		if($this->input->post('parent'))
		{
			$category = $_POST['parent'];

			$query = $this->db->get_where('ci_subcategories',array('parent' => $category));

			if($query->num_rows() > 0)
			{
				$rows = $query->result_array();
				$options = array('' => 'Subcategoría') + array_column($rows,'name','id');
		        $dropdown = form_dropdown('subcategory',$options,'','class="filter-subcategory form-control"');
		        $html = '<div class="row"><div class="col-12 form-group">'.$dropdown.'</div></div>';
		        $response =  array('status' => 'success', 'msg' =>  $html);
		    }
		    else
		    {
		    	$html = $this->fields->filter_category_fields($category);
		        $response =  array('status' => 'fields', 'msg' =>  $html);
		    }
		    
			echo json_encode($response);
		}
	}

	//-------------------------------------------------------------------------------------------
	// Get custom fields of sub category
	public function get_subcategory_custom_fields_for_filter()
	{
		if($this->input->post('parent'))
		{
			$html = $this->fields->filter_subcategory_fields($_POST['parent']);

	        $response =  array('status' => 'success', 'msg' =>  $html);
	        
			echo json_encode($response);
		}
	}

	//----------------------------------------
	public function get_country_states()
	{
		$states = $this->db->select('*')->where('country_id',$this->input->post('country'))->get('ci_states')->result_array();
	    $options = array('' => 'Estado') + array_column($states,'name','id');
	    $html = form_dropdown('state',$options,'','class="filter-state form-control"');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}

	//----------------------------------------
	public function get_state_cities()
	{
		$cities = $this->db->select('*')->where('state_id',$this->input->post('state'))->get('ci_cities')->result_array();
	    $options = array('' => 'Ciudad') + array_column($cities,'name','id');
	    $html = form_dropdown('city',$options,'','class="filter-city form-control"');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}

}// endClass
