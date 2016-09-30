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
$message = 'russik say hi';
sendMessage($token, $id, $message);
function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=". $message);
}
file_put_contents("logs.txt",$id);