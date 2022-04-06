<?php defined('BASEPATH') or exit('No direct script access allowed');

require './application/libraries/RestController.php';
require './application/libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Users extends RestController
{
    public function __construct()
    {
        parent::__construct();
        // Load User Model
    }

    /**
     * User Login API
     * --------------------
     * @param: username or email
     * @param: password
     * --------------------------
     * @method : POST
     * @link: api/user/login
     */
    public function login_post()
    {
        header("Access-Control-Allow-Origin: *");

        # XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html)
        $_POST = $this->security->xss_clean($_POST);

        # Form Validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            // Form Validation Errors
            $this->response([
                'status' => 404,
                'message' => validation_errors()
            ], RestController::HTTP_NOT_FOUND);
        } else {

            // Load Authorization Token Library
            $this->load->library('Authorization_Token');

            // Load Login Function
            $email = trim($this->input->post('email'));
            $password = trim($this->input->post('password'));
            $user = $this->db->get_where('t_user', ['email' => $email])->row_array();
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user' => $user['id_user'],
                        'email' => $user['email'],
                        'nama_user' => $user['nama_user'],
                        'time' => time()
                    ];

                    $user_token = $this->authorization_token->generateToken($data);
                    $return_data = [
                        'id_user' => $user['id_user'],
                        'nama_user' => $user['nama_user'],
                        'email' => $user['email'],
                        'token' => $user_token,
                    ];

                    // Login Success
                    $this->response([
                        'status' => 200,
                        'data' => $return_data,
                        'message' => 'User login successful'
                    ], RestController::HTTP_OK);
                } else {
                    $message = [
                        'status' => FALSE,
                        'message' => "Invalid Username or Password"
                    ];
                    $this->response($message, RestController::HTTP_NOT_FOUND);
                }
            } else {
                $message = [
                    'status' => FALSE,
                    'message' => "Invalid Username or Password"
                ];
                $this->response($message, RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
