<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model 

{

    //-------------------------------------------------------------------

	// Get Ad Packages

	public function insert_payment($data)
	{

		$this->db->insert('ci_payments',$data);

		return $this->db->insert_id();

	}

	
} // endClass

?>