<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>简版聊天</title>
</head>
<body>
	<?php
		$key = 'ziruchu';
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$token = md5(md5($id) . $key);
	?>


	<div>
		发送内容：<textarea name="content" id="content" cols="30" rows="10"></textarea><br>
		<!-- 用户 ID -->
		发送给谁：<input type="text" name="id" value="" id="userId"><br>
		<button onclick="send();">发送</button>
	</div>

	<script>
		let ws = new WebSocket("ws://127.0.0.1:9501?id=<?php echo $id ?>&token=<?php echo $token; ?>");
		ws.onopen = function(event) {
		}

		ws.onmessage = function (event) {
			let data = event.data;
			data = eval("("+data+")");
			if (data.event == 'alertTip') {
				alert(data.message);
			}
		}

	    ws.onclose = function(event) {
	        console.log('客户端关闭连接');
	    };

	    function send() {
	        let obj = document.getElementById('content');
	        let content = obj.value;
	        let userId = document.getElementById('userId').value;
	        ws.send('{"event":"alertTip", "id": '+userId+'}');
	    }


	</script>

</body>
</html>