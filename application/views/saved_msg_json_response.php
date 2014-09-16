<?php

$result_data = new stdClass();
$messages = array();

foreach ($response->saved_messages as $value) {
    array_push($messages, $value->message);
}

$result_data->messages = $messages;
$result_data->count = $response->count;
$result_data->success = TRUE;

echo json_encode($result_data);
?>
