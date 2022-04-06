<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


	public function index()
	{
		$data['page'] = 'User';
		$data['user'] = $this->db->get('t_user')->result_array();
		// var_dump($data['user']);
		// die;
		$this->load->view('v_header', $data);
		$this->load->view('v_dashboard', $data);
	}

	// edit menu
	public function delete($id_user)
	{
		// get user information
		$data['page'] = 'User';
		$this->db->delete('t_user', ['id_user' => $id_user]);
		redirect('user');
	}
}
