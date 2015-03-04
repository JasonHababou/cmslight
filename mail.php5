<?php
	require('setup/setup_php.php5');
	require('includes/globals.php5');
	
	extract($_POST);
	if (isset($message) && strlen($message)
		&& isset($from) && preg_match('/^[a-zA-Z0-9\-\_\.]+[@][a-zA-Z0-9\-\_\.]+[\.][a-zA-Z]+$/', $from)
		&& isset($subject) && strlen($subject)) {
		mail('telecomsetreseauxtwn@free.fr', $subject, $message, sprintf("From: %s", $from));
		header('Content-type: text/html');
		printf('<html><head><link type="text/css" rel="stylesheet" href="css/default.css"></head>');
		printf('<body>Message envoyé</body></html>');
		die();
	}
?>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/default.css">
	<style>
	body {
		background: #F9F9F9;
	}
	table#container {
		margin-top: 40px;
		border: 1px solid #DDDDDD;
		background: white;
		padding: 12px 32px;
	}
	form {
		margin: 0px;
		padding: 0px;
	}
	input,textarea {
		border: 1px solid black;
		width: 400px;
	}
	input.error, textarea.error {
		background: #fff0f0;
		border: 1px solid red;
	}
	textarea {
		height: 200px;
	}
	</style>
	<script type="text/javascript">
	var color_error = '#fff0f0';
	var border_error = '1px solid red';
	function validate(f) {
		submit=true;
		if (!f.from.value.match(/^[a-zA-Z0-9\-\_\.]+[@][a-zA-Z0-9\-\_\.]+[\.][a-zA-Z]+$/)) {
			f.from.className = 'error';
			submit = false;
		}
		if (f.subject.value.length == 0 || f.subject.value == f.subject.defaultValue) {
			f.subject.className = 'error';
			submit = false;
		}
		if (f.message.value.length == 0 || f.message.value == f.message.defaultValue) {
			f.message.className = 'error';
			submit = false;
		}
		return submit;
	}
	function textbox_focused(tbox) {
		if (tbox.value == tbox.defaultValue) {
			tbox.value = '';
			tbox.style.fontStyle = 'normal';
		}
		tbox.className = 'input';
	}
	function textbox_blurred(tbox) {
		if (tbox.value == '') {
			tbox.value = tbox.defaultValue;
			tbox.style.fontStyle = 'italic';
		}
	}
	</script>
</head>
<body>
<table id="container" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
	<td>
	<form id="mail_form" method="post" action="#" onsubmit="return validate(this);">
	<table border="0" cellpadding="1" cellspacing="0">
	<tr>
		<td><input type="text" name="from" id="from" onfocus="textbox_focused(this)" onblur="textbox_blurred(this)" style="font-style:italic" value="votre adresse email" /></td>
	</tr>
	<tr>
		<td><input type="text" name="subject" id="subject" onfocus="textbox_focused(this)" onblur="textbox_blurred(this)" style="font-style:italic" value="sujet de votre message" /></td>
	</tr>
	<tr>
		<td><textarea name="message" onfocus="textbox_focused(this)" onblur="textbox_blurred(this)"></textarea></td>
	</tr>
	<tr>
		<td style="text-align:right"><input type="submit" value="Expédier" style="width:80px; background:#006699; color:white" /></td>
	</tr>
	</table>
	</form>
	</td>
</tr>
</table>
</body>
</html>