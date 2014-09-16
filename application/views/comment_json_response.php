<?php
$result_data = new stdClass();
$comments = array();
$users_comment = array();
$created_dates = array();
$message_ids = array();

foreach($data->comments_data as $comment){
    array_push($comments, $comment->comment);
    $user_email = explode('@', $comment->email);
    array_push($users_comment, $user_email[0]);
    array_push($created_dates, $comment->created_at);
    array_push($message_ids, $comment->broadcast_msg_id);
}

$result_data->comments = $comments;
$result_data->users_comment = $users_comment;
$result_data->created_dates = $created_dates;
$result_data->count = $data->count;
$result_data->message_ids = $message_ids;
$result_data->success = TRUE;

echo json_encode($result_data);

?>
