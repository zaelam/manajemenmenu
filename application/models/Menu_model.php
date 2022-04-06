<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    // MENU SECTION

    // get all menu
    public function getMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    // get menu by user
    public function getMenuByUser()
    {
        $id_user = $this->session->userdata('id_user');
        $this->db->select('a.*, b.menu, b.link');
        $this->db->from('relasi_menu a');
        $this->db->join('user_menu b', 'a.id_menu =b.id_menu');
        $this->db->where('a.id_user', $id_user);
        $this->db->order_by('a.id_menu');
        $query = $this->db->get();
        return $query;
    }

    public function getMenuByUser1($id_user)
    {
        $this->db->select('a.*, b.menu, b.link');
        $this->db->from('relasi_menu a');
        $this->db->join('user_menu b', 'a.id_menu =b.id_menu');
        $this->db->where('a.id_user', $id_user);
        $this->db->order_by('a.id_menu');
        $query = $this->db->get();
        return $query;
    }

    // get menu by id
    public function getMenuById($id)
    {
        return $this->db->get_where('user_menu', ['id', $id])->row_array();
    }

    // add new menu
    public function addMenu($menu, $link)
    {
        $this->db->insert('user_menu', ['menu' => $menu, 'link' => $link]);
    }

    // delete menu by id
    public function deleteMenu($id)
    {
        $this->db->where('id_menu', $id);
        $this->db->delete('user_menu');
    }

    // edit menu
    public function editMenu($data, $id_menu)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->update('user_menu', $data);
    }

    // SUBMENU SECTION 

    // get submenu
    public function getSubMenu()
    {
        $this->db->select('a.*, b.menu, b.link as menu_link');
        $this->db->from('user_sub_menu a');
        $this->db->join('user_menu b', 'a.id_menu =b.id_menu');
        $query = $this->db->get();
        return $query;
    }

    // get submenu by id
    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    // add submenu
    public function addSubMenu($data)
    {
        $this->db->insert('user_sub_menu', $data);
    }

    // delete submenu
    public function deleteSubmenu($id)
    {
        $this->db->where('id_sub_menu', $id);
        $this->db->delete('user_sub_menu');
    }

    // edit submenu
    public function editSubmenu($data, $id_sub_menu)
    {
        $this->db->where('id_sub_menu', $id_sub_menu);
        $this->db->update('user_sub_menu', $data);
    }
}
