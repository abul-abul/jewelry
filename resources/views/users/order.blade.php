@extends('layouts.app')
@section('content')
<div class="col-md-4">
	<br />
	<p><a href="{{action('PaymentController@getPayPal')}}"><button class="btn btn-primary btn-block btn-sm">Order</button></a></p>
	<p><a href="{{action('UserController@getIndex')}}"><button class="btn btn-primary btn-block btn-sm">Cancel</button></a></p>
</div>
@endsection