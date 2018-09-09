<?php

require_once('./line/line_class.php');
require_once('./config.php');

include "./Math/EvalMath.php";
include "./Math/Stack.php";


$client = new LINEBot($channelAccessToken, $channelSecret);

$userId         = $client->parseEvents()[0]['source']['userId'];
$replyToken     = $client->parseEvents()[0]['replyToken'];
$timestamp      = $client->parseEvents()[0]['timestamp'];
$message        = $client->parseEvents()[0]['message'];
$messageid      = $client->parseEvents()[0]['message']['id'];
$profil         = $client->profil($userId);

$msg_receive   = $message['text'];
$type 		= $client->parseEvents()[0]['type'];

if($message['type']=='text'){

	$msg_xpl = explode(" ", $msg_receive);
	$keyword = $msg_xpl[0];

	if($keyword=='help') {

		$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
					'type' => 'text',                   
					'text' => 'Perintah :
>help
>hitung'
				)
			)
		);

		$client->replyMessage($balas);

	}elseif($keyword=='hitung'){

		$m = new EvalMath;
		$result = $m->evaluate($msg_xpl[1]);

		$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
					'type' => 'text',                   
					'text' => $result
				)
			)
		);

		$client->replyMessage($balas);
	}elseif($keyword=='tes'){

		$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
					'type' => 'text',                   
					'text' => 'tis'
				)
			)
		);
		
		$client->replyMessage($balas);
	}elseif($keyword=='menu'){

		$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
					{
  "type": "template",
  "altText": "fanisa cantid",
  "template": {
    "type": "carousel",
    "actions": [],
    "columns": [
      {
        "thumbnailImageUrl": "https://t00.deviantart.net/HSDuZYGxN2JuJgx9g7LssqgR7ik=/fit-in/500x250/filters:fixed_height(100,100):origin()/pre00/d417/th/pre/f/2018/175/7/1/_minimalist__zero_two___darling_in_the_franxx_by_kiddblaster-dcfcrjw.jpg",
        "title": "Menu",
        "text": "List Menu",
        "actions": [
          {
            "type": "message",
            "label": "text",
            "text": "kntl"
          },
          {
            "type": "message",
            "label": "text2",
            "text": "kental"
          }
        ]
      },
      {
        "thumbnailImageUrl": "https://t00.deviantart.net/HSDuZYGxN2JuJgx9g7LssqgR7ik=/fit-in/500x250/filters:fixed_height(100,100):origin()/pre00/d417/th/pre/f/2018/175/7/1/_minimalist__zero_two___darling_in_the_franxx_by_kiddblaster-dcfcrjw.jpg",
        "title": "Menu",
        "text": "List Menu",
        "actions": [
          {
            "type": "message",
            "label": "Hitung",
            "text": "=>hitung 8*8"
          },
          {
            "type": "uri",
            "label": "Creator",
            "uri": "http://line.me/ti/p/~alkhoarizmy",
          }
        ]
      }
    ]
  }
				)
			)
		);
		
		$client->replyMessage($balas);
	}
}
}