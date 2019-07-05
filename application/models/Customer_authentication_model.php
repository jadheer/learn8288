<?php
class Customer_authentication_model extends CI_Model
{

	public function update_customer_photo($customer_image)
	{
		return $this->db
					->where('customer_id',$customer_image['customer_id'])
					->set('customer_image',$customer_image['customer_photo'])
					->update('tbl_customers');
	}

	public function add_new_customer_details($personal_data)
	{
		$this->db->insert('tbl_customers',$personal_data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function change_password($customer_id,$new_password)
	{
		return $this->db
					->where('customer_id',$customer_id)
					->set('password',$new_password)
					->update('tbl_customers');
	}

	public function check_password_correct($customer_id,$old_password)
	{
		$query = $this->db
						->select(['customer_id'])
						->from('tbl_customers')
            			->where('customer_id',$customer_id)
            			->where('password',$old_password)
						->get();

		if($query->num_rows())
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function login_valid($customer_official_id,$password)
	{
		$q=$this->db
			->where(['customer_official_id'=>$customer_official_id,'password'=>$password])
			->get('tbl_customers');

		if($q->num_rows())
		{
			$custmer_logindata = [
		              'customer_id' => $q->row()->customer_id,
		              'fullname' => $q->row()->fullname
		          		];

			$this->session->set_userdata($custmer_logindata);
			return true;
		}
		else
		{
			return FALSE;
		}
	}
}
?>
