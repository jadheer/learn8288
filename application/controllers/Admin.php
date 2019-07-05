<?php
class Admin extends CI_Controller
{

	public function update_password()
	{
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$admin_id = $this->session->userdata('user_id');
		$this->load->model('login_model');

		if($this->login_model->check_password_correct($admin_id,$old_password))
		{

			if( $this->login_model->change_password($admin_id,$new_password) )
			{
				$this->session->set_flashdata('feedback', 'Password updated successfully');
				$this->session->set_flashdata('feedback_class', 'alert-success');
			}
			else
			{
				$this->session->set_flashdata('feedback', 'Failed to update, Please try again');
				$this->session->set_flashdata('feedback_class', 'alert-danger');
			}
			return redirect('login/logout');

		}
		else
		{
			$this->session->set_flashdata('feedback', 'Please enter correct old password');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
			return redirect('admin/password_change_view');
		}

	}

	public function password_change_view()
	{
		$this->load->view('admin/password_settings_view');
	}

	public function dashboard()
	{
		$this->load->view('admin/dashboard_view');
	} 

	public function __construct()
	{
		parent::__construct();
		if(! $this->session->userdata('user_id') )
			return redirect('Admin_authentication');
	}
}
?>
