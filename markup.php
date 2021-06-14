<?php

// Akmal Isakulov
// github.com/isakulovDev
// t.me/isakulovDev



$API_KEY = "BOT_TOKEN";
define('API_KEY',$API_KEY);
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
$message = $update->message;
$tx = $message->text;
$cid = $message->chat->id;
$ism = $message->from->first_name;
$inline = $update->callback_query->data;
$cid2 = $update->callback_query->message->chat->id; 
$reply = $message->reply_to_message->text;  



$rpl = json_encode([
    'resize_keyboard'=>false,
    'force_reply'=>true,
    'selective'=>true
     ]);
$htm=json_encode([
'inline_keyboard'=>[
[['text'=>'Html','callback_data'=>'html'],['text'=>'MarkDown','callback_data'=>'mark']],
]
]);


If($tx=="/start"){
Bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*Assalomu alaykum

Bot siz yuborgan matnni HTML va MarkDown Tarzida yuboradi*",
'parse_mode'=>'markdown',
'reply_markup'=>$htm,
]);
}


If($inline=="html"){
Bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"Html uchun xabar kiriting",
'reply_markup'=>$rpl,
]);
}


If($reply=="Html uchun xabar kiriting"){
Bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"$tx",
'parse_mode'=>'html',
]);
}


If($inline=="mark"){
Bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"Markdown uchun xabar kiriting",
'reply_markup'=>$rpl,
]);
}


If($reply=="Markdown uchun xabar kiriting"){
Bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"$tx",
'parse_mode'=>'markdown',
]);
}


//Akmal Isakulov