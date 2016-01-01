<?php

class erLhcoreClassExtensionTelegram {

	public function __construct() {
		
	}
	 
	public function run() {
		
		$dispatcher = erLhcoreClassChatEventDispatcher::getInstance();
		
		// Attatch event listeners
		$dispatcher->listen('chat.chat_started', array($this,'telegram'));
	}
		
	/**
	 * Arguments
	 * array('chat' => & $chat)
	 * */
	public function telegram($params) {

		$conf = include 'extension/telegram/settings/settings.ini.php';

		$url = 'http://api.telegram.org/bot'.$conf['telegramBot'].'/sendMessage?parse_mode=Markdown';

		$chat = $params['chat'];

        foreach ($conf['receivers'] as $receiver) {

            $internalurl = $url."&chat_id=".preg_replace('/[^0-9.]+/', '', $receiver['chatid']);

            $text = "``` Nova solicitação de suporte via chat - ";
            $text = (isset($chat->nick)) ? $text.$chat->nick : $text;
            $text = (isset($chat->email)) ? $text." ( ".$chat->email." )" : $text;
            $text .= "```";

            if (isset($receiver['operator'])) {

                $veryfyEmail = sha1(sha1($receiver['operator'].$secretHash).$secretHash);
                     
                $link = erLhcoreClassXMP::getBaseHost();
                $link .= $_SERVER['HTTP_HOST'];
                $link .= erLhcoreClassDesign::baseurl('chat/accept').'/';
                $link .= erLhcoreClassModelChatAccept::generateAcceptLink($chat).'/';
                $link .= $veryfyEmail.'/'.$receiver['operator'];
                        
                $text .= "\n".$link;

            }

            $text .= "```";
            $internalurl .= "&text=".urlencode($text);
            file_get_contents($internalurl);

        }

	}

}
