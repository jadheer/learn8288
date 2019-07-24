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
		$page_type = "class";

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
		$page_type = "online";

		$this->load->view('website/oc-training',compact('ot_batches','course_id','page_type','sub_category_name'));
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

	public function pay()
	{

		$form_data = array(
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
		);

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
			$_SESSION['amount'] = $grand_total;
			$_SESSION['name'] = $this->input->post('name');

			return redirect('Website_controller/process_payment');

		}
		else
		{
			$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

	}

	public function process_payment(){
		$this->load->view('website/process-payment');
	}

	public function process(){

		if(!empty($_GET['paymentID']) && !empty($_GET['payerID']) && !empty($_GET['token']) && !empty($_GET['pid']) ){
		    $paypalExpress = new PaypalExpress();
		    $paymentID = $_GET['paymentID'];
		    $payerID = $_GET['payerID'];
		    $token = $_GET['token'];
		    $pid = $_GET['pid'];

		    $err = NULL;
		    
		    $response=$paypalExpress->paypalCheck($paymentID, $pid, $payerID, $token);
            $result = json_decode($response); 
		    
		    if(!empty($result)){
	            $state = $result->state;
	            $total = $result->transactions[0]->amount->total;
	            $currency = $result->transactions[0]->amount->currency;
	            $subtotal = $result->transactions[0]->amount->details->subtotal;
	            $recipient_name = $result->transactions[0]->item_list->shipping_address->recipient_name;
	            
	            $purchase = $this->Website_functions_model->get_purchase_amount($pid);

	            $form_data = array(
	                'payment_status' => $state,
	                'response' => $response,
	            );

	            if(!empty($purchase)){
		            if(!empty($subtotal)){
			            if($state == 'approved' && $purchase->amount ==  $subtotal){
			                $this->Website_functions_model->update_purchase_status($pid,$form_data);
			                $res = rtrim(base64_encode($pid),"="); ;
			            	return redirect('transaction-completed/'.$res);
			            }
			            else{
			                $err = "Mismatch in the amount has occured, please contact the Skillsswear for more info, your payment id is ".$pid." please note it for future reference";
			            }
		        	}
		        	else{
		        		$err = "We have found some issue with the payment gateway, please try again later, your payment id is ".$pid." please note it for future reference";
		        	}
	        	}
	        	else{
	        		$err = "We could not find the order you tried to fetch, please contact the Skillsswear for more info, your payment id is ".$pid." please note it for future reference";
	        	}
	        	$err = "Something went wrong";
	        }
	        else{
	        	$err = "Something went wrong";
	        }
	        if($err == NULL){
	        	$err = "Something went wrong";
	        }
		    $this->load->view('website/error',compact('err'));
		}
		else{
		    return redirect('Website_controller/index');
		}

	}

	public function transaction_complete()
	{
		$pid = base64_decode($this->uri->segment(2));
		$purchase = $this->Website_functions_model->get_purchase_amount($pid);
		$obj_order_details = $this->Admin_functions_model->get_order_details($pid);

		$arr_items = explode(',', $purchase->items);

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

		$this->load->view('website/success',compact('obj_order_details','arr_batch','arr_items'));

	}

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Website_functions_model');
        $this->load->model('Admin_functions_model');
        $this->load->library('paypalExpress');
    }

}
?>
