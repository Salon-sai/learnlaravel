<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cache Test</title>
</head>
<body>
	{{Form::open(array(
		'url' 		=> URL::route('test.cache.store'),
		'method'	=> "post"
	))}}
		<input type="text" name="data"/>
		<input type="submit" value="submit"/>
	{{Form::close()}}
</body>
</html>