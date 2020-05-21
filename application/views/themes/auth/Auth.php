<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model','auth_model');
		$this->load->model('common_model');
		$this->load->library('mailer'); // load custom mailer library
		$this->load->helper('email'); // load custom mailer library
	}

	//-------------------------------------------------------------------
	// login functionality
	public function login()
	{
		if($this->session->is_user_login)
		redirect(base_url());

		if ($this->input->post()) 
		{
			//validate inputs
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]|valid_email' );
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$response =  array('status' => 'error', 'msg' => strip_tags(validation_errors()));
				echo json_encode($response);
			}
			else{

				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password') 
				);

				$data = $this->security->xss_clean($data); // XSS Clean

				$result = $this->auth_model->login($data);
				
				if ($result['status']) {

					$login_data = array(
						'user_id' => $result['message']['id'],
						'email' => $result['message']['email'], 
						'password' => $result['message']['password'],
						'username' => $result['message']['username'],
						'fname' => $result['message']['firstname'],
						'lname' => $result['message']['lastname'],
						'country' => $result['message']['country'],
						'is_user_login' => TRUE
					);

					$this->session->set_userdata($login_data);

					// Send Login Alert Email

					$to = $login_data['email'];

					$result = $this->mailer->mail_template($to,'login-alert');

					// Ending Login Alert Email


					// redirected to last request page
					if(!empty($this->session->userdata('last_request_page')))
					{
						$back_to = $this->session->userdata('last_request_page');
						$response =  array('status' => 'success', 'msg' => 'Redireccionando...', 'redirect' => $back_to);
						echo json_encode($response);
						exit();
					}
					else
					{
						$redirect = base_url();
						$response =  array('status' => 'success', 'msg' => 'Redireccionando...', 'redirect' => $redirect);
						echo json_encode($response);
						exit();
					}
				}
				else
				{
					$response =  array('status' => 'error', 'msg' => $result['message']);
					echo json_encode($response);
					exit();
				}
			}
		}
		else
		{
			$data['title'] = trans('login');
			$this->load->view('themes/auth/login_page', $data);
		}
	}

	//-------------------------------------------------------------------------------
	// Registration Functionality
	public function registration()
	{
		if($this->session->is_user_login)
		redirect(base_url());

		if($this->input->post()) 
		{
			if ($this->recaptcha_status == true) {
	            if (!$this->recaptcha_verify_request()) {
	                $response =  array('status' => 'error', 'msg' => 'reCaptcha Error');
					echo json_encode($response);
	                exit();
	            }
	        }

	        //validate inputs
			$this->form_validation->set_rules('username','Username','trim|required|min_length[5]|is_unique[ci_users.username]');
			
			$this->form_validation->set_rules('email','email','trim|required|min_length[5]|valid_email|is_unique[ci_users.email]');

			$this->form_validation->set_rules('contact','Contact Number','trim|required|is_unique[ci_users.contact]|min_length[7]|max_length[12]');

			$this->form_validation->set_rules('country','Country','trim|required');

			$this->form_validation->set_rules('password','Password','trim|required|min_length[5]');

			$this->form_validation->set_rules('confirmpassword','confirm password','trim|required|min_length[5]|matches[password]');

			$this->form_validation->set_rules('terms_n_conditions','Terms & Conditions','trim|required');

			if ($this->form_validation->run() == FALSE) 
			{
				$response =  array('status' => 'error', 'msg' => strip_tags(validation_errors()));
				echo json_encode($response);
			}
			else
			{
				$created_date =  date('Y-m-d : h:m:s');

				$data = array(
					'username' => $this->input->post('username'),  
					'email' => $this->input->post('email'),
					'contact' => $this->input->post('contact'),
					'country' => $this->input->post('country'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_date' => $created_date,
				);

				$data = $this->security->xss_clean($data); // XSS Clean Data

				$user_id = $this->auth_model->insert_into_users($data);

				// Send Verification Email

					$this->mailer->send_verification_email($user_id);

				// Ending Email


				$redirect = base_url('login');

				$this->session->set_flashdata('success','Exito! Hemos enviado un enlace de verificación a tu correo electrónico.');

				$result =  array('status' => 'Exito', 'msg' => 'Redireccionando...', 'redirect' =>  $redirect );
				
				echo json_encode($result);
			}
		}
		else
		{
			$data['title'] = 'Registro';
			$data['countries'] = $this->common_model->get_countries_list();
			$this->load->view('themes/auth/registration_page', $data);
		}
	}

	//-----------------------------------------------
	public function validate_email($token)
	{
		$result = $this->auth_model->email_verification($token);
		if($result)
		{
			$this->session->set_flashdata('success','¡Correo verificado! Por favor inicie sesión con sus datos');
			redirect(base_url('login'));
		}
		else
		{
			redirect(base_url());
		}
	}

	//--------------------------------------------------		
	public function forgot_password()
	{
		if($this->session->is_user_login)
		redirect(base_url());
	
		if($this->input->post('submit')){

			//validate inputs
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('auth/forgot_password'));
			}

			$email = $this->input->post('email');

			$response = $this->auth_model->check_user_mail($email); // check if email exist

			if($response){
				$rand_no = rand(0,1000);
				$pwd_reset_code = md5($rand_no.$response['id']);
				$this->auth_model->update_reset_code($pwd_reset_code, $response['id']);

				// --- sending email

				$data = array(
					'username' => $response['username'],
					'reset_link' => base_url('auth/reset_password/'.$pwd_reset_code),
				);

				$resp = $this->mailer->mail_template($email,'forget-password',$data);

				if($resp){

					$this->session->set_flashdata('success', 'Hemos enviado instrucciones para restablecer tu contraseña a tu correo electrónico');

					redirect(base_url('auth/forgot_password'));
				}
				else{
					$this->session->set_flashdata('error', 'Hay un problema en tu correo electrónico');
					redirect(base_url('auth/forgot_password'));
				}
			}
			else{
				$this->session->set_flashdata('error', 'El correo ingresado no esta registrado');
				redirect(base_url('auth/forgot_password'));
			}
		}
		else{
			$data['title'] = 'Recuperar';
			$data['layout'] = 'themes/auth/forget_password_page';
			$this->load->view('themes/auth/forget_password_page', $data);
		}
	}

	//----------------------------------------------------------------		
	public function reset_password($id=0)
	{
		// check the activation code in database
		if($this->input->post('submit')){
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				$result = false;
				$data['reset_code'] = $id;
				$data['title'] = 'Recuperar';
				$this->load->view('themes/auth/reset_password_page', $data);
			}   
			else{
				$new_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$this->auth_model->reset_password($id, $new_password);
				$this->session->set_flashdata('success','La nueva contraseña se ha actualizado correctamente. Inicie sesión a continuación');
				redirect(base_url('auth/login'));
			}
		}
		else{
			$result = $this->auth_model->check_password_reset_code($id);
			if($result){
				$data['reset_code'] = $id;
				$data['title'] = 'Recuperar';
				$this->load->view('themes/auth/reset_password_page', $data);
			}
			else{
				$this->session->set_flashdata('error','El código de restablecimiento de contraseña no es válido o ha caducado');
				redirect(base_url('themes/auth/forgot_password'));
			}
		}
	}

	//----------------------------------------------------------------------------
	// Logout Function
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

	//----------------------------------------
	public function get_country_states()
	{
		$states = $this->db->select('*')->where('country_id',$this->input->post('country'))->get('ci_states')->result_array();
	    $options = array('' => 'Estado') + array_column($states,'name','id');
	    $html = form_dropdown('state',$options,'','class="form-control" required');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}

	//----------------------------------------
	public function get_state_cities()
	{
		$cities = $this->db->select('*')->where('state_id',$this->input->post('state'))->get('ci_cities')->result_array();
	    $options = array('' => 'Ciudad') + array_column($cities,'name','id');
	    $html = form_dropdown('city',$options,'','class="form-control" required');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}

}// endClass
