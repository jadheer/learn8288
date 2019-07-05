<?php
class Website_functions_model extends CI_Model
{

	function insertcart($basedata)
	{
		return $this->db->insert('tbl_cart',$basedata);
	}

	public function itemscart($user)
	{
		$query = $this->db
		->select(['user','id','name','price','qty'])
		->from('tbl_cart')
		->where('user',$user)
		->get();

		return $query->result();
	} 

	public function removecart($productid,$user) 
	{
		return $this->db->delete('tbl_cart',['id'=>$productid , 'user'=>$user]);
	}

	public function clearcart($user) 
	{
		return $this->db->delete('tbl_cart',['user'=>$user]);
	}

	public function updatecart($productid,$quantity,$user)
	{
		return $this->db
		->where('id',$productid)
		->where('user',$user)
		->set('qty',$quantity)
		->update('tbl_cart');
	}

	public function get_course_content($course_id)
	{
		$query = $this->db
				->where("course_id",$course_id)
				->get("tbl_course_contents");
			return $query->row();
	}

	public function get_ot_batch_by_id($course_id)
	{
		$query = $this->db
				->where("course_id",$course_id)
		        ->from('tbl_ot_batches')
		        ->order_by("ot_batch_id", "asc")
				->get();
			return $query->result();
	}

	public function get_ct_batch_by_id($country_id,$center_id,$course_id)
	{
		$query = $this->db
				->where("country_id",$country_id)
				->where("center_id",$center_id)
				->where("course_id",$course_id)
		        ->from('tbl_ct_batches c')
				->get();
			return $query->result();
	}

	public function get_countries_list()
	{
		$query = $this->db
				->select(['country_id','country_name'])
		        ->from('tbl_countries')
				->get();
			return $query->result();
	}

	public function get_course_id_by_slug($slug)
	{
		$query = $this->db
				->select(['sub_category_id','sub_category_name'])
		        ->where('slug',$slug)
		        ->from('tbl_sub_category')
				->get();

		return $query->row();
	}

	public function get_ot_count($course_id)
	{
        $query = $this->db
				->select(['ot_batch_id'])
		        ->from('tbl_ot_batches')
		        ->where('course_id',$course_id)
				->get();
			return $query->num_rows();
	}

	public function get_ct_count($course_id)
	{
        $query = $this->db
				->select(['ct_batch_id'])
		        ->from('tbl_ct_batches')
		        ->where('course_id',$course_id)
				->get();
			return $query->num_rows();
	}

	public function get_sub_category_list()
	{
		$query = $this->db
				->select(['b.main_category_name','a.main_category_id','a.sub_category_id','a.sub_category_name','a.slug'])
		        ->from('tbl_sub_category a')
	            ->join('tbl_main_category b', 'b.main_category_id = a.main_category_id')
	            ->order_by("main_category_id", "asc")
				->get();
			return $query->result();
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

}
?>
