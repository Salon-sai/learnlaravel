<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>success to create cache</title>
</head>
<body>
	<form action="{{URL::route('test.cache.show',0)}}">
		<input type="hidden" name="_token" value="{{$token}}" />
		<input type="submit" value="submit" />
	</form>
</body>
</html>