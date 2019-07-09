<?php
class Admin_functions extends CI_Controller 
{
	/* course purchases starts here */

	public function delete_popular_course()
	{
		$popular_course_id = $this->input->post('popular_course_id');

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->delete_popular_course($popular_course_id) )
		{
			$this->session->set_flashdata('feedback', 'Popular course deleted successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to delete, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/popular_courses');
	}

	public function update_popular_course()
	{
		$this->load->model('Admin_functions_model');
		$popular_course_id	= $this->input->post('popular_course_id');
		if(!empty($_FILES['image']['name'])){
			$config['upload_path'] = './uploads/others/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|PDF';
			$config['max_size']             = 20480;

			$config['image'] = $_FILES['image']['name'];

			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$this->load->model('Admin_functions_model');

			if($this->upload->do_upload('image'))
			{
				$form_data = array(
					'title'	=> $this->input->post('title'),
					'price'	=> $this->input->post('price'),
					'link'	=> $this->input->post('link'),
					'image' => $config['image']
				);

				if( $this->Admin_functions_model->update_popular_course($popular_course_id,$form_data) )
				{
					$this->session->set_flashdata('feedback', 'Popular course updated successfully');
					$this->session->set_flashdata('feedback_class', 'alert-success');
				}
				else
				{
					$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
					$this->session->set_flashdata('feedback_class', 'alert-danger');
				}
			}
		}
		else{
				$form_data = array(
					'title'	=> $this->input->post('title'),
					'price'	=> $this->input->post('price'),
					'link'	=> $this->input->post('link')
				);


				if( $this->Admin_functions_model->update_popular_course($popular_course_id,$form_data) )
				{
					$this->session->set_flashdata('feedback', 'Popular course updated successfully');
					$this->session->set_flashdata('feedback_class', 'alert-success');
				}
				else
				{
					$this->session->set_flashdata('feedback', 'Failed to save, Please try again');
					$this->session->set_flashdata('feedback_class', 'alert-danger');
				}
			}

		return redirect('Admin_functions/popular_courses');
	}

	public function edit_popular_course()
	{
		$this->load->model('Admin_functions_model');
		$popular_course_id	= $this->input->post('popular_course_id');
		$obj_popular_course = $this->Admin_functions_model->getPopularCourseById($popular_course_id);

		$this->load->view('admin/edit_popular_course',compact('obj_popular_course'));
	}

	public function save_popular_course()
	{

		$config['upload_path'] = './uploads/others/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|PDF';
		$config['max_size']             = 20480;

		$config['image'] = $_FILES['image']['name'];

		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		$this->load->model('Admin_functions_model');

		if($this->upload->do_upload('image'))
		{
			$form_data = array(
				'title'	=> $this->input->post('title'),
				'price'	=> $this->input->post('price'),
				'link'	=> $this->input->post('link'),
				'image' => $config['image']
			);


			if( $this->Admin_functions_model->save_popular_course($form_data) )
			{
				$this->session->set_flashdata('feedback', 'Product image saved successfully');
				$this->session->set_flashdata('feedback_class', 'alert-success');
			}
			else
			{
				$this->session->set_flashdata('feedback', 'Failed to save, Please try again');
				$this->session->set_flashdata('feedback_class', 'alert-danger');
			}
		}

		return redirect('Admin_functions/popular_courses');
	}

	public function popular_courses()
	{
		$this->load->model('Admin_functions_model');
		$arr_popular_courses = $this->Admin_functions_model->getAllPopularCourses();

		$this->load->view('admin/popular_courses',compact('arr_popular_courses'));
	}

	/* course purchases starts here */

	public function invoice($invoice_id)
	{

		$this->load->model('Admin_functions_model');

		$obj_order_details = $this->Admin_functions_model->get_order_details($invoice_id);

		// echo "<pre>";print_r($obj_order_details);die;
		$arr_items = explode(',', $obj_order_details->items);

		foreach ($arr_items as $item) {
			$items_filtered = explode("-", $item);
			$course_type = $items_filtered[0];
			$course_id = $items_filtered[1];
			if($course_type == 'ct'){
				$arr_batch[] = $this->Admin_functions_model->get_ct_exact_batch_by_id($course_id);
			}
			else{
				$arr_batch[] = $this->Admin_functions_model->get_ot_exact_batch_by_id($course_id);
			}
		}

		// echo "<pre>";print_r($arr_batch);die;

		$this->load->view('admin/invoice_view.php',compact('obj_order_details','arr_batch','arr_items'));
	}

	public function customer_details($customer_id)
	{
		$this->load->model('Admin_functions_model');
		$obj_customer_details = $this->Admin_functions_model->getCustomerDetailById($customer_id);

		$this->load->view('admin/customer_details',compact('obj_customer_details'));
	}

	public function orders()
	{
		$this->load->model('Admin_functions_model');
		$order_list = $this->Admin_functions_model->get_order_list();

		$this->load->view('admin/order_view',compact('order_list'));
	}
	
	/* Course cms starts here */

	public function update_course_content()
	{
		$course_id = $this->input->post('course_id');

		$form_data = array(
					'course_id' => $this->input->post('course_id'),
					'content' => $this->input->post('content')
					);

		$this->load->model('Admin_functions_model');
		$content_exists = $this->Admin_functions_model->check_cms_content_exists($course_id);

		if($content_exists){
			$status = $this->Admin_functions_model->update_cms_content_model($course_id,$form_data);
		}
		else{
			$status = $this->Admin_functions_model->store_cms_content($form_data);
		}

		if( $status )
		{
			$this->session->set_flashdata('feedback', 'Content updated successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/course_cms');
	}

	public function get_course_content($course_id)
	{

		$this->load->model('Admin_functions_model');
		$course_content = $this->Admin_functions_model->get_content_selected($course_id);

		echo json_encode($course_content);
	}

	public function course_cms()
	{
		$this->load->model('Admin_functions_model');
		$main_category_list = $this->Admin_functions_model->get_main_category_list();
		$sub_category_list = $this->Admin_functions_model->get_sub_category_list();
		$countries_list = $this->Admin_functions_model->get_countries_list();
		$batch_list = $this->Admin_functions_model->get_ot_batches();

		$this->load->view('admin/new_course_cms_form',compact('main_category_list','sub_category_list','countries_list','batch_list'));
	}

	/* Online Training Course management starts here */

	public function update_ot_batch()
	{
		$this->load->model('Admin_functions_model');
		$batch_count = sizeof($this->input->post('timings'));
		$main_category_id = $this->input->post('mc_id');
		$course_id = $this->input->post('cor_id');

		if( $this->Admin_functions_model->delete_ot_batches($main_category_id,$course_id) )
		{
			for ($i=0; $i < $batch_count; $i++) {
				$form_data = array(
								'main_category_id' => $this->input->post('main_category_id'),
								'course_id' => $this->input->post('course_id'),
								'title' => $_POST['title'][$i],
								'timings' => $_POST['timings'][$i],
								'course_fee_full' => $_POST['course_fee_full'][$i],
								'course_fee_offer' => $_POST['course_fee_offer'][$i],
								'offer_untill_date' => $_POST['offer_untill_date'][$i],
							);
				$status = $this->Admin_functions_model->store_ot_batch($form_data);
			}
		}

		if( $status )
		{
			$this->session->set_flashdata('feedback', 'Batches updated successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/online_training');
	}

	public function edit_ot_batch()
	{
		$main_category_id = $this->input->post('main_category_id');
		$course_id = $this->input->post('course_id');

		$this->load->model('Admin_functions_model');

		$ot_batches = $this->Admin_functions_model->get_ot_batch_by_id($main_category_id,$course_id);
		$main_category_list = $this->Admin_functions_model->get_main_category_list();
		$sub_category_list = $this->Admin_functions_model->get_sub_category_list();

		// print_r($ot_batches);die;

		$this->load->view('admin/ot_batch_edit_view',compact('ot_batches','main_category_list','sub_category_list'));
	}

	public function save_ot_training()
	{
		$batch_count = sizeof($this->input->post('timings'));
		$this->load->model('Admin_functions_model');
		for ($i=0; $i < $batch_count; $i++) {
			$form_data = array(
							'main_category_id' => $this->input->post('main_category_id'),
							'course_id' => $this->input->post('course_id'),
							'title' => $this->input->post('title'),
							'timings' => $_POST['timings'][$i],
							'course_fee_full' => $_POST['course_fee_full'][$i],
							'course_fee_offer' => $_POST['course_fee_offer'][$i],
							'offer_untill_date' => $_POST['offer_untill_date'][$i],
						);
			$status = $this->Admin_functions_model->store_ot_batch($form_data);
		}

		if($status)
		{
			$this->session->set_flashdata('feedback', 'Online training created successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to create online training, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	    return redirect('Admin_functions/online_training');
	}

	public function online_training()
	{
		$this->load->model('Admin_functions_model');
		$main_category_list = $this->Admin_functions_model->get_main_category_list();
		$sub_category_list = $this->Admin_functions_model->get_sub_category_list();
		$countries_list = $this->Admin_functions_model->get_countries_list();
		$batch_list = $this->Admin_functions_model->get_ot_batches();

		$this->load->view('admin/new_ot_form',compact('main_category_list','sub_category_list','countries_list','batch_list'));
	}

	/* Course management starts here */

	public function update_ct_batch()
	{
		$this->load->model('Admin_functions_model');
		$batch_count = sizeof($this->input->post('dates'));
		$country_id = $this->input->post('co_id');
		$center_id = $this->input->post('ce_id');
		$main_category_id = $this->input->post('mc_id');
		$course_id = $this->input->post('cor_id');

		if( $this->Admin_functions_model->delete_ct_batches($country_id,$center_id,$main_category_id,$course_id) )
		{
			for ($i=0; $i < $batch_count; $i++) {
				$form_data = array(
								'country_id' => $this->input->post('country_id'),
								'center_id' => $this->input->post('center_id'),
								'main_category_id' => $this->input->post('main_category_id'),
								'course_id' => $this->input->post('course_id'),
								'dates' => $_POST['dates'][$i],
								'from_time' => $_POST['from_time'][$i],
								'to_time' => $_POST['to_time'][$i],
								'course_fee_full' => $_POST['course_fee_full'][$i],
								'course_fee_offer' => $_POST['course_fee_offer'][$i],
								'offer_untill_date' => $_POST['offer_untill_date'][$i],
							);
				$status = $this->Admin_functions_model->store_class_batch($form_data);
			}
		}

		if( $status )
		{
			$this->session->set_flashdata('feedback', 'Batches updated successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/class_room_training');
	}

	public function edit_ct_batch()
	{
		$country_id = $this->input->post('country_id');
		$center_id = $this->input->post('center_id');
		$main_category_id = $this->input->post('main_category_id');
		$course_id = $this->input->post('course_id');

		$this->load->model('Admin_functions_model');

		$ct_batches = $this->Admin_functions_model->get_ct_batch_by_id($course_id);
		$main_category_list = $this->Admin_functions_model->get_main_category_list();
		$sub_category_list = $this->Admin_functions_model->get_sub_category_list();
		$countries_list = $this->Admin_functions_model->get_countries_list();
		$centers_list = $this->Admin_functions_model->get_centers_list();

		$this->load->view('admin/ct_batch_edit_view',compact('ct_batches','main_category_list','sub_category_list','countries_list','centers_list'));
	}

	public function select_centers($country_id)
	{
		$this->load->model('Admin_functions_model');
		$centers_selected = $this->Admin_functions_model->get_center_by_country_id($country_id);

		echo json_encode($centers_selected);
	}

	/* Center management starts here */

	public function delete_center()
	{
		$center_id = $this->input->post('center_id');

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->delete_center_model($center_id) )
		{
			$this->session->set_flashdata('feedback', 'Center deleted successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to delete, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/new_country');
	}

	public function update_center()
	{
		$center_id = $this->input->post('center_id');

		$form_data = array(
					'country_id' => $this->input->post('country_id'),
					'center_name' => $this->input->post('center_name')
					);

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->update_center_model($center_id,$form_data) )
		{
			$this->session->set_flashdata('feedback', 'Center updated successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/centers');
	}

	public function edit_center()
	{
		$center_id = $this->input->post('center_id');

		$this->load->model('Admin_functions_model');
		$center = $this->Admin_functions_model->get_center_by_id($center_id);
		$countries_list = $this->Admin_functions_model->get_countries_list();

		$this->load->view('admin/center_edit_view',compact('center','countries_list'));
	}

	public function save_center()
	{

		$form_data = array(
						'country_id' => $this->input->post('country_id'),
						'center_name' => $this->input->post('center_name')
					);

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->store_center($form_data) )
		{
			$this->session->set_flashdata('feedback', 'Center created successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to create center, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	    return redirect('Admin_functions/centers');
	}

	public function centers()
	{
		$this->load->model('Admin_functions_model');
		$countries_list = $this->Admin_functions_model->get_countries_list();
		$centers_list = $this->Admin_functions_model->get_centers_list();

		$this->load->view('admin/new_centers_form',compact('countries_list','centers_list'));
	}

	public function delete_country()
	{
		$country_id = $this->input->post('country_id');

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->delete_country_model($country_id) )
		{
			$this->session->set_flashdata('feedback', 'Country deleted successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to delete, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/new_country');
	}

	public function update_country()
	{
		$country_id = $this->input->post('country_id');

		$form_data = array(
					'country_name' => $this->input->post('country_name')
					);

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->update_country_model($country_id,$form_data) )
		{
			$this->session->set_flashdata('feedback', 'Country updated successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/new_country');
	}

	public function edit_country()
	{
		$country_id = $this->input->post('country_id');

		$this->load->model('Admin_functions_model');
		$country = $this->Admin_functions_model->get_country_by_id($country_id);

		$this->load->view('admin/country_edit_view',compact('country'));
	}

	public function save_country()
	{

		$form_data = array(
						'country_name' => $this->input->post('country_name')
					);

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->store_country($form_data) )
		{
			$this->session->set_flashdata('feedback', 'Country created successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to create country, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	    return redirect('Admin_functions/new_country');
	}

	public function new_country()
	{
		$this->load->model('Admin_functions_model');
		$countries_list = $this->Admin_functions_model->get_countries_list();

		$this->load->view('admin/new_country_form',compact('countries_list'));
	}

	/* Center management ends here */

	public function delete_sub_sub_category()
	{
		$sub_sub_category_id = $this->input->post('sub_sub_category_id');

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->delete_the_sub_sub_category($sub_sub_category_id) )
		{
			$this->session->set_flashdata('feedback', 'Sub Sub Category deleted successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to delete, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/class_room_training');
	}

	public function delete_sub_category()
	{
		$sub_category_id = $this->input->post('sub_category_id');

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->delete_the_sub_category($sub_category_id) )
		{
			$this->session->set_flashdata('feedback', 'Sub Category deleted successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to delete, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/sub_category');
	}

	public function delete_main_category()
	{
		$main_category_id = $this->input->post('main_category_id');

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->delete_the_main_category($main_category_id) )
		{
			$this->session->set_flashdata('feedback', 'Main Category deleted successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to delete, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/new_product');
	}

	public function show_main_category()
	{

		$this->load->model('Admin_functions_model');
		$main_category_list = $this->Admin_functions_model->get_main_category_list();

		echo json_encode($main_category_list);
	}

	public function show_sub_sub_category($sub_cat_id)
	{ 

		$this->load->model('Admin_functions_model');
		$sub_sub_category_selected = $this->Admin_functions_model->get_sub_sub_category_selected($sub_cat_id);

		echo json_encode($sub_sub_category_selected);
	}

	public function show_sub_category($main_cat_id)
	{ 

		$this->load->model('Admin_functions_model');
		$sub_category_selected = $this->Admin_functions_model->get_sub_category_selected($main_cat_id);

		echo json_encode($sub_category_selected);
	}

	public function update_main_category()
	{
		$main_category_id = $this->input->post('main_category_id');

		$form_data = array(
					'main_category_name' => $this->input->post('main_category_name'),
					'order' => $this->input->post('order')
					);

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->update_main_category_model($main_category_id,$form_data) )
		{
			$this->session->set_flashdata('feedback', 'Main category updated successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		return redirect('Admin_functions/new_product');
	}

	public function edit_main_category()
	{
		$main_category_id = $this->input->post('main_category_id');

		$this->load->model('Admin_functions_model');
		$main_category = $this->Admin_functions_model->get_main_category($main_category_id);

		$this->load->view('admin/main_category_edit_view',compact('main_category'));
	}

	public function save_sub_sub_category()
	{
		$batch_count = sizeof($this->input->post('dates'));
		$this->load->model('Admin_functions_model');
		for ($i=0; $i < $batch_count; $i++) {
			$form_data = array(
							'country_id' => $this->input->post('country_id'),
							'center_id' => $this->input->post('center_id'),
							'main_category_id' => $this->input->post('main_category_id'),
							'course_id' => $this->input->post('course_id'),
							'dates' => $_POST['dates'][$i],
							'from_time' => $_POST['from_time'][$i],
							'to_time' => $_POST['to_time'][$i],
							'course_fee_full' => $_POST['course_fee_full'][$i],
							'course_fee_offer' => $_POST['course_fee_offer'][$i],
							'offer_untill_date' => $_POST['offer_untill_date'][$i],
						);
			$status = $this->Admin_functions_model->store_class_batch($form_data);
		}

		if($status)
		{
			$this->session->set_flashdata('feedback', 'Sub sub category created successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to create main category, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	    return redirect('Admin_functions/class_room_training');
	}

	public function select_sub_category($main_cat_id)
	{

		$this->load->model('Admin_functions_model');
		$sub_category_selected = $this->Admin_functions_model->get_sub_category_selected($main_cat_id);

		echo json_encode($sub_category_selected);
	}

	public function class_room_training()
	{
		$this->load->model('Admin_functions_model');
		$main_category_list = $this->Admin_functions_model->get_main_category_list();
		$sub_category_list = $this->Admin_functions_model->get_sub_category_list();
		$countries_list = $this->Admin_functions_model->get_countries_list();
		$batch_list = $this->Admin_functions_model->get_store_class_batch();
// echo "<pre>";print_r($batch_list);die;
		$this->load->view('admin/new_sub_sub_category_form',compact('main_category_list','sub_category_list','countries_list','batch_list'));
	}

	public function save_sub_category()
	{

		$form_data = array(
						'main_category_id' => $this->input->post('main_category_id'),
						'sub_category_name' => $this->input->post('sub_category_name'),
						'slug' => url_title($this->input->post('sub_category_name'), 'dash', true)
					);

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->store_sub_category($form_data) )
		{
			$this->session->set_flashdata('feedback', 'Sub category created successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to create sub category, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	    return redirect('Admin_functions/sub_category');
	}

	public function sub_category()
	{
		$this->load->model('Admin_functions_model');
		$main_category_list = $this->Admin_functions_model->get_main_category_list();
		$sub_category_list = $this->Admin_functions_model->get_sub_category_list();

		$this->load->view('admin/new_sub_category_form',compact('main_category_list','sub_category_list'));
	}

	public function save_main_category()
	{

		$form_data = array(
						'main_category_name' => $this->input->post('main_category_name'),
						'order' => $this->input->post('order')
					);

		$this->load->model('Admin_functions_model');
		if( $this->Admin_functions_model->store_main_category($form_data) )
		{
			$this->session->set_flashdata('feedback', 'Main category created successfully');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to create main category, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	    return redirect('Admin_functions/new_product');
	}

	public function new_product()
	{
		$this->load->model('Admin_functions_model');
		$main_category_list = $this->Admin_functions_model->get_main_category_list();

		$this->load->view('admin/new_product_form',compact('main_category_list'));
	}

	public function __construct()
	{
		parent::__construct();
		if(! $this->session->userdata('user_id') )
			return redirect('Admin_authentication');
	}

}
?>
