<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

	// registraion
	public function insert_into_users($data)
	{
		$this->db->insert('ci_users',$data);
		return $this->db->insert_id();
	}

	// login function
	public function login($data)
	{
		$query = $this->db->get_where('ci_users', array('email' => $data['email']));
		
		if ($query->num_rows() == 0){
			return array('status' => false, 'message' => 'Usuario o contraseña incorrectos');
		}
		else{
			//Compare the password attempt with the password we have stored.
			$result = $query->row_array();
		    $validPassword = password_verify($data['password'], $result['password']);
		    if($validPassword){
		        $result = $query->row_array();

		        if($result['is_verify'] == 0)
		        {
		        	return array('status' => false, 'message' => 'Debes verificar tu correo primero');
		        }
		        else
		        {
			        if($result['is_active'] == 0)
			        return array('status' => false, 'message' => 'Tu cuenta fue bloqueada por MercadoenDolar.com');
			        else
			        return array('status' => true, 'message' => $result);
			    }
		    }
			else
			{
				return array('status' => false, 'message' => 'Usuario o contraseña incorrectos');
			}
		}
	}

	//--------------------------------------------------------------------
	public function email_verification($code)
	{
		$this->db->select('email, token, is_active');
		$this->db->from('ci_users');
		$this->db->where('token', $code);
		$query = $this->db->get();
		$result= $query->result_array();
		$match = count($result);
		if($match > 0){
			$this->db->where('token', $code);
			$this->db->update('ci_users', array('is_verify' => 1, 'token'=> ''));
			return true;
		}
		else{
			return false;
			}
	}

	//============ Check User Email ============
    function check_user_mail($email)
    {
    	$result = $this->db->get_where('ci_users', array('email' => $email));

    	if($result->num_rows() > 0){
    		$result = $result->row_array();
    		return $result;
    	}
    	else {
    		return false;
    	}
    }

    //============ Update Reset Code Function ===================
    public function update_reset_code($reset_code, $user_id)
    {
    	$data = array('password_reset_code' => $reset_code);
    	$this->db->where('id', $user_id);
    	$this->db->update('ci_users', $data);
    }

    //============ Activation code for Password Reset Function ===================
    public function check_password_reset_code($code)
    {

    	$result = $this->db->get_where('ci_users',  array('password_reset_code' => $code ));
    	if($result->num_rows() > 0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    
    //============ Reset Password ===================
    public function reset_password($id, $new_password){
	    $data = array(
			'password_reset_code' => '',
			'password' => $new_password
	    );
		$this->db->where('password_reset_code', $id);
		$this->db->update('ci_users', $data);
		return true;
    }
    
}

?>