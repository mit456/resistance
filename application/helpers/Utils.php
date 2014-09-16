<?php

class Utils {

    public static function json_encode($obj, $retry = TRUE) {
        $ret = json_encode($obj);
        $error = json_last_error();
        if ($error != JSON_ERROR_NONE) {
            if ($retry && $error == JSON_ERROR_UTF8) { //last try
                log_message('error', 'Found non utf8 charactes during json_encode. Trying with converting it to utf-8.');
                return self::json_encode_with_convert($obj);
            }

            throw new \Exception('json encoding failed with error: ' . $error);
        }
        return $ret;
    }

    private static function json_encode_with_convert($a) {
        if (is_null($a))
            return 'null';
        if ($a === false)
            return 'false';
        if ($a === true)
            return 'true';
        if (is_scalar($a)) {
            if (is_float($a)) {
                return floatval(str_replace(',', '.', strval($a)));
            }
            if (is_string($a)) {
                $b = mb_convert_encoding($a, 'UTF-8', 'Windows-1252');
                if ($a != $b) {
                    log_message('error', 'The culprit might be: ' . self::trim_non_utf8($a));
                }
                return self::json_encode($b, FALSE);
            }
            else
                return self::json_encode($a, FALSE);
        }
        $isList = true;
        for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
            if (key($a) !== $i) {
                $isList = false;
                break;
            }
        }
        $result = array();
        if ($isList) {
            foreach ($a as $v)
                $result[] = self::json_encode_with_convert($v);
            return '[' . join(',', $result) . ']';
        } else {
            foreach ($a as $k => $v)
                $result[] = self::json_encode_with_convert($k) . ':' . self::json_encode_with_convert($v);
            return '{' . join(',', $result) . '}';
        }
    }

}

?>
