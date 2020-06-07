<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends Main_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('seller/ad_model','ad_model');
		$this->load->model('common_model'); // load common model 
		$this->load->library('mailer'); // load custom mailer library
		$this->load->helper('email');
	}

	//---------------------------------------------------------------------------------------
	public function add()
	{
		if(!$this->session->userdata('is_user_login'))
		{
			redirect('login');
		}

		if($this->input->post()){
		    
		    //  Set Custom Fields Validation Rules
		    if(isset($_POST['field']) && count($_POST) > 0):
				foreach ($_POST['field'] as $id) 
	        	{
		            $name = 'fd-'.$id;

		            $field = $this->db->select('*')->where('id',$id)->get('ci_fields')->row_array();

		            $required = ($field['required']) ? '|required' : '';

		            $length = ($field['length']) ? '|max_length['.$field['length'].']' : '';

		            $this->form_validation->set_rules($name, $field['name'], 'trim'.$required.$length);
	        	}
	         endif;

			$this->form_validation->set_rules('category', 'categoria', 'trim|required');

			$this->form_validation->set_rules('subcategory', 'sub categoria', 'trim');

			$this->form_validation->set_rules('title', 'titulo', 'trim|required|min_length[3]');

			$this->form_validation->set_rules('price', 'precio', 'trim|required|numeric');

			$this->form_validation->set_rules('tags', 'tags', 'trim|min_length[3]');

			$this->form_validation->set_rules('description', 'discripcion', 'trim|required|min_length[20]');

			$this->form_validation->set_rules('package', 'paquete', 'trim|required');

			$this->form_validation->set_rules('country', 'pais', 'trim|required');

			$this->form_validation->set_rules('state', 'estado', 'trim|required');

			$this->form_validation->set_rules('city', 'ciudad', 'trim|required');

			$this->form_validation->set_rules('address', 'direccion exacta', 'trim');

			$this->form_validation->set_rules('address-lang', 'direccion no encontrada', 'trim');


			if ($this->form_validation->run() == FALSE) {
                
                $response =  array('status' => 'error', 'msg' => strip_tags(validation_errors()));
				echo json_encode($response);
			}
			else
			{

				
				$user_id = $this->session->userdata('user_id');
				$slug = make_slug($this->input->post('title'));
				$package_id = $this->input->post('package');
				$payment_method = $this->input->post('payment_method');

				$data = array(
					'category' => $this->input->post('category'),
					'subcategory' => $this->input->post('subcategory'),
					'title' => ucwords($this->input->post('title')),
					'slug' => $slug,
					'price' => $this->input->post('price'),
					'negotiable' => $this->input->post('negotiable'),
					'tags' => (!empty($this->input->post('tags'))) ? $this->input->post('tags') : NULL,
					'description' => $this->input->post('description'),
					'seller' => $user_id,
					'is_featured' => is_featured_package($package_id),
					'package' => $package_id,
					'country' => $this->session->userdata('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('address'),
					'lang' => $this->input->post('address-lang'),
					'lat' => $this->input->post('address-lat'),
					'expiry_date' => create_package_expiry_date($package_id)
				);

				// Images

				$path = "assets/ads/";

				// check all mendatory files
				if(empty($_FILES['img_1']['name']))
				{
				    $response =  array('status' => 'error', 'msg' => 'Al menos una imagen es obligatoria');
				    echo json_encode($response);
				    exit();
				}

				// thumbnail picture
				if(!empty($_FILES['img_1']['name']))
				{
					$result = $this->functions->post_file_insert($path, 'img_1', '3000');
					if($result['status'] == 1){
						$data['img_1'] = $path.$result['msg'];
					}
					else
					{
					    $response =  array('status' => 'error', 'msg' => $result['msg']);
				        echo json_encode($response);
				        exit();
					}
				}

				//  picture
				if(!empty($_FILES['img_2']['name']))
				{
					$result = $this->functions->post_file_insert($path, 'img_2', '3000');
					if($result['status'] == 1){
						$data['img_2'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
				        echo json_encode($response);
				        exit();
					}
				}

				//  picture
				if(!empty($_FILES['img_3']['name']))
				{
					$result = $this->functions->post_file_insert($path, 'img_3', '3000');
					if($result['status'] == 1){
						$data['img_3'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
				        echo json_encode($response);
				        exit();
					}
				}

				//  picture
				if(!empty($_FILES['img_4']['name']))
				{
					$result = $this->functions->post_file_insert($path, 'img_4', '3000');
					if($result['status'] == 1){
						$data['img_4'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
				        echo json_encode($response);
				        exit();
					}
				}

				//  picture
				if(!empty($_FILES['img_5']['name']))
				{
					$result = $this->functions->post_file_insert($path, 'img_5', '3000');
					if($result['status'] == 1){
						$data['img_5'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
				        echo json_encode($response);
				        exit();
					}
				}

				$data = $this->security->xss_clean($data);

				$ad_id = $this->ad_model->add_ad($data);
				
				$slug = $slug.'-'.$ad_id;
				
				$this->ad_model->update_ad_slug_by_id($slug,$ad_id);

				// CUSTOM FIELDS
				
				if(isset($_POST['field']) && count($_POST['field']) > 0)
				{

					foreach ($_POST['field'] as $index) {

					$field_name = 'fd-'.$index;

						$field_data = array(
							'field_id' => $index,
							'field_value' => (is_array($_POST[$field_name])) ? implode(',', $_POST[$field_name]) : $_POST[$field_name]
						);

						$field_data['ad_id'] = $ad_id;

						$field_data = $this->security->xss_clean($field_data);

						$this->ad_model->add_ad_field_detail($field_data);

					}
				}
			
				// MAKE PAYMENT
				if($payment_method == '6')
				{
					$payment_result = $this->pay_with_stripe($package_id,$ad_id,$payment_method);
					$payment = $payment_result['status'];
				}
				else
				{
				    $payment = true;
				}

			    if($payment)
			    {
    				// Send Email
    
    					$to = $this->session->userdata('email');
    
    					$mail_data = array(
    						'username' => $this->session->userdata('username'),
    						'post_title' => $data['title'],
    					);
    
    					$template = $this->mailer->mail_template($to,'ad-post',$mail_data);
    
    				// Ending Email

    				// User Notification
    					$notification = array(
    						'user_id' => $user_id,
    						'content' => 'Tu Anuncio <b>'.$data['title'].'</b> esta pendiente por aprobacion'
    					);
    					$this->common_model->add_notification($notification);
    
    				// End Notification
                    
                    $response =  array('status' => 'success', 'msg' => 'Tu anuncio fue publicado');
			        echo json_encode($response);
			    }
			    else
			    {
			        $response =  array('status' => 'error', 'msg' => $payment_result['message']);
			        echo json_encode($response);
			    }
			}
		}
		else
		{
			$data['countries'] = $this->common_model->get_countries_list();

			$data['packages'] = $this->common_model->get_packages();

			$data['title'] = 'Anuncio gratuito';

			$data['layout'] = 'themes/ads/ad_add';

			$this->load->view('themes/layout', $data);
		}
	}

	//-----------------------------------------------------------------------------------------
	// Edit Ad
	public function edit($ad_id=0)
	{
		$data['countries'] = $this->common_model->get_countries_list();
		$data['packages'] = $this->common_model->get_packages();
		$user_id = $this->session->userdata('user_id');

		if($this->input->post()){
		    
		     //  Set Custom Fields Validation Rules
		    if(isset($_POST['field']) && count($_POST) > 0):
				foreach ($_POST['field'] as $id) 
	        	{
		            $name = 'fd-'.$id;

		            $field = $this->db->select('*')->where('id',$id)->get('ci_fields')->row_array();

		            $required = ($field['required']) ? '|required' : '';

		            $length = ($field['length']) ? '|max_length['.$field['length'].']' : '';

		            $this->form_validation->set_rules($name, $field['name'], 'trim'.$required.$length);
	        	}
	         endif;

			$this->form_validation->set_rules('category', 'categoria', 'trim|required');

			$this->form_validation->set_rules('subcategory', 'subcategoria', 'trim');

			$this->form_validation->set_rules('title', 'titulo', 'trim|required|min_length[3]');

			$this->form_validation->set_rules('price', 'precio', 'trim|required|numeric');

			$this->form_validation->set_rules('tags', 'tags', 'trim|min_length[3]');

			$this->form_validation->set_rules('description', 'descripcion', 'trim|required|min_length[20]');

			$this->form_validation->set_rules('country', 'pais', 'trim|required');

			$this->form_validation->set_rules('state', 'estado', 'trim|required');

			$this->form_validation->set_rules('city', 'ciudad', 'trim|required');

			$this->form_validation->set_rules('address', 'direccion exacta', 'trim');

			if ($this->form_validation->run() == FALSE) {

				$response =  array('status' => 'error', 'msg' => strip_tags(validation_errors()));
				echo json_encode($response);
			}
			else
			{
				$slug = make_slug($this->input->post('title'));

				$data = array(
					'category' => $this->input->post('category'),
					'subcategory' => $this->input->post('subcategory'),
					'title' => ucwords($this->input->post('title')),
					'slug' => $slug,
					'price' => $this->input->post('price'),
					'negotiable' => $this->input->post('negotiable'),
					'tags' => (!empty($this->input->post('tags'))) ? $this->input->post('tags') : NULL,
					'description' => $this->input->post('description'),
					'is_featured' => is_featured_package($this->input->post('package')),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('address'),
					'lang' => $this->input->post('address-lang'),
					'lat' => $this->input->post('address-lat'),
				);

				// Images

				$path = "assets/ads/";

				// check all mendatory files
				if(empty($_POST['old_img_1']))
				{
					$response =  array('status' => 'error', 'msg' => 'Se requiere de al menos una imagen');
					echo json_encode($response);
				}

				// update pictures
				if(!empty($_FILES['img_1']['name']))
				{
					unlink($this->input->post('old_img_1'));
					
					$result = $this->functions->post_file_insert($path, 'img_1', '3000');
					if($result['status'] == 1){
						$data['img_1'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
						echo json_encode($response);
					}
				}

				if(!empty($_FILES['img_2']['name']))
				{
					if(!empty($_POST['old_img_2']))
					unlink($this->input->post('old_img_2'));
					
					$result = $this->functions->post_file_insert($path, 'img_2', '3000');
					if($result['status'] == 1){
						$data['img_2'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
						echo json_encode($response);
					}
				}

				if(!empty($_FILES['img_3']['name']))
				{
					if(!empty($_POST['old_img_3']))
					unlink($this->input->post('old_img_3'));
					
					$result = $this->functions->post_file_insert($path, 'img_3', '3000');
					if($result['status'] == 1){
						$data['img_3'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
						echo json_encode($response);
					}
				}

				if(!empty($_FILES['img_4']['name']))
				{
					if(!empty($_POST['old_img_4']))
					unlink($this->input->post('old_img_4'));
					
					$result = $this->functions->post_file_insert($path, 'img_4', '3000');
					if($result['status'] == 1){
						$data['img_4'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
						echo json_encode($response);
					}
				}

				if(!empty($_FILES['img_5']['name']))
				{
					if(!empty($_POST['old_img_5']))
					unlink($this->input->post('old_img_5'));
					
					$result = $this->functions->post_file_insert($path, 'img_5', '3000');
					if($result['status'] == 1){
						$data['img_5'] = $path.$result['msg'];
					}
					else
					{
						$response =  array('status' => 'error', 'msg' => $result['msg']);
						echo json_encode($response);
					}
				}
				
				$slug = $slug.'-'.$ad_id;
				
				$this->ad_model->update_ad_slug_by_id($slug,$ad_id);

				$data = $this->security->xss_clean($data);

				$this->ad_model->edit_ad($data,$ad_id);

				// CUSTOM FIELDS
				
				if(isset($_POST['field']) && count($_POST['field']) > 0)
				{

					$this->ad_model->delete_ad_field_detail($ad_id);

					foreach ($_POST['field'] as $index) {

					$field_name = 'fd-'.$index;

						$field_data = array(
							'field_id' => $index,
							'field_value' => (is_array($_POST[$field_name])) ? implode(',', $_POST[$field_name]) : $_POST[$field_name]
						);

						$field_data['ad_id'] = $ad_id;

						$field_data = $this->security->xss_clean($field_data);

						$this->ad_model->add_ad_field_detail($field_data);

					}
				}

				// User Notification
					$notification = array(
						'user_id' => $user_id,
						'content' => 'Tu anuncio <b>'.ucwords($this->input->post('title')).'</b> Fue actualizado'
					);
					$this->common_model->add_notification($notification);

				// End Notification

				$response =  array('status' => '', 'msg' => 'Tu anuncio fue actualizado');
				echo json_encode($response);
			}
		}
		else{

			$data['post'] = $this->ad_model->get_ad_by_id($ad_id,$user_id);
			$data['other_detail'] = $this->ad_model->get_ad_other_detail_by_id($ad_id);

			if(!$data['post'])
			{
				$this->session->set_flashdata('error','Solicitud inválida');
				redirect('profile/ads');
			}

			$data['title'] = 'Edit Ad';
			$data['layout'] = 'themes/ads/ad_edit';
			$this->load->view('themes/layout', $data);
		}
	}

	//-----------------------------------------------------------------------------------------
	// Delete Ad
	public function delete($id=0)
	{
		$user_id = $this->session->userdata('user_id');

		$data = $this->db->get_where('ci_ads',array('id' => $id,'seller' => $user_id))->row_array();

		if(!empty($data['img_1']))
			unlink($data['img_1']);

		if(!empty($data['img_2']))
			unlink($data['img_2']);

		if(!empty($data['img_3']))
			unlink($data['img_3']);

		if(!empty($data['img_4']))
			unlink($data['img_4']);

		if(!empty($data['img_5']))
			unlink($data['img_5']);

		$this->db->where('id',$id);
		$this->db->where('seller',$user_id);
		$this->db->delete('ci_ads');

		$this->session->set_flashdata('success','El anuncio fue eliminado');

		redirect(base_url('profile/ads'));

	}

	/*
		STRIPE PAYMENT METHOD
	*/

    public function pay_with_stripe($package_id,$ad_id,$payment_method)
    {
            //get token, card and user info from the form
            $user_id = $this->session->userdata('user_id');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $card_num = $this->input->post('card-number');
            $card_cvc = $this->input->post('card-cvc');
            $card_exp_month = $this->input->post('card-expiry-month');
            $card_exp_year = $this->input->post('card-expiry-year');

            //include Stripe PHP library
            require_once APPPATH."third_party/stripe/init.php";
            
            //set api key
            $this->CI =& get_instance();

            $stripe_secret_key = $this->general_settings['secrate_key'];
            $stripe_publish_key = $this->general_settings['publishable_key'];
            $stripe = array(
                "secret_key"      => $stripe_secret_key,
                "publishable_key" => $stripe_publish_key
            );
            
            $key = \Stripe\Stripe::setApiKey($stripe['secret_key']);
            
            // get token
            $token = \Stripe\Token::create([
			  'card' => [
			    'number' => $card_num,
			    'exp_month' => $card_exp_month,
			    'exp_year' => $card_exp_year,
			    'cvc' => $card_cvc
			  ]
			]);
			
			try {
			     //add customer to stripe
                $customer = \Stripe\Customer::create(array(
                    'email' => $email,
                    'source'  => $token
                ));
			}
            catch(Stripe_CardError  $e) {
              $error = $e->getMessage();
            } catch (Stripe_InvalidRequestError $e) {
              // Invalid parameters were supplied to Stripe's API
              $error = $e->getMessage();
            } catch (Stripe_AuthenticationError $e) {
              // Authentication with Stripe's API failed
              $error = $e->getMessage();
            } catch (Stripe_ApiConnectionError $e) {
              // Network communication with Stripe failed
              $error = $e->getMessage();
            } catch (Stripe_Error $e) {
              // Display a very generic error to the user, and maybe send
              // yourself an email
              $error = $e->getMessage();
            } catch (Stripe_Validation_Error $e) {
              //Errors triggered by our client-side libraries when failing to validate fields 
              //(e.g., when a card number or expiration date is invalid or incomplete).
              $error = $e->getMessage();
            } catch (Exception $e) {
              // Something else happened, completely unrelated to Stripe
              $error = $e->getMessage();
            }
           
            if (isset($error))
            {
                return array('status' => false,'message' => $error);
            }
            
            // Package

			$package = $this->ad_model->get_package_detail_by_id($package_id);
			
			$price = $package['price'];
				
            //item information
            $item_name = $package['title'];
            $item_number = 1;
            $item_price = $price;
            $order_id = time().mt_rand().$user_id;
            $currency = get_currency_short_code($this->general_settings['currency']);

            //charge a credit or a debit card
            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $item_price,
                'currency' => $currency,
                'description' => $item_number,
                'metadata' => array(
                    'item_id' => $item_number
                )
            ));
            
            //retrieve charge details
            $chargeJson = $charge->jsonSerialize();

            //check whether the charge is successful
            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
            {
                //order details 
                $amount = $chargeJson['amount'];
                $balance_transaction = $chargeJson['balance_transaction'];
                $currency = $chargeJson['currency'];
                $status = $chargeJson['status'];
                
				// Save into DB
				
    			$payment_data = array(
    				'user_id' => $user_id,
    				'txn_id' => $balance_transaction,
    				'package_id' => $package_id,
    				'invoice_no' => 'INV-100'.$ad_id,
    				'ad_id' => $ad_id,
    				'sub_total' => number_format($price,2),
    				'grand_total' => number_format($price,2),
    				'currency' => $currency,
    				'payment_method' => $payment_method,
    				'payment_status' => $status,
    				'payer_email' => $email,
    				'created_date' => date('Y-m-d'),
    				'due_date' => date('Y-m-d',strtotime('+'.$package['no_of_days'].' days')),
    			);
    
    			$payment_data = $this->security->xss_clean($payment_data);
    
    			$this->ad_model->add_payment($payment_data);

                if($status == 'succeeded'){
                    return array('status' => true,'message' => 'Payment has been paid successfully');
                } else {
                    return array('status' => false,'message' => 'Payment paid. Error while saving payment data at local database');
                }


            }
            else
            {
                $package_id = $this->input->post('item_number');
                $this->session->set_flashdata('errors', 'Invalid Token');
                return false;
            }
    }

	// Rating

	public function update_rating()
	{

		$data = array(

			'user_id' => $this->input->post('user_id'),

			'ad_id' => $this->input->post('ad_id'),

			'rating' => $this->input->post('rating_value'),

		);

		$data = $this->security->xss_clean($data);

		$this->ad_model->update_ad_rating($data);
	}

	//---------------------------------------------------------------------
	// Save Favorite
	public function save_favorite()
	{
		if($this->input->post())
		{
			if(!$this->session->userdata('is_user_login')){
				echo 'not_login';
				exit();
			}
				
			$data = array(
				'ad_id' => $this->input->post('ad_id'),
				'user_id' => $this->session->userdata('user_id'),
			);

			$result = $this->ad_model->save_favorite($data);

			if($result){
				echo 'saved';
				exit();
			}
			else
			{
				echo 'removed';
				exit();
			}
		}
	}

}// endclass