;(function($) {
	$.get('rest.php', function(data) {
		initChat(data);
	});

	function initChat(user) {
		var conn = new WebSocket('ws://localhost:8888'),
			$chatcount = $("#chatcount"),
			$inputMsg = $("#msginput"),
			$chatwindow = $("#messagewindow"),
			$userlist = $("#userlist");

		conn.onmessage = function(e) {
			translateMessage(e.data);
		}

		conn.onopen = function() {
			conn.send('{"user": {"username" : "' + user.username + '", "department": "' + user.department + '"}, "tipo": "userconnecting"}');
		}

		$inputMsg.on('keyup', function(e) {
			var $this = $(this);

			if (e.keyCode === 13) {
				sendMessage($this);
			}
		});

		function sendMessage($msg) {
			var data = '{"tipo": "message", "msg": "' + $msg.val() + '"}';
			conn.send(data);
			
			var msg = buildMessage('me: ' + $msg.val());
			msg.addClass('mine alert alert-info');

			appendMessage(msg);
			// limpar msg field
			$msg.val('');
		}

		function receiveMessage(txt) {
			var msg = buildMessage(txt);

			msg.addClass('others alert alert-success');
			appendMessage(msg);
		}

		function buildMessage(txt) {
			return $("<p />", { text: txt });
		}

		function appendMessage($msg) {
			$chatwindow.append($msg);
		}

		function translateMessage(jsontxt) {
			var json = $.parseJSON(jsontxt);

			switch(json.tipo) {
				case 'mainmessage':
					receiveMessage(json.msg);
					break;
				case 'userconnected':
					addNewUser(json);
					break;
				case 'inituserslist':
					initUsersList(json);
					break;

			}
		}

		function addNewUser (data) {
			var userCount = data.total,
				newUser = data.username;

			appendNewUser(newUser, userCount);
		}

		function appendNewUser (newUsername, total) {
			$chatcount.empty().html(total);
			$userlist.append($("<li />", { text: newUsername }));
		}

		function initUsersList (data) {
			$chatcount.empty().html(data.total);

			var list = "";
			data.users.forEach(function(val) {
				list += '<li>' + val.username + '</li>';
			});
			$userlist.append(list);
		}
	}
})(jQuery);