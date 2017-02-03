@extends('layouts.app')
@section('content')
<div class="container" style="margin-bottom: 50px;">
	<h1 class="home_title">about jewellery</h1> 
	<div class="page-top"></div>
	<div class="col-md-7">
		<span style="font-size:2em">About OhScarlett Jewelry</span><br /><br />
		<p>
			<label style=" font:italic 1.7em Georgia, serif;">Hello and welcome to Oh Scarlett.</label></p>
			<p> We are a small design house with very skilled artisans who help to design and create the items you will see on this site. Our factory is not some dingy sweat shop, or some space age mega factory. We are a small factory where people are known by name, not by their employee number and are more like family than employees.
			</p>
		<p>	Our name Oh Scarlett comes from our daughter whose name is Scarlett, and the oh part, because her slightly older brother was always saying " oh Scarlett ! " We are a family business, the dad ( that is me writing this ) sees to the sales and marketing, and the mom sees to the daily running of production. Cash and Scarlett, our two children see to having fun and being happy children, they can work later there is always time for that in their future.
		</p>
		<p>	We have been in the jewelry business for the past twenty years. I have worked as production manager for other companies in Bali, and marketing managers for factories in Thailand where we reside part of the time. We decided to venture out on our own about 13 years ago to have the freedom to do what we wanted and the ability to shape our own future. Being self employed is not easy but it was the best decision for us.</p>

		<p>	We try to do business in a fair and ethical way, as we want our children to learn from our example and inherit something of which they can be proud. We hope you like what we produce and that you wear it in good health..</p>

		<label style="font:italic 1.7em Georgia, serif;">	Sincerely, the Oh Scarlett jewelry family.</label>
		
	</div>
	<div class="col-md-5">
		<img alt="jeweler" src="{{URL::asset('/seederImg/about_shop.jpg')}}" style="display: block; width: 100%; ">

	</div>
	
</div>
@endsection