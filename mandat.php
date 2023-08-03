<?php
ini_set('display_errors', 1);
ob_start();
error_reporting(0);
define('API_KEY','6321601405:AAFIvH0G6ZF7X88uu8vl9dchwZnPe7tQQ');
$token ="6321601405:AAFIvF0H0G6ZF7X88uu8vl9dchwZnPe7tQQ";
$admin = array("1948897525","5204489402");
$bot = bot('getme',['bot'])->result->username;
// echo file_get_contents('https://api.telegram.org/bot'.API_KEY.'/setwebhook?url='.$_SERVER["SERVER_NAME"].''.$_SERVER["SCRIPT_NAME"].'&allowed_updates=["message","edited_message","callback_query","my_chat_member","chat_member"]');


include ("sql.php");


$a=mysqli_query($db," create table users(
id int(20) auto_increment primary key,
user_id varchar(100),
lang varchar(200)
)");


$b=mysqli_query($db," create table groups(
id int(20) auto_increment primary key,
chat_id varchar(200)
)");

function bot($method,$datas=[]){
$url = "https://api.unlimited-telegram.org/bot".API_KEY."/$method";
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
function get($h){
return file_get_contents($h);
}

function keyboard($a=[]){
$d=json_encode([
inline_keyboard=>$a
]);
return $d;
}
function sms($id,$tx,$m){
return bot('sendMessage',[
'chat_id'=>$id,
'text'=>$tx,
'parse_mode'=>"HTML",
'reply_markup'=>$m,
]);
}
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$cid = $message->chat->id;
$chat_id = $message->chat->id;
$uid = $message->from->id;
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$name = $message->chat->first_name;
$user = $message->chat->username;
$data = $update->callback_query->data;
$cid2 = $update->callback_query->message->chat->id;
$replytomessageID = $update->message->reply_to_message->message_id;
$uid2 = $update->callback_query->from->id;
$mid2 = $update->callback_query->message->message_id;
$step = file_get_contents("step/$cid.step");
mkdir("step");
$resuult = mysqli_query($db,"SELECT * FROM ban WHERE user_id = '$cid'");
    $ban = mysqli_fetch_assoc($resuult);

if($ban==true){
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"❗<b>Siz Administrator Tomonidan Blocklangansiz</b>.",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['remove_keyboard'=>true,]),
]);
unlink("step/$cid.step");
return false;
}
$result = mysqli_query($db,"SELECT * FROM users WHERE user_id = '$cid'");
$row = mysqli_fetch_assoc($result);
$lang=$row["lang"];


$til = json_encode([
'inline_keyboard'=>[
[['text'=>"🇺🇿 O'zbekcha",'callback_data'=>"lang_uz"],['text'=>"🇺🇲 English",'callback_data'=>"lang_en"]],
[['text'=>"🇷🇺 Русский",'callback_data'=>"lang_ru"]],
]
]);



if($type == "private"){
$result = mysqli_query($db, "SELECT * FROM users WHERE user_id = '$cid'");
$row = mysqli_fetch_assoc($result);
if($row){
}else{
mysqli_query($db, "INSERT INTO users(user_id, lang) VALUES ('$cid','NULL')");
}
}






if($text == "/start" or $text == "/start@$bot" and $type == "private"){ 
if($lang ==null){
	bot('sendmessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Please, select a new language!</b>",
	'parse_mode'=>"html",
	'reply_markup'=>$til,
]);
exit();
}elseif($lang == "uz"){
	bot('sendmessage',[
	'chat_id'=>$cid,
'text'=>"<b> Xush kelibsiz, Bot orqali mandatingizni  tekshirishingiz mumkin:


Tekshirish uchun id yoki Qr codengizni yuboring.</b>",
	'parse_mode'=>"html",
]);
exit();
}elseif($lang == "ru"){
	bot('sendmessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Добро пожаловать, вы можете проверить свои учетные данные с помощью Bot:


Отправьте свой идентификатор или Qr-код для проверки.</b>",
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,
]);
exit();
}elseif($lang == "en"){
	bot('sendmessage',[
	'chat_id'=>$cid,
		'text'=>"<b>
Welcome, you can check your credentials with Bot:.


Send your id or Qr code to check.</b>",
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,	
]);
exit();
}
}

if($text == "/lang" and $type == "private"){
bot('sendmessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Please, select a new language!</b>",
	'parse_mode'=>"html",
	'reply_markup'=>$til,
]);
exit();
}

if(mb_stripos($data,"lang")!==false){
$lang=explode("_",$data)[1];
mysqli_query($db, "UPDATE users SET lang='$lang' WHERE user_id='$uid2'");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
if($lang == "uz"){
	bot('sendmessage',[
	'chat_id'=>$cid2,
	'text'=>"<b> Xush kelibsiz, Bot orqali mandatingizni  tekshirishingiz mumkin:.


Tekshirish uchun id yoki Qr codengizni yuboring.</b>",
	'parse_mode'=>"html",
]);
exit();
}elseif($lang == "ru"){
	bot('sendmessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Добро пожаловать, вы можете проверить свои учетные данные с помощью Bot:.


Отправьте свой идентификатор или Qr-код для проверки.</b>",
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,

]);
exit();
}elseif($lang == "en"){
	bot('sendmessage',[
	'chat_id'=>$cid2,
	'text'=>"<b> 
Welcome, you can check your credentials with Bot:.


Send your id or Qr code to check.</b>",
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,	
]);
exit();
}
}

if(is_numeric($text) == true){
$wait = bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"⏳",
])->result->message_id;
$json = json_decode(file_get_contents("https://shahzodbek.avotra.uz/mandat/api.php?id=$text&password=soqssqatwuwujjsjjsjsss"), true); 
$id = $json['short']['0']['id'];
$name = $json['short']['0']['name'];
if($name ==""){
        bot('sendMessage',[
            'chat_id'=>$cid,
            'text'=>"ID topilmadi",
'parse_mode'=>"html",

]);
}else{
$yunalish = $json['short']['0']['yunalish'];
$holat = $json['short']['0']['tavsiya'];
$muassasa = $json['short']['0']['muassasa'];
$ball = $json['short']['0']['ball'];
$tili = $json['short']['0']['til'];
$shakl = $json['short']['0']['shakli'];
$shaha ="<b>🆔ID</b> :  $id
<b>👤F.I.O</b> :  $name
<b>➕Yo'nalish</b> : $yunalish
<b>📋Holati</b> :$holat
<b>📍Oliy ta'lim muassasasi</b> : $muassasa
<b>📊To'plagan ball</b> : $ball
<b>🌐Ta'lim tili</b> : $tili
<b>📃Ta'lim shakli</b> : $shakl";
        bot('sendMessage',[
            'chat_id'=>$cid,
            'text'=>$shaha,
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Batafsil",'callback_data'=>"shah_$id"]],
]
]),
]);
}
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$wait,
]);

}


$photo = $message->photo;
 if(isset($photo)){
     $wait = bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"⏳",
])->result->message_id;
$photo = $message->photo;
$photo_id = $message->photo[count($message->photo)-1]->file_id;
$photo_info = json_decode(file_get_contents("https://api.telegram.org/bot$token/getFile?file_id=$photo_id"), true);
$file_path = $photo_info["result"]["file_path"];
$photo_url = "https://api.telegram.org/file/bot$token/$file_path";
      $get=file_get_contents("http://api.qrserver.com/v1/read-qr-code/?fileurl=".$photo_url);
$test2=str_replace('[{"type":"qrcode","symbol":[{"seq":0,"data":"','',$get);
$test2=str_replace('","error":null}]}]','',$test2);
$test2=str_replace('"','',$test2);
$test2=str_replace('\n','TT',$test2);
$test2=str_replace('\/',"/",$test2);
$test2=str_replace(';','',$test2);
$test2=str_replace("TT","\n",$test2);
$qrtexti=$test2;
              bot('sendDocument',[
            'chat_id'=>$cid,
            'document'=>$qrtexti,
'parse_mode'=>"html",
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$wait,
]);
}
   if(mb_stripos($data,"shah")!==false){
   $ids=explode("_",$data)[1];
$json = json_decode(file_get_contents("http://shahzodbek.avotra.uz/mandat/api.php?id=$ids&password=soqssqatwuwujjsjjsjsss"), true); 
$id = $json['short']['0']['id'];
$name = $json['short']['0']['name'];
$yunalish = $json['short']['0']['yunalish'];
$holat = $json['short']['0']['tavsiya'];
$muassasa = $json['short']['0']['muassasa'];
$ball = $json['short']['0']['ball'];
$tili = $json['short']['0']['til'];
$shakl = $json['short']['0']['shakli'];     
//_------_-----+++++&+$+$+$+$+$
$id1 = $json['long']['0']['id'];
$muassasa1 = $json['long']['0']['muassasa'];
$yunalish = $json['long']['0']['yunalish'];
$shakli = $json['long']['0']['shakli'];
$shifr = $json['long']['0']['shifr'];
$qgarant =$json['long']['0']['qabul']['garant'];
$qshart =$json['long']['0']['qabul']['shartnoma'];
$ogarant =$json['long']['0']['otish']['garant'];
$oshart =$json['long']['0']['otish']['shartnoma'];
//_------_-----+++++&+$+$+$+$+$
$id12 = $json['long']['1']['id'];
$muassasa12 = $json['long']['1']['muassasa'];
$yunalish2 = $json['long']['1']['yunalish'];
$shakli2 = $json['long']['1']['shakli'];
$shifr2 = $json['long']['1']['shifr'];
$qgarant2 =$json['long']['1']['qabul']['garant'];
$qshart2 =$json['long']['1']['qabul']['shartnoma'];
$ogarant2=$json['long']['1']['otish']['garant'];
$oshart2 =$json['long']['1']['otish']['shartnoma'];
//_------_-----+++++&+$+$+$+$+$
$id13 = $json['long']['2']['id'];
$muassasa13 = $json['long']['2']['muassasa'];
$yunalish3 = $json['long']['2']['yunalish'];
$shakli3= $json['long']['2']['shakli'];
$shifr3 = $json['long']['2']['shifr'];
$qgarant3 =$json['long']['2']['qabul']['garant'];
$qshart3 =$json['long']['2']['qabul']['shartnoma'];
$ogarant3 =$json['long']['2']['otish']['garant'];
$oshart3 =$json['long']['2']['otish']['shartnoma'];
//_------_-----+++++&+$+$+$+$+$
$id14 = $json['long']['3']['id'];
$muassasa14 = $json['long']['3']['muassasa'];
$yunalish4 = $json['long']['3']['yunalish'];
$shakli4 = $json['long']['3']['shakli'];
$shifr4 = $json['long']['3']['shifr'];
$qgarant4 =$json['long']['3']['qabul']['garant'];
$qshart4 =$json['long']['3']['qabul']['shartnoma'];
$ogarant4 =$json['long']['3']['otish']['garant'];
$oshart4 =$json['long']['3']['otish']['shartnoma'];
//_------_-----+++++&+$+$+$+$+$
$id15 = $json['long']['4']['id'];
$muassasa15 = $json['long']['4']['muassasa'];
$yunalish5 = $json['long']['4']['yunalish'];
$shakli5 = $json['long']['4']['shakli'];
$shifr5 = $json['long']['4']['shifr'];
$qgarant5 =$json['long']['4']['qabul']['garant'];
$qshart5 =$json['long']['4']['qabul']['shartnoma'];
$ogarant5 =$json['long']['4']['otish']['garant'];
$oshart5 =$json['long']['4']['otish']['shartnoma'];
           bot('sendMessage',[
            'chat_id'=>$cid2,
            'text'=>"<b>🆔ID</b> :  $id
<b>👤F.I.O</b> :  $name
<b>➕Yo'nalish</b> : $yunalish
<b>📋Holati</b> : $holat
<b>📌Oliy ta'lim muassasasi</b> : $muassasa
<b>📊To'plagan ball</b> : $ball
<b>🌐Ta'lim tili</b> : $tili
<b>📃Ta'lim shakli</b> : $shakl

➖➖➖➖➖➖➖➖➖➖➖➖➖

<b>🧾Yo‘nalishlar ketma-ketligi :</b> $id1
<b>🏫Oliy ta‘lim muassasasi :</b> $muassasa1
<b>📑Yo‘nalish : </b>$yunalish
<b>📝Ta‘lim shakli : </b>$shakli
<b>🔖Shifri</b> : $shifr
<b>📚Qabul rejasi : (
📊Davlat granti : </b>$qgarant
<b>💳To‘lov shartnoma : </b>$qshart<b>
)</b>
<b>📈O‘tish bali : (
📊Davlat granti : </b> $ogarant
<b>💳To‘lov shartnoma : </b> $oshart<b>
)</b>

➖➖➖➖➖➖➖➖➖➖➖➖➖

<b>🧾Yo‘nalishlar ketma-ketligi :</b> $id12
<b>🏫Oliy ta‘lim muassasasi :</b> $muassasa12
<b>📑Yo‘nalish : </b>$yunalish2
<b>📝Ta‘lim shakli : </b>$shakli2
<b>🔖Shifri</b> : $shifr2
<b>📚Qabul rejasi : (
📊Davlat granti : </b>$qgarant2
<b>💳To‘lov shartnoma : </b>$qshart2<b>
)</b>
<b>📈O‘tish bali : (
📊Davlat granti : </b> $ogarant2
<b>💳To‘lov shartnoma : </b> $oshart2<b>
)</b>

➖➖➖➖➖➖➖➖➖➖➖➖➖

<b>🧾Yo‘nalishlar ketma-ketligi :</b> $id13
<b>🏫Oliy ta‘lim muassasasi :</b> $muassasa13
<b>📑Yo‘nalish : </b>$yunalish3
<b>📝Ta‘lim shakli : </b>$shakli3
<b>🔖Shifri</b> : $shifr3
<b>📚Qabul rejasi : (
📊Davlat granti : </b>$qgarant3
<b>💳To‘lov shartnoma : </b>$qshart3<b>
)</b>
<b>📈O‘tish bali : (
📊Davlat granti : </b> $ogarant3
<b>💳To‘lov shartnoma : </b> $oshart3<b>
)</b>

➖➖➖➖➖➖➖➖➖➖➖➖➖

<b>🧾Yo‘nalishlar ketma-ketligi :</b> $id14
<b>🏫Oliy ta‘lim muassasasi :</b> $muassasa14
<b>📑Yo‘nalish : </b>$yunalish4
<b>📝Ta‘lim shakli : </b>$shakli4
<b>🔖Shifri</b> : $shifr4
<b>📚Qabul rejasi : (
📊Davlat granti : </b>$qgarant4
<b>💳To‘lov shartnoma : </b>$qshart4<b>
)</b>
<b>📈O‘tish bali : (
📊Davlat granti : </b> $ogarant4
<b>💳To‘lov shartnoma : </b> $oshart4<b>
)</b>

➖➖➖➖➖➖➖➖➖➖➖➖➖

<b>🧾Yo‘nalishlar ketma-ketligi :</b> $id15
<b>🏫Oliy ta‘lim muassasasi :</b> $muassasa15
<b>📑Yo‘nalish : </b>$yunalish5
<b>📝Ta‘lim shakli : </b>$shakli5
<b>🔖Shifri</b> : $shifr5
<b>📚Qabul rejasi : (
📊Davlat granti : </b>$qgarant5
<b>💳To‘lov shartnoma : </b>$qshart5<b>
)</b>
<b>📈O‘tish bali : (
📊Davlat granti : </b> $ogarant5
<b>💳To‘lov shartnoma : </b> $oshart5<b>
)</b>",
'parse_mode'=>"html",
]);
$imtiyoz =$json['imtiyoz']['0']['Imtiyozball'];
$cefr =$json['imtiyoz']['0']['CEFRball'];
$ijod =$json['imtiyoz']['0']['Ijodiyball'];
$serti =$json['imtiyoz']['0']['serti'];
echo $imtiyoz;
  bot('sendMessage',[
            'chat_id'=>$cid2,
            'text'=>"<b>🎁 Imtiyozlar</b> 
            
<b>👤Imtiyoz ball</b> :  $imtiyoz
<b>📝CEFR ball</b> : $cefr
<b>📄Ijodiy ball</b> : $ijod
<b>📋Milliy sertifikat ball / Olimpiada</b> : $serti
<b>📊Umumiy ball</b> : $ball


",
'parse_mode'=>"html",
]);
$texts = ""; // Initialize an empty string to store the combined text

for ($i = 0; $i < 5; $i++) {
    $a = $i + 1;
    $blockt = $json['block'][$i]['block'];
    $savol = $json['block'][$i]['savol'];
    $javob = $json['block'][$i]['answer'];
    $vall = $json['block'][$i]['ball'];

    $texts .= "<b>🗂 $a - Block</b> 
<b>📚Block turi</b> : $blockt
<b>📑Savollar soni</b> : $savol ta
<b>📋Togri javoblar</b> : $javob ta
<b>📊Ball</b> : $vall

";
}

bot('sendMessage', [
    'chat_id' => $cid2,
    'text' => $texts,
    'parse_mode' => "html",
]);
$texts2 = ""; // Initialize an empty string to store the combined text

for ($i = 0; $i < 90; $i++) {
    $a = $i + 1;
    $blockt = $json['answers'][$i]['question'];
    $savol = $json['answers'][$i]['point'];
    $javob = $json['answers'][$i]['answer'];
    $vall = $json['answers'][$i]['check'];

    $texts2 .= "<b>📚$blockt$savol</b>$javob<b>$vall</b>
";
}

bot('sendMessage', [
    'chat_id' => $cid2,
    'text' =>"$texts2
    
<b>* - 2 va undan ortiq javoblar belgilangan
** - javob belgilanmagan</b>",
    'parse_mode' => "html",
]);
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
}
?>