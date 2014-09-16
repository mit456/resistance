<?php

class Broadcast_Messages extends CI_Model {

    public function get_messages($user_id) {
        $response = new stdClass();

        $broad_messages = $this->db->query("Select * from users INNER JOIN  broadcast_messages ON broadcast_messages.user_id = users.id where broadcast_messages.user_id = '7' or broadcast_messages.user_id = '$user_id'");

        $count = $broad_messages->num_rows();
        $response->broad_messages = $broad_messages->result();
        $response->count = $count;
        $response->success = TRUE;
        return $response;
    }

}

?>
