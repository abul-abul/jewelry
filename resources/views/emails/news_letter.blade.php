<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


</head>
<body>
	<p>{!! $content !!}</p>
	<br />
	<form action="{{action('UserController@getUnsubscribe')}}">
		<input type="hidden" name="id" @if(isset($user_id)) value="{{$user_id}}" @else value="{{$user_ip}}" @endif>
		<button type="submit" value="Unsubscribe" class="btn btn-default" />
	</form>
</body>
</html>