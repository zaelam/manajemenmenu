<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('password');
    }

    public function processRegister()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|is_unique[t_user.email]', [
            'is_unique' => 'Email sudah terdapftar'
        ]);

        if ($this->form_validation->run() == false) {

            redirect('user');
        } else {
            $email = htmlspecialchars($this->input->post('email', true));
            $password = generatKode();
            $password1 = $password;
            $data = [
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'ps_kode' => $password1,
                'nama_user' => htmlspecialchars($this->input->post('nama_user', true)),
                'email' => $email,
            ];
            // siapkan token
            $token = '123456789!23fuIyGtFggHJIO09';
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => date('Y-m-d')
            ];

            $this->db->insert('t_token', $user_token);
            $this->db->insert('t_user', $data);

            $this->session->set_flashdata('message', '<div class="alert
				alert-success" role="alert">Berhasil registrasi, silahkan cek login</div>');
            redirect('user', 'refresh');
        }
    }
}
