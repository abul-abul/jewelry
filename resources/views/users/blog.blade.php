 @extends('layouts.app')

 @section('content')

{!! HTML::style( asset('new-css/blog.css')) !!}

<h1 class="home_title">jewelry blog</h1>

<div role="main" class="main">
	<section class="page-top" >
		<div class="container" >
			<div class="page-top-in" >
				<h2><span> Blog </span></h2> 
			</div>
		</div>
	</section>			
	<div class="container">
		<div class="row">
			<div class="blog-posts">
				<div class="blog-masonry">
					@foreach($articles as $article)
					<div class="col-xs-6 col-md-4 animation">
						<article class="post post-medium">
							<div class="post-image single">
							<a href="{{URL::to('blog/article',[$article->title, $article->id])}}">
								<img class="block_images blog-image" src="/uploads/{{$article->image}}"  alt="{{$article->alt}}" ></a>
							</div>
							<div class="post-content">
								<h3><a href="{{URL::to('blog/article',[$article->title, $article->id])}}">{{$article->title}}</a></h3>
								
								<p class="article-content dot-ellipsis dot-height-85">{{$article->content}}</p>
								@if(strlen($article->content) > 250)
								<a  class="btn btn-sm btn-default" href="{{URL::to('blog/article',[$article->title, $article->id])}}">View More</a>
								@else
								@endif
								<div class="post-meta post-meta-foot">
									<span class="pull-left"><i class="fa fa-clock-o"></i> {{$article->date}}</span>
								</div>
							</div>									
						</article>
					</div>
					@endforeach						
				</div>
				<div class="row">
					{{ $articles->links() }}
				</div>
			</div>			
		</div>
	</div>
</div>
 @endsection