<?php

class WebSocketServer
{
	private $server = null;
	public $key     = 'ziruchu';
	/**
	 * [
	 * 	用户 ID => fd 
	 * ]
	 * 
	 */
	public $userFds = [];


	public function __construct()
	{
		$this->server = new Swoole\WebSocket\Server('0.0.0.0', 9501);

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
		// 验证客户端连接
		$accessResult = $this->checkAccess($server, $request);
		if (!$accessResult) {
			return false;
		}

		// 客户度连接加入数组
		if (array_key_exists($request->get['id'], $this->userFds)) {
			$userFd = $this->userFds[$request->get['id']];
			$this->close($userFd, '用户已存在');
			$this->userFds[$request->get['id']] = $request->fd;
			return false;
		} else {
			$this->userFds[$request->get['id']] = $request->fd;
		}
	}

	public function onMessage($server, $frame)
	{
		// {"event":"alertTip", "id": 10}
		$data = json_decode($frame->data, true);

		if (!$data || !is_array($data) || empty($data['event'])) {
			$this->close($frame->fd, '数据格式错误');
			return false;
		}

		$method = $data['event'];
		if (!method_exists($this, $method)) {
			$this->close($frame->fd, '方法不存在');
			return false;
		}

		$this->$method($frame->fd, $data);
	}

	public function onClose($server, $fd)
	{
		echo '关闭连接: ' . $fd . PHP_EOL;
	}

	public function start()
	{
		$this->server->start();
	}

	public function checkAccess($server, $request)
	{
		if (!isset($request->get) || !isset($request->get['id']) || !isset($request->get['token'])) {
			$this->close($request->fd, '访问失败');
			return false;
		}


		$id    = $request->get['id'];
		$token = $request->get['token'];


		if (md5(md5($id). $this->key ) != $token) {
			$this->close($request->fd, 'token 验证失败');
			return false;
		}


		return true;
	}

	/**
	 * 消息提示
	 * 
	 * @param  int $fd   客户端连接标识
	 * @param  array $data 数据
	 * @return [type]       [description]
	 */
	public function alertTip($fd, $data)
	{
		if (empty($data['id']) || !array_key_exists($data['id'], $this->userFds)) {
			return false;
		}

		$userData = [
			'event'   =>	$data['event'],
			'message' => '你有新的回复，注意查看',
		];
		// 发送数据
		$this->push($this->userFds[$data['id']], $userData);
	}

	public function push($fd, $message)
	{
		if (!is_array($message)) {
			$message = [$message];
		}
		$message = json_encode($message);
		// 发送数据
		if ($this->server->push($fd, $message) == false) {
			$this->close($fd);
		}
	}

	/**
	 * 关闭连接
	 * 
	 * @param  int $fd 客户端标识
	 * @param  string $message 消息
	 * @return [type]          [description]
	 */
	public function close($fd, $message = '')
	{
		$this->server->close($fd);
		if ($id = array_search($fd, $this->userFds)) {
			unset($this->userFds[$id]);
		}
	}
}

$server = new WebSocketServer();
$server->start();

