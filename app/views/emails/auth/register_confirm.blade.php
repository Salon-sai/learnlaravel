<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Active E-mail</h2>

		<div>
			To active your e-mail, complete this form: {{ URL::route('register.auth', array($activationCode,$id)) }}.<br/>
			This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
		</div>
	</body>
</html>
