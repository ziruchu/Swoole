<?php

class Client
{
	private $client = null;

	public function __construct()
	{
		$this->client = new Swoole\Client(SWOOLE_SOCK_TCP);

		if (!$this->client->connect('127.0.0.1', 9502)) {
			throw new Exception('连接失败');
		}
	}

	public function sendData($data)
	{
		$data = $this->togetherDataByEof($data);
		$this->client->send($data);
	}

	public function togetherDataByEof($data)
	{
		if (!is_array($data)) {
			return false;
		}

		return json_encode($data) . "\r\n";
	}
}

$client = new Client;
$client->sendData([
	'event' => 'alertTip',
	'id' => 1,
]);