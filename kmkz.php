<?php
// - Developer : @SiNoTz
error_reporting(0);
date_default_timezone_set('Asia/Tehran');
$API_KEY ="6186826047:AAGSx0fs8l--NG7PVpvIJlYZLwlnE3OzqII";
define("API_KEY","$API_KEY");
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)){
    $message = $update->message; 
    $chat_id = $message->chat->id;
    $text = $message->text;
    $message_id = $message->message_id;
    $from_id = $message->from->id;
    $tc = $message->chat->type;
    $first_name = $message->from->first_name;
    $last_name = $message->from->last_name;
    $username = $message->from->username;
    $caption = $message->caption;
    $reply = $message->reply_to_message->forward_from->id;
    $reply_id = $message->reply_to_message->from->id;
}
$data = $update->callback_query->data;
$inid = $update->callback_query->from->id;
$msg_id = $update->callback_query->message->message_id;
$inmsgid = $update->callback_query->inline_message_id;
$tc = $update->message->chat->type;

$time = date('H:i:s');
$domain=$_SERVER['HTTP_HOST'];
$editm = $update->edited_message;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$id = $message->from->id;
if($text == "/start" ){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
- Hi , Welcoming",
'parse_mode'=>"html",
]);
} 
