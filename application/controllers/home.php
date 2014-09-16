<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) {
            session_start();
        }
        $this->load->database();
        $this->load->model('users');
        $this->load->model('broadcast_messages');
        $this->load->model('saved_messages');
        $this->load->model('comments');
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            $this->load->view('login');
        } else {
            $this->load->view('home');
        }
    }

    public function login_submit() {
        $data = new stdClass();
        $post_input = $this->input->post();
        $input_email = $post_input['login_email'];
        $input_password = $post_input['login_password'];
        $response = $this->users->verify_user($input_email, $input_password);

        if ($response->success == FALSE) {
            $data->success = FALSE;
            $data->error = $response->error;
            $this->load->view('json_response.php', array('data' => $data));
            exit();
        } else {
            foreach ($response->user_data as $value) {
                $user_id = $value->id;
            }
            $_SESSION['user_id'] = $user_id;
            $data->success = TRUE;
            $this->load->view('json_response.php', array('data' => $data));
        }
    }

    public function signup_submit() {
        $data = new stdClass();
        $post_input = $this->input->post();
        $encrypted_password = strtoupper('*' . sha1(sha1($post_input['password'], TRUE), FALSE));
        $input_data = array(
            'first_name' => $post_input['first_name'],
            'last_name' => $post_input['last_name'],
            'email' => $post_input['email'],
            'password' => $encrypted_password
        );
        $response = $this->users->verify_registration($input_data['email']);

        if (!$response) {
            $this->db->insert('users', $input_data);
            $data->success = TRUE;
            $data->success_message = 'Your registration is done. Now login';
            $this->load->view('json_response.php', array('data' => $data));
        } else {
            $data->success = FALSE;
            $data->error = $response->error;
            $this->load->view('json_response.php', array('data' => $data));
        }
    }

    public function broadcast_submit() {
        $data = new stdClass();
        $date_time = new DateTime();
        $post_input = $this->input->post();
        $user_id = $_SESSION['user_id'];
        $created_at = $date_time->format('Y-m-d');
        $input_data = array(
            'user_id' => $user_id,
            'message' => $post_input['broadcast_message'],
            'created_at' => $created_at
        );
        $this->db->insert('broadcast_messages', $input_data);
        $data->success = TRUE;
        $this->load->view('json_response.php', array('data' => $data));
    }

    public function save_message() {
        $data = new stdClass();
        $post_input = $this->input->post();
        $user_id = $_SESSION['user_id'];
        $input_data = array(
            'user_id' => $user_id,
            'message' => $post_input['message']
        );
        $response = $this->saved_messages->verify_message($post_input['message']);

        if (!$response) {
            $this->db->insert('saved_messages', $input_data);
            $data->success = TRUE;
            $data->success_message = 'Your message has been successfully saved, To see click saved messages';
            $this->load->view('json_response.php', array('data' => $data));
        } else {
            $data->success = FALSE;
            $data->error = $response->error;
            $this->load->view('json_response.php', array('data' => $data));
        }
    }

    public function get_broadcast_messages() {
        if (!isset($_SESSION['user_id'])) {
            $this->load->view('login');
        } else {
            $data = new stdClass();
            $user_id = $_SESSION['user_id'];
            $response = $this->broadcast_messages->get_messages($user_id);
            $data->broad_messages = $response->broad_messages;
            $data->count = $response->count;
            $this->load->view('json_response_message.php', array('data' => $data));
        }
    }

    public function get_new_broadcast_message() {
        if (!isset($_SESSION['user_id'])) {
            $this->load->view('login');
        } else {
            $data = new stdClass();
            $user_id = $_SESSION['user_id'];
        }
    }

    public function get_comments() {
        if (!isset($_SESSION['user_id'])) {
            $this->load->view('login');
        } else {
            $data = new stdClass();
            $user_id = $_SESSION['user_id'];
            $message_id = $this->input->post('message_id');
            $response = $this->comments->get_comments($message_id);
            $data->comments_data = $response->comments_data;
            $data->count = $response->count;
            $this->load->view('comment_json_response.php', array('data' => $data));
        }
    }

    public function get_saved_messages() {
        if (!isset($_SESSION['user_id'])) {
            $this->load->view('login');
        } else {
            $user_id = $_SESSION['user_id'];
            $response = $this->saved_messages->get_saved_messages($user_id);
            $this->load->view('saved_msg_json_response.php', array('response' => $response));
        }
    }

    public function logout() {
        $data = new stdClass();
        session_destroy();
        $data->success = TRUE;
        echo json_encode($data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */