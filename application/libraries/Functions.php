<?php
	class Functions 
	{
		function __construct()
		{
			$this->obj =& get_instance(); 
		}

		//--------------------------------------------------------
		// Paginaiton function 
		public function pagination_config($url,$count,$perpage) 
		{
			$config = array();
			$config["base_url"] = $url;
			$config["total_rows"] = $count;
			$config["per_page"] = $perpage;
			$config['full_tag_open'] = '<ul class="pagination pagination-split">';
			$config['full_tag_close'] = '</ul>';
			$config['prev_link'] = '&lt;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&gt;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			$config['first_link'] = '&lt;&lt;';
			$config['last_link'] = '&gt;&gt;';
			return $config;
		}


		// --------------------------------------------------------------
		/*
		* Function Name : File Upload
		* Param1 : Location
		* Param2 : HTML File ControlName
		* Param3 : Extension
		* Param4 : Size Limit
		* Return : FileName
		*/
	   
		function file_insert($location, $controlname, $type, $size)
		{
			$return = array();
			$type = strtolower($type);
			if(isset($_FILES[$controlname]) && $_FILES[$controlname]['name'] != NULL)
	        {
				$filename = $_FILES[$controlname]['name'];
				$file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
				$filesize = $_FILES[$controlname]["size"];	
						
				if($type == 'image')
				{
					if($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'gif')
					{
						if ($filesize <= $size) 
						{
							$return['msg'] = $this->file_upload($location, $controlname);
							$return['status'] = 1;
						}
						else
						{
							$size=$size/1024;
							$return['msg'] = 'File must be smaller then  '.$size.' KB';
							$return['status'] = 0;
						}
					}
					else
					{
						$return['msg'] = 'File Must Be In jpg,jpeg,png,gif Format';
						$return['status'] = 0;
						
					}
				}
				elseif($type == 'pdf')
				{
					if($file_extension == 'pdf')
					{
						if ($filesize <= $size) 
						{
							$return['msg'] = $this->file_upload($location, $controlname);
							$return['status'] = 1;
						}
						else
						{
							$size = $size/1024;
							$return['msg'] = 'File must be smaller then  '.$size.' KB';
							$return['status'] = 0;
						}
					}
					else
					{
						$return['msg'] = 'File Must Be In PDF Format';
						$return['status'] = 0;	
					}
				}
				elseif($type == 'excel')
				{
					if( $file_extension == 'xlsx' || $file_extension == 'xls')
					{
						if ($filesize <= $size) 
						{
							$return['msg'] = $this->file_upload($location, $controlname);
							$return['status'] = 1;
							
						}
						else
						{
							$size = $size/1024;
							$return['msg'] = 'File must be smaller then  '.$size.' KB';
							$return['status'] = 0;
						}
					}
					else
					{
						$return['msg'] = 'File Must Be In Excel Format Only allow .xlsx and .xls extension';
						$return['status'] = 0;
					}
				}
				elseif($type == 'doc')
				{
					if( $file_extension == 'doc' || $file_extension == 'docx' || $file_extension == 'txt' || $file_extension == 'rtf')
					{
						if ($filesize <= $size) 
						{
							$return['msg'] = $this->file_upload($location, $controlname);
							$return['status'] = 1;
						}
						else
						{
							$size=$size/1024;
							$return['msg'] = 'File must be smaller then  '.$size.' KB';
							$return['status'] = 0;
						}
					}
					else
					{
						$return['msg'] = 'File Must Be In doc,docx,txt,rtf Format'; 
						$return['status'] = 0;		
					}
				}
				else
				{
					$return['msg'] = 'Not Allow other than image,pdf,excel,doc file..';
					$return['status'] = 0;	
				}

			}
	        else
	        {
	            $return['msg'] = '';
				$return['status'] = 1;
	        }
			return $return;
		}
		
		// --------------------------------------------------------------
		/*
		* Function Name : Post File Upload
		* Param1 : Location
		* Param2 : HTML File ControlName
		* Param3 : Size Limit
		* Return : FileName
		*/
	   
		function post_file_insert($location, $controlname, $size)
		{	$CI = & get_instance();
            $CI->load->library('image_lib');
			$return = array();

			if(isset($_FILES[$controlname]) && $_FILES[$controlname]['name'] != NULL)
	        {
				// configuration
				$config['upload_path'] = $location;
				$config['encrypt_name'] = true;
				$config['overwrite'] = true;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']     = $size;
				$config['min_width'] = '360';
				$config['min_height'] = '220';
				$this->obj->load->library('upload',$config);

    

				if($this->obj->upload->do_upload($controlname))
				{

					$name=$this->obj->upload->data('file_name');//nombre de imagen
					$path=$this->obj->upload->data('file_path');//ruta


					$config2['image_library'] = 'gd2';
                    $config2['source_image'] =  $path.$name; // le decimos donde esta la imagen que acabamos de subir
                    $config2['new_image']=$path.'/thumbs'; // las nuevas imágenes se guardan en la carpeta "thumbs"
                    $config2['create_thumb'] = FALSE;
                    $config2['maintain_ratio'] = TRUE;
                    $config2['quality']='60%';             
                    
                     
                     $config2['width'] = '800';
                     $config2['height'] =  '600';
					//$this->obj->image_lib->library('image_lib', $config2);
					$CI->image_lib->clear();
					$CI->image_lib->initialize($config2);
       
                     if (!$CI->image_lib->resize())
                    {
                      $return['msg'] = $CI->image_lib->display_errors();
					  $return['status'] = 0;
                   }
       
                    if($CI->image_lib->resize()){
					/*asigno imagen renderizada y elimino la original*/
				   
					$CI->image_lib->clear(); 
					
					$origen=$path.'thumbs/'.$this->obj->upload->data('file_name');
					$origen2=$_FILES[$controlname]['tmp_name'];//leer metadatos;
					$imagen_principal=$this->obj->upload->data('file_name');

					$return['msg'] =  'thumbs/'.$this->obj->upload->data('file_name');					
				    $return['status'] = 1;
				    // list($ancho, $alto) = getimagesize($origen);
				    // echo $width."-".$height;
				    // exit;
				    $exif = exif_read_data($origen2);

				    if(!empty($exif['Orientation'])) {
                    $config2=array();
                    $config2['image_library']   = 'gd2';
                    $config2["create_thumb"] = FALSE; 
				    $config2["source_image"] =$origen;

                    
                    switch($exif['Orientation']) {
                      case 1: // fila 0 = arriba, columna 0 = lado izquierdo
                        $config2["rotation_angle"] = "0";
                      break;
                      case 2: // fila 0 = arriba, columna 0 = lado derecho
                        $config2["rotation_angle"] = "0";
                      break;
                      case 3: // fila 0 = abajo, columna 0 = lado derecho
                        $config2["rotation_angle"] = "90";
                      break;
                      case 4: // fila 0 = abajo, columna 0 = lado izquierdo
                        $config2["rotation_angle"] = "180";
                       break;
                       case 5: // fila 0 = lado izquierdo, columna 0 = arriba
                        $config2["rotation_angle"] = "90";
                       break;
                       case 6: // fila 0 = lado derecho, columna 0 = arriba
                         $config2["rotation_angle"] = "270";
                       break;
                       case 7: // fila 0 = lado derecho, columna 0 = abajo
                        $config2["rotation_angle"] = "270";
                       break;
                       case 8: // fila 0 = lado izquierdo, columna 0 = abajo
                        $config2["rotation_angle"] = "270";
                       break;
                       default:
                        $config2["rotation_angle"] = "0";
                        break;
                    }
                    
                 
                    $CI->image_lib->initialize($config2);
					$CI->image_lib->rotate();
				}
				    


				    unlink($path.$name);
				    //eliminamos la imagen no renderizada

				    }else{
				    $return['msg'] = $this->obj->upload->data('file_name');
				    $return['status'] = 1;
				    }

				}
				else
				{
					$return['msg'] = $this->obj->upload->display_errors();
					$return['status'] = 0;
				}
			}
	        else
	        {
	    		$return['msg'] = '';
				$return['status'] = 1;
	        }

			return $return;
		}


		/*
		* Function Name : File Delete
		* Param1 : Location
		* Param2 : OLD Image Name
		*/
		
		public function delete_file($oldfile)
	    {		
			if($oldfile)
			{
				if(file_exists(FCPATH.$oldfile)) 
				{
					unlink(FCPATH.$oldfile);		
				}
			}
	    }
	

		//--------------------------------------------------------
		/*
		* Function Name : File Upload
		* Param1 : Location
		* Param2 : HTML File ControlName
		* Return : FileName
		*/
		function file_upload($location, $controlname)
		{
			if ( ! file_exists(FCPATH.$location))
			{
				$create = mkdir(FCPATH.$location,0777,TRUE);
				if ( ! $create)
					return '';
			}
	        
			$new_filename= $this->rename_image($_FILES[$controlname]['name']);
			if(move_uploaded_file(realpath($_FILES[$controlname]['tmp_name']),$location.$new_filename))
			{
				return $new_filename;
			}
			else
			{
				return '';
			}     
		}

		/*
		* Function Name : Rename Image
		* Param1 : FileName
		* Return : FileName
		*/
		public function rename_image($img_name)
	    {
	        $randString = md5(time().$img_name);
	        $fileName =$img_name;
	        $splitName = explode(".", $fileName);
	        $fileExt = end($splitName);
	        return strtolower($randString.'.'.$fileExt);
	    }
   



	}



?>