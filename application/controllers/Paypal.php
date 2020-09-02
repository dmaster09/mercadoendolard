<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends Main_Controller 
{

     function  __construct(){

        parent::__construct();
        $this->load->helper('email_helper');
        $this->load->library('mailer');
        $this->load->library('paypal_lib');
        $this->load->model('Payment_model','payment_model');
		$this->load->model('seller/ad_model','ad_model');
		$this->load->model('common_model','common_model');

     }

     //--------------------------------------------------------------------

    public function success(){

		if($_POST) 
		{
			// print_r($_POST);
			
			if(strtolower($_POST['payment_status']) == 'completed'):

			    $ad_id = $_POST['item_number1'];
			    $package_id = $_POST['custom'];

			   	$package_detail = $this->ad_model->get_package_detail_by_id($package_id);
			    $no_of_days = $package_detail['no_of_days'];


			    $payment_data = array(

			    	'payment_method' => '1',

			    	'invoice_no' => 'INV-100'.$ad_id,

			    	'txn_id' => $_POST['txn_id'],

			    	'user_id' => $this->session->user_id,

			    	'currency' => $_POST['mc_currency'],

			    	'grand_total' => $_POST['payment_gross'],

			    	'payer_email' => $_POST['payer_email'],

			    	'payment_status' => $_POST['payment_status'],

			    	'package_id' => $package_id,

			    	'ad_id' => $ad_id,

			    	'client_note' => strtolower($_POST['item_name1']),

			    	'created_date' => date('Y-m-d H:i:s',strtotime($_POST["payment_date"])),

			    );


			   	$payment_id = $this->payment_model->insert_payment($payment_data);

    //             $ad_expiret = array('package'=>$package_id,'expiry_date' => create_package_expiry_date($package_id));
				// $ad_expiret = $this->security->xss_clean($ad_expiret);
				// $this->ad_model->edit_ad($ad_expiret,$ad_id);

			    $ad = $this->common_model->get_ad_by_id($ad_id);
			   	
		   		// Send Email
	    		$data['title'] = $ad['title'];
				$to = $this->session->userdata('email');

				$mail_data = array(
					'content' => 'Tu Publicación <b>'.$data['title'].'</b> está pendiente por Aprobación ',
				);
              if(!$this->config->item('develop')){
				$template = $this->mailer->mail_template($to,'general-notification',$mail_data);
			 }

				// Ending Email

				// User Notification
					$notification = array(
						'user_id' => $this->session->user_id,
						'content' => $mail_data['content']
					);
					$this->common_model->add_notification($notification);

				// End Notification

				$this->ad_model->update_paypal_ad_status($ad_id);
				
				$this->session->set_flashdata('success','Tu Publicación ha sido Creada Exitosamente');
			    redirect(base_url('profile/ads'));

		   	endif;// if status is completed

		}// if post
		else
		{
			$this->session->set_flashdata('error','Invalid Request');
			redirect(base_url('seller/ads/add'));
		}
    }

    public function cancel()
    {
    	$this->session->set_flashdata('error','Pago Cancelado. Intentar de Nuevo');
		redirect(base_url('seller/ads/add'));
    }
}
?>