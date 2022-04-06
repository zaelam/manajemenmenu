<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assignmenu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');

        $this->load->library('form_validation');
    }

    public function index($id_user)
    {
        // get user information
        $data['page'] = 'User';
        $data['id_user'] = $id_user;
        $data['relasi_menu'] = $this->Menu_model->getMenuByUser1($id_user)->result_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('v_header', $data);
        $this->load->view('v_assignmenu', $data);
    }


    //add menu
    public function addMenu()
    {
        // get user information
        $data['page'] = 'User';

        $this->form_validation->set_rules('id_menu', 'Id_menu', 'required|trim', [
            'required' => 'Menu harus diisi!'
        ]);

        $data = array(
            'id_menu' => $this->input->post('id_menu'),
            'id_user' => $this->input->post('id_user'),
        );
        if ($this->form_validation->run() == FALSE) {
            redirect('assignmenu/index/' . $data['id_user']);
        } else {
            // echo 'kk';
            $cek = $this->db->get_where('relasi_menu', $data)->row_array();
            // var_dump($cek);
            var_dump($data);
            if (!$cek) {
                $this->db->insert('relasi_menu', $data);
            }
            redirect('assignmenu/index/' . $data['id_user']);
        }
    }


    // edit menu
    public function delete($id_user, $id_relasi_menu)
    {
        // get user information
        $data['page'] = 'User';
        $this->db->delete('relasi_menu', ['id_relasi_menu' => $id_relasi_menu]);
        redirect('assignmenu/index/' . $id_user);
    }
}
