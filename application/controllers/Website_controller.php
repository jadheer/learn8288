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

		$arr_popular_courses = $this->Website_functions_model->get_popular_course();

		$this->load->view('website/index',compact('arr_popular_courses'));
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

		$course 	= $this->Website_functions_model->get_course_id_by_slug($slug);
		// echo"<pre>";print_r($course->sub_category_id);die;
		$course_id = $course->sub_category_id;
		$sub_category_name = $course->sub_category_name;
		$ot_batches = $this->Website_functions_model->get_ot_batch_by_id($course_id);

		$this->load->view('website/oc-training',compact('ot_batches','course_id','sub_category_name'));
	}

	public function customer_data()
	{
        if(count($this->cart->contents()) != 0){
			$this->load->view('website/customer_details');
        }
        else{
        	return redirect('website/products');
        }

	}

	// public function process( $paymentID=NULL,$payerID=NULL,$token=NULL,$pid=NULL )
	public function pay()
	{

/*	    $paypalExpress = new paypalExpress();
	    $paymentID = $paymentID;
	    $payerID = $payerID;
	    $token = $token;
	    $pid = $pid;
	    
	    $paypalCheck=$paypalExpress->paypalCheck($paymentID, $pid, $payerID, $token);
	    echo "<pre>";print_r($paypalCheck);die;
	    
	    if($paypalCheck){
	        header('Location:orders.php');
	    }*/

		$form_data = array(
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
		);

		// echo "<pre>";print_r($this->cart->contents());die;

		if( $customer_details_id = $this->Website_functions_model->add_billing_details($form_data) )
		{

			$total_items = 0;
			foreach ($this->cart->contents() as $items) {
				$arr_items[] = $items["type"]."-".$items["id"]."-".$items["qty"];
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

			$purchase_id = $this->Website_functions_model->add_purchase_details($arr_purchase_details);
			$_SESSION['purchase_id'] = $purchase_id;
			$_SESSION['name'] = $this->input->post('name');

			// $paypal = new PaypalExpress();
			// echo $this->config['clientId'];
			// var_dump($this->config->item('clientId'));
			// echo "<pre>";print_r($this->getToken());


		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	}

/*	public function getToken()
	{
		$clientId 	= $this->config->item('clientId');
		$secret		= $this->config->item('secret');
		$api_url	= $this->config->item('api_url');
            
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $api_url."v1/oauth2/token");
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSLVERSION , 6);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

		$result = curl_exec($ch);

		if(empty($result))die("Error: No response.");
		else
		{
		    $json = json_decode($result);
		    return $json;
		}

		curl_close($ch);
	}*/

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Website_functions_model');
        // $this->load->library('paypalExpress');
    }

}
?>
