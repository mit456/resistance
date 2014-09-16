<?php

class Users extends CI_Model {

    public function verify_registration($email) {
        $response = new stdClass();
        $sql_email_check = "select *from users where email = '$email'";
        $user_email_check = $this->db->query($sql_email_check);
        if ($user_email_check->num_rows() == 0)
            return FALSE;
        else
            $response->error = 'This Email-id is already registered';
        return $response;
    }

    public function verify_user($email, $password) {
        $response = new stdClass();
        $decrypted_password = strtoupper('*' . sha1(sha1($password, TRUE), FALSE));
        $sql_email_check = "select *from users where email = '$email'";
        $user_email_check = $this->db->query($sql_email_check);
        if ($user_email_check->num_rows() == 0) {
            $response->success = FALSE;
            $response->error = 'This email-id is not registered with Resistance. Please sign-up first';
            return $response;
        }

        $sql_user_check = "select *from users where email ='$email' and password = '$decrypted_password'";
        $user = $this->db->query($sql_user_check);
        if ($user->num_rows() == 0) {
            $response->success = FALSE;
            $response->error = "The password doesn't match. Please try again";
            return $response;
        } else {
            $user_data = $user->result();
            $response->user_data = $user_data;
            $response->success = TRUE;
            return $response;
        }
    }

}

?>
