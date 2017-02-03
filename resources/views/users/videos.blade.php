 @extends('layouts.app')
 @section('content') 
 {!! HTML::style( asset('new-css/videos.css')) !!}			
		<!-- Begin Main -->
		<div role="main" class="main">
		
			<!-- Begin page top -->
			<section class="page-top-md">
				<div class="container">
					<div class="page-top-in">
						<h2><span>Videos</span></h2>
					</div>
				</div>
			</section>
			<!-- End page top -->
			
			<div class="container">
				<div class="row">
					<div class="blog-posts">
						<div class="blog-masonry">
						@foreach($videoArray as $data)
							<div class="col-xs-6 col-md-4 post-mansory-item animation">
								<article class="post post-medium">
									<div class="post-image single">
										<iframe height="315" src='https://www.youtube.com/embed/{{$data["video"]}}'></iframe>
									</div>
									<div class="post-content">
								<h3><a href="{{URL::to('item/item',[$data->items->collection->name, $data->items->category->category, $data->items->slug])}}">{{$data->items->title}}</a></h3>
										<div class="post-meta">

											
										</div>
									
									
										<div class="col-md-4">
										</div>
										<div class="post-meta post-meta-foot">
											<span class="pull-left"><i class="fa fa-clock-o"></i>{{$data->items->date}}</span>
										</div>
									</div>
									
								</article>
							</div>
							
						@endforeach
						</div>

					</div>
					{!! $videoArray->render() !!}
					
				</div>
				
					
			</div>
			
		</div>
		<!-- End Main -->
		@endsection	