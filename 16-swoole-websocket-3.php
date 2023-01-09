<?php


class WebSocketServer
{
	private $server = null;
	public $key = 'ziruchu';

	public function __construct()
	{
		$this->server = new Swoole\WebSocket\Server('0.0.0.0', 9501);

		// 设置心跳检测
		$this->server->set([
			'heartbeat_idle_time'      => 60,
			'heartbeat_check_interval' => 10,
		]);

		$this->server->on('Open', [$this, 'onOpen']);
		$this->server->on('Message', [$this, 'onMessage']);
		$this->server->on('Close', [$this, 'onClose']);
	}


	public function onOpen($server, $request)
	{
		$this->checkAccess($server, $request);
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

	/**
	 * 验证客户端连接
	 * 
	 * @param  [type] $server  [description]
	 * @param  [type] $request [description]
	 * @return [type]          [description]
	 */
	public function checkAccess($server, $request)
	{

		// 若某个参数不存在，则关闭当前连接
		if (!isset($request->get) || !isset($request->get['id']) || !isset($request->get['token'])) {
			$server->close($request->fd);
			return false;
		}

		$id    = $request->get['id'];
		$token = $request->get['token'];

		
		// 校验 token
		if (md5(md5($id) . $this->key) != $token) {
			$server->close($request->fd);
			return false;
		}

	}
}

$server = new WebSocketServer();

$server->start();



