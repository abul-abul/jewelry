@extends('layouts.app')



@section('content')
{!! HTML::style( asset('new-css/collections.css')) !!}
<!-- <section class="page-top">
	<div class="container">
		<div class="page-top-in">
			<ol class="breadcrumb pull-left">
				<li>
					<a href="{{action('UserController@getIndex')}}">Home</a>
				</li>
				<li>
					<a href="{{URL::to('collection/collections')}}">Collections</a>
				</li>

			</ol>
		</div>
	</div>
</section> -->
<div class="container collection-cont">
<h1>JEWELRY COLLECTIONS</h1>

	<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
	@foreach($collections as $key => $collection)
		@if($key%6 == 0)
		<div class="col-md-5 col-sm-6 col-xs-6 col-lg-5 first_coll collection" data-id="{{$collection->id}}">
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><p class="coll_name {{$collection->id}}">{{$collection->name}}</p></a>
			<p class="collection-description ">{{$collection->description}}</p>
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><img src="/uploads/{{$collection->image}}" class="img-responsive collection-responsive" alt="{{$collection->alt}}"></a>
		</div>

		@elseif($key%6 == 1) 

		<div class="col-md-5 col-sm-6 col-xs-6 col-lg-5 second_coll collection" data-id="{{$collection->id}}">
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><p class="coll_name {{$collection->id}}">{{$collection->name}}</p></a>
			<p class="collection-description">{{$collection->description}}</p>
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><img src="/uploads/{{$collection->image}}" class="img-responsive collection-responsive" alt="{{$collection->alt}}"></a>
		</div>

		@elseif($key%6 == 2)

		<div class="col-md-5 col-sm-6 col-xs-6 col-lg-5 third_coll collection" data-id="{{$collection->id}}">
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><p class="coll_name {{$collection->id}}">{{$collection->name}}</p></a>
			<p class="collection-description ">{{$collection->description}}</p>
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><img src="/uploads/{{$collection->image}}" class="img-responsive collection-responsive" alt="{{$collection->alt}}"></a>
		</div>

		@elseif($key%6 == 3)

		<div class="col-md-5 col-sm-6 col-xs-6 col-lg-5 fourth_coll collection" data-id="{{$collection->id}}">
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><p class="coll_name {{$collection->id}}">{{$collection->name}}</p></a>
			<p class="collection-description ">{{$collection->description}}</p>
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><img src="/uploads/{{$collection->image}}" class="img-responsive collection-responsive" alt="{{$collection->alt}}"></a>
		</div>

		@elseif($key%6 == 4)

		<div class="col-md-5 col-sm-6 col-xs-6 col-lg-5 fivth_coll collection" data-id="{{$collection->id}}">
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><p class="coll_name {{$collection->id}}">{{$collection->name}}</p></a>
			<p class="collection-description ">{{$collection->description}}</p>
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><img src="/uploads/{{$collection->image}}" class="img-responsive collection-responsive" alt="{{$collection->alt}}"></a>
		</div>

		@elseif($key%6 == 5)

		<div class="col-md-5 col-sm-6 col-xs-6 col-lg-5 sixth_coll collection" data-id="{{$collection->id}}">
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><p class="coll_name {{$collection->id}}">{{$collection->name}}</p></a>
			<p class="collection-description ">{{$collection->description}}</p>
			<a href="{{URL::to('item/items',['collection', $collection->name,'noSort'])}}"><img src="/uploads/{{$collection->image}}" class="img-responsive collection-responsive" alt="{{$collection->alt}}"></a>
		</div>

		@endif
		@endforeach
	</div>
{{--<h2 class="col-md-12"><b>#OHSCARLETT</b></h2>--}}

{{--<h4 class="col-md-12 instagram-tag"><b>Tag a photo on <i class="fa fa-instagram"></i> for a chance to be featured in our gallery. |<a href="#"> <ins>VIEW MORE</ins></a></b></h4>--}}
</div>
@endsection