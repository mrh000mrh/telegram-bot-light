<?php
define('BOT_TOKEN','8222744145:AAHQ_4wnmVdKDjQ83k-0NNWIo_F-oeffBLo');
define('ADMIN_ID',95173864);            // ← آیدی عددی شما
define('DB','bot.db');                  // نام فایل دیتابیس

function db(){
    static $pdo;
    if(!$pdo) $pdo=new PDO('sqlite:'.DB);
    return $pdo;
}
function sendMessage($chat,$text,$kbd=null){
    $url='https://api.telegram.org/bot'.BOT_TOKEN.'/sendMessage';
    $post=['chat_id'=>$chat,'text'=>$text,'parse_mode'=>'HTML'];
    if($kbd) $post['reply_markup']=json_encode($kbd);
    curlPost($url,$post);
}
function curlPost($url,$post){
    $ch=curl_init($url);
    curl_setopt_array($ch,[
        CURLOPT_POST=>true,
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_POSTFIELDS=>$post
    ]);
    return curl_exec($ch);
}
