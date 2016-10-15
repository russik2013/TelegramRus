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
    case '/start':
        $message = 'Бот поддерживает следующие команды : 1. hi; 2. how are you?. 3. ..... ';
        sendMessage($token, $id, $message);
        break;
    case 'hi':
        $message = 'Hello';
        sendMessage($token, $id, $message.KeyboardMenu());
        break;
    case 'how are you?':
        $message = 'i am fine';
        sendMessage($token, $id, $message.KeyboardMenu());
        break;
    case 'inline keyboard':
        $message = 'inline on';
        sendMessage($token, $id, $message.InlineKeyboard());
        break;
    default:
        $message = 'What are you say?';
        sendMessage($token, $id, $message);
}

//sendMessage($token, $id, $message);
function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=". $message);
}
file_put_contents("logs.txt",$id);

function KeyboardMenu(){
    $buttons = [['hi'],['how are you?'],['inline keyboard']];
   $keyboard =json_encode($keyboard =['keyboard' => $buttons,
                                      'resize_keyboard' => true,
                                      'one_time_keyboard' => false,
                                      'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;

}

function InlineKeyboard(){
    $reply_markup = '';
    $x1 = array('text' => 'Inline_One','callback_data' => 'Inline_One');
    $x2 = array('text' => 'Inline_Two','callback_data' => 'Inline_Two');

    $opz = [[$x1], [$x2]];

    $keyboard = array("inline_keyboard" => $opz);

    $keyboard = json_encode($keyboard, true);

    $reply_markup = '&reply_markup='.$keyboard;

    return $reply_markup;
}




