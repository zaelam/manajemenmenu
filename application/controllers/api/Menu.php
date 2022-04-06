<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './application/libraries/RestController.php';
require './application/libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Menu extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model_api', 'Menu_model');

        $this->load->library('form_validation');
    }

    public function index_get()
    {
        header("Access-Control-Allow-Origin: *");

        // Load Authorization Token Library
        $this->load->library('Authorization_Token');

        /**
         * User Token Validation
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) and $is_valid_token['status'] === TRUE) {
            $data['menu'] = $this->Menu_model->getMenu();
            $data['page'] = 'Menu Management';
            if ($data['menu']) {
                // Set the response and exit
                $this->response($data, 200);
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'No menu were found'
                ], 404);
            }
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message']], RestController::HTTP_NOT_FOUND);
        }
    }


    //add menu
    public function addMenu_post()
    {
        header("Access-Control-Allow-Origin: *");

        // Load Authorization Token Library
        $this->load->library('Authorization_Token');

        /**
         * User Token Validation
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) and $is_valid_token['status'] === TRUE) {
            // get user information
            $data['page'] = 'Menu Management';

            $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
                'required' => 'Menu harus diisi!'
            ]);
            if ($this->form_validation->run() == FALSE) {
                $this->response([
                    'status' => 404,
                    'message' => 'failed validation'
                ], RestController::HTTP_BAD_REQUEST);
            } else {
                if ($this->Menu_model->addMenu($this->input->post('menu'), $this->input->post('link')) > 0) {
                    $this->response([
                        'status' => 200,
                        'message' => 'success'
                    ], RestController::HTTP_OK);
                } else {
                    $this->response([
                        'status' => 404,
                        'message' => 'failed'
                    ], RestController::HTTP_BAD_REQUEST);
                }
            }
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message']], RestController::HTTP_NOT_FOUND);
        }
    }


    // edit menu
    public function editMenu_put($id_menu)
    {
        header("Access-Control-Allow-Origin: *");

        // Load Authorization Token Library
        $this->load->library('Authorization_Token');

        /**
         * User Token Validation
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) and $is_valid_token['status'] === TRUE) {
            // get user information
            $data['page'] = 'Menu Management';

            $this->form_validation->set_rules('menu', 'Menu', 'required', [
                'required' => 'Menu harus diisi!'
            ]);
            $menu = array(
                'menu' => $this->put('menu'),
                'link' => $this->put('link')
            );
            if ($this->Menu_model->editMenu($menu, $id_menu) > 0) {
                $this->response([
                    'status' => 200,
                    'message' => 'success'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => 404,
                    'message' => 'failed'
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message']], RestController::HTTP_NOT_FOUND);
        }
    }


    // this function can delete from various table
    public function menu_delete($id = null)
    {
        header("Access-Control-Allow-Origin: *");

        // Load Authorization Token Library
        $this->load->library('Authorization_Token');

        /**
         * User Token Validation
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) and $is_valid_token['status'] === TRUE) {
            if ($this->Menu_model->deleteMenu($id) > 0) {
                $this->response([
                    'status' => 200,
                    'message' => 'success'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => 404,
                    'message' => 'failed'
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message']], RestController::HTTP_NOT_FOUND);
        }
    }
}
