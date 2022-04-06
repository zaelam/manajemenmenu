<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');

        $this->load->library('form_validation');
    }

    public function index()
    {
        // get user information

        $data['menu'] = $this->Menu_model->getMenu();
        $data['page'] = 'Menu Management';
        $this->load->view('v_header', $data);
        $this->load->view('v_menu', $data);
    }


    //add menu
    public function addMenu()
    {
        // get user information
        $data['page'] = 'Menu Management';

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
            'required' => 'Menu harus diisi!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            redirect('menu');
        } else {
            $this->Menu_model->addMenu($this->input->post('menu'), $this->input->post('link'));
            redirect('menu');
        }
    }


    // edit menu
    public function editMenu($id_menu)
    {
        // get user information
        $data['page'] = 'Menu Management';

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
            'required' => 'Menu name wajib diisi!'
        ]);
        if ($this->form_validation->run() == TRUE) {
            $this->Menu_model->editMenu($this->input->post(), $id_menu);
        }
        redirect('menu');
    }

    public function subMenu()
    {
        // get user information
        $data['user'] = $this->db->get_where('t_user', ['email' => $this->session->userdata('email')]);
        // get menu
        $data['menu'] = $this->Menu_model->getMenu();

        // get submenu
        $data['submenu'] = $this->Menu_model->getSubMenu()->result_array();
        // var_dump($data['menu']);
        // die;


        $data['title'] = 'Submenu Management';
        $this->load->view('v_header', $data);
        $this->load->view('v_submenu', $data);
    }

    public function addSubMenu()
    {
        // form validation
        $this->form_validation->set_rules('id_menu', 'Id_menu', 'required|trim');
        $this->form_validation->set_rules('sub_menu', 'Sub_menu', 'required|trim');
        $this->form_validation->set_rules('link', 'Link', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'id_menu' => $this->input->post('id_menu'),
                'sub_menu' => $this->input->post('sub_menu'),
                'link' => $this->input->post('link'),
            ];
            // send submenu data to model
            $this->Menu_model->addSubMenu($data);
            redirect('menu/subMenu');
        } else {
            redirect('menu/subMenu');
        }
    }

    public function editSubmenu($id_sub_menu)
    {
        // form validation
        $this->form_validation->set_rules('id_menu', 'Id_menu', 'required|trim');
        $this->form_validation->set_rules('sub_menu', 'Sub_menu', 'required|trim');
        $this->form_validation->set_rules('link', 'Link', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'id_menu' => $this->input->post('id_menu'),
                'sub_menu' => $this->input->post('sub_menu'),
                'link' => $this->input->post('link'),
            ];
            // send submenu data to model
            $this->Menu_model->editSubmenu($data, $id_sub_menu);
            redirect('menu/subMenu');
        } else {
            redirect('menu/subMenu');
        }
    }

    // this function can delete from various table
    public function delete($type = null, $id = null)
    {
        if (is_null($id) || is_null($type)) {
            redirect('menu');
        }
        switch ($type):
            case 'menu':
                $this->Menu_model->deleteMenu($id);
                redirect('menu');
                break;

            case 'submenu':
                $this->Menu_model->deleteSubmenu($id);
                redirect('menu/subMenu');
                break;
        endswitch;
    }

    public function getMenuEdit()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Menu_model->getMenuById($id));
    }

    public function getSubmenuEdit()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Menu_model->getSubmenuById($id));
    }
}
