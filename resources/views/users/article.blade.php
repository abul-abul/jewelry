 @extends('layouts.app')
 @section('content')

{!! HTML::style( asset('new-css/article.css')) !!}

<div role="main" class="main">		
<!-- Begin page top -->
	<section class="page-top">
		<div class="container">
			<div class="page-top-in">
				<h2><span>Blog</span></h2>
			</div>
		</div>
	</section>			
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="blog-posts single-post"> 
					<article class="post post-large blog-single-post"> 
						<p class="article_title">{{$article->title}}</p>
						<div class="post-meta">
						</div>
						<section class="main-slide border">
							<div id="owl-main-demo" class="owl-carousel main-demo " >
								@foreach($article->blogImages as $image)
								<div class="item" id="item1">
									<img src="/uploads/{{$image->name}}" class="img-responsive slider-image" alt="Photo">
								</div>
								@endforeach
							</div>
						</section>
						<div class="post-content">
							<p>{{$article->content}}</p>
								@if($article->video)
								<iframe style="width: 600px; height: 400px;" class="blog_video" src='https://www.youtube.com/embed/{{$article->video}}'></iframe>
								@endif
						</div>
					</article>
					<div class="related-posts">
						<h3>You might also like</h3>
						<div class="container">
							<div class="row">
								<div class="blog-posts">
									<div class="blog-masonry">
										@foreach($arts as $art)
										<div class="col-xs-6 col-md-4 post-mansory-item animation"> 
											<article class="post post-medium">
												<div class="post-image single">
												<a href="{{URL::to('blog/article',[$art->title, $art->id])}}">
													<img src="/uploads/{{$art->img}}" class="blog-image" alt="Photo" width="100%" height="250px"></a>
												</div>
												<div class="post-content">
													<h3><a href="{{URL::to('blog/article',[$art->title, $art->id])}}">{{$art->title}}</a></h3>
													
													<p class="article-content dot-ellipsis dot-height-150">{{$art->content}}</p>
													@if(strlen($art->content) > 250)
													<a type="button" class="btn btn-default btn-xs" href="{{URL::to('blog/article',[$art->title, $art->id])}}">View More</a>
													@else
													@endif
													<div class="post-meta post-meta-foot">
														<span class="pull-left"><i class="fa fa-clock-o"></i> {{$art->date}}</span>
													</div>
												</div>									
											</article>
										</div>
										@endforeach						
									</div>
								</div>			
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
<!-- End Main -->
@endsection