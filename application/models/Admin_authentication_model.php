<?php
class Admin_authentication_model extends CI_Model
{

	public function change_password($admin_id,$new_password)
	{

		return $this->db
					->where('id',$admin_id)
					->set('password',$new_password)
					->update('tbl_admins');

	}

	public function check_password_correct($admin_id,$old_password)
	{

		$query = $this->db
						->select(['id'])
						->from('tbl_admins')
            			->where('id',$admin_id)
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

	public function login_valid($email,$password)
	{
		$q=$this->db
			->where(['email'=>$email,'password'=>$password])
			->get('tbl_admins');

		if($q->num_rows())
		{

			$logindata = [
		              	'user_id' => $q->row()->id,
		              	'email'   => $q->row()->email,
						'fullname' => $q->row()->fullname,
						'role' => $q->row()->role
		          		];

			$this->session->set_userdata($logindata);

			return true;

		}
		else
		{
			return FALSE;
		}
	}
}
?>
