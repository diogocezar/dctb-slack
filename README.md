# Integração com o Slack

O slack é um serviço para gerenciamento de trabalhos em equipe.

Pode ser muito útil, em algum momento, enviar uma mensagem automática através de um bot para um dos seus canais.

Este script faz justamente isso.

Os passos mais complicados são os para a geração do Token.

## Como gerar o token

1. Assumindo que você já possui uma conta no slack entre em: https://api.slack.com/web
2. Acesse https://api.slack.com/applications e crie uma nova aplicação;
3. Toda a instrução de como gerar o token está detalhada aqui: https://api.slack.com/docs/oauth
4. Criando a requisição para permitir a aplicação:
	1. Após a criação do seu aplicativo observe os campos *client_id* e *client_secret*
	2. Acesse a url para solicitar a permissão do token: https://slack.com/oauth/authorize?client_id=<CLIENT_ID>&scope=channels:read channels:write chat:write:bot
	3. O scope é uma parâmetro com quais serão as permissões do aplicativo;
	4. Ao autorizar seu aplicativo para um determinado canal, ele te redirecionará para a url setada na configuração do aplicativo;
	5. Anote o código inserido na URL de retorno: <SUA_URL>code=...
	6. Acesse: https://slack.com/api/oauth.access?client_id=<CLIENT_ID>&code=<CODE>&client_secret=<CLIENT_SECRE>
	7. Anote o seu token que se parecerá com: xoxo-2100000415-0000000000-0000000000-ab1ab1
5. Após isso basta executar algum código semelhante à:

```
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
```

É isso ;)