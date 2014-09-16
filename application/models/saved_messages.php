<?php

class Saved_Messages extends CI_Model {

    public function verify_message($message) {
        $response = new stdClass();
        $messages = $this->db->query("Select *from saved_messages where message = '$message'");
        if ($messages->num_rows() == 0)
            return FALSE;
        else
            $response->error = 'You have already saved this message';
        return $response;
    }

    public function get_saved_messages($user_id) {
        $response = new stdClass();
        $saved_messages = $this->db->query("Select * from saved_messages where user_id = '$user_id'");
        $count = $saved_messages->num_rows();
        $response->saved_messages = $saved_messages->result();
        $response->count = $count;
        $response->success = TRUE;
        return $response;
    }

}

?>
