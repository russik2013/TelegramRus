<?php
/**
 * Created by PhpStorm.
 * User: russik
 * Date: 19.09.2016
 * Time: 20:50
 */
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$token = '272967076:AAFnC6WbVpExcWWoSXf1TUTE1WlnRiyKLrQ';

sendMessage($id, $token ); 

function sendMessage($token, $id){

    file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$id."&text=i can see you");

}

file_put_contents("logs.txt",$id);