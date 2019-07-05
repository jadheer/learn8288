<?php
class Website_controller extends CI_Controller
{
	public function index()
	{
		if(!$this->session->has_userdata('cart_session'))
		{
			$uniqueId = uniqid(rand(), TRUE);
			$this->session->set_userdata("cart_session", md5($uniqueId)); 
		}

		$this->load->model('Website_functions_model');
		// $main_category_list = $this->Website_functions_model->get_main_category_list();

		$this->load->view('website/index');
	}

	public function aboutus()
	{
		$this->load->model('Website_functions_model');
		$this->load->view('website/aboutus');
	}

	public function corporatetraining()
	{
		$this->load->model('Website_functions_model');
		$this->load->view('website/corporate-training');
	}

	public function referandearn()
	{
		$this->load->model('Website_functions_model');
		$this->load->view('website/corporate-training');
	}

	public function contactus()
	{
		$this->load->model('Website_functions_model');
		$this->load->view('website/contact-us');
	}

	public function course()
	{
		$slug = $this->uri->segment(2);

		$this->load->model('Website_functions_model');
		$course 			= 	$this->Website_functions_model->get_course_id_by_slug($slug);
		$course_id 			= 	$course->sub_category_id;
		$sub_category_name 	= 	$course->sub_category_name;
		$ct_count 			= 	$this->Website_functions_model->get_ct_count($course_id);
		$ot_count 			= 	$this->Website_functions_model->get_ot_count($course_id);
		$course_content 	= 	$this->Website_functions_model->get_course_content($course_id);
// echo"<pre>";print_r($course_content);die;
		$this->load->view('website/course',compact('ct_count','ot_count','slug','sub_category_name','course_content'));
	}

	public function classroom_training_course_details()
	{
		$slug = $this->uri->segment(2);

		$this->load->model('Website_functions_model');

		$course 	= $this->Website_functions_model->get_course_id_by_slug($slug);
		// echo"<pre>";print_r($course->sub_category_id);die;
		$course_id = $course->sub_category_id;
		$sub_category_name = $course->sub_category_name;
		$countries_list = $this->Website_functions_model->get_countries_list();

		$this->load->view('website/cl-training',compact('countries_list','course_id','sub_category_name'));
	}

	public function select_centers($country_id)
	{
		$this->load->model('Admin_functions_model');
		$centers_selected = $this->Admin_functions_model->get_center_by_country_id($country_id);

		echo json_encode($centers_selected);
	}

	public function getClassroomTrainingBatches()
	{
        $this->load->model('Website_functions_model');
		$data = $this->input->get();
		$country_id = $data['country_id'];
		$center_id = $data['center_id'];
		$course_id = $data['course_id'];
		$current_url = $data['current_url'];
		$sub_category_name = $data['sub_category_name'];

		$ct_batches = $this->Website_functions_model->get_ct_batch_by_id($country_id,$center_id,$course_id);

		// print_r($ct_batches);die;
		$count=0;
		foreach ($ct_batches as $batch) {
		// echo"<pre>";print_r($batch);
        	$this->load->view('website/ct_batches', compact('batch','current_url','count','sub_category_name'));
        	$count++;
		}
	}

	public function online_training_course_details()
	{
		$slug = $this->uri->segment(2);

		$this->load->model('Website_functions_model');

		$course 	= $this->Website_functions_model->get_course_id_by_slug($slug);
		// echo"<pre>";print_r($course->sub_category_id);die;
		$course_id = $course->sub_category_id;
		$sub_category_name = $course->sub_category_name;
		$ot_batches = $this->Website_functions_model->get_ot_batch_by_id($course_id);

		$this->load->view('website/oc-training',compact('ot_batches','course_id','sub_category_name'));
	}

	public function customer_data()
	{
		$this->load->model('Website_functions_model');

        if(count($this->cart->contents()) != 0){
			$this->load->view('website/customer_details');
        }
        else{
        	return redirect('website/products');
        }

	}

	public function pay()
	{

		$form_data = array(
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address')
		);

		if( $customer_details_id = $this->Web_model->add_billing_details($form_data) )
		{

			$total_items = 0;
			foreach ($this->cart->contents() as $items) {
				$arr_items[] = $items["id"]."-".$items["qty"];
				$total_items++;
			}

			$items = implode(",", $arr_items);

			$grand_total = $this->cart->total();

			$arr_purchase_details = array(
				'customer_id' => $customer_details_id,
				'items' => $items,
				'no_of_items' => $total_items,
				'amount' => $grand_total,
				'payment_status' => "PENDING",
			);

			$purchase_id = $this->Web_model->add_purchase_details($arr_purchase_details);
			$_SESSION['purchase_id'] = $purchase_id;
			$_SESSION['name'] = $this->input->post('name');


		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	}

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
    }

}
?>
