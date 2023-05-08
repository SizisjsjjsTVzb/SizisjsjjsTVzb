<?php
// - Developer : @SiNoTz
error_reporting(0);
date_default_timezone_set('Asia/Tehran');
$API_KEY ="5258063948:AAGUfdSb3iR7XwCRHmz1ODlCxb00_HG9i4k";
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
function SendVideo($chatid,$video,$keyboard,$caption,$reply,$duration){
return bot('SendVideo',[
'chat_id'=>$chatid,
'video'=>$video,
'caption'=>$caption,
'reply_to_message_id'=>$reply,
'duration'=>$duration,
'reply_markup'=>$keyboard
]);
}

function sendphoto($chat_id, $photo, $captionl){
 bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>$photo,
 'caption'=>$caption,
 ]);
 }

function SendDocument($chatid,$document,$keyboard,$caption,$reply){
return bot('SendDocument',[
'chat_id'=>$chatid,
'document'=>$document,
'caption'=>$caption,
'reply_to_message_id'=>$reply,
'reply_markup'=>$keyboard
]);
}
function SendMessage($chat_id,$text,$mode,$keyboard,$reply,$disable='true'){
return bot('SendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>$mode,
'reply_to_message_id'=>$reply,
'disable_web_page_preview'=>$disable,
'reply_markup'=>$keyboard
]);
}
function EditMessageText($chat_id,$message_id,$text,$parse_mode,$disable_web_page_preview,$keyboard){
bot('editMessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>$text,
'parse_mode'=>$parse_mode,
'disable_web_page_preview'=>$disable_web_page_preview,
'reply_markup'=>$keyboard
]);
}

function AnswerCallbackQuery($callback_query_id,$text,$show_alert){
  bot('answerCallbackQuery',[
        'callback_query_id'=>$callback_query_id,
        'text'=>$text,
    'show_alert'=>$show_alert
    ]);
  }
function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
    function sendsticker($chat_id, $photo, $captionl){
 bot('sendsticker',[
 'chat_id'=>$chat_id,
 'sticker'=>$photo,
 'caption'=>$caption,
 ]);
 }
 function sendaction($chat_id, $action){
 bot('sendchataction',[
 'chat_id'=>$chat_id,
 'action'=>$action
 ]);
 }
 function getFile($file_id){
 return json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY.'/getFile?file_id='.$file_id));
}
function deleteFolder($path){
if(is_dir($path) === true){
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $file)
deleteFolder(realpath($path) . '/' . $file);
return rmdir($path);
}else if (is_file($path) === true)
return unlink($path);
return false;
}
function Ziper($folder_to_zip_path, $destination_zip_file_path){
$rootPath = realpath($folder_to_zip_path);
$zip = new ZipArchive();
$zip->open($destination_zip_file_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);
$files = new RecursiveIteratorIterator(
new RecursiveDirectoryIterator($rootPath),
RecursiveIteratorIterator::LEAVES_ONLY);
foreach ($files as $name => $file){
if(!$file->isDir()){
$filePath = $file->getRealPath();
$relativePath = substr($filePath, strlen($rootPath) + 1);
$zip->addFile($filePath, $relativePath);
}
}
$zip->close();
}

  function mediaTimeDeFormater($seconds)
  {
  $m = 'm';
$s = 's';
$h = 'h';
      if (!is_numeric($seconds))
          throw new Exception("Invalid Parameter Type!");

      $ret = "";
      $hours = (string)floor($seconds / 3600);
      $secs = (string)$seconds % 60;
      $mins = (string)floor(($seconds - ($hours * 3600)) / 60);
      $days = floor(($hours / 24));
      if (strlen($hours) == 1)
          $hours = "0" . $hours;
      if (strlen($secs) == 1)
          $secs = "0" . $secs;
      if (strlen($mins) == 1)
          $mins = "0" . $mins;
      if ($hours == 0)
  
          $ret = "$mins$m:$secs$s";
      else
          $ret = "$hours$h:$mins$m:$secs$s";
  
      return $ret;
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
$step = file_get_contents("step.txt");
$time = date('H:i:s');
$SERVER_Tz=('http://'.$_SERVER['HTTP_HOST'].'/Api-Tz');
$editm = $update->edited_message;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$id = $message->from->id;
$DeveloperTz = array("1660834081","5338490508","2141959357","504080684");

$Cancel = json_encode([
      'keyboard'=> [
      [['text'=> '/Cancel']]
      ],'resize_keyboard'=> true
]);
$Rem = json_encode([
      'ReplyKeyboardRemove'=>[
       []
      ],'remove_keyboard'=> true
]);
if(in_array($from_id, $DeveloperTz)) {

// Web Server - Developer : @SiNoTz
$instaDownloader = "null";
$instainfo = "$SERVER_Tz/Instagram.php";
$instainfo2 = "$SERVER_Tz/Instagraminfo.php";
$Twitter = "$SERVER_Tz/Twitter.php";
$SMSBooMBer = "$Remover/smsboomb.php";
$Cronjob = "$SERVER_Tz/Cronjob.php";
$ServerAPI = "$SERVER_Tz";
$Remover = "$SERVER_Tz/Remover.php";
// End Code - Developer : @SiNoTz

if($text == "/start" or $text == "/Cancel"){
file_put_contents("step.txt","none");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
<strong>├ • Ping ↬ /Ping
├ • Time ↬ /Time
├ • Timer ↬ /Timer
├ • Run Code ↬ /run code
├ • ┅┅━━━━ 𖣫 ━━━━┅┅ •
├ • Hack Game ↬ /Hack Game Coin Link
├ • Sms Boomber ↬ /sms number
├ • Cron Job ↬ /Cronjob link time
├ • Twitter info ↬ /info Twitter
├ • Instagram info ↬ /info instagram
├ • Downloade Post ↬ /Post link
├ • Downloade Story ↬ /Story id
├ • Remove Bg  ↬ /Remove Bg
├ • ┅┅━━━━ 𖣫 ━━━━┅┅ •
├ • Sticker To Photo ↬ /Sticker To Photo
├ • Photo To Sticker ↬ /Photo To Sticker
├ • Token info  ↬ /Tokeninfo Token
├ • Setwebhook ↬ /Setwebhook Token link
├ • Delete Webhook ↬ /Delwebhook Token
├ • ┅┅━━━━ 𖣫 ━━━━┅┅ •
├ • Info Folder  ↬ /info Folder
├ • Zip Folder  ↬ /Zip Folder
├ • Add File  ↬ /Add File file
├ • Delete File  ↬ /Delete File file
├ • Add Folder  ↬ /Add Folder folder
├ • Delete Folder  ↬ /Delete Folder folder
├ • ┅┅━━━━ 𖣫 ━━━━┅┅ •
├ • Developer ↬ @SiNoTz</strong>",
'parse_mode'=>"html",
'reply_markup'=>$Rem

]);
} 
if(preg_match('/^[\/\#\!\.]?ping$/i',$text)){
$domain = 'tcp://149.154.167.51';
    $port = 443;
    $starttime = microtime(true);
    $file = fsockopen($domain, $port, $s, $s, 1);
    $stoptime = microtime(true);
    fclose($file);
    $ping = floor(($stoptime - $starttime) * 1000);
    $load         = sys_getloadavg()[0];
    $mem_usage    = round((memory_get_usage() / 1024) / 1024, 1) . 'MB';
    $domain = $_SERVER['SERVER_NAME'];
    $version = PHPversion();
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
<strong>├ • Ping ↬ (<code>$load MS</code>)
├ • Ping Server ↬ (<code>$ping MS</code>)
├ • Ram Usage ↬ (<code>$mem_usage</code>)
├ • PHP Version ↬ (<code>$version</code>)
├ • Source Version ↬ (<code>v1</code>)
├ • Language ↬ (<code>PHP</code>)
├ • Server ↬ (<code>$domain</code>)
├ • ServerApi ↬ (<code>$ServerAPI</code>)
├ • Developer ↬ @SiNoTz</strong>",
'parse_mode'=>'html',
]);
} 
if(preg_match("/^[\/\#\!]?(time)$/ius", $text)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"<strong>├ • Time ↬ (<code>$time</code>)</strong>",
'parse_mode'=>'html',
]);
}
if (preg_match("~^[\/]run\s?(.*)~siu", $text, $match)) {
  $CodeResult = '';
  $CodeErrors = '';
  $Eval       = "return(function() use (&\$update,&\$text,&\$message_id,&\$from_id){{$match[1]}})();";
  try {
      ob_start();
      eval($Eval);
      $CodeResult .= ob_get_contents();
  } catch (\Throwable $e) {
      $CodeErrors .= $e->getMessage();
  }
  ob_end_clean();
  $Result = $CodeResult . $CodeErrors;
  bot('sendMessage',[
          'chat_id'             => $chat_id,
          'text'                => $Result,
          'reply_to_message_id' => $message_id
      ]);
}
if(preg_match('/^[\/\#\!\.]?timer$/i',$text)){
  $uptime = 1660320064;
  $uptime       = mediaTimeDeFormater(time() - $uptime);
      bot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
  <strong>├ • Time ↬ (<code>$uptime</code>)</strong>",
  'parse_mode'=>'html',
  
  ]);
  }
  

if(preg_match("/^[\/\#\!]?(TokenInfo) (.*)$/ius", $text, $m)){
$token = "$m[2]";
$inf = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
  $obj = objectToArrays($inf);
    $url = $obj['result']['url'];
    $certificate = $obj['result']['has_custom_certificate'];
    $panding = $obj['result']['pending_update_count'];
    $max = $obj['result']['max_connections'];
    $ip = $obj['result']['ip_address'];
    $ok = $obj['ok'];
  
    $getme = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getme"));
    $obj2 = objectToArrays($getme);
  $un = $obj2['result']['username'];
    $na = $obj2['result']['first_name'];
    $id = $obj2['result']['id'];
    $cj = $obj2['result']['can_join_groups'];
    $cr = $obj2['result']['can_read_all_group_messages'];
    $si = $obj2['result']['supports_inline_queries'];
  $ok2 = $obj2['ok'];
    if ($ok == 1 and $ok2 == 1) {
  if($url != ''){
      bot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
<strong>🎟 Name : <code>$na</code>
📯 ID : $id
🤖 ID BoT : @$un
🔍 iP : <code>$ip</code>
🌐 Link : <code>$url</code>
📥 Waiting : <code>$panding</code>
🔒 Maximum connections : <code>$max</code>
💠 Your Token : <code>$token</code></strong>",

  'parse_mode'=>'html',
  
  ]);
}else{
      bot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
<strong>🎟 Name : <code>$na<strong>
📯 ID : <code>$id<strong>
🤖 ID BoT : @$un
🌐 Link : <code>NoT SeT<strong>
💠 Your Token : <code>$token</code></strong>",
  'parse_mode'=>'html',
  
  ]);
}
}
}
if(preg_match("/^[\/\#\!]?(Setwebhook) (.*) (.*)$/ius", $text, $m)){
$token = $m[2];
$link = $m[3];
$get = json_decode(file_get_contents("https://api.telegram.org/bot$token/setwebhook?url=$link")); 
    $ok = $get->ok;
  if($ok == ok){
$getme = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getme"));
    $obj2 = objectToArrays($getme);
  $un = $obj2['result']['username'];
    $na = $obj2['result']['first_name'];
    $id = $obj2['result']['id'];
    $cj = $obj2['result']['can_join_groups'];
    $cr = $obj2['result']['can_read_all_group_messages'];
    $si = $obj2['result']['supports_inline_queries'];
  $ok2 = $obj2['ok'];
 bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>" 
<strong>Setwebhook ✅
🎟 Name : <strong>$na</code>
📯 ID : <code>$id</code>
🤖 ID BoT : @$un
🌐 Link : <code>$link</code>
💠 Token : <code>$token</code></strong>
",
'parse_mode'=>'html',
]);
  }else{
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"<strong>❌ Error !</strong>",
'parse_mode'=>'html',
]);
  }
}
if(preg_match("/^[\/\#\!]?(Delwebhook) (.*)$/ius", $text, $m)){
$token = "$m[2]";
file_get_contents("https://api.telegram.org/bot$token/deletewebhook");
 bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>" 
<strong>Webhook Delete ❌</strong>
",
'parse_mode'=>'html',
]);
}
if(preg_match("/^[\/\#\!]?(CronJob) (.*) ([0-9]+)$/ius", $text, $m)){
$link = "$m[2]";
$time = "$m[3]";
file_get_contents("$Cronjob?url=$link&time=$time");
 bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>" 
<strong>✅ Cron Job
Time : <code>$time</code>
Link : <code>$link</code></strong>
",
'parse_mode'=>'html',
]);
}

if(preg_match("/^[\/\#\!]?(info insta|info Instagram) (.*)$/ius", $text, $m)){
$user = $m[2];
$link = file_get_contents("$instainfo?User=$user&Mode=info");
$array=json_decode($link,true);
$fullname=$array['result']['full_name'];
if ($fullname == "") {
$name = "NoT SeT";
} else {
$name = "$fullname";
}
$username=$array['result']['username'];
$bios=$array['result']['biography'];
if ($bios == "") {
$bio = "NoT SeT";
} else {
$bio = "$bios";
}
$followers=$array['result']['edge_followed_by']['count'];
$following=$array['result']['edge_follow']['count'];
$post=$array['result']['edge_owner_to_timeline_media']['count'];
$photos=$array['result']['profile_pic_url'];
if ($photos == "") {
$photo = "https://t.me/BoTPach/11";
} else {
$photo = "$photos";
}
$is_private=$array['result']['is_private'];
if ($is_private == 1) {
$pri = "Yes";
} else {
$pri = "No";
}
$Profilemd=$array['result']['Profile Modified'];
$linkk = file_get_contents("$instainfo2?url=$user");
$r=json_decode($linkk,true);
$isVerified=$r['Results']['is_Verified'];
$user = $array['result']['id'];
bot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>$photo,
'caption'=>"
<strong>├ • ID ↬ <code>$user</code>
├ • Name ↬ <code>$name</code>
├ • UserName ↬ <code>$username</code>
├ • Biography ↴ ↴ ↴
├ • ┅┅━━━━ 𖣫 ━━━━┅┅ •
<code>$bio</code>
├ • ┅┅━━━━ 𖣫 ━━━━┅┅ •
├ • Post Count ↬ <code>$post</code>
├ • Followers Count ↬ <code>$followers</code>
├ • Following Count ↬ <code>$following</code>
├ • Private Account ↬ <code>$pri</code>
├ • Verified By instagram ↬ <code>$isVerified</code>
├ • Developer ↬ @SiNoTz
├ • ┅┅━━━━ 𖣫 ━━━━┅┅ •</strong>
",
  'parse_mode'=>'html',
]);
}
if(preg_match("/^[\/\#\!]?(infoT|info Twitter) (.*)$/ius", $text, $m)){
$id = $m[2];
$link = file_get_contents("$Twitter?id=$id");
$array = json_decode($link,true);
$Tweets=$array['Results']['Tweets'];
$Followers=$array['Results']['Followers'];
$Following=$array['Results']['Following'];
$Likes=$array['Results']['Likes'];
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
<strong>
├ • UserName ↬ @$id
├ • Tweets ↬ <code>$Tweets</code>
├ • Followers Count ↬ <code>$Followers</code>
├ • Following Count ↬ <code>$Following</code>
├ • Likes Count ↬ <code>$Likes</code>
├ • Developer ↬ @SiNoTz
├ • ┅┅━━━━ 𖣫 ━━━━┅┅ •</strong>
",
  'parse_mode'=>'html',
]);
}
if(preg_match("/^[\/\#\!]?(Add File) (.*)$/ius", $text , $m)){
file_put_contents("step.txt","Add file s");
file_put_contents("f.txt","$m[2]");
bot('sendmessage', [
'chat_id' => $chat_id,
'text' =>"Send Me File",
]);
}
if(isset($update->message->document) && $step =='Add file s'){
file_put_contents("step.txt","none");
$file = file_get_contents("f.txt");
  $file_id=$update->message->document->file_id;
  $get_file=getFile($file_id)->result;
  $file_path=$get_file->file_path;
  file_put_contents("$file",file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$file_path));

bot('sendmessage', [
'chat_id' => $chat_id,
'text' =>"
<strong>├ • Add File ↬ <code>$file</code></strong>
",
'parse_mode'=>'html',
]);
unlink("f.txt");
}
if(preg_match("/^[\/\#\!]?(Add Folder) (.*)$/ius", $text, $m)){
$file = "$m[2]";
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
<strong>├ • Add Folder ↬ <code>$file</code></strong>",
'parse_mode'=>'html',
]);
mkdir("$file");
}
if(preg_match("/^[\/\#\!]?(Delete Folder) (.*)$/ius", $text, $m)){
$folder = "$m[2]";
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
<strong>├ • Delete Folders ↬ <code>$folder</code></strong>",
'parse_mode'=>'html',
]);
deletefolder("$folder");
}
if(preg_match("/^[\/\#\!]?(Delete File) (.*)$/ius", $text, $m)){
$file = "$m[2]";
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
<strong>├ • Delete File ↬ <code>$file</code></strong>",
'parse_mode'=>'html',
]);
unlink("$file");
}
if(preg_match("/^[\/\#\!]?(Source|zip) (.*)$/ius", $text, $m)){
$zip = "$m[2]";
Ziper("$zip","$zip");
bot('senddocument',[
'chat_id'=>$chat_id,
'document'=>new CURLFile("$zip"),
]);
unlink("$zip");
}
if(preg_match("/^[\/\#\!]?(Info Folder) (.*)$/ius", $text, $m)){
$folder = "$m[2]";
$scan = scandir($folder);
$scan = array_diff($scan, ['.','..']);
foreach($scan as $value){
$all .= $value ."\n";
}
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"<strong>
$all
├ • Developer ↬ @SiNoTz</strong>",
'parse_mode'=>'html',
]);
}
if(preg_match("/^[\/\#\!]?(photo to sticker|عکس به استیکر)$/ius", $text)){

file_put_contents("step.txt","photo to sticker");
bot('sendmessage', [
'chat_id' => $chat_id,
'text' =>"Send Me Photo",
'reply_markup'=>$Cancel,
]);
}
elseif(isset($message->photo) && $step== 'photo to sticker'){
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('SiNoTz.png',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    sendsticker($chat_id , new CURLFile('SiNoTz.png'), "Developer : @SiNoTz");
    unlink ("SiNoTz.png");
    }
    
if(preg_match("/^[\/\#\!]?(sticker to photo|استیکر به عکس)$/ius", $text)){

file_put_contents("step.txt","sticker to photo");
bot('sendmessage', [
'chat_id' => $chat_id,
'text' =>"Send Me Sticker",
'reply_markup'=>$Cancel,
]);
}
elseif(isset($message->sticker) && $step == 'sticker to photo'){
$sticker = $message->sticker;
$file = $sticker->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('SiNoTz.png',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    sendphoto($chat_id , new CURLFile('SiNoTz.png'), "Developer : @SiNoTz");
    unlink ("SiNoTz.png");
    }

if(preg_match("/^[\/\#\!]?(sms) (.*)$/ius", $text, $m)){
$number = "$m[2]";
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
<strong>
├ • Waiting For Send ↬ <code>$number</code>
</strong>",
'parse_mode'=>'html',
]);
for($i=1; $i <= 180; $i++) {
file_get_contents("$SMSBooMBer?phone=$text$?count=20");
}
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
<strong>
├ • The End Boomber ↬ <code>$number</code>
</strong>",
'parse_mode'=>'html',
]);
}

if(preg_match("/^[\/\#\!]?(Hack Game) (.*) (.*)$/ius", $text, $m)){
$coin = "$m[2]";
$url = "$m[3]";
$xcoin = number_format($coin);
file_get_contents("https://api-bot.site/API/gamee.php?score=$coin&url=$url");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
**├ • Send (`$xcoin`) Coin**
**├ • Your Game ↬ [Link]($url)**
**├ • Developer ↬ @SiNoTz**
",
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if(preg_match("/^[\/\#\!]?(حذف بکگراند|Remove bg)$/ius", $text)){
file_put_contents("step.txt","Remove Bg");
bot('sendmessage', [
'chat_id' => $chat_id,
'text' =>"Send Me Photo",
 'reply_markup'=>$Cancel,
]);
}
elseif(isset($message->photo) && $step== 'Remove Bg'){
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('SiNoTz.png',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
$filee = "SiNoTz.png";
$img = file_get_contents("$Remover?url=".$filee);
     bot('sendDocument',[
 'chat_id'=>$chat_id,
 'document'=>$img,
]);
unlink ("SiNoTz.png");
}

if(preg_match("/^[\/\#\!]?(screen) (.*)$/ius", $text,$m)){
 bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>"https://api.apiflash.com/v1/urltoimage?access_key=64917d1e36c44484acd2a9824352c9c8&url=$m[2]",
 'caption'=>"
**├ • Screen Shot : [Link]($m[2])**
**├ • Developer : @SiNoTz**
 ",
 'parse_mode'=>'Markdown',
 ]);
}
}
if(preg_match("/^[\/\#\!]?(kos)$/ius", $text)){
$bans =  file_get_contents("$chat_id.txt");  
bot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>"https://bot99t.000webhostapp.com/x.php?text=$bans",
'caption'=>"Coded By @SiNoTz",]);
}
 $gt1 =file_get_contents("tolk/$id.txt");
if(preg_match('(:)',$text) and  $gt1 == $id){
file_put_contents("$chat_id.txt",$text);
}
// - Developer : @SiNoTz
?>
