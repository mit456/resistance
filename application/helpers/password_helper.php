<?php

class Password_Helper {

    public static function to_mysql_encoded($readable) {
        if (Utils::is_null_or_blank($readable)) {
            return NULL;
        }
        return strtoupper('*' . sha1(sha1($readable, TRUE), FALSE));
    }

    public static function compare($readable, $mysql_encoded) {
        if ($readable === NULL || $mysql_encoded === NULL) {
            return FALSE;
        }
        return self::to_mysql_encoded($readable) === strtoupper($mysql_encoded);
    }

    public static function generate_password($ci) {
        $ci->load->helper('string');
        return random_string('alpha', 10);
    }

}