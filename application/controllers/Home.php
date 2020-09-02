<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('ad_model'); // load job model
		$this->load->model('common_model');
	}

	//-----------------------------------------------------------------------------
	// Index funciton will call bydefault
	public function index()
	{	
		$data['testimonials'] = $this->home_model->get_testimonials();
		$data['packages'] = $this->common_model->get_packages();
		$data['ads'] = $this->home_model->get_current_ads(12,0);
		$data['featured'] = $this->home_model->get_featured_ads(10,0);
		$data['hot'] = $this->home_model->get_hot_ads(5,0);
		$data['categories'] =  $this->home_model->get_home_page_categories();
		
		$data['title'] = trans('home');
		$data['layout'] = 'themes/home';
		$this->load->view('themes/layout', $data);
	}

	// --------------------------------------------------------------------------
	// Add Subscriber 
	public function add_subscriber()
	{
		if ($this->input->post())
		{
			$this->form_validation->set_rules('email','email','trim|required|valid_email');

			if ($this->form_validation->run() == FALSE) {

				$response =  array('status' => 'error', 'msg' => strip_tags(validation_errors()));

				echo json_encode($response);
			}
			else
			{
				$data = array(
					'email' => $this->input->post('email'),
					'created_at' => date('Y-m-d h:i:s')
				);

				$this->home_model->add_subscriber($data);

				$this->session->set_flashdata('success_subscriber','Your email added successfully!');
				$response =  array('status' => 'success', 'msg' => 'Your email added successfully!');

				echo json_encode($response);
			}
		}
	}

	//  Dynamic Pages
	public function page($slug = '')
	{
		$data['body'] = $this->home_model->get_page_by_slug($slug);

		$data['title'] = $data['body']['title'];
		$data['layout'] = 'themes/blank_page';
		$this->load->view('themes/layout', $data);
	}

	//-----------------------------------------------------------------------------
	// Services Page
	public function services()
	{
		$data['title'] = trans('services');
		$data['layout'] = 'themes/services';
		$this->load->view('themes/layout', $data);
	}

	//-----------------------------------------------------------------------------
	// Contact Us Functionality
	public function contact()
	{
		if ($this->input->post('submit'))
		{
			$this->form_validation->set_rules('username','first name','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]');
			$this->form_validation->set_rules('subject','last name','trim|required|min_length[3]');
			$this->form_validation->set_rules('message','message','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_send', $data['errors']);

				redirect(base_url('contact'),'refresh');
			}
			else
			{
				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // XSS Clean Data

				$result = $this->home_model->contact($data);

				if ($result) 
				{

					// email code
					$this->load->helper('email_helper');

					$to = $this->general_settings['admin_email'];
					$subject = 'Contact Us | '.$this->general_settings['application_name'];
					$message =  '<p>Username: '.$data['username'].'</p> 
					<p>Email: '.$data['email'].'</p>
					<p>Message: '.$data['message'].'</p>' ;

					sendEmail($to, $subject, $message, $file = '' , $cc = '');

					$this->session->set_flashdata('success','<p class="alert alert-success"><strong>Exito! </strong>Tu mensaje ha sido enviado!</p>');
					redirect(base_url('contact'), 'refresh');
				}
				else
				{
					redirect(base_url('contact'), 'refresh');
				}
			}
		}
		else
		{
			$data['title'] = trans('contact');
			$data['layout'] = 'themes/contact_us';
			$this->load->view('themes/layout', $data);
		}
	}

	//set site language
    public function set_site_language($lang_id)
    {
        $this->session->set_userdata("site_lang", $lang_id);
        redirect(base_url());
    }

    // -------------------------------------------
	// Error 404
	public function error_404()
	{
		$data['title'] = trans('404_error');
		$data['layout'] = 'themes/404';
		$this->load->view('themes/layout', $data);
	}

	/***********************
	 CRON JOBS
	***********************/
	public function auto_post_expire_cj()
	{
		/*$this->load->model('admin/employer_model', 'employer_model');*/
        $array = array('expiry_date <' => date('Y-m-d H:i'), 'is_status =' => 1);
		$pending_jobs = $this->db->get_where('ci_ads',$array)->result_array();
		
		//$pending_jobs= $this->db->get('ci_ads')->row_array();
		
  //      print_r($this->db->last_query()); 
		// exit;
		$cont=0;
		foreach ($pending_jobs as $job) 
		{
   
			$this->db->where('id',$job['id']);
			$this->db->update('ci_ads',array('is_status' => 2));
			$cont=$cont+1;

			
			//echo "hi";
			// $created  = date('Y-m-d H:i',strtotime(' + 20 minutes',strtotime($job['created_date'])));
			// $now = date('Y-m-d H:i');

			// if ($now >= $created) 
			// {
			// 	$this->db->where('id',$job['id']);
			// 	$this->db->update('ci_ads',array('is_status' => 2));
				
			// 	// $emp_info = $this->employer_model->get_employer_by_id($job['employer_id']);
			// 	// $email = $emp_info['email'];
			// 	// $data['link'] = base_url('employers/auth/login');
			// 	// $data['message'] = 'Felicitaciones, tu anuncio fue aprovado.';
			// 	// $subject = 'Nota - Notificaion de Aprobación de anuncio';

			// 	// $mail_html = $this->load->view('admin/mails/general_notification',$data,true);

			// 	// sendEmail($emp['email'],$subject,$mail_html);

			// }
		}

		echo "Saludos Mercadoendolard Tus anuncios Verificados con fechas expiradas son un total de:".$cont;
	}
	
}// endClass
