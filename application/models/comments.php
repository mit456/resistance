<?php

class Comments extends CI_Model {

    public function get_comments($message_id) {
        $response = new stdClass();
        $comments = $this->db->query("Select * from comments INNER JOIN users ON comments.user_id = users.id where broadcast_msg_id = '$message_id'");
        $response->comments_data = $comments->result();
        $response->count = $comments->num_rows();
        return $response;
    }

}

?>
