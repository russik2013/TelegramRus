<?php
/**
 * Created by PhpStorm.
 * User: russik
 * Date: 19.09.2016
 * Time: 20:50
 */
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = '272967076:AAFnC6WbVpExcWWoSXf1TUTE1WlnRiyKLrQ';

switch ($message){

    case'hi':
        $message = 'Hello';
        sendMessage($token, $id, $message);

        break;

    case'how are you?':
        $message = 'I am fine, and you?';
        sendMessage($token, $id, $message);
        break;
    default:
        $message = 'What are you say?';
        sendMessage($token, $id, $message);
}

sendMessage($token, $id, $message);
function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=".$message);
}
//file_put_contents("logs.txt",$id);