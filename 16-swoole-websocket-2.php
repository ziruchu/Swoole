<?php


class WebSocketServer
{
	private $server = null;

	public function __construct()
	{
		$this->server = new Swoole\WebSocket\Server('0.0.0.0', 9501);
		$this->server->on('Open', [$this, 'onOpen']);
		$this->server->on('Message', [$this, 'onMessage']);
		$this->server->on('Close', [$this, 'onClose']);
	}


	public function onOpen($server, $request)
	{
		echo '客户端 ' . $request->fd . ' 连接成功' . PHP_EOL;
	}

	public function onMessage($server, $frame)
	{
		$server->push($frame->fd, '服务器返回数据：' . $frame->data);
	}

	public function onClose($server, $fd)
	{
		echo '客户端 ' . $fd . '已断开连接' . PHP_EOL;
	}

	public function start()
	{
		$this->server->start();
	}
}

$server = new WebSocketServer();

$server->start();



