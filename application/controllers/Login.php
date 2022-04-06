<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('recaptcha', 'form_validation'));
    }
    public function index()
    {
        $data = array(
            'recaptcha_html' => $this->recaptcha->render()
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required'
        );
        // $this->form_validation->set_rules('g-recaptcha-response', '<strong>Captcha</strong>', 'callback_getResponseCaptcha');
        // // set message form validation
        // $this->form_validation->set_message('required', '{field} is required.');
        // $this->form_validation->set_message('callback_getResponseCaptcha', '{field} {g-recaptcha-response} harus diisi. ');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login Page';
            $this->load->view('v_login', $data);
        } else {
            $this->_login();
        }
    }


    public function getResponseCaptcha($str)
    {
        $this->load->library('recaptcha');
        $response = $this->recaptcha->verifyResponse($str);
        if ($response['success']) {
            return true;
        } else {
            $this->form_validation->set_message('getResponseCaptcha', '%s is required.');
            return false;
        }
    }


    private function _login()
    {
        $email = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));
        $user = $this->db->get_where('t_user', ['email' => $email])->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'success' => TRUE,
                    'email' => $user['email'],
                    'nama_user' => $user['nama_user'],
                    'id_user' => $user['id_user'],
                    'id_role' => $user['id_role'],
                ];
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('message', '<div class="alert
                        alert-danger" role="alert">Password salah</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Username tidak terdaptar</div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama_user');
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Terima Kasih</div>');
        redirect('login');
    }

    public function blocked()
    {
        $data['title'] = '403 Forbidden';
        $this->load->view('errors/index', $data);
    }
}
