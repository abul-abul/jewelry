<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 


</head>
<body>
	<a href="{{action('UserController@getActivationUser',$activation_token)}}">Activate your account</a>
	<span>{{$username}}</span>
</body>
</html>