<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model 

{

    //-------------------------------------------------------------------

	// Get Ad Packages

	public function get_packages()
	{

		$this->db->select('*');

		$this->db->from('ci_packages');

		$this->db->order_by('sort_order');

		$query = $this->db->get();

		return $query->result_array();

	}

	//-----------------------------------------------

	// Get Categories

    function get_categories_list()

    {

   	   $this->db->from('ci_categories');

   	   $this->db->order_by('name');

	   $query = $this->db->get();

	   return $query->result_array();

    }	

    //-----------------------------------------------

	// Get Categories

    function get_blog_categories_list()

    {

   	   $this->db->from('ci_blog_categories');

   	   $this->db->order_by('name');

	   $query = $this->db->get();

	   return $query->result_array();

    }	

	//------------------------------------------------

	// Get Countries

	function get_countries_list($id=0)

	{

		if($id==0)

		{

			return  $this->db->get('ci_countries')->result_array();	

		}

		else

		{

			return  $this->db->select('id,country')->from('ci_countries')->where('id',$id)->get()->row_array();	

		}

	}	

	//------------------------------------------------
	// Get states
	
	function get_states_list($id=0)
	{
		if($id==0)
		{
			return  $this->db->get('ci_states')->result_array();	
		}
		else
		{
			return  $this->db->select('id,name')->from('ci_states')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------

	// Get Cities

	function get_cities_list($id=0)

	{

		if($id==0){

			return  $this->db->get('ci_cities')->result_array();	

		}

		else{

			return  $this->db->select('id,city')->from('ci_cities')->where('id',$id)->get()->row_array();	

		}

	}

	// Get ad by ID

	public function get_ad_by_id($id)
	{
		$this->db->select(
			'ci_ads.*,
			ci_categories.id as cat_id,
			ci_categories.name as category_name,
			ci_subcategories.id as subcat_id,
			ci_subcategories.name as subcategory_name,
			ci_users.id as seller_id,
			ci_users.firstname,
			ci_users.lastname,
			ci_users.contact,
			ci_users.email,
			ci_users.created_date as since,
		');
		$this->db->join('ci_categories','ci_categories.id = ci_ads.category');
		$this->db->join('ci_subcategories','ci_subcategories.id = ci_ads.subcategory','left');
		$this->db->join('ci_users','ci_users.id = ci_ads.seller');
		$this->db->where('ci_ads.id',$id);
		return $this->db->get('ci_ads')->row_array();
	}

	//-----------------------------------------------

	// Add Notification

    function add_notification($data)
    {

   	   $this->db->insert('ci_notifications',$data);

	   return true;

    }	

} // endClass

?>