<?php
class Admin_authentication extends CI_Controller
{
	public function index()
	{
		if( $this->session->userdata('user_id') )
			return redirect('admin/dashboard');
		$this->load->view('login_view');
	} 

	public function admin_login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
		if($this->form_validation->run('admin_login'))
		{
			$email = $this->input->post('email'); 
			$password = $this->input->post('password'); 
			$this->load->model('admin_authentication_model');
			$login_id = $this->admin_authentication_model->login_valid($email,$password);
			if($login_id)
			{
				$this->session->set_flashdata('feedback', 'Welcome back Admin');
				$this->session->set_flashdata('feedback_class', 'alert-success');
				return redirect('Admin/dashboard');
			}
			else
			{
				$this->session->set_flashdata('login_failed', 'Invalid Username/Password');
				return redirect('Admin_authentication');
			}
		}
		else
		{
			$this->load->view('login_view');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('user_id');
		return redirect('Admin_authentication');
	}
}
?>
