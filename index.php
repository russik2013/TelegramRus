<?php
/**
 * Created by PhpStorm.
 * User: russik
 * Date: 19.09.2016
 * Time: 20:50
 */
print_r($_COOKIE);
file_put_contents('logs.txt', $_COOKIE);
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = '272967076:AAFnC6WbVpExcWWoSXf1TUTE1WlnRiyKLrQ';

if(isset($output['inline_query'])){
    $id = $output['inline_query']['from']['id'];


    $input_context = array(
        "message_text" => "russik is cool"
    );
//$fuck = file_get_contents("errors.txt");

    $gen = array( "type" => "article",
        "id" => "2",
        "title" => "Very cool?",
        "input_message_content" => array("message_text"=>"very cool")
    );
    $home = array( "type" => "article",
        "id" => "1",
        "title" => "You are cool", 
        "input_message_content" => array("message_text"=>"I'm cool" ,
            "parse_mode" => "HTML"),

    );
    $drug = json_encode([$gen,$home]);

    file_get_contents("https://api.telegram.org/bot".$token."/answerInlineQuery?inline_query_id=".$output['inline_query']['id']."&results=".$drug."&cache_time=1");
}

if (isset($output['callback_query']['data'])) {
    checkInline($output, $token);
}

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
    case 'inline_keyboard':
        $message = 'DONE';
        sendMessage($token, $id, $message.inlineKeyboard());
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
    $buttons = [['hi'],['how are you?'],['inline_keyboard']];
   $keyboard =json_encode($keyboard =['keyboard' => $buttons,
                                      'resize_keyboard' => true,
                                      'one_time_keyboard' => false,
                                      'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;

}

function inlineKeyboard(){

    $reply_markup = '';

    $x1 = array('text' => 'Inline_one', 'callback_data' => 'Inline_one');
    $x2 = array('text' => 'Inline_five', 'callback_data' => 'Inline_five');
    $opz = [[$x1], [$x2]];

    $keyboard = array("inline_keyboard" => $opz);

    $keyboard = json_encode($keyboard, true);
    $reply_markup = '&reply_markup='.$keyboard;
    return $reply_markup;
}

function checkInline($output, $token)
{
        $id = $output['callback_query']['message']['chat']['id'];
        $message = $output['callback_query']['data'];
        sendMessage($token, $id, $message);
}



