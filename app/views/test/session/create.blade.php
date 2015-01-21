<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Session</title>
</head>
<body>
	<form action="{{URL::route('test.session.store')}}" method="post">
		<input type="text" name="data" />
		<input type="submit" value="submit" />
	</form>
</body>
</html>