<?php

$result_data = new stdClass();
$messages = array();
$message_ids = array();
$upvotes = array();
$downvotes = array();
$user_ids = array();

foreach ($data->broad_messages as $value) {
    array_push($messages, $value->message);
    array_push($upvotes, $value->upvote_count);
    array_push($downvotes, $value->downvote_count);
    array_push($user_ids, $value->user_id);
    array_push($message_ids, $value->id);
    $email = $value->email;
    $user_email = explode('@', $email);
    $username = $user_email[0];
}

$result_data->messages = $messages;
$result_data->upvotes = $upvotes;
$result_data->user_ids = $user_ids;
$result_data->message_ids = $message_ids;
$result_data->downvotes = $downvotes;
$result_data->username = $username;
$result_data->count = $data->count;
$result_data->success = TRUE;

echo json_encode($result_data);
?>
