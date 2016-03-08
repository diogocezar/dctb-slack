<?php
	function slack($message, $channel){
		$ch = curl_init("https://slack.com/api/chat.postMessage");
		$data = http_build_query([
		    "token"    => "<SEU_TOKEN>",
			"channel"  => $channel,
			"text"     => $message,
			"username" => "nome_do_seu_bot",
		]);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		print($result);
		return $result;
	}
	slack("Mensagem", "#canal");
?>