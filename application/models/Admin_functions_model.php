<?php
class Admin_functions_model extends CI_Model
{
	/* Course cms starts here */

	public function store_cms_content($array)
	{
		return $this->db->insert('tbl_course_contents',$array);
	}

	public function update_cms_content_model($course_id, Array $form_data)
	{
		return $this->db
					->where('course_id',$course_id)
					->update('tbl_course_contents',$form_data);
	}

	public function check_cms_content_exists($course_id)
	{
		$query = $this->db
				->select(['course_id'])
		        ->from('tbl_course_contents')
		        ->where('course_id',$course_id)
				->get();
			return $query->num_rows();

	}

	public function get_content_selected($course_id)
	{
		$query = $this->db
				->where("course_id",$course_id)
				->get("tbl_course_contents");
			return $query->result();
	}

	/* Online Training Course management starts here */

	public function delete_ot_batches($main_category_id,$course_id)
	{
		return $this->db->delete('tbl_ot_batches',['main_category_id'=>$main_category_id,'course_id'=>$course_id]);
	}

	public function get_ot_batch_by_id($main_category_id,$course_id)
	{
		$query = $this->db
				->where("main_category_id",$main_category_id)
				->where("course_id",$course_id)
		        ->from('tbl_ot_batches')
		        ->order_by("ot_batch_id", "asc")
				->get();
			return $query->result();
	}

	public function get_ot_batches()
	{
		$query = $this->db
				->select(['b.main_category_name','a.sub_category_name','c.ot_batch_id','c.main_category_id','c.course_id','c.title','c.timings','c.course_fee_full','c.course_fee_offer','c.offer_untill_date'])
		        ->from('tbl_ot_batches c')
	            ->join('tbl_main_category b', 'b.main_category_id = c.main_category_id')
	            ->join('tbl_sub_category a', 'a.sub_category_id = c.course_id')
	            ->order_by("c.course_id", "desc")
				->get();
			return $query->result();
	}

	public function store_ot_batch($array)
	{
		return $this->db->insert('tbl_ot_batches',$array);
	}

	/* Course management starts here */

	public function delete_ct_batches($country_id,$center_id,$main_category_id,$course_id)
	{
		return $this->db->delete('tbl_ct_batches',['country_id'=>$country_id,'center_id'=>$center_id,'main_category_id'=>$main_category_id,'course_id'=>$course_id]);
	}

	public function get_center_by_country_id($country_id)
	{
		$query = $this->db
				->where("country_id",$country_id)
				->get("tbl_centers");
			return $query->result();
	}

	/* Center management starts here */

	public function delete_center_model($center_id)
	{
		return $this->db->delete('tbl_centers',['center_id'=>$center_id]);
	}

	public function update_center_model($center_id, Array $form_data)
	{
		return $this->db
					->where('center_id',$center_id)
					->update('tbl_centers',$form_data);
	}

	public function get_center_by_id($center_id)
	{
        $query = $this->db
				->select(['center_id','country_id','center_name'])
		        ->from('tbl_centers')
		        ->where('center_id',$center_id)
				->get();
			return $query->result();
	}

	public function store_center($array)
	{
		return $this->db->insert('tbl_centers',$array);
	}

	public function get_centers_list()
	{
		$query = $this->db
				->select(['b.country_name','a.center_id','a.center_name'])
		        ->from('tbl_centers a')
	            ->join('tbl_countries b', 'b.country_id = a.country_id')
				->get();
			return $query->result();
	}

	public function delete_country_model($country_id)
	{
		return $this->db->delete('tbl_countries',['country_id'=>$country_id]);
	}

	public function update_country_model($country_id, Array $form_data)
	{
		return $this->db
					->where('country_id',$country_id)
					->update('tbl_countries',$form_data);
	}

	public function get_country_by_id($country_id)
	{
        $query = $this->db
				->select(['country_id','country_name'])
		        ->from('tbl_countries')
		        ->where('country_id',$country_id)
				->get();
			return $query->result();
	}

	public function store_country($array)
	{
		return $this->db->insert('tbl_countries',$array);
	}

	public function get_countries_list()
	{
		$query = $this->db
				->select(['country_id','country_name'])
		        ->from('tbl_countries')
				->get();
			return $query->result();
	}

	/* Center management ends here */

	public function delete_the_sub_sub_category($sub_sub_category_id)
	{
		return $this->db->delete('tbl_sub_sub_category',['sub_sub_category_id'=>$sub_sub_category_id]);
	}

	public function delete_the_sub_category($sub_category_id)
	{
		return $this->db->delete('tbl_sub_category',['sub_category_id'=>$sub_category_id]);
	}

	public function delete_the_main_category($main_category_id)
	{
		return $this->db->delete('tbl_main_category',['main_category_id'=>$main_category_id]);
	}

	public function get_customer_id_name($customer_id)
	{
        $query = $this->db
				->select(['customer_id','customer_official_id','fullname'])
		        ->from('tbl_customers')
		        ->where('customer_id',$customer_id)
				->get();
			return $query->result();
	}

	public function save_the_widthdraw(Array $array)
	{
		return $this->db->insert('tbl_transactions',$array);
	} 

	public function delete_discount_card($discount_id)
	{
		return $this->db->delete('tbl_discounts',['discount_id'=>$discount_id]);
	}

	public function update_discount_details($discount_id, Array $form_data)
	{
		return $this->db
					->where('discount_id',$discount_id)
					->update('tbl_discounts',$form_data);
	}

	public function get_discounts_details($discount_id)
	{
		$query = $this->db
				->select(['discount_id','card_name','percentage'])
		        ->from('tbl_discounts')
		        ->where('discount_id',$discount_id)
				->get();
			return $query->result();
	}

	public function get_discounts()
	{
		$query = $this->db
				->select(['discount_id','card_name','percentage'])
		        ->from('tbl_discounts')
				->get();
			return $query->result();
	}

	public function save_the_discount(Array $array)
	{
		return $this->db->insert('tbl_discounts',$array);
	} 

	public function multiple_delete_the_mail($selectedRows)
	{
		foreach ($selectedRows as $Rows)
		{
			$this->db
					->where('enquiry_id',$Rows)
					->set('admin_delete',1)
					->update('tbl_enquiry');
		}
		return 1;
	}

	public function delete_the_mail($enquiry_id)
	{
		return $this->db
					->where('enquiry_id',$enquiry_id)
					->set('admin_delete',1)
					->update('tbl_enquiry');
	}

	public function update_batch_status($batch, Array $form_data)
	{
		return $this->db
					->where('batch',$batch)
					->update('tbl_orders',$form_data);
	}

	public function get_batch_list()
	{
		$query = $this->db
				->distinct()
				->select(['batch'])
		        ->from('tbl_orders')
				->get();
			return $query->result();
	}

	public function update_batch_data($order_id, Array $form_data)
	{
		return $this->db
					->where('order_id',$order_id)
					->update('tbl_orders',$form_data);
	}

	public function save_message(Array $array)
	{
		return $this->db->insert('tbl_enquiry',$array);
	} 

	public function update_inbox_status($enquiry_id)
	{
		return $this->db
					->where('enquiry_id',$enquiry_id)
					->set('status',1)
					->update('tbl_enquiry');
	}

	public function get_mail_details($enquiry_id)
	{
		$query = $this->db
				->select(['a.enquiry_id','a.customer_id','a.subject','a.message','a.time','b.fullname','b.customer_official_id'])
		        ->from('tbl_enquiry a')
		        ->join('tbl_customers b', 'b.customer_id = a.customer_id')
		        ->where('a.enquiry_id',$enquiry_id)
				->get();
			return $query->result();
	}

	public function get_unviewed_messages_count()
	{
		$query = $this->db
				->select(['customer_id'])
		        ->from('tbl_enquiry')
		        ->where('status',0)
		        ->where('route','N')
		        ->where('admin_delete',0)
				->get();
			return $query->num_rows();

	}

	public function get_total_messages_count()
	{
		$query = $this->db
				->select(['customer_id'])
		        ->from('tbl_enquiry')
		        ->where('route','N')
		        ->where('admin_delete',0)
				->get();
			return $query->num_rows();

	}

	public function get_unviewed_messages()
	{
		$query = $this->db
				->select(['a.enquiry_id','a.customer_id','a.subject','a.message','a.time','b.fullname'])
		        ->from('tbl_enquiry a')
		        ->join('tbl_customers b', 'b.customer_id = a.customer_id')
		        ->where('a.status',0)
		        ->where('admin_delete',0)
		        ->limit(5)
				->get();
			return $query->result();

	}

	public function get_sent_mail_details($enquiry_id)
	{
		$query = $this->db
				->select(['enquiry_id','subject','message','time'])
		        ->from('tbl_enquiry')
		        ->where('enquiry_id',$enquiry_id)
				->get();
			return $query->result();
	}

	public function get_sent_messages()
	{

		$query = $this->db
				->select(['a.enquiry_id','a.to_customer_id','a.subject','a.message','a.time','a.status','b.fullname'])
		        ->from('tbl_enquiry a')
		        ->join('tbl_customers b', 'b.customer_id = a.to_customer_id')
		        ->where('route','R')
		        ->where('admin_delete',0)
		        ->order_by("enquiry_id","desc")
				->get();
			return $query->result();

	}

	public function get_messages()
	{
		$query = $this->db
				->select(['a.enquiry_id','a.customer_id','a.subject','a.message','a.status','a.time','b.fullname'])
		        ->from('tbl_enquiry a')
		        ->where('route','N')
		        ->where('admin_delete',0)
		        ->join('tbl_customers b', 'b.customer_id = a.customer_id')
		        ->order_by("enquiry_id","desc")
				->get();
			return $query->result();

	}

	public function update_main_category_model($main_category_id, Array $form_data)
	{
		return $this->db
					->where('main_category_id',$main_category_id)
					->update('tbl_main_category',$form_data);
	}

	public function get_main_category($main_category_id)
	{
		$query = $this->db
				->select(['main_category_id','main_category_name','order'])
		        ->from('tbl_main_category')
		        ->where('main_category_id',$main_category_id)
				->get();
			return $query->result();
	}

	public function remove_coupen($deposit_id)
	{
		return $this->db->delete('tbl_coupens',['deposit_id'=>$deposit_id]);
	}

	public function add_coupen($array)
	{
		return $this->db->insert('tbl_coupens',$array);
	}

	public function approve_customer_request($customer_id,Array $array)
	{
		return $this->db
					->where('customer_id',$customer_id)
					->update('tbl_customers',$array);
	}

	public function get_unverified_order_list()
	{
		$query = $this->db
				->select(['a.order_id','a.quantity','a.file','a.alter_file_name','a.order_date_time','a.sub_sub_category_id','a.batch','e.customer_official_id','e.fullname','d.sub_sub_category_name','c.sub_category_name','b.main_category_name','a.amount','a.order_status'])
		        ->from('tbl_orders a')
	            ->join('tbl_sub_sub_category d', 'd.sub_sub_category_id = a.sub_sub_category_id')
	            ->join('tbl_main_category b', 'b.main_category_id = d.main_category_id')
	            ->join('tbl_sub_category c', 'c.sub_category_id = d.sub_category_id')
	            ->join('tbl_customers e', 'e.customer_id = a.customer_id')
	            ->where('order_status',0)
	            ->order_by("order_id","desc")
				->get();
			return $query->result();
	}

	public function get_verified_order_list()
	{
		$query = $this->db
				->select(['a.order_id','a.quantity','a.file','a.alter_file_name','a.order_date_time','a.sub_sub_category_id','a.batch','e.customer_official_id','e.fullname','d.sub_sub_category_name','c.sub_category_name','b.main_category_name','a.amount','a.order_status'])
		        ->from('tbl_orders a')
	            ->join('tbl_sub_sub_category d', 'd.sub_sub_category_id = a.sub_sub_category_id')
	            ->join('tbl_main_category b', 'b.main_category_id = d.main_category_id')
	            ->join('tbl_sub_category c', 'c.sub_category_id = d.sub_category_id')
	            ->join('tbl_customers e', 'e.customer_id = a.customer_id')
	            ->where('order_status !=',0)
	            ->order_by("order_id","desc")
				->get();
			return $query->result();
	}

	public function get_sub_sub_category_data($sub_sub_category_id)
	{
		$query = $this->db
				->select(['b.main_category_name','a.sub_category_name','c.sub_sub_category_id','c.sub_sub_category_name','c.cost'])
		        ->from('tbl_sub_sub_category c')
	            ->join('tbl_main_category b', 'b.main_category_id = c.main_category_id')
	            ->join('tbl_sub_category a', 'a.sub_category_id = c.sub_category_id')
	            ->where('sub_sub_category_id',$sub_sub_category_id)
				->get();
			return $query->result();
	}

	public function get_sub_sub_category_selected($sub_cat_id)
	{
		$query = $this->db
				->where("sub_category_id",$sub_cat_id)
				->get("tbl_sub_sub_category");
			return $query->result();
	}

	public function get_sub_sub_category_list()
	{
		$query = $this->db
				->select(['b.main_category_name','a.sub_category_name','c.sub_sub_category_id','c.sub_sub_category_name','c.cost'])
		        ->from('tbl_sub_sub_category c')
	            ->join('tbl_main_category b', 'b.main_category_id = c.main_category_id')
	            ->join('tbl_sub_category a', 'a.sub_category_id = c.sub_category_id')
				->get();
			return $query->result();
	}

	public function get_ct_batch_by_id($country_id,$center_id,$main_category_id,$course_id)
	{
		$query = $this->db
				->where("country_id",$country_id)
				->where("center_id",$center_id)
				->where("main_category_id",$main_category_id)
				->where("course_id",$course_id)
		        ->from('tbl_ct_batches c')
				->get();
			return $query->result();
	}

	public function get_store_class_batch()
	{
		$query = $this->db
				->select(['e.country_name','d.center_name','b.main_category_name','a.sub_category_name','c.ct_batch_id','c.country_id','c.center_id','c.main_category_id','c.course_id','c.dates','c.from_time','c.to_time','c.course_fee_full','c.course_fee_offer','c.offer_untill_date'])
		        ->from('tbl_ct_batches c')
	            ->join('tbl_main_category b', 'b.main_category_id = c.main_category_id')
	            ->join('tbl_sub_category a', 'a.sub_category_id = c.course_id')
	            ->join('tbl_centers d', 'd.center_id = c.center_id')
	            ->join('tbl_countries e', 'e.country_id = c.country_id')
				->get();
			return $query->result();
	}

	public function store_class_batch($array)
	{
		return $this->db->insert('tbl_ct_batches',$array);
	}

	public function get_sub_category_selected($main_cat_id)
	{
		$query = $this->db
				->where("main_category_id",$main_cat_id)
				->get("tbl_sub_category");
			return $query->result();
	}

	public function get_sub_category_list()
	{
		$query = $this->db
				->select(['b.main_category_name','a.sub_category_id','a.sub_category_name'])
		        ->from('tbl_sub_category a')
	            ->join('tbl_main_category b', 'b.main_category_id = a.main_category_id')
				->get();
			return $query->result();
	}

	public function store_sub_category($array)
	{
		return $this->db->insert('tbl_sub_category',$array);
	}

	public function get_main_category_list()
	{
		$query = $this->db
				->select(['main_category_id','main_category_name','order'])
		        ->from('tbl_main_category')
		        ->order_by("order", "asc")
				->get();
			return $query->result();
	}

	public function store_main_category($array)
	{
		return $this->db->insert('tbl_main_category',$array);
	}

	public function get_customer_id($extracted_id)
	{
		$query = $this->db
				->select(['customer_id'])
		        ->from('tbl_customers')
		        ->where('customer_official_id',$extracted_id)
				->get();
				
		return $query->row()->customer_id;
	}

	public function save_recharge_info($array)
	{
		return $this->db->insert('tbl_deposits',$array);
	}

 	public function get_customer_detail($keyword)
	{
        $this->db->select('*')->from('tbl_customers'); 
        $this->db->like('customer_official_id',$keyword); 
        $this->db->or_like('fullname',$keyword); 
        $query = $this->db->get();     
        return $query->result();
	}

	public function update_topup_request($deposit_id, $status) 
	{
		return $this->db
					->where('deposit_id',$deposit_id)
					->set('status',$status)
					->set('verified',0)
					->update('tbl_deposits');
	}

	public function get_topup_requests()
	{
		$query = $this->db
				->select(['a.deposit_id','a.customer_id','b.customer_official_id','a.deposit_date','a.deposit_amount','a.payment_mode','a.transfer_no','a.payslip_copy','a.deposited_bank','a.deposited_branch','a.deposited_account','a.remarks'])
		        ->from('tbl_deposits a')
	            ->join('tbl_customers b', 'b.customer_id = a.customer_id')
		        ->where('a.status',0)
				->get();
			return $query->result();
	}

	public function get_topup_accepted_list()
	{
		$query = $this->db
				->select(['a.deposit_id','a.customer_id','b.customer_official_id','a.deposit_date','a.deposit_amount','a.payment_mode','a.transfer_no','a.payslip_copy','a.deposited_bank','a.deposited_branch','a.deposited_account','a.remarks'])
		        ->from('tbl_deposits a')
	            ->join('tbl_customers b', 'b.customer_id = a.customer_id')
		        ->where('a.status',1)
				->get();
			return $query->result();
	}

	public function get_topup_rejected_list()
	{
		$query = $this->db
				->select(['a.deposit_id','a.customer_id','b.customer_official_id','a.deposit_date','a.deposit_amount','a.payment_mode','a.transfer_no','a.payslip_copy','a.deposited_bank','a.deposited_branch','a.deposited_account','a.remarks'])
		        ->from('tbl_deposits a')
	            ->join('tbl_customers b', 'b.customer_id = a.customer_id')
		        ->where('a.status',2)
				->get();
			return $query->result();
	}

	public function get_membership_request_list()
	{
		$query = $this->db
				->select(['customer_id','customer_official_id','fullname','phone_no','email','customer_image','registration_date'])
		        ->from('tbl_customers')
		        ->where('status',0)
				->get();
			return $query->result();
	}

	public function get_membership_accepted_list()
	{
		$query = $this->db
				->select(['customer_id','customer_official_id','fullname','phone_no','email','customer_image','registration_date'])
		        ->from('tbl_customers')
		        ->where('status',1)
				->get();
			return $query->result();
	}

	public function get_membership_rejected_list()
	{
		$query = $this->db
				->select(['customer_id','customer_official_id','fullname','phone_no','email','customer_image','registration_date'])
		        ->from('tbl_customers')
		        ->where('status',2)
				->get();
			return $query->result();
	}

	public function update_customer_request_status($customer_id, $status)
	{
		return $this->db
					->where('customer_id',$customer_id)
					->set('status',$status)
					->update('tbl_customers');
	}

	public function update_customer_info($customer_id, Array $form_data)
	{
		return $this->db
					->where('customer_id',$customer_id)
					->update('tbl_customers',$form_data);
	}

	public function get_customer_details($customer_id)
	{
		$query = $this->db
				->select(['customer_id','customer_official_id','password','credit_limit','card_type','fullname','phone_no','email','customer_image','registration_date','company_name','company_address'])
		        ->from('tbl_customers')
		        ->where('customer_id',$customer_id)
				->get();
			return $query->result();
	}

	public function get_customer_list()
	{
		$query = $this->db
				->select(['customer_id','customer_official_id','fullname','phone_no','email','customer_image','registration_date'])
		        ->from('tbl_customers')
		        ->where('status',1)
				->get();
			return $query->result();
	}


	public function change_password($admin_id,$new_password)
	{

		return $this->db
					->where('id',$admin_id)
					->set('password',$new_password)
					->update('tbl_admins');

	}

}
?>
